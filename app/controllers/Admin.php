<?php
    session_start();

    class Admin extends Controller
    {
        public function __construct()
        {
            $this->vradminModel = $this->model('VRAdmin');
            $this->vrsesiModel = $this->model('VRSesi');
            $this->vraktivitiModel = $this->model('VRAktiviti');
            $this->vrpesertaModel = $this->model('VRPeserta');
            $this->vrnamaparameterModel = $this->model('VRNamaParameter');
            $this->vrnamakumpulanModel = $this->model('VRNamaKumpulan');
            $this->vrbuktilarianModel = $this->model('VRBuktiLarian');
            $this->vrpembayaranModel = $this->model('VRPembayaran');
            $this->vrbuktigambarModel = $this->model('VRBuktiGambar');
        }

        public function auth()
        {
            if(empty($_SESSION['jawatan']))
            {
                echo "
                <script>
                window.alert('Anda tidak boleh akses halaman ini. Sila kembali ke halaman utama');
                window.location.href='//". URLROOT . "/halamanutama';
                </script>";
            }
        }

        public function index()
        {
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $katanama = (isset($_POST['katanama']) ? $_POST['katanama'] : "");
                $katalaluan = (isset($_POST['katalaluan']) ? $_POST['katalaluan'] : "");
                $result = $this->vradminModel->getMaklumatAdmin($katanama);
                if(count($result) > 0)
                {
                    foreach($result as $row)
                        $adminkatalaluan = $row->KATA_LALUAN;

                    if(password_verify($katalaluan, $adminkatalaluan))
                    {
                        $_SESSION['jawatan'] = "ADMIN";
                        echo "
                        <script>
                        window.alert('Selamat datang, ADMIN.');
                        window.location.href='//". URLROOT . "/admin/dashboard';
                        </script>";
                    }
                    else
                        echo "<script>
                        window.alert('Kata nama dan kata laluan adalah salah.');
                        window.location.href='//". URLROOT . "/admin';</script>";
                }
                else
                    echo "<script>
                    window.alert('Kata nama dan kata laluan adalah salah.');
                    window.location.href='//". URLROOT . "/admin';</script>";
            }

            $this->view('Admin/index');
        }

        public function dashboard()
        {
            $this->auth();

            $this->view('Admin/dashboard');
        }

        public function senaraiaktiviti()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $aktiviti = (isset($_POST['aktiviti']) ? $_POST['aktiviti'] : '');
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : '');

                if(empty($sesi) && !empty($aktiviti))
                    $result = $this->vraktivitiModel->getMaklumatAktivitiByAktiviti($aktiviti);
                else if(!empty($sesi) && empty($aktiviti))
                    $result = $this->vraktivitiModel->getMaklumatAktivitiBySesi($sesi);
                else
                {
                    $val = [
                        "aktiviti" => $aktiviti,
                        "sesi" => $sesi,
                    ];
                    $result = $this->vraktivitiModel->getMaklumatAktivitiByAktiviSesi($val);
                }
            }
            else
                $result = $this->vraktivitiModel->getMaklumatAktiviti();

            $sesi = $this->vrsesiModel->getMaklumatSesiByStatusAktif();
            $data = [
                "aktiviti" => $result,
                "sesi" => $sesi,
            ];
            $this->view('Admin/senaraiaktiviti', $data);
        }

        public function tambahaktiviti()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $aktiviti = (isset($_POST['aktiviti']) ? $_POST['aktiviti'] : "");
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : null);
                $urlLogo = (!empty($_FILES['urllogo']['name']) ? date('dmy_His')."_".$_FILES['urllogo']['name'] : "");
                $urlPoster = (!empty($_FILES['urlposter']['name']) ? date('dmy_His')."_".$_FILES['urlposter']['name'] : "");
                $urlIklan = (!empty($_FILES['urliklan']['name']) ? date('dmy_His')."_".$_FILES['urliklan']['name'] : "");
                $urlSaizbaju = (!empty($_FILES['urlsaizbaju']['name']) ? date('dmy_His')."_".$_FILES['urlsaizbaju']['name'] : "");
                $yuran = (isset($_POST['yuran']) ? $_POST['yuran'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                // Saiz fail tidak boleh lebih dari 4MB
                /*
                $errLogo = ($_FILES["urllogo"]["size"] > 4194304 ? true : false);
                $errPoster = ($_FILES["urlposter"]["size"] > 4194304 ? true : false);
                $errIklan = ($_FILES["urliklan"]["size"] > 4194304 ? true : false);
                

                if(!$errPoster && !$errIklan && !$errLogo)
                {
                */
                    $val = [
                        "sesi" => $sesi, 
                        "aktiviti" => $aktiviti,
                        "iklan" => $urlIklan, 
                        "logo" => $urlLogo, 
                        "poster" => $urlPoster,
                        "saizbaju" => $urlSaizbaju, 
                        "yuran" => $yuran,
                        "status" => $status
                    ];

                    if($this->vraktivitiModel->setMaklumatAktiviti($val))
                    {
                        move_uploaded_file($_FILES['urliklan']['tmp_name'], "./uploads/".$urlIklan);
                        move_uploaded_file($_FILES['urllogo']['tmp_name'], "./uploads/".$urlLogo);
                        move_uploaded_file($_FILES['urlposter']['tmp_name'], "./uploads/".$urlPoster);
                        move_uploaded_file($_FILES['urlsaizbaju']['tmp_name'], "./uploads/".$urlSaizbaju);
                        
                        echo "
                        <script>
                        window.alert('Maklumat telah berjaya hantar');
                        window.location.href='//". URLROOT . "/admin/senaraiaktiviti';
                        </script>";
                    } 
                    else
                        die("unable to submit aktiviti");
                /*}
                else
                {
                    echo "
                    <script>
                    alert('Saiz gambar melebihi 4MB.');
                    </script>";
                }*/
            }

            $sesi = $this->vrsesiModel->getAvailableSesiAktif();

            $data = [
                "sesi" => $sesi,
                /*"errIklan" => empty($errIklan) ? false : $errIklan,
                "errLogo" => empty($errLogo) ? false : $errLogo,
                "errPoster" => empty($errPoster) ? false : $errPoster,*/
            ];

            $this->view('Admin/tambahaktiviti', $data);
        }

        public function kemaskiniaktiviti($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                $aktiviti = (!empty($_POST['aktiviti']) ? $_POST['aktiviti'] : "");
                $sesi = (!empty($_POST['sesi']) ? $_POST['sesi'] : "");
                $urlIklan = (!empty($_FILES['urliklan']['name']) ? date('dmy_His')."_".$_FILES['urliklan']['name'] : $_POST['urliklan']);
                $urlLogo = (!empty($_FILES['urllogo']['name']) ? date('dmy_His')."_".$_FILES['urllogo']['name'] : $_POST['urllogo']);
                $urlPoster = (!empty($_FILES['urlposter']['name']) ? date('dmy_His')."_".$_FILES['urlposter']['name'] : $_POST['urlposter']);
                $urlSaizbaju = (!empty($_FILES['urlsaizbaju']['name']) ? date('dmy_His')."_".$_FILES['urlsaizbaju']['name'] : $_POST['urlsaizbaju']);
                $yuran = (isset($_POST['yuran']) ? $_POST['yuran'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                // Saiz fail tidak boleh lebih dari 4MB
                /*
                $errIklan = ($_FILES["urliklan"]["size"] > 4194304 ? true : false);
                $errLogo = ($_FILES["urllogo"]["size"] > 4194304 ? true : false);
                $errPoster = ($_FILES["urlposter"]["size"] > 4194304 ? true : false);
               

                if(!$errPoster && !$errIklan && !$errLogo)
                {
                */
                    $val = [
                        "id" => $id,
                        "sesi" => $sesi, 
                        "aktiviti" => $aktiviti,
                        "iklan" => $urlIklan,  
                        "logo" => $urlLogo, 
                        "poster" => $urlPoster,
                        "saizbaju" => $urlSaizbaju,
                        "yuran" => $yuran,
                        "status" => $status
                    ];

                    if($this->vraktivitiModel->updateMaklumatAktiviti($val))
                    {
                        move_uploaded_file($_FILES['urliklan']['tmp_name'], "./uploads/".$urlIklan);
                        move_uploaded_file($_FILES['urllogo']['tmp_name'], "./uploads/".$urlLogo);
                        move_uploaded_file($_FILES['urlposter']['tmp_name'], "./uploads/".$urlPoster);
                        move_uploaded_file($_FILES['urlsaizbaju']['tmp_name'], "./uploads/".$urlSaizbaju);

                        echo "
                        <script>
                        window.alert('Maklumat telah berjaya kemaskini');
                        window.location.href='//". URLROOT . "/admin/senaraiaktiviti';
                        </script>";
                    } 
                    else
                        die("unable to update aktiviti");
                /*
                }
                else
                {
                    echo "
                    <script>
                    window.alert('Saiz gambar melebihi 4MB.');
                    window.location.href='//". URLROOT . "/admin/kemaskiniaktiviti/$id';
                    </script>";
                }
                */
            }

            $aktiviti = $this->vraktivitiModel->getMaklumatAktivitiById($params);

            $data = [
                "aktiviti" => $aktiviti,
                /*"errIklan" => empty($errIklan) ? false : $errIklan,
                "errLogo" => empty($errLogo) ? false : $errLogo,
                "errPoster" => empty($errPoster) ? false : $errPoster,*/
            ];
            
            $this->view('Admin/kemaskiniaktiviti', $data);
        }

        public function hapusgambar($param)
        {
            $this->auth();

            $val = [
                "id" => $_GET["id"],
                "gambar" => $param
            ];

            if($this->vraktivitiModel->updateMaklumatAktivitiByGambar($val))
            {
                echo "
                <script>
                window.alert('Gambar telah berjaya hapus');
                window.location.href='//". URLROOT . "/admin/kemaskiniaktiviti/$_GET[id]';
                </script>";
            }
            else
                die("Something wrong at delete gambar aktiviti");
        }

        public function hapusaktiviti($param)
        {
            $this->auth();

            if($this->vraktivitiModel->removeMaklumatAktiviti($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='//". URLROOT . "/admin/senaraiaktiviti';
                </script>";
            }
        }

        public function senaraisesi()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : '');
                $status = (isset($_POST['status']) ? $_POST['status'] : '');
               
                if(empty($sesi) && !empty($status))
                    $result = $this->vrsesiModel->getMaklumatSesiByStatus($status);
                else if(!empty($sesi) && empty($status))
                    $result = $this->vrsesiModel->getMaklumatSesiBySesi($sesi);
                else
                {
                    $val = [
                        "status" => $status,
                        "sesi" => $sesi,
                    ];
                    $result = $this->vrsesiModel->getMaklumatSesiBySesiAndStatus($val);
                }
            }
            else
                $result = $this->vrsesiModel->getMaklumatSesi();

            $data = [
                "sesi" => $result,
            ];

            $this->view('Admin/senaraisesi', $data);
        }

        public function tambahsesi()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "sesi" => $sesi, 
                    "status" => $status
                ];

                if($this->vrsesiModel->setMaklumatSesi($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya hantar');
                    window.location.href='//". URLROOT . "/admin/senaraisesi';
                    </script>";
                } 
                else
                    die("problem insert sesi");
            }

            $this->view('Admin/tambahsesi');
        }

        public function kemaskinisesi($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                //$sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "id" => $id, 
                    "status" => $status
                ];

                if($this->vrsesiModel->updateMaklumatSesiAndStatusById($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya kemaskini');
                    window.location.href='//". URLROOT . "/admin/senaraisesi';
                    </script>";
                } 
                else
                    die("problem update sesi");
            }

            $sesi = $this->vrsesiModel->getMaklumatSesiById($params);

            $data = [
                "sesi" => $sesi,
            ];
            
            $this->view('Admin/kemaskinisesi', $data);
        }

        public function hapussesi($param)
        {
            $this->auth();

            if($this->vrsesiModel->removeMaklumatSesi($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='//". URLROOT . "/admin/senaraisesi';
                </script>";
            }
        }

        public function senaraipeserta()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $namapeserta = (isset($_POST['namapeserta']) ? $_POST['namapeserta'] : '');
                $notel = (isset($_POST['notel']) ? $_POST['notel'] : '');
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : '');

                if(isset($_POST['btnCetak']))
                {
                    if(empty($sesi))
                    {
                        echo 
                        "<script>
                        alert('Sila masukkan sesi sebelum cetak');
                        </script>";
                    }
                    else
                        echo "<script type='text/javascript'>window.open('//". URLROOT ."/admin/cetakpeserta/" . $sesi ."');</script>";
                
                    $result = $this->vrpesertaModel->getMaklumatPeserta();
                }
                else
                {
                    if(!empty($namapeserta) && empty($notel) && empty($sesi))
                        $result = $this->vrpesertaModel->getMaklumatPesertaByNamaPeserta($namapeserta);
                    else if(empty($namapeserta) && !empty($notel) && empty($sesi))
                        $result = $this->vrpesertaModel->getMaklumatPesertaByNoTelefon($notel);
                    else if(empty($namapeserta) && empty($notel) && !empty($sesi))
                        $result = $this->vrpesertaModel->getMaklumatPesertaBySesi($sesi);
                    else if(!empty($namapeserta) && !empty($notel) && empty($sesi))
                    {
                        $val = [
                            "namapeserta" => $namapeserta,
                            "notel" => $notel,
                        ];
                        $result = $this->vrpesertaModel->getMaklumatPesertaByNamaAndNoTelefon($val);
                    }
                    else if(!empty($namapeserta) && empty($notel) && !empty($sesi))
                    {
                        $val = [
                            "namapeserta" => $namapeserta,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpesertaModel->getMaklumatPesertaByNamaAndSesi($val);
                    }
                    else if(empty($namapeserta) && !empty($notel) && !empty($sesi))
                    {
                        $val = [
                            "notel" => $notel,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpesertaModel->getMaklumatPesertaNoTelefonAndSesi($val);
                    }
                    else
                    {
                        $val = [
                            "namapeserta" => $namapeserta,
                            "notel" => $notel,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpesertaModel->getMaklumatPesertaNamaNoTelefonAndSesi($val);
                    }
                }
            }
            else
                $result = $this->vrpesertaModel->getMaklumatPeserta();

            $data = [
                "peserta" => $result,
            ];

            $this->view('Admin/senaraipeserta', $data);
        }

        public function cetakpeserta($param)
        {
            $this->auth();

            if($param == NULL)
            {
                echo 
                "<script>
                window.alert('Sila masukkan sesi sebelum cetak');
                window.location.href='//". URLROOT . "/admin/senaraipeserta';
                </script>";
            }
            else
            {
                $result = $this->vrpesertaModel->getMaklumatPesertaPembayaranAndAktivitiBySesi($param);
                $data = [
                    "peserta" => $result,
                ];
                $this->view('Admin/cetakpeserta', $data);
            }
        }

        public function kemaskinipeserta($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                $nama = $_POST['nama'];
                $noic = $_POST['noic'];
                $emel = $_POST['emel'];
                $notel = $_POST['notel'];
                $alamat1 = $_POST['alamat1'];
                $alamat2 = $_POST['alamat2'];
                $alamat3 = $_POST['alamat3'];
                $poskod = $_POST['poskod'];
                $bandar = $_POST['bandar'];
                $negeri = (isset($_POST['negeri']) ? $_POST['negeri'] : "");
                $negara = (isset($_POST['negara']) ? $_POST['negara'] : "");
                $ebib = $_POST['ebib'];
                $saizbaju = (isset($_POST['saizbaju']) ? $_POST['saizbaju'] : "");

                $val = [
                    "id" => $id,
                    "nama" => $nama,
                    "noic" => $noic,
                    "emel" => $emel,
                    "notel" => $notel,
                    "alamat1" => $alamat1,
                    "alamat2" => $alamat2,
                    "alamat3" => $alamat3,
                    "poskod" => $poskod,
                    "bandar" => $bandar,
                    "negeri" => $negeri,
                    "negara" => $negara,
                    "ebib" => $ebib,
                    "saizbaju" => $saizbaju
                ];

                if($this->vrpesertaModel->updateMaklumatPesertaById($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya kemaskini.');
                    window.location.href='../senaraipeserta';
                    </script>";
                }
                else
                    die("Something wrong on update maklumat peserta");
                
            }

            $peserta = $this->vrpesertaModel->getMaklumatPesertaById($params);
            $listnegeri = $this->vrnamaparameterModel->getNegeri();
            $listnegara = $this->vrnamaparameterModel->getNegara();
            $listsaizbaju = $this->vrnamaparameterModel->getSaizBaju();

            $data = [
                "peserta" => $peserta,
                "listnegeri" => $listnegeri,
                "listnegara" => $listnegara,
                "listsaizbaju" => $listsaizbaju,
            ];
            
            $this->view('Admin/kemaskinipeserta', $data);
        }

        public function hapuspeserta($param)
        {
            $this->auth();

            if($this->vrpesertaModel->removeMaklumatPeserta($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='../senaraipeserta';
                </script>";
            }
            else
                die("Problem at remove maklumat peserta.");
        }

        public function senaraigambarpeserta()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $ebib = (isset($_POST['ebib']) ? $_POST['ebib'] : '');
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : '');

                if(isset($_POST['btnCetak']))
                {
                    if(empty($sesi))
                    {
                        echo 
                        "<script>
                        alert('Sila masukkan sesi sebelum cetak');
                        </script>";
                    }
                    else
                        echo "<script type='text/javascript'>window.open('//". URLROOT ."/admin/cetakgambarpeserta/" . $sesi ."');</script>";

                    $result = $this->vrbuktilarianModel->getMaklumatBuktiLarian();   
                }
                else
                {  
                    if(!empty($ebib) && empty($sesi))
                        $result = $this->vrbuktilarianModel->getMaklumatBuktiLarianByEbib($ebib);
                    else if(empty($ebib) && !empty($sesi))
                        $result = $this->vrbuktilarianModel->getMaklumatBuktiLarianBySesi($sesi);
                    else
                    {
                        $val = [
                            "ebib" => $ebib,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrbuktilarianModel->getMaklumatBuktiLarianByEbibSesi($val);
                    }
                }
            }
            else
                $result = $this->vrbuktilarianModel->getMaklumatBuktiLarian();

            $data = [
                "gambarpeserta" => $result,
            ];

            $this->view('Admin/senaraigambarpeserta', $data);
        }

        public function cetakgambarpeserta($param)
        {
            $this->auth();

            if($param == NULL)
            {
                echo 
                "<script>
                window.alert('Sila masukkan sesi sebelum cetak');
                window.location.href='//". URLROOT . "/admin/senaraigambarpeserta';
                </script>";
            }
            else
            {
                $result = $this->vrbuktigambarModel->getMaklumatGambarPesertaAndSenaraiPeserta($param);
                $data = [
                    "gambarpeserta" => $result,
                ];
                $this->view('Admin/cetakgambarpeserta', $data);
            }
        }

        public function hapusgambarpeserta($param)
        {
            $this->auth();

            if($this->vrbuktilarianModel->removeMaklumatBuktiLarian($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='../senaraigambarpeserta';
                </script>";
            }
            else
                die("Problem at remove maklumat bukti larian.");
        }

        public function senaraipembayaran()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $norujukanpeserta = (isset($_POST['norujukanpeserta']) ? $_POST['norujukanpeserta'] : '');
                $norujukan = (isset($_POST['norujukan']) ? $_POST['norujukan'] : '');
                $sesi = (isset($_POST['sesi']) ? $_POST['sesi'] : '');

                if(isset($_POST['btnCetak']))
                {
                    if(empty($sesi))
                    {
                        echo 
                        "<script>
                        alert('Sila masukkan sesi sebelum cetak');
                        </script>";
                    }
                    else
                        echo "<script type='text/javascript'>window.open('//". URLROOT ."/admin/cetakpembayaran/" . $sesi ."');</script>";
                    
                    $result = $this->vrpembayaranModel->getMaklumatPembayaran();
                }
                else
                {
                    if(!empty($norujukanpeserta) && empty($norujukan) && empty($sesi))
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukanPeserta($norujukanpeserta);
                    else if(empty($norujukanpeserta) && !empty($norujukan) && empty($sesi))
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukan($norujukan);
                    else if(empty($norujukanpeserta) && empty($norujukan) && !empty($sesi))
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranBySesi($sesi);
                    else if(!empty($norujukanpeserta) && !empty($norujukan) && empty($sesi))
                    {
                        $val = [
                            "norujukanpeserta" => $norujukanpeserta,
                            "norujukan" => $norujukan,
                        ];
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukanPesertaAndNoRujukan($val);
                    }
                    else if(!empty($norujukanpeserta) && empty($norujukan) && !empty($sesi))
                    {
                        $val = [
                            "norujukanpeserta" => $norujukanpeserta,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukanPesertaAndSesi($val);
                    }
                    else if(empty($norujukanpeserta) && !empty($norujukan) && !empty($sesi))
                    {
                        $val = [
                            "norujukan" => $norujukan,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukanAndSesi($val);
                    }
                    else
                    {
                        $val = [
                            "norujukanpeserta" => $norujukanpeserta,
                            "norujukan" => $norujukan,
                            "sesi" => $sesi,
                        ];
                        $result = $this->vrpembayaranModel->getMaklumatPembayaranByNoRujukanPesertaNoRujukanAndSesi($val);
                    }
                }
            }
            else
                $result = $this->vrpembayaranModel->getMaklumatPembayaran();

            $data = [
                "pembayaran" => $result,
            ];

            $this->view('Admin/senaraipembayaran', $data);
        }

        public function cetakpembayaran($param)
        {
            $this->auth();

            if($param == NULL)
            {
                echo 
                "<script>
                window.alert('Sila masukkan sesi sebelum cetak');
                window.location.href='//". URLROOT . "/admin/senaraipembayaran';
                </script>";
            }
            else
            {
                $result = $this->vrpembayaranModel->getMaklumatPembayaranBySesi($param);
                $data = [
                    "pembayaran" => $result,
                ];
                $this->view('Admin/cetakpembayaran', $data);
            }
        }

        public function kemaskinipembayaran($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                $status = $_POST['status'];

                $val = [
                    "id" => $id,
                    "status" => $status
                ];

                if($this->vrpembayaranModel->updateMaklumatPembayaranById($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya kemaskini.');
                    window.location.href='../senaraipembayaran';
                    </script>";
                }
                else
                    die("Something wrong on update maklumat pembayaran");
                
            }

            $result = $this->vrpembayaranModel->getMaklumatPembayaranById($params);

            $data = [
                "pembayaran" => $result,
            ];
            
            $this->view('Admin/kemaskinipembayaran', $data);
        }

        public function hapuspembayaran($param)
        {
            $this->auth();

            if($this->vrpembayaranModel->removeMaklumatPembayaranById($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='../senaraipembayaran';
                </script>";
            }
            else
                die("Problem at remove maklumat pembayaran.");
        }

        public function senaraikumpulan()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $kumpulan = (isset($_POST['kumpulan']) ? $_POST['kumpulan'] : '');
                $status = (isset($_POST['status']) ? $_POST['status'] : '');
               
                if(empty($kumpulan) && !empty($status))
                    $result = $this->vrnamakumpulanModel->getMaklumatKumpulanByStatus($status);
                else if(!empty($kumpulan) && empty($status))
                    $result = $this->vrnamakumpulanModel->getMaklumatKumpulanByNamaKumpulan($kumpulan);
                else
                {
                    $val = [
                        "status" => $status,
                        "kumpulan" => $kumpulan,
                    ];
                    $result = $this->vrnamakumpulanModel->getMaklumatKumpulanByNamaKumpulanAndStatus($val);
                }
            }
            else
                $result = $this->vrnamakumpulanModel->getMaklumatKumpulan();

            $data = [
                "kumpulan" => $result,
            ];

            $this->view('Admin/senaraikumpulan', $data);
        }

        public function tambahkumpulan()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $kumpulan = (isset($_POST['kumpulan']) ? $_POST['kumpulan'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "kumpulan" => $kumpulan, 
                    "status" => $status
                ];

                if($this->vrnamakumpulanModel->setMaklumatKumpulan($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya hantar');
                    window.location.href='//". URLROOT . "/admin/senaraikumpulan';
                    </script>";
                } 
                else
                    die("problem insert kumpulan");
            }

            $this->view('Admin/tambahkumpulan');
        }

        public function kemaskinikumpulan($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                $kumpulan = (isset($_POST['kumpulan']) ? $_POST['kumpulan'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "id" => $id,
                    "kumpulan" => $kumpulan, 
                    "status" => $status
                ];

                if($this->vrnamakumpulanModel->updateMaklumatKumpulanById($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya kemaskini');
                    window.location.href='//". URLROOT . "/admin/senaraikumpulan';
                    </script>";
                } 
                else
                    die("problem update kumpulan");
            }

            $result = $this->vrnamakumpulanModel->getMaklumatKumpulanById($params);

            $data = [
                "kumpulan" => $result,
            ];
            
            $this->view('Admin/kemaskinikumpulan', $data);
        }

        public function hapuskumpulan($param)
        {
            $this->auth();

            if($this->vrnamakumpulanModel->removeMaklumatKumpulanById($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='//". URLROOT . "/admin/senaraikumpulan';
                </script>";
            }
            else
                die("problem remove kumpulan");
        }

        public function senaraiparameter()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $parameter = (isset($_POST['parameter']) ? $_POST['parameter'] : '');
                $status = (isset($_POST['status']) ? $_POST['status'] : '');
               
                if(empty($parameter) && !empty($status))
                    $result = $this->vrnamaparameterModel->getMaklumatParameterByStatus($status);
                else if(!empty($parameter) && empty($status))
                    $result = $this->vrnamaparameterModel->getMaklumatParameterByParameter($parameter);
                else
                {
                    $val = [
                        "status" => $status,
                        "parameter" => $parameter,
                    ];
                    $result = $this->vrnamaparameterModel->getMaklumatParameterByParameterAndStatus($val);
                }
            }
            else
                $result = $this->vrnamaparameterModel->getMaklumatParameter();

            $data = [
                "parameter" => $result,
            ];

            $this->view('Admin/senaraiparameter', $data);
        }

        public function tambahparameter()
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $parameter = (isset($_POST['parameter']) ? $_POST['parameter'] : "");
                $kumpulan = (isset($_POST['kumpulan']) ? $_POST['kumpulan'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "kumpulan" => $kumpulan,
                    "parameter" => $parameter,
                    "status" => $status
                ];

                if($this->vrnamaparameterModel->setMaklumatParameter($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya hantar');
                    window.location.href='//". URLROOT . "/admin/senaraiparameter';
                    </script>";
                } 
                else
                    die("problem insert parameter");
            }

            $result = $this->vrnamakumpulanModel->getMaklumatKumpulanAktif();

            $data = [
                "kumpulan" => $result,
            ];

            $this->view('Admin/tambahparameter', $data);
        }

        public function kemaskiniparameter($params)
        {
            $this->auth();

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = $params;
                $parameter = (isset($_POST['parameter']) ? $_POST['parameter'] : "");
                $kumpulan = (isset($_POST['kumpulan']) ? $_POST['kumpulan'] : "");
                $status = (isset($_POST['status']) ? $_POST['status'] : "");

                $val = [
                    "id" => $id,
                    "parameter" => $parameter, 
                    "kumpulan" => $kumpulan, 
                    "status" => $status
                ];

                if($this->vrnamaparameterModel->updateMaklumatParameterById($val))
                {
                    echo "
                    <script>
                    window.alert('Maklumat telah berjaya kemaskini');
                    window.location.href='//". URLROOT . "/admin/senaraiparameter';
                    </script>";
                } 
                else
                    die("problem update parameter");
            }

            $result = $this->vrnamaparameterModel->getMaklumatParameterById($params);
            $kumpulan = $this->vrnamakumpulanModel->getMaklumatKumpulanAktif();

            $data = [
                "parameter" => $result,
                "kumpulan" => $kumpulan,
            ];
            
            $this->view('Admin/kemaskiniparameter', $data);
        }

        public function hapusparameter($param)
        {
            $this->auth();

            if($this->vrnamaparameterModel->removeMaklumatParameterById($param))
            {
                echo "
                <script>
                window.alert('Maklumat telah berjaya hapus');
                window.location.href='//". URLROOT . "/admin/senaraiparameter';
                </script>";
            }
            else
                die("problem remove parameter");
        }

        public function logkeluar()
        {
            $this->auth();

            unset($_SESSION['jawatan']);

            echo "
                <script>
                window.alert('Anda telah log keluar.');
                window.location.href='../halamanutama';
                </script>
            ";
        }
    }