<?php
session_start();
    if( !empty( $_SESSION['id'] ) ){
    include "koneksi.php";


$idx = $_SESSION['id'];


// mengaktifkan session php

$nonaktif = mysqli_query($koneksi,"UPDATE `m_pegawai` SET  `status_login`='nonaktif' WHERE id = $idx ");

}
// menghapus semua session
session_destroy();



// mengalihkan halaman ke halaman login
header("location:index.php");
?>