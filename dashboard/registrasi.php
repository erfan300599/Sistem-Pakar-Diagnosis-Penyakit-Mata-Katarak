<?php
  include "inc/koneksi.php";
   
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MATA SEHAT</title>
	<link rel="icon" href="dist/img/logo_mata.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-image: url(dist/img/gambar_login.jpg);">
	<div class="login-box">
		<div class="login-logo">
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<center>
					<h1>
						<b class="text-primary">SIGN</b> <b class="text-success">UP</b>
					</h1>
					<br>
				</center>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>Warning!</strong> Silahkan mengisi data registrasi pasien dibawah ini sesuai dengan data pasien yang sedang mengalami gangguan pada mata.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>


				<form action="" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Lengkap" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
				        <select class="form-control" name="jk" required>
				          <option value="" disabled selected>-  Jenis Kelamin  -</option>
				          <option value="Laki-Laki">Laki-Laki</option>
				          <option value="Perempuan">Perempuan</option>
				        </select>
				      </div>
				      <div class="input-group mb-3">
						<input type="date" class="form-control" name="tanggal_lahir" required>
						
					</div>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-map-marker"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="telepon" placeholder="Telepon" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-phone"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="username" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password<br><br>

					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block btn-flat" name="btnsave" title="Daftar Akun">
								<b>Daftar Akun</b>
							</button>
						</div>
				</form>
			</div><br>
			<center>
			Sudah Punya Akun? <a href="login.php"> Sign In </a>
			</center> 
			</div>
				</div>
			</div>
		</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- Alert -->
		<script src="plugins/alert.js"></script>

</body>

</html>

<?php


if (isset($_POST['btnsave'])) {  
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO tb_pengguna (nama_pengguna,jk, tanggal_lahir, alamat,telepon,username,password,level) VALUES (
            '".$_POST['nama_pengguna']."',
            '".$_POST['jk']."',
            '".$_POST['tanggal_lahir']."',
          '".$_POST['alamat']."',
        '".$_POST['telepon']."',
      '".$_POST['username']."',
    '".$_POST['password']."',
 'Pasien')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

	   if ($query_simpan) {
		echo "<script>
			Swal.fire({title: 'Sukses!',text: 'Akun Berhasil Terdaftar',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'login.php';}
			})</script>";
		}else{
		echo "<script>
			Swal.fire({title: 'Oops...',text: 'Akun Gagal Terdaftar',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'login.php';}
			})</script>";
		}}
?>

<script type="text/javascript">
    function change()
    {
    var x = document.getElementById('pass').type;

    if (x == 'password')
    {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML;
    }
    else
    {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML;
    }
    }
</script>

