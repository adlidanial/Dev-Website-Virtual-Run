<?php
        
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Peserta - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>SENARAI PESERTA</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/senaraipeserta">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama</label>
                                <input class="form-control" type="text" name="namapeserta">
                            </div>
                            <div class="form-group">
                                <label>No. Telefon</label>
                                <input class="form-control" type="text" name="notel">
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
                                            <th>Nama Peserta</th>
                                            <th>No. Kad Pengenalan</th>
                                            <th>Emel</th>
                                            <th>No Telefon</th>
                                            <th>Alamat Pertama</th>
                                            <th>Alamat Kedua</th>
                                            <th>Alamat Ketiga</th>
                                            <th>Poskod</th>
                                            <th>Bandar</th>
                                            <th>Negeri</th>
                                            <th>Negara</th>
                                            <th>No. Ebib</th>
                                            <th>Saiz Baju</th>
                                            <th>No. Rujukan</th>
                                            <th>Amaun (RM)</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $bil = 1;
                                        foreach($data["peserta"] as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>$bil</td>";
                                            echo "<td>$row->SESI</td>";
                                            echo "<td>$row->NAMA</td>";
                                            echo "<td>$row->NO_KAD_PENGENALAN</td>";
                                            echo "<td>$row->EMEL</td>";
                                            echo "<td>$row->NO_TELEFON</td>";
                                            echo "<td>$row->ALAMAT_PERTAMA</td>";
                                            echo "<td>$row->ALAMAT_KEDUA</td>";
                                            echo "<td>$row->ALAMAT_KETIGA</td>";
                                            echo "<td>$row->POSKOD</td>";
                                            echo "<td>$row->BANDAR</td>";
                                            echo "<td>$row->NEGERI</td>";
                                            echo "<td>$row->NEGARA</td>";
                                            echo "<td>$row->NO_EBIB</td>";
                                            echo "<td>$row->SAIZ_BAJU</td>";
                                            echo "<td>$row->NO_RUJUKAN</td>";
                                            echo "<td>$row->AMAUN</td>";
                                            echo "<td><div class='d-flex'>
                                            <a href='//" . URLROOT . "/admin/kemaskinipeserta/$row->PK_ID_PESERTA' class='btn btn-secondary border rounded'>Kemaskini</a>
                                            <a class='btn btn-danger border rounded' href='//" . URLROOT . "/admin/hapuspeserta/$row->PK_ID_PESERTA' type='submit' onclick='return confirm(`Adakah anda ingin hapus maklumat ini?`)'>Hapus</a>
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