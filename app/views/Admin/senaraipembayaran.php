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
                    <h2>SENARAI PEMBAYARAN</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/senaraipembayaran">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>No. Rujukan Peserta</label>
                                <input class="form-control" type="text" name="norujukanpeserta">
                            </div>
                            <div class="form-group">
                                <label>No. Rujukan</label>
                                <input class="form-control" type="text" name="norujukan">
                            </div>
                            <div class="form-group">
                                <label>Sesi</label>
                                <input class="form-control" type="text" name="sesi">
                            </div>
                            <button class="btn btn-secondary btn-block border rounded" type="submit" name="btnCarian"><i class="fa fa-search"></i> Carian</button>
                            <hr>
                            <button class="btn btn-primary btn-block border rounded" type="submit" name="btnCetak"><i class="fa fa-print"></i> Cetak ke Excel</a>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="bootstrap_datatables">
                    <div class="container py-3">
                        <div class="card rounded shadow border-0">
                            <div class="card-body p-5 bg-white rounded">
                                <div class="table-responsive">
                                    <table id="example" style="width:100%" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Sesi</th>
                                            <th>Nama</th>
                                            <th>No. Rujukan Peserta</th>
                                            <th>No. Rujukan</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Kod Bil</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $bil = 1;
                                        foreach($data["pembayaran"] as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>$bil</td>";
                                            echo "<td>$row->FK_ID_SESI</td>";
                                            echo "<td>$row->NAMA</td>";
                                            echo "<td>$row->FK_ID_NO_RUJUKAN_PESERTA</td>";
                                            echo "<td>$row->NO_RUJUKAN</td>";
                                            echo "<td>";
                                            if($row->STATUS == 1) echo "Transaksi Berjaya"; elseif($row->STATUS == 2) echo "Transaksi Belum Selesai"; elseif($row->STATUS == 3) echo "Transaksi Gagal";
                                            echo "</td>";
                                            echo "<td>$row->KETERANGAN</td>";
                                            echo "<td>$row->KOD_BIL</td>";
                                            echo "<td><div class='d-flex'>
                                            <a href='./kemaskinipembayaran/$row->PK_ID' class='btn btn-secondary border rounded'>Kemaskini</a>
                                            <a class='btn btn-danger border rounded' href='./hapuspembayaran/$row->PK_ID' type='submit' onclick='return confirm(`Adakah anda ingin hapus maklumat ini?`)'>Hapus</a>
                                            </div></td>";
                                            echo "</tr>";
                                            $bil++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>