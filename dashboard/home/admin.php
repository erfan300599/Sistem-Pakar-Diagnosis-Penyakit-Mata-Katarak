<?php

  $sql = $koneksi->query("SELECT COUNT(id_penyakit) as penyakit  from tb_penyakit");
  while ($data= $sql->fetch_assoc()) {
    $penyakit=$data['penyakit'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_gejala) as gejala  from tb_gejala");
  while ($data= $sql->fetch_assoc()) {
    $gejala=$data['gejala'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_pengetahuan) as pengetahuan  from tb_pengetahuan");
  while ($data= $sql->fetch_assoc()) {
    $pengetahuan=$data['pengetahuan'];
  }

?>
  <div class="card bg-dark text-white">
  <img src="dist/img/banner.jpg" class="card-img" alt="...">
<!--   <div class="card-img-overlay">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text">Last updated 3 mins ago</p>
  </div> -->
</div>

<div class="row">
	<div class="col-lg-4 col-6">
		<!-- small box -->
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>
					<?php echo $penyakit;  ?>
				</h3>

				<p>Penyakit</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-eye"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-6">
		<!-- small box -->
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>
					<?php echo $gejala;  ?>
				</h3>

				<p>Gejala</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-thermometer"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-6">
		<!-- small box -->
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>
					<?php echo $pengetahuan;  ?>
				</h3>

				<p>Pengetahuan</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-erlenmeyer-flask"></i>
			</div>
		</div>
	</div>

</div>