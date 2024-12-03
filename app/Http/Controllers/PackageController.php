<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageM;
use Validator;
use Session;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        return view('package/package');
    }

    public function getDataPackage(Request $request)
    {
        try {
            $model = new PackageM();
            $query = $model->select();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('package_name', 'ilike', '%' . $searchValue . '%');
                });
            }

            if ($request->has('order') && is_array($request->order)) {
                foreach ($request->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $request->columns[$columnIndex]['data'];
                    $direction = $order['dir'];
                    $query = $query->orderBy($columnName, $direction);
                }
            }

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();
            $totalRecords = $model->count();
            $filteredRecords = $query->count();

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
            'package_name' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
        ];

        $messages = [
            'package_name.required' => 'Nama Paket wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'desc.required' => 'Deskripsi Paket wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('package');
        }

        $package = new PackageM;
        $package->package_name = $request->package_name;
        $package->price = $request->price;
        $package->desc = $request->desc;

        $package->save();

        session()->flash('success', 'Paket beru telah disimpan');
        return redirect()->route('package');
    }

    public function delete($id)
    {
        $package = PackageM::find($id);

        if ($package->delete()) {
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
        $package = PackageM::find($id);
        
        if ($package) {
            $data['package'] = $package;
            
            return view('package/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'package_name' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
        ];

        $messages = [
            'package_name.required' => 'Nama Paket wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'desc.required' => 'Deskripsi Paket wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('package.detail', ['id' => $id]);
        }

        $package = PackageM::find($id);
        $package->package_name = $request->package_name;
        $package->price = $request->price;
        $package->desc = $request->desc;

        $package->save();

        session()->flash('success', 'Paket diperbarui');
        return redirect()->route('package.detail', ['id' => $id]);
    }
}
