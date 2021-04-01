<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Aktiviti - Virtual Run</title>
</head>

<body style="background: var(--light);">
<?php include '../app/includes/admin-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>SENARAI AKTIVITI</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/senaraiaktiviti">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama Aktiviti</label>
                                <input class="form-control" type="text" name="aktiviti">
                            </div>
                            <div class="form-group">
                                <label>Sesi</label>
                                <select class="form-control" name="sesi">
                                    <option selected disabled value="">Sila Pilih</option>
                                    <?php
                                    foreach($data["sesi"] as $row)
                                        echo "<option value='$row->PK_ID'>$row->SESI</option>";
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-secondary btn-block border rounded" type="submit" name="btnCarian"><i class="fa fa-search"></i> Carian</button>
                            <hr>
                            <a href="//<?php echo URLROOT; ?>/admin/tambahaktiviti" class="btn btn-primary btn-block border rounded" type="button"><i class="fa fa-plus"></i> Tambah Aktiviti</a>
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
                                            <th>Logo</th>
                                            <th>Poster</th>
                                            <th>Iklan</th>
                                            <th>Saiz Baju</th>
                                            <th>Yuran Peserta (RM)</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $bil = 1;
                                        foreach($data["aktiviti"] as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>".$bil."</td>";
                                            echo "<td>".$row->SESI."</td>";
                                            echo "<td>".$row->NAMA_AKTIVITI."</td>";
                                            echo "<td>".(!empty($row->URL_LOGO) ? "<i class='fa fa-check text-success' aria-hidden='true'></i>" : "<i class='fa fa-times text-danger' aria-hidden='true'></i>")."</td>";
                                            echo "<td>".(!empty($row->URL_POSTER) ? "<i class='fa fa-check text-success' aria-hidden='true'></i>" : "<i class='fa fa-times text-danger' aria-hidden='true'></i>")."</td>";
                                            echo "<td>".(!empty($row->URL_IKLAN) ? "<i class='fa fa-check text-success' aria-hidden='true'></i>" : "<i class='fa fa-times text-danger' aria-hidden='true'></i>")."</td>";
                                            echo "<td>".(!empty($row->URL_SAIZ_BAJU) ? "<i class='fa fa-check text-success' aria-hidden='true'></i>" : "<i class='fa fa-times text-danger' aria-hidden='true'></i>")."</td>";
                                            echo "<td>".$row->YURAN_PESERTA."</td>";
                                            echo "<td>";
                                            if($row->STATUS == 'Y') echo "Buka Pendaftaran"; elseif($row->STATUS == 'N') echo "Tutup Pendaftaran"; elseif($row->STATUS == 'F') echo "Tamat Larian"; elseif($row->STATUS == 'L') echo "Mula Larian";
                                            echo "</td>";
                                            echo "<td><div class='d-flex'>
                                            <a href='//" . URLROOT . "/admin/kemaskiniaktiviti/$row->VR_AKTIVITI_PK_ID' class='btn btn-secondary border rounded'>Kemaskini</a>
                                            <a class='btn btn-danger border rounded' href='//" . URLROOT . "/admin/hapusaktiviti/$row->VR_AKTIVITI_PK_ID' type='submit' onclick='return confirm(`Adakah anda ingin hapus maklumat ini?`)'>Hapus</a>
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