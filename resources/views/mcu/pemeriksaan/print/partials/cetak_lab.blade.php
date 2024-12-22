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
    @if(($no + 1) < count($table) )
        <div class="page-break"></div>
    @endif
@endforeach

