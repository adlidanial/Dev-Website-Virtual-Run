<?php
    foreach($data["aktiviti"] as $row)
    {
        $id = $row->VR_AKTIVITI_PK_ID;
        $sesi = $row->SESI;
        $namaaktiviti = $row->NAMA_AKTIVITI;
        $urllogo = $row->URL_LOGO;
        $urlposter = $row->URL_POSTER;
        $urliklan = $row->URL_IKLAN;
        $urlsaizbaju = $row->URL_SAIZ_BAJU;
        $yuran = $row->YURAN_PESERTA;
        $status = $row->STATUS;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Aktiviti - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>KEMASKINI AKTIVITI</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/kemaskiniaktiviti/<?php echo $id; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Aktiviti</label>
                        <input class="form-control" type="text" name="aktiviti" value="<?php echo $namaaktiviti; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Sesi</label>
                        <input class="form-control" type="text" name="sesi" value="<?php echo $sesi; ?>" readonly>
                    </div>               
                    <div class="form-group">
                        <label>Gambar Logo</label><br>
                        <input type="file" name="urllogo"><br>
                        <input class="d-none" type="text" name="urllogo" value="<?php echo $urllogo;?>">
                        <?php echo (!empty($urllogo) ? "<a href='//". URLROOT ."/uploads/$urllogo' target='_blank'>Gambar Logo</a>
                        <a class='float-right' href='//". URLROOT ."/admin/hapusgambar/gambarlogo?id=$id'>Hapus Gambar</a>" : ""); ?>
                    </div>
                    <div class="form-group">
                        <label>Gambar Poster</label><br>
                        <input type="file" name="urlposter"><br>
                        <input class="d-none" type="text" name="urlposter" value="<?php echo $urlposter;?>">
                        <?php echo (!empty($urlposter) ? "<a href='//". URLROOT ."/uploads/$urlposter' target='_blank'>Gambar Poster</a>
                        <a class='float-right' href='//". URLROOT ."/admin/hapusgambar/gambarposter?id=$id'>Hapus Gambar</a>" : ""); ?>
                    </div>
                    <div class="form-group">
                        <label>Gambar Iklan (Gabungan antara medal, baju, ebib & cert dan lain-lain)</label><br>
                        <input type="file" name="urliklan"><br>
                        <input class="d-none" type="text" name="urliklan" value="<?php echo $urliklan;?>">
                        <?php echo (!empty($urliklan) ? "<a href='//". URLROOT ."/uploads/$urliklan' target='_blank'>Gambar Iklan</a>
                        <a class='float-right' href='//". URLROOT ."/admin/hapusgambar/gambariklan?id=$id'>Hapus Gambar</a>" : ""); ?>
                    </div>
                    <div class="form-group">
                        <label>Gambar Saiz Baju</label><br>
                        <input type="file" name="urlsaizbaju"><br>
                        <input class="d-none" type="text" name="urlsaizbaju" value="<?php echo $urlsaizbaju;?>">
                        <?php echo (!empty($urlsaizbaju) ? "<a href='//". URLROOT ."/uploads/$urlsaizbaju' target='_blank'>Gambar Saiz Baju</a>
                        <a class='float-right' href='//". URLROOT ."/admin/hapusgambar/gambarsaizbaju?id=$id'>Hapus Gambar</a>" : ""); ?>
                    </div>
                    <div class="form-group">
                        <label>Yuran Peserta (RM)</label>
                        <input class="form-control" type="text" name="yuran" value="<?php echo $yuran; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                                <option value="" <?php if($status == '') echo "selected"; ?> disabled>Sila Pilih</option>
                                <option value="Y" <?php if($status == 'Y') echo "selected"; ?> >Buka Pendaftaran</option>
                                <option value="N" <?php if($status == 'N') echo "selected"; ?> >Tutup Pendaftaran</option>
                                <option value="L" <?php if($status == 'L') echo "selected"; ?> >Mula Larian</option>
                                <option value="F" <?php if($status == 'F') echo "selected"; ?> >Tamat Larian</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="//<?php echo URLROOT; ?>/admin/senaraiaktiviti" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnSimpan" type="submit">Simpan</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>