<?php

if(isset($_GET['kode'])){

  $arcolor = array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
  date_default_timezone_set("Asia/Ujung_Pandang");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = array('0', '1', '0.8', '0.6', '0.4', '0.2');
  $argejala = array();

        // for ($i = 0; $i < count($_POST['kondisi']); $i++) {
        //   $arkondisi = explode("_", $_POST['kondisi'][$i]);
        //   if (strlen($_POST['kondisi'][$i]) > 1) {
        //     $argejala += array($arkondisi[0] => $arkondisi[1]);
        //   }
        // }

  $sqlkondisi = mysqli_query($koneksi, "SELECT * FROM tb_kondisi order by id");
  while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
  }

  $sqlpkt = mysqli_query($koneksi, "SELECT * FROM tb_penyakit order by id_penyakit");
  while ($rpkt = mysqli_fetch_array($sqlpkt)) {
    $arpkt[$rpkt['id_penyakit']] = $rpkt['nama_penyakit'];
    $ardpkt[$rpkt['id_penyakit']] = $rpkt['det_penyakit'];
    $arspkt[$rpkt['id_penyakit']] = $rpkt['srn_penyakit'];
    $argpkt[$rpkt['id_penyakit']] = $rpkt['gambar_penyakit'];
  }

  $sqlhasil = mysqli_query($koneksi, "SELECT * FROM tb_hasil where id_hasil=" . $_GET['kode']);
  while ($rhasil = mysqli_fetch_array($sqlhasil)) {
    $arpenyakit = unserialize($rhasil['penyakit']);
    $argejala = unserialize($rhasil['gejala']);
  }

  $np1 = 0;
  foreach ($arpenyakit as $key1 => $value1) {
    $np1++;
    $idpkt1[$np1] = $key1;
    $vlpkt1[$np1] = $value1;
  }

  //Tampilkan Data Pasien
  $edit = mysqli_query($koneksi, "SELECT * FROM tb_hasil INNER JOIN tb_pengguna on tb_hasil.id_pengguna= tb_pengguna.id_pengguna WHERE  tb_hasil.id_hasil='$_GET[kode]'");
  $r = mysqli_fetch_array($edit);

  echo "<div class='content'>
  <h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;<button id='print' onClick='window.print();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'><i class='fa fa-print'></i> Cetak</button> </h2>
  <hr>";

  if ($data_level == "Pasien") {
    echo "<div><p class='card-header bg-secondary'><b>Data Pasien</b></p>
    <table class='table table-bordered'>
    <tr><td width=300>Nama Pasien</td><td><input autocomplete='off' type=text class='form-control' name='nama_pengguna' size=30 value='$data_nama' readonly></td></tr> 
    <tr><td width=300>Jenis Kelamin</td><td><input autocomplete='off' type=text class='form-control' name='jk' size=30 value='$data_jk' readonly></td></tr>
    <tr><td width=300>Umur Pasien</td><td><input autocomplete='off' type=text class='form-control' name='tanggal_lahir' size=30 value='$umur Tahun' readonly></td></tr>
    </table>
    </div>";
  }elseif($data_level == "Pakar"){
    echo "<div><p class='card-header bg-secondary'><b>Data Pasien</b></p>
    <table class='table table-bordered'>
    <input type=hidden name=id_pengguna value='$r[id_pengguna]'>
    <tr><td width=300>Nama Pasien</td><td><input autocomplete='off' type=text class='form-control' name='nama_pengguna' size=30 value=\"$r[nama_pengguna]\" readonly></td></tr> 
    <tr><td width=300>Jenis Kelamin</td><td><input autocomplete='off' type=text class='form-control' name='jk' size=30 value=\"$r[jk]\"readonly></td></tr>
    <tr><td width=300>Umur Pasien</td><td><input autocomplete='off' type=text class='form-control' name='tanggal_lahir' size=30 value='$umur Tahun' readonly></td></tr>
    </table>
    </div>";
  }

  echo"<table class='table table-bordered table-striped konsultasi'> 
  <th width=8%>No</th>
  <th>Gejala</th>
  <th width=20%>Pilihan</th>
  </tr>";
  $ig = 0;
  foreach ($argejala as $key => $value) {
    $kondisi = $value;
    $ig++;
    $gejala = $key;
    $sql4 = mysqli_query($koneksi, "SELECT * FROM tb_gejala where id_gejala= '$key'");
    $r4 = mysqli_fetch_array($sql4);
    echo '<tr><td>' . $ig . '</td>';
    // echo '<td>G' . str_pad($r4['id_gejala'], 3, '0', STR_PAD_LEFT) . '</td>';
    echo '<td><span class="hasil text text-primary">' . $r4['nama_gejala'] . "</span></td>";
    echo '<td><span class="kondisipilih" style="color:' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
  }
  $np = 0;
  foreach ($arpenyakit as $key => $value) {
    $np++;
    $idpkt[$np] = $key;
    $nmpkt[$np] = $arpkt[$key];
    $vlpkt[$np] = $value;
  }
  if ($argpkt[$idpkt[1]]) {
    $gambar = 'admin/gambar/' . $argpkt[$idpkt[1]];
  } else {
    $gambar = 'admin/gambar/noimage.png';
  }
  echo "</table>";

  echo "<h4 class='card-header bg-info'><b>Jenis Penyakit Yang Diderita</b></h4><div class='callout callout-default'>
  <div class='card' style='width: 18rem;'>
  <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'>
  <div class='card-body bg-light'>
  <p class='card-text text-center'>" . $nmpkt[1] . " - " . round($vlpkt[1] * 100, 2) . " % </p>
  </div>
  </div>";
  echo "</div><h4 class='card-header bg-success'><b>Detail Penyakit</b></h4><div class='callout callout-default'>";
  echo $ardpkt[$idpkt[1]];

  echo "</div>
  <h4 class='card-header bg-primary'><b>Saran Pengobatan</b></h4><div class='callout callout-default'>";
  echo $arspkt[$idpkt[1]];

  echo "</div>
  <h4 class='card-header bg-danger'><b>Kemungkinan Lain</b></h4><div class='callout callout-default'>";

  echo "<form name=text_form method=POST action='' >
  <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
  <tr><th>Jenis Penyakit</th><th>Detail Penyakit</th><th>Saran Pengobatan</th><th>Gambar</th></tr>";
  for ($ipl = 2; $ipl < count($idpkt); $ipl++) {

    $gambar = 'admin/gambar/' . $argpkt[$idpkt[$ipl]];
          // echo "<tr><td class=gejala>".$idpkt[$ipl]."</td>";
    echo "<tr><td class=opsi>" .$nmpkt[$ipl]. " - " . round($vlpkt[$ipl]*100, 3) . " % </td>";
    echo "<td class=gejala>".$ardpkt[$idpkt[$ipl]]."</td>";
    echo "<td class=gejala>".$arspkt[$idpkt[$ipl]]."</td>";
    echo "<td class=gejala> 
    <div class='card' style='width: 18rem;'>
    <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'></div></td>";
          // echo"<td class=gejala><a href=?page=data-kemungkinanlain&kode=$idpkt[$ipl] class='btn btn-success btn-sm'>Detail</a></td>";

  }
  echo "</tbody></table></form>";
  echo "</div>
  </div>";
}
?>
<link href="admin/konsultasi/aset/main.css" rel="stylesheet" type="text/css" media="all">
<link href="admin/konsultasi/aset/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="admin/konsultasi/aset/style.css">
<!-- jQuery 2.1.4 -->
<script src="admin/konsultasi/aset/jQuery-2.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="admin/konsultasi/aset/bootstrap.js"></script>
<script src="admin/konsultasi/aset/icheck/icheck.js"></script>
<script src="admin/konsultasi/aset/ckeditor/ckeditor.js"></script>
<script src="admin/konsultasi/aset/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="admin/konsultasi/aset/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="admin/konsultasi/aset/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="admin/konsultasi/aset/Flot/jquery.flot.categories.js"></script>
<!-- AdminLTE App -->
<script src="admin/konsultasi/aset/app.js"></script>
