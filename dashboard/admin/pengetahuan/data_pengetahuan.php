<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Pengetahuan</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-pengetahuan" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Penyakit</th>
						<th>Nama Gejala</th>
						<th>MB</th>
						<th>MD</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * FROM tb_pengetahuan ORDER BY id_pengetahuan DESC");
              while ($data= $sql->fetch_assoc()) {
              	$peny = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from tb_penyakit where id_penyakit='$data[id_penyakit]'"));
				$gel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from tb_gejala where id_gejala='$data[id_gejala]'"));
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $peny['nama_penyakit']; ?>
						</td>
						<td>
							<?php echo $gel['nama_gejala']; ?>
						</td>
							<td>
							<?php echo $data['mb']; ?>
						</td>
							<td>
							<?php echo $data['md']; ?>
						</td>

						<td>
							<a href="?page=edit-pengetahuan&kode=<?php echo $data['id_pengetahuan']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-pengetahuan&kode=<?php echo $data['id_pengetahuan']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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