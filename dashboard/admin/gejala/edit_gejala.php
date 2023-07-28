<?php

if(isset($_GET['kode'])){
	$sql_cek = "SELECT * FROM tb_gejala WHERE id_gejala='".$_GET['kode']."'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
	if ($data_cek['gambar_gejala']) {
		$gambar = "admin/gambar/gejala/" . $data_cek['gambar_gejala'];
	} else {
		$gambar = "admin/gambar/noimage.png";
	}
}
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Update Data</h3>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<input type="hidden" class="form-control" id="id_gejala" name="id_gejala" value="<?php echo $data_cek['id_gejala']; ?>"
				readonly/>


				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Gejala</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nama_gejala" name="nama_gejala" value="<?php echo $data_cek['nama_gejala']; ?>"
						/>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tipe Gejala</label>
					<div class="col-sm-6">
						<select class="form-control" id="tipe_gejala" name="tipe_gejala" required>
							<option value="" disabled selected>-  Tipe Gejala  -</option>
							<?php

							if ($data_cek['tipe_gejala'] == "5 Tahun Keatas") echo "<option value='5 Tahun Keatas' selected>5 Tahun Keatas</option>";
							else echo "<option value='5 Tahun Keatas'>5 Tahun Keatas</option>";

							if ($data_cek['tipe_gejala'] == "Umum") echo "<option value='Umum' selected>Umum</option>";
							else echo "<option value='Umum'>Umum</option>";
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Gambar Gejala</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" id="upload" name="gambar_gejala" value="<?php echo $data_cek['nama_gejala']; ?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-6">
						<img  id="preview" src="<?php echo $gambar; ?>" width="200px">
					</div>
				</div>


			</div>
			<div class="card-footer">
				<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
				<a href="?page=data-gejala" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
		</form>
	</div>

	<script>
		function readURL(input) {

			if (input.files &&
				input.files[0]) {
				var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#upload").change(function() {
		readURL(this);
	});

	$(function() {
		CKEDITOR.replace('editor1');
		CKEDITOR.replace('editor2');
		CKEDITOR.replace('editor1a');
		CKEDITOR.replace('editor2a');
	})
</script>

<?php

if (isset ($_POST['Ubah'])){
	$fileName = $_FILES['gambar_gejala']['name'];
	if ($fileName !=='') {
		move_uploaded_file($_FILES['gambar_gejala']['tmp_name'], "admin/gambar/gejala/" . $_FILES['gambar_gejala']['name']);
		$sql_ubah = "UPDATE tb_gejala SET 
		nama_gejala='".$_POST['nama_gejala']."',
		tipe_gejala='".$_POST['tipe_gejala']."',
		gambar_gejala='$fileName'
		WHERE id_gejala='".$_POST['id_gejala']."'";
		$query_ubah = mysqli_query($koneksi, $sql_ubah);
		mysqli_close($koneksi);

		if ($query_ubah) {
			echo "<script>
			Swal.fire({title: 'Sukses!',text: 'Data Gejala Berhasil Diupdate',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'index.php?page=data-gejala';
			}
		})</script>";
	}else{
		echo "<script>
		Swal.fire({title: 'Oops...!',text: 'Data Gejala Gagal Diupdate',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'index.php?page=data-gejala';
		}
	})</script>";
}}else{
	$sql_ubah = "UPDATE tb_gejala SET 
	nama_gejala='".$_POST['nama_gejala']."',
	tipe_gejala='".$_POST['tipe_gejala']."'
	WHERE id_gejala='".$_POST['id_gejala']."'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
	mysqli_close($koneksi);

	if ($query_ubah) {
		echo "<script>
		Swal.fire({title: 'Sukses!',text: 'Data Gejala Berhasil Diupdate',icon: 'success',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'index.php?page=data-gejala';
		}
	})</script>";
}else{
	echo "<script>
	Swal.fire({title: 'Oops...!',text: 'Data Gejala Gagal Diupdate',icon: 'error',confirmButtonText: 'OK'
	}).then((result) => {if (result.value)
		{window.location = 'index.php?page=data-gejala';
	}
})</script>";
}}

}
