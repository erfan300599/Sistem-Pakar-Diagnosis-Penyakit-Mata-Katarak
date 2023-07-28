<?php

    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_username"])==""){
	header("location: login.php");
    
    }else{
    	$data_pass=$_SESSION["ses_password"];
      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_nama"];
      $data_jk = $_SESSION["ses_jk"];
      $data_tanggal_lahir = $_SESSION["ses_tanggal_lahir"];
      $data_alamat = $_SESSION["ses_alamat"];
      $data_telepon = $_SESSION["ses_telepon"];
      $data_user = $_SESSION["ses_username"];
	  $data_level = $_SESSION["ses_level"];
    }
    //KONEKSI DB
    include "inc/koneksi.php";

    	function hitungUmur($tanggal_lahir){
  	$tgl_lahir= new DateTime($tanggal_lahir);
  	$sekarang = new DateTime();
  	$perbedaan = $sekarang->diff($tgl_lahir);
  	return $perbedaan->y;
  }
  $umur=hitungUmur($data_tanggal_lahir);


$satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
       
          function tglIndonesia($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
         }
         $lahir=tglIndonesia(date('d F Y', strtotime($data_tanggal_lahir)));
         
         date_default_timezone_set("Asia/Ujung_Pandang")

				
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
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-primary">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>
				<li>
					<a href="index.php" class="nav-link">
						<font color="white">
							<b>Selamat Datang <?php echo $data_nama; ?></b>
						<span class="badge badge-success">
							<?php echo $data_level; ?>
						</span>
						</font>
					</a>
				</li>
			</ul>

			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">
			<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">
						<font color="white">
							<?php $tgl=date('Y-m-d'); ?>
							<i class="fas fa-calendar-alt"> </i>  <b><?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?> |</b>
							<b><span id="jam"></span> WITA</b> 	<i class="fas fa-clock"> </i>  
						</font>
					</a>
				</li>
			</ul>

		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
				<img src="dist/img/logo_mata.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
				<h4><b><span class="brand-text text-primary">MATA</span> <span class="brand-text text-success">SEHAT</span> </b></h4>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<!-- Halaman Pakar -->
						<?php
          if ($data_level=="Pakar"){
        ?>
						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
								<li class="nav-item">
									<a href="?page=data-gejala" class="nav-link">
										<i class="nav-icon fas fa-eye-dropper"></i>
										<p>Data Gejala</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-penyakit" class="nav-link">
										<i class="nav-icon fas fa-eye"></i>
										<p>Data Penyakit</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-pengetahuan" class="nav-link">
										<i class="nav-icon fas fa-book"></i>
										<p>Data Pengetahuan</p>
									</a>
								</li>
						<li class="nav-item">
							<a href="?page=riwayat-konsultasipakar" class="nav-link">
								<i class="nav-icon fas fa-file-medical"></i>
								<p>
									Rekam Medis
								</p>
							</a>
						</li>

						<li class="nav-header">Setting</li>

						<li class="nav-item">
							<a href="?page=update-password" class="nav-link">
								<i class="nav-icon fas fa-cog"></i>
								<p>
									Update Password
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=view-pengguna" class="nav-link">
								<i class="nav-icon fas fa-user-cog"></i>
								<p>
									Profile
								</p>
							</a>
						</li>

						<!-- Halaman Pasien -->
						<?php
          				} elseif($data_level=="Pasien"){
          				?>

<!-- 						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="?page=data-konsultasi" class="nav-link">
								<i class="nav-icon fas fa-search-plus"></i>
								<p>
									Konsultasi
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=riwayat-konsultasi" class="nav-link">
								<i class="nav-icon fas fa-file-medical"></i>
								<p>
									Riwayat Konsultasi
								</p>
							</a>
						</li>

						<li class="nav-header">Setting</li>

						<li class="nav-item">
							<a href="?page=update-password" class="nav-link">
								<i class="nav-icon fas fa-cog"></i>
								<p>
									Update Password
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=view-pengguna" class="nav-link">
								<i class="nav-icon fas fa-user-cog"></i>
								<p>
									Profile
								</p>
							</a>
						</li>

						<!-- Halaman Admin -->
								<?php
          				} elseif($data_level=="Admin"){
          				?>

						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-pengguna" class="nav-link">
								<i class="nav-icon far fa-user"></i>
								<p>
								Data Pakar
								</p>
							</a>
						</li>

					<li class="nav-header">Setting</li>

						<li class="nav-item">
							<a href="?page=update-password" class="nav-link">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Update Password
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=view-pengguna" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Profile
								</p>
							</a>
						</li>
		
						<?php
							}
						?>

						<li class="nav-item">
							<a type="button" href="" data-toggle="modal" data-target="#modallogout" class="nav-link">
							<i class="nav-icon fas fa-arrow-circle-right"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		  <!-- Modal -->
  <div class="modal fade" id="modallogout" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text text-white"> Pemberitahuan!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
          <p>Apakah Anda Yakin Ingin Keluar Dari Sistem?</p>
        </div>
        <div class="modal-footer">
        	<a type="button" href="logout.php" class="btn btn-primary">Oke</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>

    </div>
  </div>


		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {

         //gejala
				case 'data-gejala':
					include "admin/gejala/data_gejala.php";
					break;
				case 'add-gejala':
					include "admin/gejala/add_gejala.php";
					break;
				case 'edit-gejala':
					include "admin/gejala/edit_gejala.php";
					break;
				case 'del-gejala':
					include "admin/gejala/del_gejala.php";
					break;

				//penyakit
				case 'data-penyakit':
					include "admin/penyakit/data_penyakit.php";
					break;
				case 'add-penyakit':
					include "admin/penyakit/add_penyakit.php";
					break;
				case 'edit-penyakit':
					include "admin/penyakit/edit_penyakit.php";
					break;
				case 'del-penyakit':
					include "admin/penyakit/del_penyakit.php";
					break;

				//pengetahuan
				case 'data-pengetahuan':
					include "admin/pengetahuan/data_pengetahuan.php";
					break;
				case 'add-pengetahuan':
					include "admin/pengetahuan/add_pengetahuan.php";
					break;
				case 'edit-pengetahuan':
					include "admin/pengetahuan/edit_pengetahuan.php";
					break;
				case 'del-pengetahuan':
					include "admin/pengetahuan/del_pengetahuan.php";
					break;

				//konsultasi
				case 'data-konsultasi':
					include "admin/konsultasi/data_konsultasi.php";
					break;
				case 'data-kemungkinanlain':
					include "admin/konsultasi/kemungkinanlain.php";
					break;


				//Riwayat konsultasi
				case 'riwayat-konsultasi':
					include "admin/riwayat/riwayat_konsultasi.php";
					break;
				case 'riwayat-konsultasipakar':
					include "admin/riwayat/riwayat_konsultasipakar.php";
					break;
				case 'detail-konsultasi':
					include "admin/riwayat/detail_konsultasi.php";
					break;
				case 'del-riwayat':
					include "admin/riwayat/del_riwayat.php";
					break;
				case 'del-riwayatpakar':
					include "admin/riwayat/del_riwayatpakar.php";
					break;
              
				//Pengguna
				case 'data-pengguna':
					include "admin/pengguna/data_pengguna.php";
					break;
				case 'add-pengguna':
					include "admin/pengguna/add_pengguna.php";
					break;
				case 'edit-pengguna':
					include "admin/pengguna/edit_pengguna.php";
					break;
				case 'del-pengguna':
					include "admin/pengguna/del_pengguna.php";
					break;
				case 'view-pengguna':
					include "admin/pengguna/view_pengguna.php";
					break;
				case 'view-admin':
					include "admin/pengguna/view_admin.php";
					break;
				case 'update-password':
					include "admin/pengguna/update_password.php";
					break;
				case 'data-pasien':
					include "admin/pengguna/data_pasien.php";
					break;
				
				//konsultasi
				case 'data-pesan':
					include "admin/pesan/data_pesan.php";
					break;
				case 'del-pesan':
					include "admin/pesan/del_pesan.php";
					break;

          
              //default
              default:
                  echo "<center><h1> Halaman Tidak Ditemukan!</h1></center>";
                  break;    
          }

      }else{
        // Auto Halaman Home Pengguna
          if($data_level=="Pakar"){
              include "home/admin.php";
              }
          elseif($data_level=="Pasien"){
              include "admin/konsultasi/data_konsultasi.php";
              }
           elseif($data_level=="Admin"){
              include "home/admin.php";
              }
          }
    ?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
					Copyright &copy; 2023. Developer -
				<a target="_blank" href="#">
					<strong> Ilmu Komputer Universitas Nusa Cendana Kupang</strong>
				</a>.
				All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>
<script type="text/javascript">
	window.onload = function(){jam();}
	function jam(){
		var e = document.getElementById('jam'),
		d = new Date(), h, m, s;
		h= d.getHours();
		m= set(d.getMinutes());
		s= set(d.getSeconds());

		e.innerHTML= h+':'+ m+':'+ s;

		setTimeout('jam()',1000);
	}

	function set(e){
		e = e < 10 ? '0'+ e: e;
		return e;
	}
</script>
</body>

</html>