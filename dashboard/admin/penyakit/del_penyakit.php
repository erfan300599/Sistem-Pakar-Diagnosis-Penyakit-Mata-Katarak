<?php
if(isset($_GET['kode'])){
            $sql_hapus = "DELETE FROM tb_penyakit WHERE id_penyakit='".$_GET['kode']."'";
            $query_hapus = mysqli_query($koneksi, $sql_hapus);

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Sukses!',text: 'Data Penyakit Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-penyakit';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Oops...!',text: 'Data Penyakit Gagal Dihapus',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-penyakit';
                    }
                })</script>";
            }
        }

