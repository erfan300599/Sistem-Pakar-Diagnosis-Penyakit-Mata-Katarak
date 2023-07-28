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

<body class="hold-transition login-page" style="background-image: url(dist/img/4.jpg);">

	<div class="login-box">
		<div class="login-logo">
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<center>
					<h1 class="mb-0">
						<b class="text-primary">SIGN</b> <b class="text-success">IN</b>
					</h1>
					<br>
				</center>

				<form action="" method="post">
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
<!-- 		<div class="input-group mb-3">
        <select class="form-control" name="level" required>
          <option value="" disabled selected>-  Masuk Sebagai  -</option>
          <option value="Pakar">Pakar</option>
          <option value="Pasien">Pasien</option>
        </select>
      </div> -->
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block btn-flat" name="btnLogin" title="Masuk Sistem">
								<b>Login</b>
							</button>
						</div>
				</form>

				</div><br>
				    			<center>
				    				Belum Punya Akun? <a href="registrasi.php"> Sign Up </a><br>
				    				<a type="button" href="" data-toggle="modal" data-target="#modallupapassword"> Lupa Password? </a><br>
				    				Kunjungi Website <b class="text-secondary">Mata Sehat</b> <a href="../index.php">Klik Disini</a>
				    			</center> 
			</div>
		</div>
		<!-- /.login-box -->

  <!-- Modal -->
  <div class="modal fade" id="modallupapassword" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text text-white"></i>Pemberitahuan!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
          <p>Silahkan hubungi admin untuk mereset password Anda. Terima Kasih</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>

    </div>
  </div>


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





if (isset($_POST['btnLogin'])) {  
	//anti inject sql
	$username=mysqli_real_escape_string($koneksi,$_POST['username']);
	$password=mysqli_real_escape_string($koneksi,$_POST['password']);

	//query login
	$sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username' AND password='$password'";
	$query_login = mysqli_query($koneksi, $sql_login);
	$data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
	$jumlah_login = mysqli_num_rows($query_login);


	if ($jumlah_login ==1 ){
		session_start();
		$_SESSION["ses_id"]=$data_login["id_pengguna"];
		$_SESSION["ses_nama"]=$data_login["nama_pengguna"];
		$_SESSION["ses_jk"]=$data_login["jk"];
		$_SESSION["ses_tanggal_lahir"]=$data_login["tanggal_lahir"];
		$_SESSION["ses_alamat"]=$data_login["alamat"];
		$_SESSION["ses_telepon"]=$data_login["telepon"];
		$_SESSION["ses_username"]=$data_login["username"];
		$_SESSION["ses_password"]=$data_login["password"];
		$_SESSION["ses_level"]=$data_login["level"];
	
		echo "<script>
			Swal.fire({title: 'Sukses!',text: 'Login Sistem Berhasil',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'index.php';}
			})</script>";
		}else{
		echo "<script>
			Swal.fire({title: 'Oops...!',text: 'Login Sistem Gagal',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'login.php';}
			})</script>";
		}
		}
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

