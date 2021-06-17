<?php
session_start();
include('koneksi.php');
?>

<?php
if (isset($_POST["tambah_hp"])) {
    $nama      = $_POST["nama"];
    $harga     = $_POST["harga"];
    $ram       = $_POST["ram"];
    $memori    = $_POST["memori"];
    $processor = $_POST["processor"];
    $kamera    = $_POST["kamera"];

    $harga_angka = $ram_angka = $memori_angka = $processor_angka = $kamera_angka = 0;

    if ($harga < 1000000) {
        $harga_angka = 5;
    } elseif ($harga >= 1000000 && $harga <= 3000000) {
        $harga_angka = 4;
    } elseif ($harga > 3000000 && $harga <= 4000000) {
        $harga_angka = 3;
    } elseif ($harga > 4000000 && $harga <= 5000000) {
        $harga_angka = 2;
    } elseif ($harga > 5000000) {
        $harga_angka = 1;
    }


    if ($ram < 6) {
        $ram_angka = $ram;
    } elseif ($ram == 6) {
        $ram_angka = 5;
    }


    if ($memori == 4) {
        $memori_angka = 1;
    } elseif ($memori == 8) {
        $memori_angka = 2;
    } elseif ($memori == 16) {
        $memori_angka = 3;
    } elseif ($memori == 32) {
        $memori_angka = 4;
    } elseif ($memori == 64) {
        $memori_angka = 5;
    }


    if ($processor == "Dualcore") {
        $processor_angka = 1;
    } elseif ($processor == "Quadcore") {
        $processor_angka = 3;
    } elseif ($processor == "Octacore") {
        $processor_angka = 5;
    }


    if ($kamera == 8) {
        $kamera_angka = 1;
    } elseif ($kamera == 13) {
        $kamera_angka = 3;
    } elseif ($kamera == 16) {
        $kamera_angka = 5;
    }

    $sql = "INSERT INTO `data_hp` (`id_hp`, `nama_hp`, `harga_hp`, `ram_hp`, `memori_hp`, `processor_hp`, `kamera_hp`, `harga_angka`, `ram_angka`, `memori_angka`, `processor_angka`, `kamera_angka`) 
				VALUES (NULL, :nama_hp, :harga_hp, :ram_hp, :memori_hp, :processor_hp, :kamera_hp, :harga_angka, :ram_angka, :memori_angka, :processor_angka, :kamera_angka)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':nama_hp', $nama);
    $stmt->bindValue(':harga_hp', $harga);
    $stmt->bindValue(':ram_hp', $ram);
    $stmt->bindValue(':memori_hp', $memori);
    $stmt->bindValue(':processor_hp', $processor);
    $stmt->bindValue(':kamera_hp', $kamera);
    $stmt->bindValue(':harga_angka', $harga_angka);
    $stmt->bindValue(':ram_angka', $ram_angka);
    $stmt->bindValue(':memori_angka', $memori_angka);
    $stmt->bindValue(':processor_angka', $processor_angka);
    $stmt->bindValue(':kamera_angka', $kamera_angka);
    $stmt->execute();
}

if (isset($_POST["hapus_hp"])) {
    $id_hapus_hp = $_POST['id_hapus_hp'];
    $sql_delete = "DELETE FROM `data_hp` WHERE `id_hp` = :id_hapus_hp";
    $stmt_delete = $db->prepare($sql_delete);
    $stmt_delete->bindValue(':id_hapus_hp', $id_hapus_hp);
    $stmt_delete->execute();
    $query_reorder_id = mysqli_query($selectdb, "ALTER TABLE data_hp AUTO_INCREMENT = 1");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Smartphone List</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">SPK</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="recommendation.php">Recommendation</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded active" href="list.php">Smartphone List</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">SmartPhone List</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Technique For Others Reference by Similarity to Ideal Solution (TOPSIS)</p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <div class="section-card">
                <ul>

                    <div class="row">
                        <div class="card">
                            <div class="card-content">
                                <h2 class="page-section-heading text-center text-secondary m-4">Smartphone List</h2>
                                <table id="table_id" class="table" style="width:100%">
                                    <thead style="border-top: 1px solid #d0d0d0;">
                                        <tr>
                                            <th>
                                                <center>No </center>
                                            </th>
                                            <th>
                                                <center>Nama HP</center>
                                            </th>
                                            <th>
                                                <center>Harga HP</center>
                                            </th>
                                            <th>
                                                <center>RAM HP</center>
                                            </th>
                                            <th>
                                                <center>Memori HP</center>
                                            </th>
                                            <th>
                                                <center>Processor HP</center>
                                            </th>
                                            <th>
                                                <center>Kamera HP</center>
                                            </th>
                                            <th>
                                                <center>Hapus</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $no; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['nama_hp'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo "Rp. ", $data['harga_hp'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['ram_hp'], " GB" ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['memori_hp'], " GB" ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['processor_hp'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['kamera_hp'], " MP" ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <form method="POST">
                                                            <input type="hidden" name="id_hapus_hp" value="<?php echo $data['id_hp'] ?>">
                                                            <button type="submit" name="hapus_hp" style="height: 32px; width: 32px;" class="btn btn-sm btn-danger">-</button>
                                                        </form>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="portfolio-item mx-auto m-4" data-bs-toggle="modal" data-bs-target="#tambahSmartphone">
                                    <div class="d-flex align-items-center justify-content-center h-100 w-100">
                                        <div class="text-center text-white"></div>
                                    </div>
                                    <a class="btn btn-primary h-100 w-100">Tambah Smartphone</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </ul>
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="section-card">
                <ul>

                    <div class="row">
                        <div class="card">
                            <div class="card-content" style="padding-top: 10px;">
                                <h2 class="page-section-heading text-center text-secondary m-4">Analisa Smartphone</h2>
                                <table class="table">

                                    <thead style="border-top: 1px solid #d0d0d0;">
                                        <tr>
                                            <th>
                                                <center>Alternatif</center>
                                            </th>
                                            <th>
                                                <center>C1 (Cost)</center>
                                            </th>
                                            <th>
                                                <center>C2 (Benefit)</center>
                                            </th>
                                            <th>
                                                <center>C3 (Benefit)</center>
                                            </th>
                                            <th>
                                                <center>C4 (Benefit)</center>
                                            </th>
                                            <th>
                                                <center>C5 (Benefit)</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo "A", $no ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['harga_angka'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['ram_angka'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['memori_angka'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['processor_angka'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $data['kamera_angka'] ?></center>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </ul>
            </div>
        </div>
    </section>

    <!-- Modal Start -->
    <div class="portfolio-modal modal fade" id="tambahSmartphone" tabindex="-1" aria-labelledby="tambahSmartphone" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <h2 class="page-section-heading text-center text-secondary m-4">Tambah Smartphone</h2>
                        <form method="POST" action="">
                            <div class="row justify-content-center">

                                <div class="col s12">
                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>Nama</b>
                                    </div>
                                    <div class="col s6">
                                        <input class="form-control" style="height: 2rem;" name="nama" type="text" required>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>Harga</b>
                                    </div>
                                    <div class="col s6">
                                        <input class="form-control" style=" height: 2rem;" name="harga" type="number" required>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>RAM</b>
                                    </div>
                                    <div class="col s6">
                                        <select class="form-select" style="display: block; margin-bottom: 4px;" required name="ram">
                                            <!-- <option value = "" disabled selected>Kriteria RAM</option>  -->
                                            <option value="1">1 Gb</option>
                                            <option value="2">2 Gb</option>
                                            <option value="3">3 Gb</option>
                                            <option value="4">4 Gb</option>
                                            <option value="6">6 Gb</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>ROM</b>
                                    </div>
                                    <div class="col s6">
                                        <select class="form-select" style="display: block; margin-bottom: 4px;" required name="memori">
                                            <!-- <option value = "" disabled selected>Kriteria Penyimpanan</option> -->
                                            <option value="4">4 Gb</option>
                                            <option value="8">8 Gb</option>
                                            <option value="16">16 Gb</option>
                                            <option value="32">32 Gb</option>
                                            <option value="64">64 Gb</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>Processor</b>
                                    </div>
                                    <div class="col s6">
                                        <select class="form-select" style="display: block; margin-bottom: 4px;" required name="processor">
                                            <option value="Dualcore">Dualcore</option>
                                            <option value="Quadcore">Quadcore</option>
                                            <option value="Octacore">Octacore</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <b>Kamera</b>
                                    </div>
                                    <div class="col s6">
                                        <select class="form-select" style="display: block; margin-bottom: 4px;" required name="kamera">
                                            <!-- <option value = "" disabled selected>Kriteria Kamera</option> -->
                                            <option value="8">8 Mp</option>
                                            <option value="13">13 Mp</option>
                                            <option value="16">16 Mp</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <button name="tambah_hp" type="submit" class="btn btn-primary h-80 w-80 m-2">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; SPK 2021</small></div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>