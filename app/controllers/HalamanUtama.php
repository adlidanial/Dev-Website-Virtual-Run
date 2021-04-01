<?php
    session_start();

    class HalamanUtama extends Controller
    {
        public function __construct()
        {
            $this->vraktivitiModel = $this->model('VRAktiviti');
            $this->vrnamaparameterModel = $this->model('VRNamaParameter');
            $this->vrpesertaModel = $this->model('VRPeserta');
            $this->vrpembayaranModel = $this->model('VRPembayaran');
            $this->vrbuktilarianModel = $this->model('VRBuktiLarian');
        }

        public function index()
        {
            $aktiviti = $this->vraktivitiModel->getAktiviti();
            $aktivitiSelesai = $this->vraktivitiModel->getAktivitiSelesai();
            $data = [
                "aktiviti" => $aktiviti,
                "aktivitiSelesai" => $aktivitiSelesai,
            ];
            $this->view('HalamanUtama/index', $data);
        }

        public function tematerkini()
        {
            $fksesi = $this->vraktivitiModel->validateLarian($_SESSION['fksesi']);
            $listnegeri = $this->vrnamaparameterModel->getNegeri();
            $listnegara = $this->vrnamaparameterModel->getNegara();
            $listsaizbaju = $this->vrnamaparameterModel->getSaizBaju();

            $data = [
                "result" => $fksesi,
                "listnegeri" => $listnegeri,
                "listnegara" => $listnegara,
                "listsaizbaju" => $listsaizbaju,
                "nama" => '',
                "errNama" => '',
                "noic" => '',
                "errNoic" => '',
                "emel" => '',
                "errEmel" => '',
                "notel" => '',
                "errNotelefon" => '',
                "alamat1" => '',
                "errAlamat" => '',
                "alamat2" => '',
                "alamat3" => '',
                "poskod" => '',
                "errPoskod" => '',
                "bandar" => '',
                "errBandar" => '',
                "negeri" => '',
                "errNegeri" => '',
                "negara" => '',
                "errNegara" => '',
                "saizbaju" => '',
                "errSaizbaju" => '',
            ];

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $amaun = trim($_POST['amaun']);
                $sesi = $_SESSION['sesi'];
                $nama = trim($_POST['nama']);
                $errNama = (empty($nama) ? true : false);
                $noic = trim($_POST['noic']);
                $errNoic = (empty($noic) ? true : false);
                $emel = trim($_POST['emel']);
                $errEmel = (empty($emel) ? true : false);
                $notel = trim($_POST['notel']);
                $errNotelefon = (empty($notel) ? true : false);
                $alamat1 = trim($_POST['alamat1']);
                $errAlamat = (empty($alamat1) ? true : false);
                $alamat2 = trim($_POST['alamat2']);
                $alamat3 = trim($_POST['alamat3']);
                $poskod = trim($_POST['poskod']);
                $errPoskod = (empty($poskod) ? true : false);
                $bandar = trim($_POST['bandar']);
                $errBandar = (empty($bandar) ? true : false);
                $negeri = (isset($_POST['negeri']) ? $_POST['negeri'] : "");
                $errNegeri = (empty($negeri) ? true : false);
                $negara = (isset($_POST['negara']) ? $_POST['negara'] : "");
                $errNegara = (empty($negara) ? true : false);
                $saizbaju = (isset($_POST['saizbaju']) ? $_POST['saizbaju'] : "");
                $errSaizbaju = (empty($saizbaju) ? true : false);

                $data = [
                    "result" => $fksesi,
                    "listnegeri" => $listnegeri,
                    "listnegara" => $listnegara,
                    "listsaizbaju" => $listsaizbaju,
                    "amaun" => $amaun,
                    "sesi" => $sesi,
                    "nama" => $nama,
                    "errNama" => $errNama,
                    "noic" => $noic,
                    "errNoic" => $errNoic,
                    "emel" => $emel,
                    "errEmel" => $errEmel,
                    "notel" => $notel,
                    "errNotelefon" => $errNotelefon,
                    "alamat1" => $alamat1,
                    "errAlamat" => $errAlamat,
                    "alamat2" => $alamat2,
                    "alamat3" => $alamat3,
                    "poskod" => $poskod,
                    "errPoskod" => $errPoskod,
                    "bandar" => $bandar,
                    "errBandar" => $errBandar,
                    "negeri" => $negeri,
                    "errNegeri" => $errNegeri,
                    "negara" => $negara,
                    "errNegara" => $errNegara,
                    "saizbaju" => $saizbaju,
                    "errSaizbaju" => $errSaizbaju,
                ];

                if(!$errBandar && !$errAlamat && !$errEmel && !$errNama && !$errNegara && 
                !$errNegeri && !$errNotelefon && !$errPoskod && !$errSaizbaju)
                {
                    $result = $this->vrpesertaModel->setPeserta($data);
                    if($result)
                    {
                        $listpeserta = $this->vrpesertaModel->getLastIdAndGenerateNoRujukanPeserta();
                        foreach($listpeserta as $row)
                        {
                            $norujukan = $row->PK_ID.date('-dmY-His');
                            $id = $row->PK_ID;
                            $countid = $row->COUNT_ID;
                        }

                        if($countid < 10)
                            $countid = "000" . $countid;
                        else if($countid < 100)
                            $countid = "00" . $countid;
                        else if($countid < 1000)
                            $countid = "0" . $countid;

                        $val = [
                            "norujukan" => $norujukan,
                            "id" => $id,
                            "count_id" => $countid,
                        ];

                        if($this->vrpesertaModel->updatePeserta($val))
                        {
                            $val = [
                                "norujukanpeserta" => $norujukan,
                                "sesi" => $sesi
                            ];

                            if($this->vrpembayaranModel->setPembayaran($val))
                            {
                                require_once '../app/includes/toyyibpay-key.php';
                                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                                    $url = "https://";   
                                else  
                                    $url = "http://"; 
                                /*
                                //returns the current URL
                                $tmpurl = $_SERVER['REQUEST_URI']; 
                                $parts = explode('/', $tmpurl);
                                $dir = $_SERVER['SERVER_NAME'];
                                for ($i = 0; $i < count($parts) - 1; $i++)
                                    $dir .= $parts[$i] . "/";
                                $url.= $dir;*/
                                $some_data = array(
                                    'userSecretKey'=> $secretkey,
                                    'categoryCode'=> $categorycode,
                                    'billName'=> trim($_POST['namaaktiviti']),
                                    'billDescription'=> 'Yuran Penyertaan - RM'.number_format($amaun, 2, '.', ''),
                                    'billPriceSetting'=>1,
                                    'billPayorInfo'=>1,
                                    'billAmount'=>$amaun*100,
                                    'billReturnUrl'=>$url . URLROOT. '/resitpembayaran',
                                    'billCallbackUrl'=>'',
                                    'billExternalReferenceNo'=>$norujukan,
                                    'billTo'=>$nama,
                                    'billEmail'=>$emel,
                                    'billPhone'=>$notel,
                                    'billSplitPayment'=>0,
                                    'billSplitPaymentArgs'=>'',
                                    'billPaymentChannel'=>0,
                                );
                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_POST, 1);
                                // Production ToyyibPay
                                curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');
                                // Development ToyyibPay
                                //curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
                    
                                $result = curl_exec($curl);
                                $info = curl_getinfo($curl);  
                                curl_close($curl);
                                $obj = json_decode($result,true);
                                $billcode = $obj[0]['BillCode'];
                    
                                // Production ToyyibPay
                                
                                echo "
                                <script>
                                window.alert('Pendaftaran telah berjaya dihantar. Sila buat pembayaran dahulu.');
                                window.location.href='https://toyyibpay.com/".$billcode."';
                                </script>";
                                
                    
                                // Development ToyyibPay                 
                                /*echo "
                                <script>
                                window.alert('Pendaftaran telah berjaya dihantar. Sila buat pembayaran dahulu.');
                                window.location.href='https://dev.toyyibpay.com/".$billcode."';
                                </script>";
                                */
                            }
                            else
                                die("Something went wrong on open pembayaran. Please contact admin.");
                        }
                        else
                            die("Something went wrong on update peserta. Please contact admin.");
                    }
                    else
                        die("Something went wrong on submit form. Please contact admin.");
                }
            }
            
            $this->view('HalamanUtama/tematerkini', $data);
        }

        public function buktilarian()
        {
            $result = $this->vraktivitiModel->validateBuktiLarian($_SESSION['fksesi']);
            $data = [
                "aktiviti" => $result,
                "ebib" => !empty($_SESSION['ebib']) ? $_SESSION['ebib']: "",
                "errEbib" => false,
                "sesi" => !empty($sesi) ? $sesi : "",
                "noic" => !empty($_SESSION['noic']) ? $_SESSION['noic'] : "",
                "errNoic" => false,
                "isexist" => false,
                "user" => !empty($user) ? $user : "",
                "errFail" => false,
            ];
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $_SESSION['ebib'] = isset($_POST['ebib']) ? trim($_POST['ebib']): $_SESSION['ebib'];
                $errEbib = (empty($_SESSION['ebib']) ? true : false);
                $sesi = $_SESSION['sesi'];
                $_SESSION['noic'] = isset($_POST['noic']) ? trim($_POST['noic']) : $_SESSION['noic'];
                $errNoic = (empty($_SESSION['noic']) ? true : false);

                if(!$errEbib && !$errNoic)
                {
                    $val = [
                        "ebib" => $_SESSION['ebib'],
                        "sesi" => $sesi,
                        "noic" => $_SESSION['noic'],
                    ];

                    $isexist = $this->vrpesertaModel->ifExistMaklumatPesertaBySesiEbibNoic($val);
                    if($isexist)
                    {
                        $user = $this->vrpesertaModel->getMaklumatPesertaBySesiEbibNoic($val);

                        if(isset($_POST['btnHantar']))
                        {
                            $maxfile = count($_FILES['urlbuktilarian']['name']);
                            
                            for($i = 0; $i < $maxfile; $i++)
                            {
                                $urlBuktiLarian[$i] = (!empty($_FILES['urlbuktilarian']['name'][$i]) ? date('dmy_His')."_".$_FILES['urlbuktilarian']['name'][$i] : "");
                                $errFail[$i] = (empty($_FILES['urlbuktilarian']['name'][$i]) ? true : false);
                                $id[$i] = $_SESSION['id'];
                                
                                if(!$errFail[$i])
                                {
                                    $val = [
                                        "idpeserta" => $id[$i],
                                        "urlbuktilarian" => $urlBuktiLarian[$i]
                                    ];
                                    
                                    if($this->vrbuktilarianModel->setBuktiLarian($val))
                                        move_uploaded_file($_FILES['urlbuktilarian']['tmp_name'][$i], "./uploads/gambar-peserta/".$urlBuktiLarian[$i]);
                                }
                            } 
                            echo "
                            <script>
                            window.alert('Gambar telah berjaya hantar. Sila kembali ke Halaman Utama.');
                            window.location.href='//" . URLROOT. "/halamanutama';
                            </script>";
                        }
                        else
                        {
                            echo "
                            <script>
                            alert('Maklumat anda wujud dalam sesi ini. Sila muat naik gambar bukti larian anda.');
                            </script>
                            "; 

                            $data = [
                                "aktiviti" => $result,
                                "ebib" => !empty($_SESSION['ebib']) ? $_SESSION['ebib']: "",
                                "errEbib" => !empty($errEbib) ?  $errEbib : "",
                                "sesi" => !empty($sesi) ? $sesi : "",
                                "noic" => !empty($_SESSION['noic']) ? $_SESSION['noic'] : "",
                                "errNoic" => !empty($errNoic) ? $errNoic : "",
                                "isexist" => !empty($isexist) ? $isexist : "",
                                "user" => !empty($user) ? $user : "",
                                "errFail" => !empty($errFail) ? $errFail : "",
                            ];
                        }     
                    }
                    else
                    {
                        echo "
                        <script>
                        alert('Maklumat anda tidak wujud dalam sesi ini.');
                        </script>
                        ";
                    }

                    $data = [
                        "aktiviti" => $result,
                        "ebib" => !empty($_SESSION['ebib']) ? $_SESSION['ebib']: "",
                        "errEbib" => !empty($errEbib) ?  $errEbib : "",
                        "sesi" => !empty($sesi) ? $sesi : "",
                        "noic" => !empty($_SESSION['noic']) ? $_SESSION['noic'] : "",
                        "errNoic" => !empty($errNoic) ? $errNoic : "",
                        "isexist" => !empty($isexist) ? $isexist : "",
                        "user" => !empty($user) ? $user : "",
                        "errFail" => !empty($errFail) ? $errFail : "",
                        "errSaiz" => !empty($errSaiz) ? $errSaiz : "",
                    ];
                }
                else
                {
                    $data = [
                        "aktiviti" => $result,
                        "ebib" => !empty($_SESSION['ebib']) ? $_SESSION['ebib']: "",
                        "errEbib" => !empty($errEbib) ?  $errEbib : "",
                        "sesi" => !empty($sesi) ? $sesi : "",
                        "noic" => !empty($_SESSION['noic']) ? $_SESSION['noic'] : "",
                        "errNoic" => !empty($errNoic) ? $errNoic : "",
                        "isexist" => !empty($isexist) ? $isexist : "",
                        "user" => !empty($user) ? $user : "",
                        "errFail" => !empty($errFail) ? $errFail : "",
                    ];
                }
            }
    
            $this->view('HalamanUtama/buktilarian', $data);
        }
    }