<?php
    require 'functions.php';

    $idkonsumen = $_POST["konsumen"];
    $waktu = $_POST["waktu"];
    $status = $_POST["status"];

    //menampilkan nama user
    $nama = query("SELECT namakonsumen FROM konsumen WHERE idkonsumen = '$idkonsumen'")[0];

    // menampilkan data transaksi
    $trans = query("SELECT pembelian.idpembelian, namabarang, namakonsumen,jumlahbeli,harga,harga * jumlahbeli AS 'hargapembelian'
    FROM pembelian
    INNER JOIN konsumen
    ON pembelian.idkonsumen = konsumen.idkonsumen
    INNER JOIN inventoribarang
    ON pembelian.idbarang = inventoribarang.idbarang
    WHERE konsumen.idkonsumen = '$idkonsumen' AND DATE(waktu) = '$waktu' AND STATUS = '$status'");

    // menghitung total transaksi
    $biayaTotal = query("SELECT SUM(harga * jumlahbeli) AS 'hargapembelian'
    FROM pembelian
    INNER JOIN konsumen
    ON pembelian.idkonsumen = konsumen.idkonsumen
    INNER JOIN inventoribarang
    ON pembelian.idbarang = inventoribarang.idbarang
    WHERE konsumen.idkonsumen = '$idkonsumen' AND DATE(waktu) = '$waktu' AND STATUS = '$status'")[0];

    if (isset($_POST["bayar"])){
        if(bayarStatusTransaksi($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah');
                    document.location.href = 'transaksi.php'
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah');
                    document.location.href = 'transaksi.php'
                </script>
            ";
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Menampilkan Data Transaksi</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Masukkan keyword" name="keyword" aria-label="" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="cari" type="submit" name="cari"><i class="fas fa-search"></i></button>
                </div>           
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                HOME
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseTransaksi" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="transaksi.php">Menampilkan Transaksi</a>
                                    <a class="nav-link" href="menambahTransaksi.php">Menambah Transaksi</a>
                                    <a class="nav-link" href="menghitungTransaksi.php">Hitung Transaksi</a>
                                </nav>
                            </div>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Menampilkan Data Pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Nama Konsumen : <?= $nama["namakonsumen"]?></li>
                            <li class="breadcrumb-item active">Waktu : <?= $waktu?></li>
                        </ol>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Status Pembayaran : <?= $status?></li>
                        </ol>
                        <div class="div">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Harga Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trans as $row) : ?>
                            <tr>
                            <td><?= $row["namabarang"]?></td>
                            <td><?= $row["jumlahbeli"]?></td>
                            <td><?= $row["harga"]?></td>
                            <td><?= $row["hargapembelian"]?></td>
                        </tr>
                            <?php endforeach; ?>
                            <td>Total : RP. <?= $biayaTotal['hargapembelian'] ?></td>
                        </tbody>

                        </table>
                        </div>
                    </div>

                    <div class="container-fluid px-4">
                        <!-- form update -->
                        <form action= "" method="POST">
                            <input type="hidden" id="idpegawai" name="idpegawai" value= <?= $idkonsumen?> >
                            <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
                        </form>
                        <!-- penutup form  -->
                    </div>
                    


                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
