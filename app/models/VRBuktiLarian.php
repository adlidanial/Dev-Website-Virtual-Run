<?php

    class VRBuktiLarian
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function setBuktiLarian($data)
        {
            $this->db->query("
            INSERT INTO VRBUKTILARIAN (FK_ID_PESERTA, URL_GAMBAR)
            VALUES (:idpeserta, :urlbuktilarian)
            ");

            $this->db->bind(":idpeserta", $data['idpeserta']);
            $this->db->bind(":urlbuktilarian", $data['urlbuktilarian']);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getMaklumatBuktiLarian()
        {
            $this->db->query("
            SELECT 
                VRBUKTILARIAN.PK_ID, 
                VRBUKTILARIAN.FK_ID_PESERTA, 
                VRBUKTILARIAN.URL_GAMBAR, 
                VRPESERTA.FK_ID_SESI,
                VRAKTIVITI.NAMA_AKTIVITI,
                VRPESERTA.NAMA, 
                VRPESERTA.EMEL, 
                VRPESERTA.NO_TELEFON, 
                VRPESERTA.NO_EBIB,
                VRSESI.SESI
            FROM VRBUKTILARIAN
            INNER JOIN VRPESERTA ON VRBUKTILARIAN.FK_ID_PESERTA = VRPESERTA.PK_ID
            INNER JOIN VRAKTIVITI ON VRPESERTA.FK_ID_SESI = VRAKTIVITI.FK_ID_SESI
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatBuktiLarianByEbib($val)
        {
            $this->db->query("
            SELECT 
                VRBUKTILARIAN.PK_ID, 
                VRBUKTILARIAN.FK_ID_PESERTA, 
                VRBUKTILARIAN.URL_GAMBAR, 
                VRPESERTA.FK_ID_SESI,
                VRAKTIVITI.NAMA_AKTIVITI,
                VRPESERTA.NAMA, 
                VRPESERTA.EMEL, 
                VRPESERTA.NO_TELEFON, 
                VRPESERTA.NO_EBIB,
                VRSESI.SESI
            FROM VRBUKTILARIAN
            INNER JOIN VRPESERTA ON VRBUKTILARIAN.FK_ID_PESERTA = VRPESERTA.PK_ID
            INNER JOIN VRAKTIVITI ON VRPESERTA.FK_ID_SESI = VRAKTIVITI.FK_ID_SESI
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NO_EBIB = :ebib
            ");
            $this->db->bind(":ebib", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatBuktiLarianBySesi($val)
        {
            $this->db->query("
            SELECT 
                VRBUKTILARIAN.PK_ID, 
                VRBUKTILARIAN.FK_ID_PESERTA, 
                VRBUKTILARIAN.URL_GAMBAR, 
                VRPESERTA.FK_ID_SESI,
                VRAKTIVITI.NAMA_AKTIVITI,
                VRPESERTA.NAMA, 
                VRPESERTA.EMEL, 
                VRPESERTA.NO_TELEFON, 
                VRPESERTA.NO_EBIB,
                VRSESI.SESI
            FROM VRBUKTILARIAN
            INNER JOIN VRPESERTA ON VRBUKTILARIAN.FK_ID_PESERTA = VRPESERTA.PK_ID
            INNER JOIN VRAKTIVITI ON VRPESERTA.FK_ID_SESI = VRAKTIVITI.FK_ID_SESI
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRSESI.SESI = :sesi
            ");
            $this->db->bind(":sesi", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatBuktiLarianByEbibSesi($data)
        {
            $this->db->query("
            SELECT 
                VRBUKTILARIAN.PK_ID, 
                VRBUKTILARIAN.FK_ID_PESERTA, 
                VRBUKTILARIAN.URL_GAMBAR, 
                VRPESERTA.FK_ID_SESI,
                VRAKTIVITI.NAMA_AKTIVITI,
                VRPESERTA.NAMA, 
                VRPESERTA.EMEL, 
                VRPESERTA.NO_TELEFON, 
                VRPESERTA.NO_EBIB,
                VRSESI.SESI
            FROM VRBUKTILARIAN
            INNER JOIN VRPESERTA ON VRBUKTILARIAN.FK_ID_PESERTA = VRPESERTA.PK_ID
            INNER JOIN VRAKTIVITI ON VRPESERTA.FK_ID_SESI = VRAKTIVITI.FK_ID_SESI
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NO_EBIB = :ebib AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":sesi", $data["sesi"]);
            $this->db->bind(":ebib", $data["ebib"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function removeMaklumatBuktiLarian($val)
        {
            $this->db->query("
            DELETE FROM VRBUKTILARIAN
                WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }