<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Recommendation</title>
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
            <h1 class="masthead-heading text-uppercase mb-0">SmartPhone Recommendation</h1>
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

    <!--Section-->
    <section class="page-section">

        <div class="container">
            <ul>
                <div class="container">
                    <div class="row justify-content-center">
                        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Recommendation</h2>
                        <!-- Icon Divider-->
                        <div class="divider-custom">
                            <div class="divider-custom-line"></div>
                            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                            <div class="divider-custom-line"></div>
                        </div>

                        <form class="col s12 align-items-center dropdown" method="POST" action="result.php">

                            <div class="row">
                                <div class="col s12">
                                    <div class="col s6" style="margin-top: 10px;">
                                        <h3 class="">Harga</h3>
                                    </div>
                                    <div class="col s6 lead">
                                        <select class="form-select" required name="harga">
                                            <option value="" disabled selected style="color: #eceff1;">Harga</option>
                                            <option value="5">
                                                < Rp. 1.000.000</option>
                                            <option value="4">1.000.000 - 3.000.000</option>
                                            <option value="3">3.000.000 - 4.000.000</option>
                                            <option value="2">4.000.000 - 5.000.000</option>
                                            <option value="1">> 5.000.000</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <h3 class="">RAM</h3>
                                    </div>
                                    <div class="col s6 lead">
                                        <select class="form-select" required name="ram">
                                            <option value="" disabled selected style="color: #eceff1;">RAM</option>
                                            <option value="1">0 - 1 Gb</option>
                                            <option value="2">2 Gb</option>
                                            <option value="3">3 Gb</option>
                                            <option value="4">4 Gb</option>
                                            <option value="5">> 5 Gb</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <h3 class="">ROM</h3>
                                    </div>
                                    <div class="col s6 lead">
                                        <select class="form-select" required name="memori">
                                            <option value="" disabled selected style="color: #eceff1;">ROM</option>
                                            <option value="1">0 - 4 Gb</option>
                                            <option value="2">8 Gb</option>
                                            <option value="3">16 Gb</option>
                                            <option value="4">32 Gb</option>
                                            <option value="5">> 32 Gb</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <h3 class="">Processor</h3>
                                    </div>
                                    <div class="col s6 lead">
                                        <select class="form-select" required name="processor">
                                            <option value="" disabled selected style="color: #eceff1;">Processor</option>
                                            <option value="1">Dualcore</option>
                                            <option value="3">Quadcore</option>
                                            <option value="5">Octacore</option>
                                        </select>
                                    </div>

                                    <div class="col s6" style="margin-top: 10px;">
                                        <h3 class="">Kamera</h3>
                                    </div>
                                    <div class="col s6 lead">
                                        <select class="form-select" required name="kamera">
                                            <option value="" disabled selected style="color: #eceff1;">Kamera</option>
                                            <option value="1">0 - 8 Mp</option>
                                            <option value="3">8 - 13 Mp</option>
                                            <option value="5">>13 Mp</option>
                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-xl btn-primary mt-5">SUBMIT</button>
                            </div>
                        </form>
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