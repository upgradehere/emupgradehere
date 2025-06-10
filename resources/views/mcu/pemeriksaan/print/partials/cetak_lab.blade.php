@php
    $table = array();
    $counter = 0;
    $limit   = 25;
    $table_count = 0;
    foreach ($laboratorium->detail as $lab) {
        if($counter == $limit) {
            $counter = 0;
            $table_count++;
        }

        $table[$table_count][$lab->group][$lab->type][] = $lab;

        $counter++;
    }
@endphp

@foreach ($table as $no => $lab)
    @if (!empty($laboratorium))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN LABORATORIUM'])
    @endif

    <table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr style="border-bottom: 2px solid black; font-size: 15px;">
                <td width="240px" align="left"><b>Nama Pemeriksaan</b></td>
                <td align="center"><b>Hasil</b></td>
                <td align="center"><b>Nilai Rujukan</b></td>
                <td align="center"><b>Kesan</b></td>
            </tr>
            @foreach ($lab as $group_name => $group)
                <tr>
                    <th align="left" colspan="4">{{ $group_name }}</th>
                </tr>
                @foreach ($group as $type_name => $type)
                    <tr>
                        <th style="padding-left: 20px; padding-right: 20px" align="left" colspan="4">{{ $type_name }}</th>
                    </tr>
                    @foreach ($type as $lab)
                        <tr>
                            <td style="padding-left: 30px; padding-right: 30px" width="240px" align="left">{{ $lab->laboratory_examination_name }}</td>
                            <td style="padding-left: 30px; padding-right: 30px" align="center">{{ $lab->result }}</td>
                            <td style="padding-left: 30px; padding-right: 30px" align="center">{{ $lab->reference_value }}</td>
                            <td style="padding-left: 30px; padding-right: 30px" align="center">{{ ($lab->is_abnormal == 1) ? 'Abnormal' : '' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr style="border-bottom: 2px solid black; font-size: 15px;">
                <td width="240px" align="left"><b>Catatan</b></td>
            </tr>
            <tr>
                <td>{{ $laboratorium->notes ?? '' }}</td>
            </tr>
        </tbody>
    </table>
    <div style="padding-top: 50px;">
	    <table style="width: 100%; font-size: 13px;" cellpadding="3">
	         <tr>
	            <td style="width: 60%; text-align: center; vertical-align: bottom;">
	            </td>
	            <td style="width: 40%; text-align: center; vertical-align: bottom;">
	                <img src="{{ public_path('uploads/doctor_sign/'.$doctor_sign[$laboratorium->doctor_id]) }}" style="max-width: 150px;"><br>
	                <b>{{ $doctor_list[$laboratorium->doctor_id] ?? '' }} </b>
	                <p style="border-top: 1px solid black; padding-top: 10px;"></p>
	            </td>
	        </tr>
	    </table>
	</div>
    @if(($no + 1) < count($table) )
        <div class="page-break"></div>
    @endif
@endforeach

