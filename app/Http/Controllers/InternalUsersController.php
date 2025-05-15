<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LookupC;
use App\Models\CompanyM;
use Validator;
use Session;

class InternalUsersController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $examinations = LookupC::where('lookup_type', 'examination_type')->get();
        $company = CompanyM::all();

        $data['examinations'] = $examinations;
        $data['company'] = $company;
        
        return view('internal-users/index', $data);
    }

    public function data(Request $request)
    {
        try {
            $query = User::query();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('name', 'ilike', '%' . $searchValue . '%')
                    ->orWhere('email', 'ilike', '%' . $searchValue . '%');
                });
            }

            $query->whereNotIn('id_role', [2, 5]);

            if ($request->has('order') && is_array($request->order)) {
                foreach ($request->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $request->columns[$columnIndex]['data'];
                    $direction = $order['dir'];
                    $query = $query->orderBy($columnName, $direction);
                }
            }
           
            // Total records before filtering
            $totalRecords = User::count();
        
            // Total records after filtering
            $filteredRecords = $query->count();

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();

            // Map additional fields
            $data = $data->map(function ($item) {
                if ($item->id_role == 1) {
                    $item->role = 'Super Admin';
                    if ($item->id_company != NULL) {
                        $item->role = 'Small Admin';
                    }
                } else if ($item->id_role == 3) {
                    $item->role = 'Checker';
                } else if ($item->id_role == 4) {
                    $item->role = 'CSO';
                }

                return $item;
            });

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'id_role' => 'required',
            'examination_type' => 'required_if:id_role,3',
            'id_company' => 'required_if:id_role,11',
        ];
        
        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'phone_number.required' => 'No Telp wajib diisi',
            'password.required' => 'Password wajib diisi',
            'id_role.required' => 'Role wajib diisi',
            'examination_type.required_if' => 'Examination Type wajib diisi jika role yang dipilih adalah Checker',
            'id_company.required_if' => 'Perusahaan wajib diisi jika role yang dipilih adalah Small Admin',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('internal-users');
        }

        $check = User::withTrashed()
                        ->where('email', $request->email)
                        ->first();
        if ($check) {
            session()->flash('error', 'Email yang diinput sudah pernah terdaftar');
            return redirect()->route('internal-users');
        }

        $user = new User;
        foreach ($request->all() as $k => $r) {
            if ($k != '_token') {
                if ($k == 'password') {
                    $user->$k = Hash::make($request->password);
                } else {
                    $user->$k = $r;
                }
            }
        }

        if ($user->id_role == 11) {
            $user->id_role = 1;
        }

        if($user->save()) {
            session()->flash('success', 'Internal User berhasil disimpan');
        } else {
            session()->flash('error', 'Kesalahan terjadi, Internal User gagal disimpan, harap hubungi Admin kami');
        }

        return redirect()->route('internal-users');
        
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            $data = [
                'status' => 'success',
                'message' => 'Delete success',
            ];
            
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Delete failed',
                'data' => 'Kesalahan terjadi, data gagal dihapus, harap hubungi Admin kami',
            ];

            return response()->json($data, 200);
        }
    }

    public function detail($id)
    {
        $data = [];
        $user = User::find($id);
        $examinations = LookupC::where('lookup_type', 'examination_type')->get();
        $company = CompanyM::all();
        
        if ($user && $examinations) {
            $data['user'] = $user;
            $data['examinations'] = $examinations;
            $data['company'] = $company;

            return view('internal-users/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'id_role' => 'required',
            'examination_type' => 'required_if:id_role,3',
            'id_company' => 'required_if:id_role,11',
        ];

        $messages = [
            'id.required' => 'User tidak dipilih',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'phone_number.required' => 'No Telp wajib diisi',
            'id_role.required' => 'Role wajib diisi',
            'examination_type.required_if' => 'Examination Type wajib diisi jika role yang dipilih adalah Checker',
            'id_company.required_if' => 'Perusahaan wajib diisi jika role yang dipilih adalah Small Admin',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('internal-users.detail', ['id' => $id]);
        }

        $user = User::find($id);

        if ($user) {
            // check email duplicate
            if ($user->email != $request->email) {
                $check = User::withTrashed()
                            ->where('email', $request->email)
                            ->first();
    
                if ($check) {
                    session()->flash('error', 'Email yang diinput sudah pernah terdaftar');
                    return redirect()->route('internal-users.detail', ['id' => $id]);
                }
            }

            foreach ($request->all() as $k => $r) {
                if ($k != '_token' && $k != 'id') {
                    if ($k == 'password') {
                        $user->$k = Hash::make($request->password);
                    } else {
                        $user->$k = $r;
                    }
                }
            }
    
            if ($user->id_role != 3) {
                $user->examination_type = NULL;
            }

            if ($user->id_role != 11) {
                $user->id_company = NULL;
            } else {
                $user->id_role = 1;
            }

            if($user->save()) {
                session()->flash('success', 'Internal User berhasil diperbarui');
            } else {
                session()->flash('error', 'Kesalahan terjadi, Internal User baru gagal diperbarui, harap hubungi Admin kami');
            }
        } else {
            session()->flash('error', 'Internal User tidak ditemukan');
        }

        return redirect()->route('internal-users');
    }
}
