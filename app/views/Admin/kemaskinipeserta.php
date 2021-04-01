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
                    <h2>KEMASKINI PESERTA</h2>
                </div>
                <?php foreach($data["peserta"] as $row){ ?>
                <form class="bg-white" method="post" action="//<?php echo URLROOT; ?>/admin/kemaskinipeserta/<?php echo $row->PK_ID_PESERTA; ?>">
                    <div class="form-group">
                        <label><strong>Sesi</strong></label>
                        <input class="form-control" type="text" value="<?php echo $row->SESI; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Nama</strong></label>
                        <input class="form-control" type="text" name="nama" value="<?php echo $row->NAMA; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>No. Kad Pengenalan</strong></label>
                        <input class="form-control" type="text" name="noic" value="<?php echo $row->NO_KAD_PENGENALAN; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Emel</strong></label>
                        <input class="form-control" type="email" name="emel" value="<?php echo $row->EMEL; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>No. Telefon (HP)</strong></label>
                        <input class="form-control" type="text" name="notel" value="<?php echo $row->NO_TELEFON; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Alamat</strong></label>
                        <div>
                            <input class="form-control" type="text" name="alamat1" value="<?php echo $row->ALAMAT_PERTAMA; ?>"><br>
                            <input class="form-control" type="text" name="alamat2" value="<?php echo $row->ALAMAT_KEDUA; ?>"><br>
                            <input class="form-control" type="text" name="alamat3" value="<?php echo $row->ALAMAT_KETIGA; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Poskod</strong></label>
                        <input class="form-control" type="text" name="poskod" value="<?php echo $row->POSKOD; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Bandar</strong></label>
                        <input class="form-control" type="text" name="bandar" value="<?php echo $row->BANDAR; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Negeri</strong></label>
                        <select class="form-control" name="negeri">
                            <option selected disabled value="">Sila Pilih</option>
                            <?php
                                foreach($data["listnegeri"] as $negeri)
                                    echo "<option value='$negeri->NAMA_PARAMETER'" . ($row->NEGERI == $negeri->NAMA_PARAMETER ? "selected" : "") . ">$negeri->NAMA_PARAMETER</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>Negara</strong></label>
                        <select class="form-control" name="negara">
                            <option selected disabled value="">Sila Pilih</option>
                            <?php
                                foreach($data["listnegara"] as $negara)
                                    echo "<option value='$negara->NAMA_PARAMETER'" . ($row->NEGARA == $negara->NAMA_PARAMETER ? "selected" : "") . ">" . strtoupper($negara->NAMA_PARAMETER) . "</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>No. EBib</strong></label>
                        <input class="form-control" type="text" name="ebib" value="<?php echo $row->NO_EBIB; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Saiz Baju</strong></label>
                        <select class="form-control" name="saizbaju">
                            <option selected disabled>Sila Pilih</option>
                            <?php
                                foreach($data["listsaizbaju"] as $saizbaju)
                                    echo "<option value='$saizbaju->NAMA_PARAMETER'" . ($row->SAIZ_BAJU == $saizbaju->NAMA_PARAMETER ? "selected" : "") . ">".strtoupper($saizbaju->NAMA_PARAMETER) . "</option>";
                            ?>
                        </select>
                    </div>
                    <a class="btn btn-secondary border rounded" href="//<?php echo URLROOT; ?>/admin/senaraipeserta" type="button">Kembali</a>
                    <button class="btn btn-primary border rounded float-right" name="btnSimpan" type="submit">Simpan</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
    <?php include '../app/includes/admin-footer.php'; ?>
</body>
</html>