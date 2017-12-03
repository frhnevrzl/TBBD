 <?php
$koneksi = new mysqli("localhost", "root", "", "tbbd");
if ($koneksi->connect_errno) {
    echo "Koneksi ke Database Gagal" . $koneksi->connect_error;
}
?>
