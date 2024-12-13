<h4>Refraksi / Trial Lens</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
            	<table>
			        <tr>
			            <td>Spheris Kiri</td>
			            <td>{{ $refraksi->left_spherical }}</td>
			        </tr>
			        <tr>
			            <td>Cylinder Kiri</td>
			            <td>{{ $refraksi->left_cylinder }}</td>
			        </tr>
			        <tr>
			            <td>Axis Kiri</td>
			            <td>{{ $refraksi->left_axis }}</td>
			        </tr>
			        <tr>
			            <td>ADD Kiri</td>
			            <td>{{ $refraksi->left_add }}</td>
			        </tr>
			        <tr>
			            <td>PD Kiri</td>
			            <td>{{ $refraksi->left_pd }}</td>
			        </tr>
			        <tr>
			            <td>Visus Tanpa Koreksi, OD Kiri</td>
			            <td>{{ $refraksi->uncorrected_vision_left_od }}</td>
			        </tr>
			        <tr>
			            <td>Visus Tanpa Koreksi, OS Kiri</td>
			            <td>{{ $refraksi->uncorrected_vision_left_os }}</td>
			        </tr>
			    </table>
            </td>
            <td>
            <table>
		        <tr>
		            <td>Spheris Kanan</td>
		            <td>{{ $refraksi->right_spherical }}</td>
		        </tr>
		        <tr>
		            <td>Cylinder Kanan</td>
		            <td>{{ $refraksi->right_cylinder }}</td>
		        </tr>
		        <tr>
		            <td>Axis Kanan</td>
		            <td>{{ $refraksi->right_axis }}</td>
		        </tr>
		        <tr>
		            <td>ADD Kanan</td>
		            <td>{{ $refraksi->right_add }}</td>
		        </tr>
		        <tr>
		            <td>PD Kanan</td>
		            <td>{{ $refraksi->right_pd }}</td>
		        </tr>
		        <tr>
		            <td>Visus Tanpa Koreksi, OD Kanan</td>
		            <td>{{ $refraksi->uncorrected_vision_right_od }}</td>
		        </tr>
		        <tr>
		            <td>Visus Tanpa Koreksi, OS Kanan</td>
		            <td>{{ $refraksi->uncorrected_vision_right_os }}</td>
		        </tr>
		    </table>		
            </td>
        </tr>
    </tbody>
</table>
