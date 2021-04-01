<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Pembayaran - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>KEMASKINI PEMBAYARAN</h2>
                </div>
                <?php foreach($data["pembayaran"] as $row){?>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/kemaskinipembayaran/<?php echo $row->ID_PEMBAYARAN; ?>">
                    <div class="form-group">
                        <label><strong>Status</strong></label>
                        <select class="form-control" name="status">
                            <option value="" selected disabled>Sila Pilih</option>
                            <option value="1" <?php if($row->STATUS == 1) echo "selected"; ?> >Transaksi Berjaya</option>
                            <option value="2" <?php if($row->STATUS == 2) echo "selected"; ?> >Transaksi Belum Selesai</option>
                            <option value="3" <?php if($row->STATUS == 3) echo "selected"; ?> >Transaksi Gagal</option>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="../senaraipembayaran" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnSimpan" type="submit">Simpan</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>