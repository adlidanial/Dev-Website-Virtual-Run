<?php
    session_start();

    class TemaTerkini extends Controller
    {
        public function __construct()
        {
            $this->vraktivitiModel = $this->model('VRAktiviti');
        }

        public function index()
        {
            $result = $this->vraktivitiModel->validateSesi($_SESSION['fksesi']);
            $data = [
                "result" => $result,
            ];
            $this->view('HalamanUtama/tematerkini', $data);
        }
    }