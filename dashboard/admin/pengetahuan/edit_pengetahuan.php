<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pengetahuan WHERE id_pengetahuan='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Update Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

					<input type="hidden" class="form-control" id="id_pengetahuan" name="id_pengetahuan" value="<?php echo $data_cek['id_pengetahuan']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Penyakit</label>
				<div class="col-sm-6">
					<select class="form-control" name="id_penyakit" id="id_penyakit">
										<?php 
					$query = mysqli_query($koneksi,"SELECT * FROM tb_penyakit order by id_penyakit");
					while($tampil_t=$query->fetch_assoc()){
						$pilih_t=($tampil_t['id_penyakit']==$data_cek['id_penyakit']?"selected":"");
						echo "<option value = '$tampil_t[id_penyakit]' $pilih_t> $tampil_t[nama_penyakit]</option>";
					}

				?>
			</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Gejala</label>
				<div class="col-sm-6">
				<select class="form-control" name="id_gejala" id="id_gejala">
				<?php 
					$query = mysqli_query($koneksi,"SELECT * FROM tb_gejala order by id_gejala");
					while($tampil_t=$query->fetch_assoc()){
						$pilih_t=($tampil_t['id_gejala']==$data_cek['id_gejala']?"selected":"");
						echo "<option value = '$tampil_t[id_gejala]' $pilih_t> $tampil_t[nama_gejala]</option>";
					}

				?>
			</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">MB</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="mb" name="mb" value="<?php echo $data_cek['mb']; ?>"
					/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">MD</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="md" name="md" value="<?php echo $data_cek['md']; ?>"
					/>
				</div>
			</div>
		

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-pengetahuan" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE tb_pengetahuan SET 
		id_penyakit='".$_POST['id_penyakit']."',
		id_gejala='".$_POST['id_gejala']."',
		mb='".$_POST['mb']."',
		md='".$_POST['md']."'
		WHERE id_pengetahuan='".$_POST['id_pengetahuan']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Sukses!',text: 'Data Pengetahuan Berhasil Diupdate',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-pengetahuan';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Oops...!',text: 'Data Pengetahuan Gagal Diupdate',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-pengetahuan';
        }
      })</script>";
    }}
