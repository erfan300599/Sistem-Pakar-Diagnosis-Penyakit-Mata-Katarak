<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Penyakit</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<div class="table-responsive">
				<div>
					<a href="?page=add-penyakit" class="btn btn-primary">
						<i class="fa fa-edit"></i> Tambah Data</a>
					</div>
					<br>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Penyakit</th>
								<th>Detail</th>
								<th>Saran</th>
								<th>Tipe</th>
								<th>Gambar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * FROM tb_penyakit ORDER BY id_penyakit DESC");
							while ($data= $sql->fetch_assoc()) {
								?>

								<tr>
									<td>
										<?php echo $no++; ?>
									</td>
									<td>
										<?php echo $data['nama_penyakit']; ?>
									</td>
									<td>
										<?php echo $data['det_penyakit']; ?>
									</td>

									<td>
										<?php echo $data['srn_penyakit']; ?>
									</td>

									<td>
										<?php echo $data['tipe_penyakit']; ?>
									</td>

									<td>
										<?php $gambar="admin/gambar/" . $data['gambar_penyakit'];?>
										<div class="text-center">
											<img src="<?php echo $gambar; ?>" style="width: 200px;">
										</div>

									</td>


									<td>
										<a href="?page=edit-penyakit&kode=<?php echo $data['id_penyakit']; ?>" title="Ubah"
											class="btn btn-success btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<a href="?page=del-penyakit&kode=<?php echo $data['id_penyakit']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
											title="Hapus" class="btn btn-danger btn-sm">
											<i class="fa fa-trash"></i>
											<a/>
										</td>
									</tr>

									<?php
								}
								?>
							</tbody>
						</tfoot>
					</table>
				</div>
			</div>
	<!-- /.card-body -->