<?php
    session_start();
    session_unset();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Tentang Kami - Virtual Run</title>
</head>

<body>
    <?php include '../app/includes/user-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>TENTANG KAMI</h2>
                </div>
                <div class="text-center about-me"><img alt="Logo-VR" class="img-fluid" src="assets/img/Logo%20Rasmi%20Horizontal.png" width="500" height="200"></div><br><br><br>
                <h3>Pengenalan</h3>
                <p class="text-justify">Virtual Run merupakan satu program yang diadakan di bawah Kelab Informasi Teknologi Maklumat (ITC) di bawah Fakulti Sains Komputer dan Teknologi Maklumat (FSKTM) di UTHM.</p>
            </div>
        </section>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
</body>

</html>