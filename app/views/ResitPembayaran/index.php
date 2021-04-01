<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Resit Pembayaran - Virtual Run</title>
</head>

<body style="background: var(--light);">
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>RESIT PEMBAYARAN VIRTUAL RUN</h2>
                    <form class="shadow">
                        <div class="d-flex">
                            <div class="form-group pt-4 pb-4"><img alt="Logo-VR" src="assets/img/Logo%20Rasmi%20Horizontal.png" width="80%"></div>
                            <div class="form-group"><img alt="Logo-VR" src="assets/img/logo-ketupat-run.png" width="50%"></div>
                        </div>
                        <div class="table-responsive text-left">
                            <table class="table">
                                <tbody>
                                    <?php foreach($data['user'] as $row){ ?>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo $row->NAMA; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telefon</td>
                                        <td><?php echo $row->NO_TELEFON; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Emel</td>
                                        <td><?php echo $row->EMEL; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Rujukan</td>
                                        <td><?php echo $data["norujukan"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php if($data["status"] == 1) echo "Transaksi Berjaya"; elseif($data["status"] == 2) echo "Transaksi Belum Selesai"; elseif($data["status"] == 3) echo "Transaksi Gagal";?></td>
                                    </tr>
                                    <tr>
                                        <td>Kod Bil</td>
                                        <td><?php echo $data["kodbil"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Rujukan Peserta</td>
                                        <td><?php echo $data["norujukanpeserta"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tajuk</td>
                                        <td><?php echo $row->NAMA_AKTIVITI."- Sesi ".$row->FK_ID_SESI; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Amaun</td>
                                        <td><?php echo "RM".number_format($row->AMAUN, 2, '.', ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Butiran</td>
                                        <td>Pingat (Medal)<br>Baju<br>Sticker<br>Penutup Mulut (Mask)<br>Drawstring Bag<br>EBib &amp; Cert<br>Kos Penghantaran</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label>Anda boleh semak maklumat resit pembayaran melalui emel anda.<br></label>
                            <label>Sila ambil gambar atau '<i>screenshot</i>' sebagai bukti pembayaran.<br></label>
                            <label>Anggaran tempoh penghantaran <i>race kit</i> kepada peserta adalah 10-15 hari selepas tarikh tamat larian iaitu 12 Jun 2021.<br></label>
                        </div>
                        <p class="lead">Terima kasih<br></p>
                        <p>Kembali ke <a href="//<?php echo URLROOT ?>/halamanutama">Halaman Utama</a><br></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
</body>

</html>