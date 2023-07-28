<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card-body">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Penyakit</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Nama Penyakit" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Detail Penyakit</label>
					<div class="col-sm-6">
						<textarea class="ckeditor" id="det_penyakit" name="det_penyakit"  required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Saran Penyakit</label>
					<div class="col-sm-6">
						<textarea class="ckeditor" id="srn_penyakit" name="srn_penyakit" required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tipe Penyakit</label>
					<div class="col-sm-6">
						<select class="form-control" name="tipe_penyakit" required>
							<option value="" disabled selected>-  Pilih Tipe Penyakit  -</option>
							<option value="Umum">Umum</option>
							<option value="5 Tahun Keatas">5 Tahun Keatas</option>
							<option value="5 Tahun Kebawah">5 Tahun Kebawah</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Gambar Penyakit</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" id="gambar_penyakit" name="gambar_penyakit" onchange="previewImage(event)" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-6">
						<img  src="#" alt="Pratinjau" class="preview-img" id="preview" width="200px">
					</div>
				</div>



			</div>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
				<a href="?page=data-penyakit" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
	<?php

	if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
		$nama_penyakit=$_POST['nama_penyakit'];
		$det_penyakit=$_POST['det_penyakit'];
		$srn_penyakit=$_POST['srn_penyakit'];
		$tipe_penyakit=$_POST['tipe_penyakit'];
		$fileName = $_FILES['gambar_penyakit']['name'];
		move_uploaded_file($_FILES['gambar_penyakit']['tmp_name'], "admin/gambar/" . $_FILES['gambar_penyakit']['name']);
		$sql_cek_gejala=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_penyakit WHERE nama_penyakit='$nama_penyakit'"));

		if($sql_cek_gejala > 0){
			echo "<script>
			Swal.fire({title: 'Oops...!',text: 'Data Penyakit Sudah Tersimpan',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-penyakit';
			}
		})</script>";
	}else{
		$sql_simpan = "INSERT INTO tb_penyakit (nama_penyakit, det_penyakit, srn_penyakit, tipe_penyakit, gambar_penyakit) VALUES (
			'".$_POST['nama_penyakit']."',
			'".$_POST['det_penyakit']."',
			'".$_POST['srn_penyakit']."',
			'".$_POST['tipe_penyakit']."',
			'$fileName')";
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
			mysqli_close($koneksi);
			if ($query_simpan) {
				echo "<script>
				Swal.fire({title: 'Sukses!',text: 'Data Penyakit Berhasil Disimpan',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {if (result.value){
					window.location = 'index.php?page=data-penyakit';
				}
			})</script>";
		}else{
			echo "<script>
			Swal.fire({title: 'Oops...!',text: 'Data Penyakit Gagal Disimpan',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-penyakit';
			}
		})</script>";
	}}}
     //selesai proses simpan data
	?>

	<script>
		function previewImage(event) {
			var reader = new FileReader();
			reader.onload = function(){
				var output = document.getElementById('preview');
				output.src = reader.result;
			};
			reader.readAsDataURL(event.target.files[0]);
		}
	</script>