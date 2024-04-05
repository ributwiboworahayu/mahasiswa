<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Mahasiswa</title>
    <style>
        /* Styling untuk warna latar belakang tabel */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="tambah_data.php">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Kontak Mahasiswa</h1>
        <!-- Lihat Data -->
        <div id="lihatData" class="mt-4">
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

            // Mendapatkan nilai sortColumn dan sortOrder dari query string URL
            $sortColumn = isset($_GET['sort']) && $_GET['sort'] != '' ? $_GET['sort'] : 'nama'; // jika data yang diambil tidak ada == nama
            $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

            // Query untuk mengambil data
            $sql = "SELECT * FROM mahasiswa order by $sortColumn $sortOrder";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- Tombol pengurutan untuk ID -->
                            <th><a href="?sort=id&order=<?php echo $sortColumn === 'id' && $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>">ID</a></th>
                            <!-- Tombol pengurutan untuk Nama -->
                            <th><a href="?sort=nama&order=<?php echo $sortColumn === 'nama' && $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>">Nama</a></th>
                            <!-- Tombol pengurutan untuk NIM -->
                            <th><a href="?sort=nim&order=<?php echo $sortColumn === 'nim' && $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>">NIM</a></th>
                            <!-- Tombol pengurutan untuk Email -->
                            <th><a href="?sort=email&order=<?php echo $sortColumn === 'email' && $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>">Email</a></th>
                            <!-- Tombol pengurutan untuk Telepon -->
                            <th><a href="?sort=telepon&order=<?php echo $sortColumn === 'telepon' && $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>">Telepon</a></th>
                            <!-- Aksi -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tampilkan data
                        $i = 1; // untuk nomor halaman
                        while ($row = $result->fetch_assoc()) {
                            // Menampilkan setiap baris data mahasiswa
                            echo '<tr>
                                    <td>' . $i++ . '</td> <!-- Kolom Nomor -->
                                    <td>' . $row['nama'] . '</td> <!-- Kolom Nama -->
                                    <td>' . $row['nim'] . '</td> <!-- Kolom NIM -->
                                    <td>' . $row['email'] . '</td> <!-- Kolom Email -->
                                    <td>' . $row['telepon'] . '</td> <!-- Kolom Telepon -->
                                    <td><a href="edit.php?id=' . $row['id'] . '">Edit</a> | <a href="delete.php?id=' . $row['id'] . '">Hapus</a></td> <!-- Aksi -->
                                  </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Tidak ada data mahasiswa.</p> <!-- Pesan jika tidak ada data -->
            <?php endif;

            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>