<?php
if(isset($_GET['kode'])){
            $sql_hapus = "DELETE FROM tb_hasil WHERE id_hasil='".$_GET['kode']."'";
            $query_hapus = mysqli_query($koneksi, $sql_hapus);

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Sukses!',text: 'Data Riwayat Konsultasi Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=riwayat-konsultasi';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Oops...!',text: 'Data Riwayat Konsultasi Gagal Dihapus',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=riwayat-konsultasi';
                    }
                })</script>";
            }
        }

