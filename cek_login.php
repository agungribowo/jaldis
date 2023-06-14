<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $koneksi->real_escape_string($_POST['username']);
$password = $koneksi->real_escape_string($_POST['password']);

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query(
	$koneksi,"SELECT m_pegawai.* from m_pegawai
	where username='$username' and password=MD5('$password') and status_pegawai='Aktif' ");
$aktif = mysqli_query($koneksi,"UPDATE `m_pegawai` SET  `status_login`='Aktif' WHERE username='$username' and password=MD5('$password') ");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);
	// cek jika user login sebagai admin
	if($data['level']=="sysadmin"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "sysadmin";
		$_SESSION['id'] = $data['id'];
		$_SESSION['nama'] = $data['nama'];
		 $_SESSION["last_login_time"] = time();
		// alihkan ke halaman dashboard admin
		header("location:./modul/sysadmin/");

		// cek jika user login sebagai pegawai
	}else if($data['level']=="Pelaksana"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Pelaksana";
		$_SESSION['id'] = $data['id'];
		$_SESSION['nama'] = $data['nama'];
		 $_SESSION["last_login_time"] = time();
		// alihkan ke halaman dashboard pegawai
		header("location:./modul/pelaksana/");

		// cek jika user login sebagai pegawai
	}else if($data['level']=="PPK"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "PPK";
		$_SESSION['id'] = $data['id'];
		$_SESSION['nama'] = $data['nama'];
			$_SESSION["last_login_time"] = time();
		// alihkan ke halaman dashboard pegawai
		header("location:./modul/ppk/");

	}else{
		// alihkan ke halaman login kembali
		header("location:index?pesan=gagal");
	}
}else{
	header("location:index?pesan=gagal");
}
?>
