<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div><br>
	
	<div class="alert alert-success alert-dismissible">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <h4 class="text-white"><b>Petunjuk Pengisian!</b></h4>
        Silahkan pilih gejala yang sesuai dengan penyakit yang Anda alami dan berikan <b>nilai kepastian (MB & MB)</b> dengan cakupan sebagai berikut:<br><br>
       <ul>
       	<li><b>1.0</b> = Sangat Yakin</li>
       	<li><b>0.8</b> = Yakin</li>
       	<li><b>0.6</b> = Cukup Yakin</li>
       	<li><b>0.4</b> = Sedikit Yakin</li>
       	<li><b>0.2</b> = Kurang Yakin</li>
				<li><b>0.0</b> = Tidak Yakin</li>
			</ul>
				<b>CF (Pakar) = MB – MD</b><br>
			<ul>
				<li>MB : Ukuran kenaikan kepercayaan (Measure Of Increased Belief)</li>
				<li>MD : Ukuran kenaikan ketidakpercayaan (Measure Of Increased Disbelief)</li>
			</ul>
				<b>Contoh:</b><br>
				Jika kepercayaan <b>(MB)</b> Anda terhadap gejala .... untuk penyakit ... adalah <b>1.0 (Yakin)</b><br>
				Dan ketidakpercayaan <b>(MD)</b> Anda terhadap gejala .... untuk penyakit ... adalah <b>0.2 (Kurang Yakin)</b><br><br>
				<b>Maka:</b> CF (Pakar) = MB – MD (1.0 - 0.2) = <b>0.8</b> <br>
				Dimana nilai kepastian anda terhadap gejala .... untuk penyakit ... adalah <b>0.8 (Yakin)</b>
  </div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Penyakit</label>
				<div class="col-sm-6">
					<select name="id_penyakit" id="id_penyakit" class="form-control select2bs4" required>
						<option value="" disabled selected>- Pilih Penyakit -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from tb_penyakit where id_penyakit";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $row['id_penyakit'] ?>">
							<?php echo $row['nama_penyakit'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>
						<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Gejala</label>
				<div class="col-sm-6">
					<select name="id_gejala" id="id_gejala" class="form-control select2bs4" required>
						<option value="" disabled selected>- Pilih Gejala -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from tb_gejala where id_gejala";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $row['id_gejala'] ?>">
							<?php echo $row['nama_gejala'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>
				<div class="form-group row">
				<label class="col-sm-2 col-form-label">MB</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="mb" name="mb" placeholder="Measure Of Belief" required>
				</div>
			</div>
						<div class="form-group row">
				<label class="col-sm-2 col-form-label">MD</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="md" name="md" placeholder="Measure Of Disbelief" required>
				</div>
			</div>


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-pengetahuan" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO tb_pengetahuan (id_penyakit, id_gejala, mb, md) VALUES (
            '".$_POST['id_penyakit']."',
           '".$_POST['id_gejala']."',
          '".$_POST['mb']."',
         '".$_POST['md']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Sukses!',text: 'Data Pengetahuan Berhasil Disimpan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-pengetahuan';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Oops...!',text: 'Data Pengetahuan Gagal Disimpan',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-pengetahuan';
          }
      })</script>";
    }}
     //selesai proses simpan data
