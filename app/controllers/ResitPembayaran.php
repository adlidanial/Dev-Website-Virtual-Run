<?php

    class ResitPembayaran extends Controller
    {
        public function __construct()
        {
            $this->vrpembayaranModel = $this->model('VRPembayaran');
            $this->vrpesertaModel = $this->model('VRPeserta');
            
        }

        public function index()
        {
            $val = [
                "norujukan" => $_GET['transaction_id'],
                "status" => $_GET['status_id'],
                "keterangan" => $_GET['msg'],
                "kodbil" => $_GET['billcode'],
                "norujukanpeserta" => $_GET['order_id'],
            ];

            if($this->vrpembayaranModel->updatePembayaran($val))
            {
                $val = $_GET['order_id'];
                $result = $this->vrpesertaModel->getNoRujukanPeserta($val);
                $data = [
                    "user" => $result,
                    "norujukan" => $_GET['transaction_id'],
                    "status" => $_GET['status_id'],
                    "kodbil" => $_GET['billcode'],
                    "norujukanpeserta" => $_GET['order_id'],
                ];

                $this->view('ResitPembayaran/index', $data);
            }
            else
                die('Something wrong at update pembayaran');
        }
    }