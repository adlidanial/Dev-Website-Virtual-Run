<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Kumpulan - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>TAMBAH KUMPULAN</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/tambahkumpulan">
                    <div class="form-group">
                        <label>Nama Kumpulan</label>
                        <input class="form-control" type="text" name="kumpulan" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Tidak Aktif</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="./senaraikumpulan" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnHantar" type="submit">Hantar</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>