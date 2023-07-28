<?php

if(isset($_GET['kode'])){
	$sql_cek = "SELECT * FROM tb_penyakit WHERE id_penyakit='".$_GET['kode']."'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);

	if ($data_cek['gambar_penyakit']) {
		$gambar = "admin/gambar/" . $data_cek['gambar_penyakit'];
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

				<input type="hidden" class="form-control" id="id_penyakit" name="id_penyakit" value="<?php echo $data_cek['id_penyakit']; ?>"
				readonly/>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Penyakit</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="<?php echo $data_cek['nama_penyakit']; ?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Detail Penyakit</label>
					<div class="col-sm-6">
						<textarea class="ckeditor" id="det_penyakit" name="det_penyakit"><?php echo $data_cek['det_penyakit']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Saran Penyakit</label>
					<div class="col-sm-6">
						<textarea class="ckeditor" id="srn_penyakit" name="srn_penyakit"><?php echo $data_cek['srn_penyakit']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tipe Penyakit</label>
					<div class="col-sm-6">
						<select class="form-control" id="tipe_penyakit" name="tipe_penyakit" required>
							<option value="" disabled selected>-  Tipe Penyakit  -</option>
							<?php
							if ($data_cek['tipe_penyakit'] == "Umum") echo "<option value='Umum' selected>Umum</option>";
							else echo "<option value='Umum'>Umum</option>";

							if ($data_cek['tipe_penyakit'] == "5 Tahun Keatas") echo "<option value='5 Tahun Keatas' selected>5 Tahun Keatas</option>";
							else echo "<option value='5 Tahun Keatas'>5 Tahun Keatas</option>";

							if ($data_cek['tipe_gejala'] == "5 Tahun Kebawah") echo "<option value='5 Tahun Kebawah' selected>5 Tahun Kebawah</option>";
							else echo "<option value='5 Tahun Kebawah'>5 Tahun Kebawah</option>";
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Gambar Penyakit</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" id="upload" name="gambar_penyakit" value="<?php echo $data_cek['nama_penyakit']; ?>"
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
	<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
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
	$fileName = $_FILES['gambar_penyakit']['name'];
	if ($fileName !=='') {
		move_uploaded_file($_FILES['gambar_penyakit']['tmp_name'], "admin/gambar/" . $_FILES['gambar_penyakit']['name']);
		$sql_ubah = "UPDATE tb_penyakit SET 
		nama_penyakit='".$_POST['nama_penyakit']."',
		det_penyakit='".$_POST['det_penyakit']."',
		srn_penyakit='".$_POST['srn_penyakit']."',
		tipe_penyakit='".$_POST['tipe_penyakit']."',
		gambar_penyakit='$fileName'
		WHERE id_penyakit='".$_POST['id_penyakit']."'";
		$query_ubah = mysqli_query($koneksi, $sql_ubah);
		mysqli_close($koneksi);

		if ($query_ubah) {
			echo "<script>
			Swal.fire({title: 'Sukses!',text: 'Data Penyakit Berhasil Diupdate',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'index.php?page=data-penyakit';
			}
		})</script>";
	}else{
		echo "<script>
		Swal.fire({title: 'Oopss...!',text: 'Data Penyakit Gagal Diupdate',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'index.php?page=data-penyakit';
		}
	})</script>";
}}else{
	$sql_ubah = "UPDATE tb_penyakit SET 
	nama_penyakit='".$_POST['nama_penyakit']."',
	det_penyakit='".$_POST['det_penyakit']."',
	srn_penyakit='".$_POST['srn_penyakit']."',
	tipe_penyakit='".$_POST['tipe_penyakit']."'
	WHERE id_penyakit='".$_POST['id_penyakit']."'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
	mysqli_close($koneksi);

	if ($query_ubah) {
		echo "<script>
		Swal.fire({title: 'Sukses!',text: 'Data Penyakit Berhasil Diupdate',icon: 'success',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'index.php?page=data-penyakit';
		}
	})</script>";
}else{
	echo "<script>
	Swal.fire({title: 'Oopss...!',text: 'Data Penyakit Gagal Diupdate',icon: 'error',confirmButtonText: 'OK'
	}).then((result) => {if (result.value)
		{window.location = 'index.php?page=data-penyakit';
	}
})</script>";
}}

}
