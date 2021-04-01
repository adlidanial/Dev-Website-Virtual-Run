<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Sesi - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>TAMBAH SESI</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/tambahsesi">
                    <div class="form-group">
                        <label>Sesi</label>
                        <input class="form-control" type="text" name="sesi" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Tidak Aktif</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="//<?php echo URLROOT; ?>/admin/senaraisesi" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnHantar" type="submit">Hantar</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>