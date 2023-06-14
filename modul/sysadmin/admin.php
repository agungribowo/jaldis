<?php
session_start();
if (empty($_SESSION['id'])) {
    //session_destroy();
    if ($_SESSION['level'] == "")
        header('Location: ../../index.php');
    die();
} else {
    include "../../koneksi.php";
?>

<?php
    include 'header.php';
    include 'menu.php';
?>

<?php
    if (isset($_REQUEST['hlm'])) {

        $hlm = $_REQUEST['hlm'];

        switch ($hlm) {
            case 'dashboard':
                include "dashboard/dashboard.php";
                break;

            case 'pegawai':
                include "master/pegawai/pegawai.php";
                break;

            case 'tambah_pegawai':
                include "master/pegawai/tambah_pegawai.php";
                break;

            case 'saku':
                include "master/saku/saku.php";
                break;            

            case 'harian':
                include "master/harian/harian.php";
                break;

            case 'meeting':
                include "master/meeting/meeting.php";
                break;

            case 'transport':
                include "master/transport/transport.php";
                break;

            
        }
    } else {
?>

<?php
        include 'dashboard/dashboard.php';
    }
}
?>

<?php include 'footer.php'; ?>