<?php

    class VRAktiviti
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAktiviti()
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.STATUS, 
                MAX(VRAKTIVITI.FK_ID_SESI) AS FK_ID_SESI,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            INNER JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
                GROUP BY VRAKTIVITI.URL_LOGO, VRAKTIVITI.STATUS, VRSESI.PK_ID, VRSESI.SESI
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getAktivitiSelesai()
        {
            $this->db->query("
            SELECT 
                URL_LOGO, 
                STATUS 
            FROM VRAKTIVITI
                WHERE STATUS = 'F'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function validateLarian($val)
        {
            $this->db->query("
            SELECT * FROM VRAKTIVITI
            WHERE FK_ID_SESI = :fksesi
            ");
            $result = $this->db->bind(':fksesi', $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function validateBuktiLarian($val)
        {
            $this->db->query("
            SELECT * FROM VRAKTIVITI
            WHERE STATUS = 'L' AND FK_ID_SESI = :fksesi
            ");
            $result = $this->db->bind(':fksesi', $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatAktiviti()
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.PK_ID AS VR_AKTIVITI_PK_ID, 
                VRAKTIVITI.FK_ID_SESI, 
                VRAKTIVITI.NAMA_AKTIVITI, 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.URL_POSTER, 
                VRAKTIVITI.URL_IKLAN, 
                VRAKTIVITI.URL_SAIZ_BAJU, 
                VRAKTIVITI.YURAN_PESERTA,
                VRAKTIVITI.STATUS,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            LEFT JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatAktivitiByAktiviti($data)
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.PK_ID AS VR_AKTIVITI_PK_ID, 
                VRAKTIVITI.FK_ID_SESI, 
                VRAKTIVITI.NAMA_AKTIVITI, 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.URL_POSTER, 
                VRAKTIVITI.URL_IKLAN, 
                VRAKTIVITI.URL_SAIZ_BAJU, 
                VRAKTIVITI.YURAN_PESERTA,
                VRAKTIVITI.STATUS,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            LEFT JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRAKTIVITI.NAMA_AKTIVITI LIKE :aktiviti
            ");
            $this->db->bind(':aktiviti', $data);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatAktivitiBySesi($data)
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.PK_ID AS VR_AKTIVITI_PK_ID, 
                VRAKTIVITI.FK_ID_SESI, 
                VRAKTIVITI.NAMA_AKTIVITI, 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.URL_POSTER, 
                VRAKTIVITI.URL_IKLAN, 
                VRAKTIVITI.URL_SAIZ_BAJU, 
                VRAKTIVITI.YURAN_PESERTA,
                VRAKTIVITI.STATUS,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            LEFT JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRSESI.SESI = :sesi
            ");
            $this->db->bind(':sesi', $data);
            $result = $this->db->resultSet();
            return $result;
        }
        
        public function getMaklumatAktivitiByAktiviSesi($data)
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.PK_ID AS VR_AKTIVITI_PK_ID, 
                VRAKTIVITI.FK_ID_SESI, 
                VRAKTIVITI.NAMA_AKTIVITI, 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.URL_POSTER, 
                VRAKTIVITI.URL_IKLAN, 
                VRAKTIVITI.URL_SAIZ_BAJU, 
                VRAKTIVITI.YURAN_PESERTA,
                VRAKTIVITI.STATUS,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            LEFT JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRAKTIVITI.NAMA_AKTIVITI LIKE :aktiviti AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(':aktiviti', $data["aktiviti"]);
            $this->db->bind(':sesi', $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function setMaklumatAktiviti($data)
        {
            $this->db->query("
            INSERT INTO VRAKTIVITI (FK_ID_SESI, NAMA_AKTIVITI, URL_LOGO, URL_POSTER, URL_IKLAN, URL_SAIZ_BAJU, YURAN_PESERTA, STATUS)
            VALUES (:sesi, :aktiviti, :logo, :poster, :iklan, :saizbaju, :yuran, :status)        
            ");
            try
            {
                $this->db->bind(':sesi', $data["sesi"]);
                $this->db->bind(':aktiviti', $data["aktiviti"]);
                $this->db->bind(':logo', $data["logo"]);
                $this->db->bind(':poster', $data["poster"]);
                $this->db->bind(':iklan', $data["iklan"]);
                $this->db->bind(':saizbaju', $data["saizbaju"]);
                $this->db->bind(':yuran', $data["yuran"]);
                $this->db->bind(':status', $data["status"]);
                if($this->db->execute())
                    return true;
                else
                    return false;
            }
            catch(Exception $e)
            {
                echo $e;
            }
        }

        public function getMaklumatAktivitiById($val)
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.PK_ID AS VR_AKTIVITI_PK_ID, 
                VRAKTIVITI.FK_ID_SESI, 
                VRAKTIVITI.NAMA_AKTIVITI, 
                VRAKTIVITI.URL_LOGO, 
                VRAKTIVITI.URL_POSTER, 
                VRAKTIVITI.URL_IKLAN, 
                VRAKTIVITI.URL_SAIZ_BAJU, 
                VRAKTIVITI.YURAN_PESERTA,
                VRAKTIVITI.STATUS,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRAKTIVITI
            LEFT JOIN VRSESI ON VRAKTIVITI.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRAKTIVITI.PK_ID = :id
            ");
            $result = $this->db->bind(':id', $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatAktiviti($data)
        {
            $this->db->query("
            UPDATE VRAKTIVITI SET
                FK_ID_SESI = :sesi, 
                NAMA_AKTIVITI = :aktiviti,
                URL_LOGO = :logo, 
                URL_POSTER = :poster, 
                URL_IKLAN = :iklan,
                URL_SAIZ_BAJU = :saizbaju,
                YURAN_PESERTA = :yuran,
                STATUS = :status
            WHERE PK_ID = :id
            ");

            try
            {
                $this->db->bind(':id', $data["id"]);
                $this->db->bind(':sesi', $data["sesi"]);
                $this->db->bind(':aktiviti', $data["aktiviti"]);
                $this->db->bind(':logo', $data["logo"]);
                $this->db->bind(':poster', $data["poster"]);
                $this->db->bind(':iklan', $data["iklan"]);
                $this->db->bind(':saizbaju', $data["saizbaju"]);
                $this->db->bind(':yuran', $data["yuran"]);
                $this->db->bind(':status', $data["status"]);
                if($this->db->execute())
                    return true;
                else
                    return false;
            }
            catch(Exception $e)
            {
                echo $e;
            }
        }

        public function updateMaklumatAktivitiByGambar($data)
        {
            if($data["gambar"] == 'gambarlogo')
                $sql = 'URL_LOGO = null';
            else if($data["gambar"] == 'gambarposter')
                $sql = 'URL_POSTER = NULL';
            else if($data["gambar"] == 'gambariklan')
                $sql = 'URL_IKLAN = NULL';
            else if($data["gambar"] == 'gambarsaizbaju')
                $sql = 'URL_SAIZ_BAJU = NULL';

            $this->db->query("
            UPDATE VRAKTIVITI SET
            " . $sql . " WHERE PK_ID = :id");

            $this->db->bind(':id', $data["id"]);
            if($this->db->execute())
                return true;
            else
                return false;   
        }

        public function removeMaklumatAktiviti($val)
        {
            $this->db->query("
            DELETE FROM VRAKTIVITI
                WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }