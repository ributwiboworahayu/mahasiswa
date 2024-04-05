<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Edit Data Mahasiswa</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Edit Data Mahasiswa</h1>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "unimed";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query untuk mendapatkan data mahasiswa berdasarkan ID
            $sql = "SELECT * FROM mahasiswa WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nama = $row['nama'];
                $nim = $row['nim'];
                $email = $row['email'];
                $telepon = $row['telepon'];
            } else {
                echo "Data mahasiswa tidak ditemukan.";
                $conn->close();
                exit();
            }
        } else {
            header("Location: /");
            $conn->close();
            exit();
        }
        ?>

        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>