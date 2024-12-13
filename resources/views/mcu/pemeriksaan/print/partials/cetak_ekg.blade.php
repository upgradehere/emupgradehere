<h4>EKG</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
            	<table>
		            <tr>
		                <td>Irama</td>
		                <td>{{ $ekg->rhythm ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Rate</td>
		                <td>{{ $ekg->rate ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Axis</td>
		                <td>{{ $ekg->axis ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kelainan</td>
		                <td>{{ $ekg->abnormality ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
            <td>
         		<table>
		            <tr>
		                <td>Kesimpulan</td>
		                <td>{{ $ekg->conclusion ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Saran</td>
		                <td>{{ $ekg->suggestion ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Abnormal</td>
		                <td>{{ $ekg->is_abnormal ? 'Yes' : 'No' }}</td>
		            </tr>
		            <tr>
		                <td>Pemeriksa</td>
		                <td>{{ $ekg->doctor_id ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
        </tr>
    </tbody>
</table>
