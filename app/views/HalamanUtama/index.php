<?php

    unset($_SESSION['ebib']);
    unset($_SESSION['notel']);
    unset($_SESSION['paparmaklumat']);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Halaman Utama - Virtual Run</title>
</head>

<body>
    <?php include '../app/includes/user-navbar.php'; ?>
    <main class="page lanidng-page" style="background: var(--white);">
        <section class="portfolio-block block-intro" style="padding-top: 10px;padding-bottom: 0px;">
            <div class="container">
                <div class="about-me">
                    <p class="text-center">Program Virtual Run yang diadakan di bawah Kelab Teknologi Maklumat (ITC), Fakulti Sains Komputer dan Teknologi Maklumat, UTHM</p>
                </div>
            </div>
        </section>
        <section class="portfolio-block call-to-action border-bottom" style="padding-top: 0px;padding-bottom: 30px;">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center content">
                    <h3 style="margin-right: 0;"><strong>TERKINI</strong></h3>
                </div>
               
                <?php
                    foreach($data["aktiviti"] as $row)
                    {
                        $urllogo = $row->URL_LOGO;
                        $status = $row->STATUS;
                        $_SESSION['sesi'] = $row->SESI;
                        $_SESSION['fksesi'] = $row->FK_ID_SESI;
                    }

                    if(isset($urllogo) && $status != "F")
                    {
                ?>
                 <div>
                    <div class="text-center about-me"><img alt="Gambar-Logo" class="img-fluid" src="./uploads/<?php echo $urllogo; ?>" width="200" height="100"></div><br>
                    <div class="text-center">
                        <?php if($status == 'Y'){ ?>
                        <h4><strong>Pendaftaran telah dibuka</strong></h4><br>
                        <a class="btn btn-primary border rounded" role="button" href="halamanutama/tematerkini">Pendaftaran</a>
                        <?php }else if($status == 'N'){ ?>
                        <h4><strong>Pendaftaran telah ditutup</strong></h4><br>
                        <?php }else if($status == 'L'){ ?>
                        <h4><strong>Larian sedang berlangsung</strong></h4><br>
                        <a class="btn btn-primary border rounded" role="button" href="halamanutama/tematerkini">Pendaftaran</a>
                        <a class="btn btn-secondary border rounded" role="button" href="halamanutama/buktilarian">Bukti Larian</a>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    }
                    else
                    {
                ?>

                <div class="d-flex justify-content-center align-items-center content">
                    <h3 style="margin-right: 0;">---Akan Datang---</h3>
                </div>
                <?php } ?>
            </div>
        </section>
        <section class="portfolio-block photography"">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center content">
                    <h3 style="margin-right: 0;"><strong>TEMA LEPAS</strong></h3>
                </div>
                <?php
                    if(count($data["aktivitiSelesai"]) > 0)
                    {
                ?>
                <div class="row no-gutters">
                    <?php
                        foreach($data["aktivitiSelesai"] as $row)
                            echo "<div class='col-md-6 col-lg-4 item zoom-on-hover' style='background-color:#ffffff;'><a href='#'><img class='img-fluid image' alt='Logo-VR' src='./uploads/$row->URL_LOGO'></a></div>";
                    ?>
                </div>
                <?php
                    }
                    else
                    {
                    ?>  

                    <div class="d-flex justify-content-center align-items-center content">
                    <h3 style="margin-right: 0;">---Tiada---</h3>
                    </div>

                    <?php
                    }
                ?>            
            </div>
        </section>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
</body>

</html>