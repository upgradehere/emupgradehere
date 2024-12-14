<div class="no-break">
	<h4>USG</h4>
	<table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
	    <thead>
	        <tr>
	            <th colspan="2" scope="col" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Gambar Hasil USG </th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr style="padding-bottom: 50px;">
	            <td colspan="2"> {{ '-' }} <br><br></td>
	        </tr>
	        <tr>
	            <th colspan="2" scope="col" align="left" style="border-bottom: 2px solid black; font-size: 15px;">Hasil USG</th>
	        </tr>
	        <tr>
	            <td>
	                <table cellpadding="3" style="width: 100%;">
	                    <tr>
	                        <td align="left" width="20%"><b>Hepar</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->liver ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kantong Empedu</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->gallbladder ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Pankreas</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->pancreas ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Lien</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->lien ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Ginjal</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->kidney ?? 'N/A' }}</td>
	                    </tr>
	                </table>
	            </td>
	            <td>
	                <table cellpadding="3" style="width: 100%;">
	                    <tr>
	                        <td align="left" width="20%"><b>Buli Buli</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->bladder ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Prostat/Uterus</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->prostat ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kesan</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->classification ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kesimpulan</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->suggestion ?? 'N/A' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Pemeriksa</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->doctor_id ?? 'N/A' }}</td>
	                    </tr>
	                </table>
	            </td>
	        </tr>
	    </tbody>
	</table>
</div>
