<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Parameter - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>TAMBAH PARAMETER</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/tambahparameter">
                    <div class="form-group">
                        <label>Nama Kumpulan</label>
                        <select class="form-control" name="kumpulan" required>
                            <option value="" selected disabled>Sila Pilih</option>
                            <?php
                            foreach($data["kumpulan"] as $row)
                                echo "<option value='$row->PK_ID'>$row->NAMA_KUMPULAN</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Parameter</label>
                        <input class="form-control" type="text" name="parameter" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Tidak Aktif</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="./senaraiparameter" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnHantar" type="submit">Hantar</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>