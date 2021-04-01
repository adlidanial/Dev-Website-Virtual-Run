<?php

    class VRPembayaran
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function setPembayaran($data)
        {
            $this->db->query("
            INSERT INTO VRPEMBAYARAN (FK_ID_SESI, FK_ID_NO_RUJUKAN_PESERTA)
            VALUES (:sesi, :norujukanpeserta)
            ");
            $this->db->bind(":sesi", $data['sesi']);
            $this->db->bind(":norujukanpeserta", $data['norujukanpeserta']);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function updatePembayaran($data)
        {
            $this->db->query("
            UPDATE VRPEMBAYARAN SET
                NO_RUJUKAN = :norujukan,
                STATUS = :status,
                KETERANGAN = :keterangan,
                KOD_BIL = :kodbil,
                TARIKH_KEMASKINI = now()
            WHERE FK_ID_NO_RUJUKAN_PESERTA = :norujukanpeserta
            ");
            $this->db->bind(":norujukan", $data['norujukan']);
            $this->db->bind(":status", $data['status']);
            $this->db->bind(":keterangan", $data['keterangan']);
            $this->db->bind(":kodbil", $data['kodbil']);
            $this->db->bind(":norujukanpeserta", $data['norujukanpeserta']);

            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getMaklumatPembayaran()
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
                INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
                INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranByNoRujukanPeserta($val)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = :norujukanpeserta
            ");
            $this->db->bind(":norujukanpeserta", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranByNoRujukan($val)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.NO_RUJUKAN = :norujukan
            ");
            $this->db->bind(":norujukan", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranBySesi($val)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRSESI.SESI = :sesi
            ");
            $this->db->bind(":sesi", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranByNoRujukanPesertaAndNoRujukan($data)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = :norujukanpeserta AND VRPEMBAYARAN.NO_RUJUKAN = :norujukan
            ");
            $this->db->bind(":norujukanpeserta", $data["norujukanpeserta"]);
            $this->db->bind(":norujukan", $data["norujukan"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranByNoRujukanPesertaAndSesi($data)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = :norujukanpeserta AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":norujukanpeserta", $data["norujukanpeserta"]);
            $this->db->bind(":sesi", $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranByNoRujukanPesertaNoRujukanAndSesi($data)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = :norujukanpeserta AND VRPEMBAYARAN.NO_RUJUKAN = :norujukan AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":norujukanpeserta", $data["norujukanpeserta"]);
            $this->db->bind(":norujukan", $data["norujukan"]);
            $this->db->bind(":sesi", $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPembayaranById($val)
        {
            $this->db->query("
            SELECT
                VRPEMBAYARAN.PK_ID AS ID_PEMBAYARAN,
                VRPEMBAYARAN.FK_ID_SESI,
                VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA,
                VRPEMBAYARAN.NO_RUJUKAN,
                VRPEMBAYARAN.STATUS,
                VRPEMBAYARAN.KETERANGAN,
                VRPEMBAYARAN.KOD_BIL,
                VRPEMBAYARAN.TARIKH_KEMASKINI,
                VRSESI.SESI,
                VRPESERTA.NAMA
            FROM VRPEMBAYARAN
            INNER JOIN VRSESI ON VRPEMBAYARAN.FK_ID_SESI = VRSESI.PK_ID
            INNER JOIN VRPESERTA ON VRPEMBAYARAN.FK_ID_NO_RUJUKAN_PESERTA = VRPESERTA.NO_RUJUKAN
                WHERE VRPEMBAYARAN.PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatPembayaranById($data)
        {
            $this->db->query("
            UPDATE VRPEMBAYARAN 
            SET
                STATUS = :status
            WHERE PK_ID = :id
            ");
            $this->db->bind(":id", $data["id"]);
            $this->db->bind(":status", $data["status"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function removeMaklumatPembayaranById($val)
        {
            $this->db->query("
            DELETE FROM VRPEMBAYARAN 
            WHERE PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }

    }