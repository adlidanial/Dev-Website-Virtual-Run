<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Gambar Peserta - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>SENARAI GAMBAR PESERTA</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/senaraigambarpeserta">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>No. Ebib</label>
                                <input class="form-control" type="text" name="ebib">
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
                                            <th>Nama Aktiviti</th>
                                            <th>No. Ebib</th>
                                            <th>Nama</th>
                                            <th>Emel</th>
                                            <th>No. Telefon</th>
                                            <th>Gambar</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $bil = 1;
                                        foreach($data["gambarpeserta"] as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>$bil</td>";
                                            echo "<td>$row->FK_ID_SESI</td>";
                                            echo "<td>$row->NAMA_AKTIVITI</td>";
                                            echo "<td>$row->NO_EBIB</td>";
                                            echo "<td>$row->NAMA</td>";
                                            echo "<td>$row->EMEL</td>";
                                            echo "<td>$row->NO_TELEFON</td>";
                                            echo "<td><a href='//". URLROOT ."/uploads/gambar-peserta/$row->URL_GAMBAR' target='_blank'>
                                            <i class='fa fa-file-image-o' aria-hidden='true'></i></a></td>";
                                            echo "<td><div class='d-flex'>
                                            <a class='btn btn-danger border rounded' href='./hapusgambarpeserta/$row->PK_ID' type='submit' onclick='return confirm(`Adakah anda ingin hapus maklumat ini?`)'>Hapus</a>
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