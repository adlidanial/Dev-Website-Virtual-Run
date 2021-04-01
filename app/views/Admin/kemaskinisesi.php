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
                    <h2>KEMASKINI SESI</h2>
                </div>
                <?php foreach($data["sesi"] as $row){ ?>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/kemaskinisesi/<?php echo $row->PK_ID; ?>">           
                    <div class="form-group">
                        <label>Sesi</label>
                        <input class="form-control" type="text" name="sesi" value="<?php echo $row->SESI; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                                <option value="" disabled>Sila Pilih</option>
                                <option value="Y" <?php if($row->STATUS == 'Y') echo "selected"; ?> >Aktif</option>
                                <option value="N" <?php if($row->STATUS == 'N') echo "selected"; ?> >Tidak Aktif</option>
                        </select>
                    </div>
                    <?php } ?>
                    <a class="btn btn-secondary border rounded" href="//<?php echo URLROOT; ?>/admin/senaraisesi" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnSimpan" type="submit">Simpan</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>