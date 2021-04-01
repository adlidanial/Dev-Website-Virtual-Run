<?php
    if(count($data["aktiviti"]) == 0)
    {
        echo "
        <script>
        window.alert('Larian belum dimulakan lagi. Sila kembali ke Halaman Utama');
        window.location.href='../halamanutama';
        </script>";
    }
    else
    {
        foreach($data["aktiviti"] as $row)
            $urllogo = $row->URL_LOGO;
    }  
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Bukti Larian - Virtual Run</title>
</head>

<body>
<?php include '../app/includes/user-navbar.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block block-intro border-bottom">
            <div class="container">
                <div><img class="img-fluid" width="200" src="//<?php echo URLROOT; ?>/uploads/<?php echo $urllogo; ?>" alt="Gambar-Logo"></div>
            </div>
            <div class="heading">
                <h2 class="text-center">CARIAN</h2>
            </div>
            <form class="bg-white shadow" method="post" action="//<?php echo URLROOT ?>/halamanutama/buktilarian">
                <div class="form-group">
                    <label><strong>No. Ebib</strong><span style="color:red">&#42;</span></label>
                    <input class="form-control" type="text" name="ebib" value="<?php echo (isset($data["ebib"]) ? $data["ebib"] : $_SESSION['ebib']); ?>">
                    <?php echo ($data["errEbib"] ? "<span style='color:red'>Sila masukkan nombor ebib anda.</span>": "");?>
                </div>
                <div class="form-group">
                    <label><strong>No. Kad Pengenalan</strong><span style="color:red">&#42;</span></label>
                    <input class="form-control" type="text" name="noic" value="<?php echo (isset($data["noic"]) ? $data["noic"] : $_SESSION['noic']); ?>">
                    <?php echo ($data["errNoic"] ? "<span style='color:red'>Sila masukkan nombor kad pengenalan anda.</span>": "");?>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary btn-block border rounded" name="btnCarian" type="submit">Carian</button>
                </div>
            </form>
        </section>
        <?php if($data["isexist"]){ ?>
        <section class="portfolio-block cv">
            <div class="container">
                <div class="heading">
                    <h2 class="text-center">BUTIRAN MAKLUMAT</h2>
                </div>
                <div class="group">
                    <form class="bg-white" method="post" action="//<?php echo URLROOT ?>/halamanutama/buktilarian" enctype="multipart/form-data">
                        <?php foreach($data["user"] as $row){ ?>
                        <div class="form-group">
                            <label><strong>Nama</strong></label>
                            <?php $_SESSION['id'] = $row->PK_ID; ?>
                            <input class="form-control" type="text" value="<?php echo $row->NAMA; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Emel</strong></label>
                            <input class="form-control" type="email" value="<?php echo $row->EMEL; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>No. Telefon (HP)</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->NO_TELEFON; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Alamat</strong></label>
                            <div>
                                <input class="form-control" type="text" value="<?php echo $row->ALAMAT_PERTAMA; ?>" readonly><br>
                                <input class="form-control" type="text" value="<?php echo $row->ALAMAT_KEDUA; ?>" readonly><br>
                                <input class="form-control" type="text" value="<?php echo $row->ALAMAT_KETIGA; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong>Poskod</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->POSKOD; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Bandar</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->BANDAR; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Negeri</strong></label>
                            <input class="form-control" type="text" value="<?php echo ucwords(strtolower($row->NEGERI)); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Negara</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->NEGARA; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>No. EBib</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->NO_EBIB; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Saiz Baju</strong></label>
                            <input class="form-control" type="text" value="<?php echo $row->SAIZ_BAJU; ?>" readonly>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label><strong>Gambar Bukti Larian</strong><span style="color:red">&#42;</span></label><br>
                            <div class="alert alert-primary" role="alert">
                                <b>Perhatian!</b><br>* Dibenarkan muat naik melebihi 1 gambar
                            </div>
                            <input type="file" name="urlbuktilarian[]" multiple require><br>
                            
                            <?php echo ($data['errFail'] ? "<span style='color:red'>Sila muat naik gambar</span>": "") ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary btn-block border rounded" name="btnHantar" type="submit">Hantar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php } ?>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
</body>

</html>