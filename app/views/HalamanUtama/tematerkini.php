<?php
    foreach($data["result"] as $row)
    {
        $urllogo = $row->URL_LOGO;
        $namaaktiviti = $row->NAMA_AKTIVITI;
        $urlposter = $row->URL_POSTER;
        $urliklan = $row->URL_IKLAN;
        $yuranpeserta = $row->YURAN_PESERTA;
        $urlsaizbaju = $row->URL_SAIZ_BAJU;
        $status = $row->STATUS;
    }      
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Tema Terkini - Virtual Run</title>
</head>

<body>
<?php include '../app/includes/user-navbar.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block block-intro border-bottom">
            <div class="container">
                <div><img alt="Logo-VR" height="200" src="//<?php echo URLROOT ?>/uploads/<?php echo $urllogo; ?>"></div>
            </div>
            <div class="container">
                <div class="about-me">
                    <p>Program ini bertemakan tentang Virtual Run iaitu <?php echo $namaaktiviti; ?></p>
                </div>
            </div>
            <div class="container">
                <div class="form-group">
                <?php
                    if($status != "Y")
                    {
                ?>
                <label><strong>Pendaftaran telah ditutup</strong></label>
                <?php }else{ ?>
                    <a href="#pendaftaran" class="btn btn-primary">Klik untuk Pendaftaran</a>
                <?php } ?>
                </div>
            </div>
        </section>
        <section class="portfolio-block call-to-action border-bottom">
            <div class="container">
                <div class="heading">
                    <h2 class="text-center">POSTER</h2>
                </div>
                <form class="bg-white shadow pt-5">
                    <div>
                        <div class="text-center about-me"><img class="img-fluid" alt="Poster" width="600" src="//<?php echo URLROOT ?>/uploads/<?php echo $urlposter; ?>"></div>
                    </div>
                    <br>
                    <div>
                        <div class="text-center about-me"><img class="img-fluid" alt="Iklan" width="600" src="//<?php echo URLROOT ?>/uploads/<?php echo $urliklan; ?>"></div>
                    </div>
                </form>
            </div>
        </section>
        <?php
            if($status == "Y")
            {
        ?>
        <section class="portfolio-block cv">
            <div class="container" id="pendaftaran">
                <div class="heading">
                    <h2 class="text-center">BUTIRAN MAKLUMAT</h2>
                </div>
                <div class="group">
                    <form class="bg-white shadow pt-5" method="post" name="frmPeserta" action="//<?php echo URLROOT ?>/halamanutama/tematerkini">
                        <div class="alert alert-primary" role="alert">
                            <h5 class="alert-heading"><strong>Perhatian!</strong></h5>
                            <p class="mb-0">1. Simbol (<strong><span style="font-size:20px; color: red;">*</span></strong>) adalah wajib untuk diisi.</p>
                            <p class="mb-0">2. Anggaran tempoh penghantaran <i>race kit</i> kepada peserta adalah 10-15 hari selepas tarikh tamat larian iaitu 12 Jun 2021.</p>
                        </div>
                        <div class="text-left heading">
                            <h4>1. BUTIRAN PEMBAYARAN</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="table-dark">Pakej Larian (Race Kit)</th>
                                        <th class="table-dark" style="width: 52px;"></th>
                                        <th class="table-dark" style="width: 109px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1x Pingat (Medal)</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1x Baju</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1x Sticker</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1x Penutup Mulut (Mask)</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1x Drawstring Bag</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1x EBib &amp; Cert</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-right"><strong>JUMLAH (RM)</strong></td>
                                        <td></td>
                                        <td><?php echo number_format(floatval($yuranpeserta), 2, '.', '');?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="table-dark"><label><strong>Kos Penghantaran (RM)</strong><span style="color:red">&#42;</span></label></th>
                                            <th class="table-dark"></th>
                                            <th class="table-dark"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"><input class="form-check-input" type="radio" name="harga-pos" id="harga-pos" value="10" required>Kos Semenanjung Malaysia</td>
                                            <td></td>
                                            <td style="width: 108.8px;">10.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><input class="form-check-input" type="radio" name="harga-pos" id="harga-pos" value="15">Kos Sabah & Sarawak</td>
                                            <td></td>
                                            <td style="width: 108.8px;">15.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-right"><strong>JUMLAH KESELURUHAN (RM)</strong></td>
                                            <td></td>
                                            <td style="width: 108.8px;">
                                            <input class="d-none" type="text" name="amaun" id="amaun">
                                            <label id="total-fee">--</label>
                                            </td>               
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="text-left heading">
                            <h4>2. BUTIRAN PESERTA</h4>
                        </div>
                        <?php
                            echo "<input class='d-none' type='text' name='namaaktiviti' value='$namaaktiviti' readonly>";
                        ?>
                        <div class="form-group">
                            <label><strong>Nama</strong><span style="color:red">&#42;</span></label>
                            <div class="alert alert-primary" role="alert">
                                <strong>Perhatian!</strong>
                                <p>Sila masukkan nama penuh untuk dicetak ke dalam sijil.</p>
                            </div>
                            <input class="form-control" type="text" name="nama" value="<?php echo $data['nama']; ?>" >
                            <?php echo ($data['errNama'] ? "<span style='color:red'>Sila masukkan nama anda.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>No. Kad Pengenalan</strong><span style="color:red">&#42;</span></label>
                            <input class="form-control" type="noic" name="noic" value="<?php echo $data['noic']; ?>" >
                            <?php echo ($data['errNoic'] ? "<span style='color:red'>Sila masukkan no. kad pengenalan anda.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Emel</strong><span style="color:red">&#42;</span></label>
                            <input class="form-control" type="email" name="emel" value="<?php echo $data['emel']; ?>" >
                            <?php echo ($data['errEmel'] ? "<span style='color:red'>Sila masukkan emel anda.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>No. Telefon (HP)</strong><span style="color:red">&#42;</span></label>
                            <input class="form-control" type="text" name="notel" value="<?php echo $data['notel']; ?>" >
                            <?php echo ($data['errNotelefon'] ? "<span style='color:red'>Sila masukkan nombor telefon anda.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Alamat</strong><span style="color:red">&#42;</span></label>
                            <div>
                                <input class="form-control" type="text" name="alamat1" value="<?php echo $data['alamat1']; ?>" ><br>
                                <input class="form-control" type="text" name="alamat2" value="<?php echo $data['alamat2']; ?>"><br>
                                <input class="form-control" type="text" name="alamat3" value="<?php echo $data['alamat3']; ?>">
                                <?php echo ($data['errAlamat'] ? "<span style='color:red'>Sila masukkan alamat anda.</span>": "");?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong>Poskod</strong><span style="color:red">&#42;</span></label>
                            <input class="form-control" type="text" name="poskod" value="<?php echo $data['poskod']; ?>" >
                            <?php echo ($data['errPoskod'] ? "<span style='color:red'>Sila masukkan poskod.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Bandar</strong><span style="color:red">&#42;</span></label>
                            <input class="form-control" type="text" name="bandar" value="<?php echo $data['bandar']; ?>" >
                            <?php echo ($data['errBandar'] ? "<span style='color:red'>Sila masukkan bandar.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Negeri</strong><span style="color:red">&#42;</span></label>
                            <select class="form-control" name="negeri" >
                                <option selected disabled value="">Sila Pilih</option>
                                <?php
                                    foreach($data['listnegeri'] as $row)
                                    {
                                        echo "<option value='$row->NAMA_PARAMETER'".($row->NAMA_PARAMETER == $data['negeri'] ? "selected" : "").">$row->NAMA_PARAMETER</option>";
                                    }

                                ?>
                            </select>
                            <?php echo ($data['errNegeri'] ? "<span style='color:red'>Sila pilih negeri.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Negara</strong><span style="color:red">&#42;</span></label>
                            <select class="form-control" name="negara" >
                                <option selected disabled value="">Sila Pilih</option>
                                <?php
                                    foreach($data['listnegara'] as $row)
                                    {
                                        // Enablekan untuk pelbagai pilihan negara selain dari MALAYSIA
                                        // echo "<option value='".$row->NAMA_PARAMETER."'>".strtoupper($row->NAMA_PARAMETER)."</option>";

                                        // Enablekan untuk satu pilihan negara ialah MALAYSIA
                                        echo "<option value='".$row->NAMA_PARAMETER."' selected>".strtoupper($row->NAMA_PARAMETER)."</option>";
                                    }
                                ?>
                            </select>
                            <?php echo ($data['errNegara'] ? "<span style='color:red'>Sila pilih negara.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <label><strong>Saiz Baju</strong><span style="color:red">&#42;</span></label>
                            <div class="alert alert-primary" role="alert">
                                <strong>Perhatian!</strong>
                                <p>Klik <a href="//<?php echo URLROOT ?>/uploads/<?php echo $urlsaizbaju; ?>" target="_blank" class="alert-link">sini</a> untuk lihat ukuran/saiz baju.</p>
                            </div>
                            <select class="form-control" name="saizbaju" >
                                <option selected disabled>Sila Pilih</option>
                                <?php
                                    foreach($data['listsaizbaju'] as $row)
                                    {
                                        echo "<option value='".$row->NAMA_PARAMETER."'".($row->NAMA_PARAMETER == $data['saizbaju'] ? "selected" : "").">".strtoupper($row->NAMA_PARAMETER)."</option>";
                                    }
                                ?>
                            </select>
                            <?php echo ($data['errSaizbaju'] ? "<span style='color:red'>Sila pilih saiz baju.</span>": "");?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary btn-block border rounded" name="btnHantar" type="submit">Teruskan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
            }
        ?>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
    <script>
    $(document).ready(function(){
        $(".form-check-input").click(function(){
            let yuran = 50.00 + parseFloat($(this).val());
            yuran = yuran.toFixed(2);
            $("#total-fee").text(yuran);
            $("#amaun").val(yuran);
        });
    });
       
    </script>
</body>

</html>