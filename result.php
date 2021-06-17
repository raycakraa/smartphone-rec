<?php
session_start();
include('koneksi.php');

//Bobot
$W1    = $_POST['harga'];
$W2    = $_POST['ram'];
$W3    = $_POST['memori'];
$W4    = $_POST['processor'];
$W5    = $_POST['kamera'];

//Pembagi Normalisasi
function pembagiNM($matrik)
{
    for ($i = 0; $i < 5; $i++) {
        $pangkatdua[$i] = 0;
        for ($j = 0; $j < sizeof($matrik); $j++) {
            $pangkatdua[$i] = $pangkatdua[$i] + pow($matrik[$j][$i], 2);
        }
        $pembagi[$i] = sqrt($pangkatdua[$i]);
    }
    return $pembagi;
}

//Normalisasi
function Transpose($squareArray)
{

    if ($squareArray == null) {
        return null;
    }
    $rotatedArray = array();
    $r = 0;

    foreach ($squareArray as $row) {
        $c = 0;
        if (is_array($row)) {
            foreach ($row as $cell) {
                $rotatedArray[$c][$r] = $cell;
                ++$c;
            }
        } else $rotatedArray[$c][$r] = $row;
        ++$r;
    }
    return $rotatedArray;
}

function JarakIplus($aplus, $bob)
{
    for ($i = 0; $i < sizeof($bob); $i++) {
        $dplus[$i] = 0;
        for ($j = 0; $j < sizeof($aplus); $j++) {
            $dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]), 2);
        }
        $dplus[$i] = round(sqrt($dplus[$i]), 4);
    }
    return $dplus;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Recommendation Result</title>
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
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded active" href="recommendation.php">Recommendation</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="list.php">Smartphone List</a></li>
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
            <h1 class="masthead-heading text-uppercase mb-0">SmartPhone Recommendation Result</h1>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Matriks Smartphone</h2>
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
                                    while ($data_hp = mysqli_fetch_array($query)) {
                                        $Matrik[$no - 1] = array($data_hp['harga_angka'], $data_hp['ram_angka'], $data_hp['memori_angka'], $data_hp['processor_angka'], $data_hp['kamera_angka']);
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo "A", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $data_hp['harga_angka'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $data_hp['ram_angka'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $data_hp['memori_angka'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $data_hp['processor_angka'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $data_hp['kamera_angka'] ?></center>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Matriks Normalisasi "R"</h2>
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
                                    $pembagiNM = pembagiNM($Matrik);
                                    while ($data_hp = mysqli_fetch_array($query)) {

                                        $MatrikNormalisasi[$no - 1] = array(
                                            $data_hp['harga_angka'] / $pembagiNM[0],
                                            $data_hp['ram_angka'] / $pembagiNM[1],
                                            $data_hp['memori_angka'] / $pembagiNM[2],
                                            $data_hp['processor_angka'] / $pembagiNM[3],
                                            $data_hp['kamera_angka'] / $pembagiNM[4]
                                        );

                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo "A", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($data_hp['harga_angka'] / $pembagiNM[0], 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($data_hp['ram_angka'] / $pembagiNM[1], 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($data_hp['memori_angka'] / $pembagiNM[2], 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($data_hp['processor_angka'] / $pembagiNM[3], 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($data_hp['kamera_angka'] / $pembagiNM[4], 6) ?></center>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Bobot (W)</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Value Kriteria Harga</center>
                                        </th>
                                        <th>
                                            <center>Value Kriteria Ram</center>
                                        </th>
                                        <th>
                                            <center>Value Kriteria Memori</center>
                                        </th>
                                        <th>
                                            <center>Value Kriteria Processor</center>
                                        </th>
                                        <th>
                                            <center>Value Kriteria Kamera</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--count($W)-->
                                    <tr>
                                        <td>
                                            <center><?php echo ($W1); ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo ($W2); ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo ($W3); ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo ($W4); ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo ($W5); ?></center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </ul>

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Matriks Normalisasi Bobot "Y"</h2>
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
                                    $pembagiNM = pembagiNM($Matrik);
                                    while ($data_hp = mysqli_fetch_array($query)) {

                                        $NormalisasiBobot[$no - 1] = array(
                                            $MatrikNormalisasi[$no - 1][0] * $W1,
                                            $MatrikNormalisasi[$no - 1][1] * $W2,
                                            $MatrikNormalisasi[$no - 1][2] * $W3,
                                            $MatrikNormalisasi[$no - 1][3] * $W4,
                                            $MatrikNormalisasi[$no - 1][4] * $W5
                                        );

                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo "A", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($MatrikNormalisasi[$no - 1][0] * $W1, 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($MatrikNormalisasi[$no - 1][1] * $W2, 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($MatrikNormalisasi[$no - 1][2] * $W3, 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($MatrikNormalisasi[$no - 1][3] * $W4, 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($MatrikNormalisasi[$no - 1][4] * $W5, 6) ?></center>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Matriks Solusi Ideal Positif "A+" & Negatif "A-"</h2>
                            <table class="table">

                                <thead style="border-top: 1px solid #d0d0d0;">
                                    <tr>
                                        <th>
                                            <center></center>
                                        </th>
                                        <th>
                                            <center>Y1 (Cost)</center>
                                        </th>
                                        <th>
                                            <center>Y2 (Benefit)</center>
                                        </th>
                                        <th>
                                            <center>Y3 (Benefit)</center>
                                        </th>
                                        <th>
                                            <center>Y4 (Benefit)</center>
                                        </th>
                                        <th>
                                            <center>Y5 (Benefit)</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $NormalisasiBobotTrans = Transpose($NormalisasiBobot);
                                    ?>
                                    <tr>
                                        <?php
                                        $idealpositif = array(min($NormalisasiBobotTrans[0]), max($NormalisasiBobotTrans[1]), max($NormalisasiBobotTrans[2]), max($NormalisasiBobotTrans[3]), max($NormalisasiBobotTrans[4]));
                                        ?>
                                        <td>
                                            <center><?php echo "Y+" ?> </center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(min($NormalisasiBobotTrans[0]), 6)); ?>&nbsp(min)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(max($NormalisasiBobotTrans[1]), 6)); ?>&nbsp(max)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(max($NormalisasiBobotTrans[2]), 6)); ?>&nbsp(max)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(max($NormalisasiBobotTrans[3]), 6)); ?>&nbsp(max)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(max($NormalisasiBobotTrans[4]), 6)); ?>&nbsp(max)</center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $idealnegatif = array(max($NormalisasiBobotTrans[0]), min($NormalisasiBobotTrans[1]), min($NormalisasiBobotTrans[2]), min($NormalisasiBobotTrans[3]), min($NormalisasiBobotTrans[4]));
                                        ?>
                                        <td>
                                            <center><?php echo "Y-" ?> </center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(max($NormalisasiBobotTrans[0]), 6)); ?>&nbsp(max)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(min($NormalisasiBobotTrans[1]), 6)); ?>&nbsp(min)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(min($NormalisasiBobotTrans[2]), 6)); ?>&nbsp(min)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(min($NormalisasiBobotTrans[3]), 6)); ?>&nbsp(min)</center>
                                        </td>
                                        <td>
                                            <center><?php echo (round(min($NormalisasiBobotTrans[4]), 6)); ?>&nbsp(min)</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </ul>

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Jarak Antara Nilai Bobot Setiap Alternatif Terhadap Solusi Ideal Positif "A+"
                            </h2>
                            <table class="table">

                                <thead style="border-top: 1px solid #d0d0d0;">
                                    <tr>
                                        <th>
                                            <center>D+</center>
                                        </th>
                                        <th>
                                            <center></center>
                                        </th>
                                        <th>
                                            <center>D-</center>
                                        </th>
                                        <th>
                                            <center></center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                    $no = 1;
                                    $Dplus = JarakIplus($idealpositif, $NormalisasiBobot);
                                    $Dmin = JarakIplus($idealnegatif, $NormalisasiBobot);
                                    while ($data_hp = mysqli_fetch_array($query)) {

                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo "D", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($Dplus[$no - 1], 6) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo "D", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo round($Dmin[$no - 1], 6) ?></center>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Nilai Preferensi Setiap Alternatif (V)</h2>
                            <table class="table">

                                <thead style="border-top: 1px solid #d0d0d0;">
                                    <tr>
                                        <th>
                                            <center>Nilai Preferensi "V"</center>
                                        </th>
                                        <th>
                                            <center>Nilai</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                    $no = 1;
                                    $nilaiV = array();
                                    while ($data_hp = mysqli_fetch_array($query)) {

                                        array_push($nilaiV, $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]));
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo "V", $no ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]); ?></center>
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

            <ul class="mb-5">

                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="page-section-heading text-center text-secondary m-4">Nilai Preferensi Tertinggi</h2>
                            <table class="table">

                                <thead style="border-top: 1px solid #d0d0d0;">
                                    <tr>
                                        <th>
                                            <center>Nilai Preferensi tertinggi</center>
                                        </th>
                                        <th></th>
                                        <th>
                                            <center>Alternatif HP terpilih</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $testmax = max($nilaiV);
                                        for ($i = 0; $i < count($nilaiV); $i++) {
                                            if ($nilaiV[$i] == $testmax) {
                                                $query = mysqli_query($selectdb, "SELECT * FROM data_hp where id_hp = $i+1");
                                        ?>
                                                <td>
                                                    <center><?php echo "V" . ($i + 1); ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $nilaiV[$i]; ?></center>
                                                </td>
                                                <?php while ($user = mysqli_fetch_array($query)) { ?>
                                                    <td>
                                                        <center><?php echo $user['nama_hp']; ?></center>
                                                    </td>
                                        <?php
                                                }
                                            }
                                        } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </ul>
        </div>

    </section>

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