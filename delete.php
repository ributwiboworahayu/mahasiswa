<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "unimed";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID yang akan dihapus
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM mahasiswa WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data mahasiswa berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: /");
exit();
