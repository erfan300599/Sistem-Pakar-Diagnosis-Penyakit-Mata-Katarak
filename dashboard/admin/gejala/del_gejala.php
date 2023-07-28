<?php
if(isset($_GET['kode'])){
            $sql_hapus = "DELETE FROM tb_gejala WHERE id_gejala='".$_GET['kode']."'";
            $query_hapus = mysqli_query($koneksi, $sql_hapus);

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Sukses!',text: 'Data Gejala Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-gejala';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Oops...!',text: 'Data Gejala Gagal Dihapus',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-gejala';
                    }
                })</script>";
            }
        }

