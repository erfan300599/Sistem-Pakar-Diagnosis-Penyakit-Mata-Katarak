<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Riwayat Konsultasi</h3>
	</div>

	<?php
      $sqlgjl = mysqli_query($koneksi,"SELECT * FROM tb_gejala order by id_gejala+0");
        while ($rgjl = mysqli_fetch_array($sqlgjl)) {
            $argjl[$rgjl['id_gejala']] = $rgjl['nama_gejala'];
        }

        $sqlpkt = mysqli_query($koneksi,"SELECT * FROM tb_penyakit order by id_penyakit");
        while ($rpkt = mysqli_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['id_penyakit']] = $rpkt['nama_penyakit'];
            $ardpkt[$rpkt['id_penyakit']] = $rpkt['det_penyakit'];
            $arspkt[$rpkt['id_penyakit']] = $rpkt['srn_penyakit'];
            $argpkt[$rpkt['id_penyakit']] = $rpkt['gambar_penyakit'];
        }

	?>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Penyakit</th>
						<th>Nilai CF</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * FROM tb_hasil WHERE id_hasil");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['tanggal']; ?>
						</td>
						<td>
							<?php echo $arpkt[$data['hasil_id']]; ?>
						</td>

						<td>
							<?php echo $data['hasil_nilai']; ?>
						</td>


						<td>
							<a href="?page=detail-konsultasi&kode=<?php echo $data['id_hasil']; ?>" title="Detail Riwayat Konsultasi"
							 class="btn btn-success btn-sm">
								<i class="fa fa-eye"></i>
							</a>
							<a href="?page=del-riwayatpakar&kode=<?php echo $data['id_hasil']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus Riwayat Konsultasi" class="btn btn-danger btn-sm">
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