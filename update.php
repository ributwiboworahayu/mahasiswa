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

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    // Query untuk mengubah data
    $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', email='$email', telepon='$telepon' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data mahasiswa berhasil diubah.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
header("Location: /");
exit();
