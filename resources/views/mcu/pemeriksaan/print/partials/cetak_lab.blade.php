@php
    $grup = array();
    foreach ($laboratorium->detail as $lab) {
        $grup[$lab->group][$lab->type][] = $lab; 
    }
@endphp

<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
    <tbody>
        <tr style="border-bottom: 2px solid black; font-size: 15px;">
            <td width="240px" align="left"><b>Nama Pemeriksaan</b></td>
            <td align="left"><b>Hasil</b></td>
            <td align="left"><b>Nilai Rujukan</b></td>
            <td align="center"><b>Kesan</b></td>
        </tr>
        @foreach ($grup as $group_name => $group)
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
                        <td style="padding-left: 30px; padding-right: 30px" align="left">{{ $lab->result }}</td>
                        <td style="padding-left: 30px; padding-right: 30px" align="left">{{ $lab->reference_value }}</td>
                        <td style="padding-left: 30px; padding-right: 30px" align="center">{{ ($lab->is_abnormal == 1) ? 'Abnormal' : '' }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
</table>
