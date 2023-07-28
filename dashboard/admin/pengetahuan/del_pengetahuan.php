<?php
if(isset($_GET['kode'])){
            $sql_hapus = "DELETE FROM tb_pengetahuan WHERE id_pengetahuan='".$_GET['kode']."'";
            $query_hapus = mysqli_query($koneksi, $sql_hapus);

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Sukses!',text: 'Data Pengetahuan Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pengetahuan';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Oops...!',text: 'Data Pengetahuan Gagal Dihapus',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pengetahuan';
                    }
                })</script>";
            }
        }

