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
                    <h2>TAMBAH AKTIVITI</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/tambahaktiviti" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Aktiviti</label>
                        <input class="form-control" type="text" name="aktiviti" required>
                    </div>
                    <div class="form-group">
                        <label>Sesi</label>
                        <select class="form-control" name="sesi" required>
                            <option selected disabled value="">Sila Pilih</option>
                            <?php
                            foreach($data["sesi"] as $row)
                                echo "<option value=' $row->PK_ID '>$row->SESI</option>";           
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar Logo</label><br>
                        <input type="file" name="urllogo"><br>
                    </div>
                    <div class="form-group">
                        <label>Gambar Poster</label><br>
                        <input type="file" name="urlposter">
                    </div>
                    <div class="form-group">
                        <label>Gambar Iklan (Gabungan antara medal, baju, ebib & cert dan lain-lain)</label><br>
                        <input type="file" name="urliklan">
                    </div>
                    <div class="form-group">
                        <label>Gambar Saiz Baju</label><br>
                        <input type="file" name="urlsaizbaju">
                    </div>
                    <div class="form-group">
                        <label>Yuran Peserta (RM)</label>
                        <input class="form-control" type="text" name="yuran" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Y">Buka Pendaftaran</option>
                                <option value="N">Tutup Pendaftaran</option>
                                <option value="L">Mula Larian</option>
                                <option value="F">Tamat Larian</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="//<?php echo URLROOT; ?>/senaraiaktiviti" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnHantar" type="submit">Hantar</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>