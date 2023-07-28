<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user"></i> Profile</h3>
		</h3>
		<div class="card-tools">
		</div>
	</div>
	<div class="card-body p-0">
		<table class="table">
			<tbody>
				<tr>
					<td style="width: 150px">
						<b>Nama Lengkap</b>
					</td>
					<td>:
							<?php echo $data_nama; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Jenis Kelamin</b>
					</td>
					<td>:
							<?php echo $data_jk; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Tanggal Lahir</b>
					</td>
					<td>: 
							<?php echo $lahir; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Umur</b>
					</td>
					<td>: 
							<?php echo $umur; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Alamat</b>
					</td>
					<td>:
							<?php echo $data_alamat; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Email</b>
					</td>
					<td>:
							<?php echo $data_telepon; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Level</b>
					</td>
					<td>:
							<?php echo $data_level; ?>
					</td>
				</tr>
			</tbody>
		</table>
<!-- 		<div class="card-footer">
			<a href="?page=view-pengguna" class="btn btn-warning">Kembali</a>
		</div> -->
	</div>
</div>