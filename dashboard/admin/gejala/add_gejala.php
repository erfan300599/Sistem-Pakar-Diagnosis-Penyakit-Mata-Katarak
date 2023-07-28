<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
   </div>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">
     <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nama Gejala</label>
      <div class="col-sm-6">
       <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" placeholder="Nama Gejala" required>
     </div>
   </div>

   <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tipe Gejala</label>
    <div class="col-sm-6">
      <select class="form-control" name="tipe_gejala" required>
        <option value="" disabled selected>-  Pilih Tipe Gejala  -</option>
        <option value="5 Tahun Keatas">5 Tahun Keatas</option>
        <option value="Umum">Umum</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Gambar Gejala</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="gambar_gejala" name="gambar_gejala" onchange="previewImage(event)" required>
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
 <a href="?page=data-gejala" title="Kembali" class="btn btn-secondary">Batal</a>
</div>
</form>
</div>

<?php

if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
 $nama_gejala=$_POST['nama_gejala'];
 $tipe_gejala=$_POST['tipe_gejala'];
 $fileName = $_FILES['gambar_gejala']['name'];
 move_uploaded_file($_FILES['gambar_gejala']['tmp_name'], "admin/gambar/gejala/" . $_FILES['gambar_gejala']['name']);
 $sql_cek_gejala=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_gejala WHERE nama_gejala='$nama_gejala'"));

 if($sql_cek_gejala > 0){
  echo "<script>
  Swal.fire({title: 'Oops...!',text: 'Data Gejala Sudah Disimpan',icon: 'error',confirmButtonText: 'OK'
  }).then((result) => {if (result.value){
    window.location = 'index.php?page=add-gejala';
  }
})</script>";
}else{
  $sql_simpan = "INSERT INTO tb_gejala (nama_gejala, tipe_gejala, gambar_gejala) VALUES (
    '".$_POST['nama_gejala']."',
    '".$_POST['tipe_gejala']."',
    '$fileName')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);
    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Sukses!',text: 'Data Gejala Berhasil Disimpan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-gejala';
      }
    })</script>";
  }else{
    echo "<script>
    Swal.fire({title: 'Oops...!',text: 'Data Gejala Gagal Disimpan',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
      window.location = 'index.php?page=add-gejala';
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