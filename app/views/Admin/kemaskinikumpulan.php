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
                    <h2>KEMASKINI KUMPULAN</h2>
                </div>
                <?php foreach($data["kumpulan"] as $row){ ?>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/kemaskinikumpulan/<?php echo $row->PK_ID; ?>">
                    <div class="form-group">
                        <label>Nama Kumpulan</label>
                        <input class="form-control" type="text" name="kumpulan" value="<?php echo $row->NAMA_KUMPULAN; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Y" <?php if($row->STATUS == 'Y') echo "selected"; ?> >Aktif</option>
                                <option value="N" <?php if($row->STATUS == 'N') echo "selected"; ?> >Tidak Aktif</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="./senaraikumpulan.php" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnSimpan" type="submit">Simpan</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>