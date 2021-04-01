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
                    <h2>SENARAI SESI</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/senaraisesi">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Sesi</label>
                                <input class="form-control" type="text" name="sesi">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                        <option value="" selected disabled>Sila Pilih</option>
                                        <option value="Y">Aktif</option>
                                        <option value="N">Tidak Aktif</option>
                                </select>
                            </div>
                            <button class="btn btn-secondary btn-block border rounded" type="submit" name="btnCarian"><i class="fa fa-search"></i> Carian</button>
                            <hr>
                            <a href="//<?php echo URLROOT; ?>/admin/tambahsesi" class="btn btn-primary btn-block border rounded" type="button"><i class="fa fa-plus"></i> Tambah Sesi</a>
                        </div>
                    </div>
                </form>
                <hr><div class="bootstrap_datatables">
                <div class="bootstrap_datatables">
                    <div class="container py-3">
                        <div class="row py-3">
                            <div class="col-lg-10 mx-auto">
                                <div class="card rounded shadow border-0">
                                    <div class="card-body p-5 bg-white rounded">
                                        <div class="table-responsive">
                                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Bil</th>
                                                    <th>Sesi</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $bil = 1;
                                                foreach($data["sesi"] as $row)
                                                {
                                                    echo "<tr>";
                                                    echo "<td>".$bil."</td>";
                                                    echo "<td>".$row->SESI."</td>";
                                                    echo "<td>".($row->STATUS == 'Y' ? "Aktif" : "Tidak Aktif")."</td>";
                                                    echo "<td><div class='d-flex'>
                                                    <a href='//" . URLROOT . "/admin/kemaskinisesi/$row->PK_ID' class='btn btn-secondary border rounded'>Kemaskini</a>
                                                    <a class='btn btn-danger border rounded' href='//" . URLROOT . "/admin/hapussesi/$row->PK_ID' type='submit' onclick='return confirm(`Adakah anda ingin hapus maklumat ini?`)'>Hapus</a>
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
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>

</html>