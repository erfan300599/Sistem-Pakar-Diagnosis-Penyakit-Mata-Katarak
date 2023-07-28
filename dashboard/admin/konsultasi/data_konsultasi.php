<?php
switch (isset($_GET['act'])) {

  default:
  if (isset($_POST['submit'])) {

    $input_gejala = $_POST['kondisi'];
    $kosong = true;
    foreach ($input_gejala as $g) {
      if ($g != 0) {
        $kosong = false;
      }
    }

    if ($kosong == false) {

      $arcolor = array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
      date_default_timezone_set("Asia/Ujung_Pandang");
      $inptanggal = date('Y-m-d H:i:s');

      $arbobot = array('0', '1', '0.8', '0.6', '0.4', '0.2');
      $argejala = array();

      for ($i = 0; $i < count($_POST['kondisi']); $i++) {
        $arkondisi = explode("_", $_POST['kondisi'][$i]);
        if (strlen($_POST['kondisi'][$i]) > 1) {
          $argejala += array($arkondisi[0] => $arkondisi[1]);
        }
      }

      $sqlkondisi = mysqli_query($koneksi,"SELECT * FROM tb_kondisi order by id+0");
      while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
        $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
      }

      $sqlpkt = mysqli_query($koneksi,"SELECT * FROM tb_penyakit order by id_penyakit+0");
      while ($rpkt = mysqli_fetch_array($sqlpkt)) {
        $arpkt[$rpkt['id_penyakit']] = $rpkt['nama_penyakit'];
        $ardpkt[$rpkt['id_penyakit']] = $rpkt['det_penyakit'];
        $arspkt[$rpkt['id_penyakit']] = $rpkt['srn_penyakit'];
        $argpkt[$rpkt['id_penyakit']] = $rpkt['gambar_penyakit'];
      }


      if ($umur > 5){

        // -------- perhitungan certainty factor (CF) ---------
        // --------------------- START ------------------------
        $sqlpenyakit = mysqli_query($koneksi,"SELECT * FROM tb_penyakit WHERE tipe_penyakit='5 Tahun Keatas' OR tipe_penyakit='umum'");
        // mengambil data penyakit dari database
        $arpenyakit = array();
        while ($rpenyakit = mysqli_fetch_array($sqlpenyakit,MYSQLI_BOTH)) { // melakukan perulangan berdasarkan jumlah data penyakit dalam database
          $cftotal_temp = 0; // dihitung mulai dari 0
          $cf = 0; // dihitung mulai dari 0
          $sqlgejala = mysqli_query($koneksi,"SELECT * FROM tb_pengetahuan where id_penyakit=$rpenyakit[id_penyakit]"); // mengambil data pengetahuan berdasarkan id penyakit karena tabel pengetahuan digabungkan dengan tabel penyakit
          $cflama = 0; // nilai combine awal 
          while ($rgejala = mysqli_fetch_array($sqlgejala,MYSQLI_BOTH)) { // melakukan perulangan berdasarkan data pengetahuan dalam database
            $arkondisi = explode("_", $_POST['kondisi'][0]); // memecah array
            $gejala = $arkondisi[0]; // mengambil nilai kondisi 

            for ($i = 0; $i < count($_POST['kondisi']); $i++) { // menghitung nilai gejala berdasarkan nilai kondisi
              $arkondisi = explode("_", $_POST['kondisi'][$i]); // membongkar array kondisi berdasarkan jumlah nilai kondisi 
              $gejala = $arkondisi[0]; 
              if ($rgejala['id_gejala'] == $gejala) { // menjalankan fungsi cf combine
                $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];
                if (($cf >= 0) && ($cf * $cflama >= 0)) {
                  $cflama = $cflama + ($cf * (1 - $cflama));
                }
                if ($cf * $cflama < 0) {
                  $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
                }
                if (($cf < 0) && ($cf * $cflama >= 0)) {
                  $cflama = $cflama + ($cf * (1 + $cflama));
                }
              }
            }
          }
          if ($cflama > 0) {
            $arpenyakit += array($rpenyakit['id_penyakit'] => number_format($cflama, 4)); // ambil nilai dari penyakit berdasarkan nilai kondisi dalam bentuk angka
          }
        }
      }elseif($umur < 5){

        // -------- perhitungan certainty factor (CF) ---------
        // --------------------- START ------------------------
        $sqlpenyakit = mysqli_query($koneksi,"SELECT * FROM tb_penyakit WHERE tipe_penyakit='5 Tahun Kebawah' OR tipe_penyakit='umum'");
        // mengambil data penyakit dari database
        $arpenyakit = array();
        while ($rpenyakit = mysqli_fetch_array($sqlpenyakit,MYSQLI_BOTH)) { // melakukan perulangan berdasarkan jumlah data penyakit dalam database
          $cftotal_temp = 0; // dihitung mulai dari 0
          $cf = 0; // dihitung mulai dari 0
          $sqlgejala = mysqli_query($koneksi,"SELECT * FROM tb_pengetahuan where id_penyakit=$rpenyakit[id_penyakit]"); // mengambil data pengetahuan berdasarkan id penyakit karena tabel pengetahuan digabungkan dengan tabel penyakit
          $cflama = 0; // nilai combine awal 
          while ($rgejala = mysqli_fetch_array($sqlgejala,MYSQLI_BOTH)) { // melakukan perulangan berdasarkan data pengetahuan dalam database
            $arkondisi = explode("_", $_POST['kondisi'][0]); // memecah array
            $gejala = $arkondisi[0]; // mengambil nilai kondisi 

            for ($i = 0; $i < count($_POST['kondisi']); $i++) { // menghitung nilai gejala berdasarkan nilai kondisi
              $arkondisi = explode("_", $_POST['kondisi'][$i]); // membongkar array kondisi berdasarkan jumlah nilai kondisi 
              $gejala = $arkondisi[0]; 
              if ($rgejala['id_gejala'] == $gejala) { // menjalankan fungsi cf combine
                $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];
                if (($cf >= 0) && ($cf * $cflama >= 0)) {
                  $cflama = $cflama + ($cf * (1 - $cflama));
                }
                if ($cf * $cflama < 0) {
                  $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
                }
                if (($cf < 0) && ($cf * $cflama >= 0)) {
                  $cflama = $cflama + ($cf * (1 + $cflama));
                }
              }
            }
          }
          if ($cflama > 0) {
            $arpenyakit += array($rpenyakit['id_penyakit'] => number_format($cflama, 4)); // ambil nilai dari penyakit berdasarkan nilai kondisi dalam bentuk angka
          }
        }
      }

      arsort($arpenyakit);

      $inpgejala = serialize($argejala); 
      $inppenyakit = serialize($arpenyakit);

      $np1 = 0;
      foreach ($arpenyakit as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = $key1;
        $vlpkt1[$np1] = $value1;
      }
      $id = $_SESSION["ses_id"];
      mysqli_query($koneksi,"INSERT INTO tb_hasil(
        tanggal,
        gejala,
        penyakit,
        hasil_id,
        hasil_nilai,
        id_pengguna                 
        ) 
      VALUES(
        '$inptanggal',
        '$inpgejala',
        '$inppenyakit',
        '$idpkt1[1]',
        '$vlpkt1[1]',
        '$id'
      )");
        // --------------------- END -------------------------

      echo "<div class='content'>
      <h2 class='text text-primary'><b>Hasil Konsultasi</b> &nbsp;&nbsp;<button id='print' onClick='window.print();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil Konsultasi'><i class='fa fa-print'></i> Cetak</button></h2>
      <hr>

      <div><h4 class='card-header bg-secondary'><b>Data Pasien</b></h4>
      <table class='table table-bordered'>
      <tr><td width=300>Nama Pasien</td><td><input autocomplete='off' type=text class='form-control' name='nama_pengguna' size=30 value='$data_nama' readonly></td></tr> 
      <tr><td width=300>Jenis Kelamin</td><td><input autocomplete='off' type=text class='form-control' name='jk' size=30 value='$data_jk' readonly></td></tr>
      <tr><td width=300>Umur Pasien</td><td><input autocomplete='off' type=text class='form-control' name='tanggal_lahir' size=30 value='$umur Tahun' readonly></td></tr>
      </table>
      </div>



      <table class='table table-bordered table-striped konsultasi'> 
      <th width=8%>No</th>
      <th>Gejala yang dialami (keluhan)</th>
      <th width=20%>Pilihan</th>
      </tr>";
      $ig = 0;
      foreach ($argejala as $key => $value) {
        $kondisi = $value;
        $ig++;
        $gejala = $key;
        $sql4 = mysqli_query($koneksi,"SELECT * FROM tb_gejala where id_gejala = '$key'");
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
    } else {
      echo '<script type ="text/JavaScript">';
      echo 'alert("Silahkan pilih gejala yang dialami!")';
      echo '</script>';
      echo "
      <h2 class='text text-primary'>Konsultasi Penyakit</h2>  <hr>
      <div class='alert alert-success alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <h4 class='text-white'><b>Perhatian!</b></h4>
      Silahkan memilih gejala sesuai dengan yang Anda rasakan atau sedang dialami dengan memilih kepastian kondisi yang tertera mulai dari <b>'sangat yakin'</b> sampai <b>'kurang yakin'</b>. Jika bukan gejala yang Anda rasakan atau sedang dialami maka silahkan dikosongkan saja lalu dilanjutkan dengan menekan tombol diagnosa (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
      </div>
      <form name=text_form method=POST action='' >
      <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
      <tr><th>No</th><th>Gejala</th><th>Foto</th><th width='20%'>Pilih Kondisi</th></tr>";

   // echo "<input class='btn btn-success' type=submit value='Betina' name='betina'>&nbsp
   //      <input class='btn btn-success' type=submit value='Jantan' name='jantan'><br><br>";


      if($umur > 5){     
        $sql3 = mysqli_query($koneksi,"SELECT * FROM tb_gejala order by id_gejala");
        $i = 0;
        while ($r3 = mysqli_fetch_array($sql3)) {
          $i++;
          $gambar="admin/gambar/gejala/" . $r3['gambar_gejala'];
          echo "<tr><td class=opsi>$i</td>";
        // echo "<td class=opsi>G" . str_pad($r3['id_gejala'], 3, '0', STR_PAD_LEFT) . "</td>";
          echo "<td class=gejala>$r3[nama_gejala]</td>";
          echo "<td class=gejala> 
          <div class='card' style='width: 15rem;'>
          <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'></div></td>";
          echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
          $s = "select * from tb_kondisi order by id";
          $q = mysqli_query($koneksi,$s) or die($s);
          while ($rw = mysqli_fetch_array($q)) {
            ?>
            <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['id_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
            <?php
          }
          echo '</select></td>';
          ?>
          <script type="text/javascript">
            $(document).ready(function() {
              var arcolor = new Array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
              setColor();
              $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function() {
                setColor();
              });

              function setColor() {
                var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
                var color = arcolor[selectedItem.data("id")];
                $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
                console.log(color);

              }
            });
          </script>
          <?php
          echo "</tr>";
        }
      }      elseif($umur < 5){     
        $sql3 = mysqli_query($koneksi,"SELECT * FROM tb_gejala WHERE tipe_gejala='Umum'");
        $i = 0;
        while ($r3 = mysqli_fetch_array($sql3)) {
          $i++;
          $gambar="admin/gambar/gejala/" . $r3['gambar_gejala'];
          echo "<tr><td class=opsi>$i</td>";
        // echo "<td class=opsi>G" . str_pad($r3['id_gejala'], 3, '0', STR_PAD_LEFT) . "</td>";
          echo "<td class=gejala>$r3[nama_gejala]</td>";
          echo "<td class=gejala> 
          <div class='card' style='width: 15rem;'>
          <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'></div></td>";
          echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
          $s = "select * from tb_kondisi order by id";
          $q = mysqli_query($koneksi,$s) or die($s);
          while ($rw = mysqli_fetch_array($q)) {
            ?>
            <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['id_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
            <?php
          }
          echo '</select></td>';
          ?>
          <script type="text/javascript">
            $(document).ready(function() {
              var arcolor = new Array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
              setColor();
              $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function() {
                setColor();
              });

              function setColor() {
                var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
                var color = arcolor[selectedItem.data("id")];
                $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
                console.log(color);

              }
            });
          </script>
          <?php
          echo "</tr>";
        }
      }
      echo "
      <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
      </tbody></table></form>";

    }
  } else {
    echo "
    <h2 class='text text-primary'><b>Konsultasi Penyakit</b></h2>  <hr>
    <div class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
    <h4 class='text-white'><b>Perhatian!</b></h4>
    Silahkan memilih gejala sesuai dengan yang Anda rasakan atau sedang dialami dengan memilih kepastian kondisi yang tertera mulai dari <b>'sangat yakin'</b> sampai <b>'kurang yakin'</b>. Jika bukan gejala yang Anda rasakan atau sedang dialami maka silahkan dikosongkan saja lalu dilanjutkan dengan menekan tombol diagnosa (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
    </div>


    <form name=text_form method=POST action='' >
    <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
    <tr><th>No</th><th>Gejala</th><th>Foto</th><th width='20%'>Pilih Kondisi</th></tr>";

    if($umur > 5){  
      $sql3 = mysqli_query($koneksi,"SELECT * FROM tb_gejala order by id_gejala");
      $i = 0;
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        $gambar="admin/gambar/gejala/" . $r3['gambar_gejala'];
        echo "<tr><td class=opsi>$i</td>";
        // echo "<td class=opsi>G" . str_pad($r3['id_gejala'], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=gejala>$r3[nama_gejala]</td>";
        echo "<td class=gejala> 
        <div class='card' style='width: 15rem;'>
        <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'></div></td>";
        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
        $s = "select * from tb_kondisi order by id";
        $q = mysqli_query($koneksi,$s) or die($s);
        while ($rw = mysqli_fetch_array($q)) {
          ?>
          <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['id_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
          <?php
        }
        echo '</select></td>';
        ?>
        <script type="text/javascript">
          $(document).ready(function() {
            var arcolor = new Array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
            setColor();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function() {
              setColor();
            });

            function setColor() {
              var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
              var color = arcolor[selectedItem.data("id")];
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
              console.log(color);

            }
          });
        </script>
        <?php
        echo "</tr>";
      }
    }       elseif($umur < 5){  
      $sql3 = mysqli_query($koneksi,"SELECT * FROM tb_gejala WHERE tipe_gejala='Umum'");
      $i = 0;
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        $gambar="admin/gambar/gejala/" . $r3['gambar_gejala'];
        echo "<tr><td class=opsi>$i</td>";
        // echo "<td class=opsi>G" . str_pad($r3['id_gejala'], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=gejala>$r3[nama_gejala]</td>";
        echo "<td class=gejala> 
        <div class='card' style='width: 15rem;'>
        <img class='card-img-top' src='" . $gambar . "' alt='Card image cap'></div></td>";
        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
        $s = "select * from tb_kondisi order by id";
        $q = mysqli_query($koneksi,$s) or die($s);
        while ($rw = mysqli_fetch_array($q)) {
          ?>
          <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['id_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
          <?php
        }
        echo '</select></td>';
        ?>
        <script type="text/javascript">
          $(document).ready(function() {
            var arcolor = new Array('#ffffff', '#00ff0d', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
            setColor();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function() {
              setColor();
            });

            function setColor() {
              var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
              var color = arcolor[selectedItem.data("id")];
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
              console.log(color);

            }
          });
        </script>
        <?php
        echo "</tr>";
      }
    }
    echo "
    <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
    </tbody></table></form>";
  }
  break;
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