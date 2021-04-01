<?php

    class VRPeserta
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function setPeserta($data)
        {
            $this->db->query("
            INSERT INTO VRPESERTA (FK_ID_SESI, NAMA, NO_KAD_PENGENALAN, EMEL, NO_TELEFON, ALAMAT_PERTAMA, ALAMAT_KEDUA, ALAMAT_KETIGA, POSKOD, BANDAR, NEGERI, NEGARA, SAIZ_BAJU, AMAUN)
            VALUES (:sesi, :nama, :noic, :emel, :notel, :alamat1, :alamat2, :alamat3, :poskod, :bandar, :negeri, :negara, :saizbaju, :amaun)
            ");
            $this->db->bind(":sesi", $data['sesi']);
            $this->db->bind(":nama", $data['nama']);
            $this->db->bind(":noic", $data['noic']);
            $this->db->bind(":emel", $data['emel']);
            $this->db->bind(":notel", $data['notel']);
            $this->db->bind(":alamat1", $data['alamat1']);
            $this->db->bind(":alamat2", $data['alamat2']);
            $this->db->bind(":alamat3", $data['alamat3']);
            $this->db->bind(":poskod", $data['poskod']);
            $this->db->bind(":bandar", $data['bandar']);
            $this->db->bind(":negeri", $data['negeri']);
            $this->db->bind(":negara", $data['negara']);
            $this->db->bind(":saizbaju", $data['saizbaju']);
            $this->db->bind(":amaun", $data['amaun']);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getLastIdAndGenerateNoRujukanPeserta()
        {
            $this->db->query("
            SELECT 
                MAX(PK_ID) AS PK_ID, 
                COUNT(PK_ID) AS COUNT_ID 
            FROM VRPESERTA
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function updatePeserta($data)
        {
            $this->db->query("
            UPDATE VRPESERTA SET
                NO_EBIB = :ebib,
                NO_RUJUKAN = :norujukan
            WHERE PK_ID = :pkid
            ");

            $this->db->bind(":ebib", $data['count_id']);
            $this->db->bind(":norujukan", $data['norujukan']);
            $this->db->bind(":pkid", $data['id']);
            
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getNoRujukanPeserta($data)
        {
            $this->db->query("
            SELECT 
                A.NAMA, 
                A.NO_TELEFON, 
                A.EMEL, 
                A.AMAUN, 
                A.FK_ID_SESI, 
                B.FK_ID_SESI, 
                B.NAMA_AKTIVITI
            FROM VRPESERTA A, VRAKTIVITI B
                WHERE A.FK_ID_SESI = B.FK_ID_SESI AND NO_RUJUKAN = :norujukan
            ");
            $this->db->bind(":norujukan", $data);
            $result = $this->db->resultSet();
            return $result;
        }

        public function ifExistMaklumatPesertaBySesiEbibNoic($data)
        {
            $this->db->query("
            SELECT 
                NO_EBIB, 
                FK_ID_SESI, 
                NO_KAD_PENGENALAN 
            FROM VRPESERTA
                WHERE FK_ID_SESI = :sesi AND NO_EBIB = :ebib AND NO_KAD_PENGENALAN  = :noic
            ");
            $this->db->bind(":sesi", $data["sesi"]);
            $this->db->bind(":ebib", $data["ebib"]);
            $this->db->bind(":noic", $data["noic"]);
            if($this->db->resultSet())
                return true;
            else
                return false;
        }

        public function getMaklumatPesertaBySesiEbibNoic($data)
        {
            $this->db->query("
            SELECT *
            FROM VRPESERTA
                WHERE FK_ID_SESI = :sesi AND NO_EBIB = :ebib AND NO_KAD_PENGENALAN = :noic
            ");
            $this->db->bind(":sesi", $data["sesi"]);
            $this->db->bind(":ebib", $data["ebib"]);
            $this->db->bind(":noic", $data["noic"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPeserta()
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaByNamaPeserta($val)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NAMA LIKE :nama
            ");
            $this->db->bind(":nama", "%". $val ."%");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaByNoTelefon($val)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NO_TELEFON = :notel
            ");
            $this->db->bind(":notel", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaBySesi($val)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRSESI.SESI = :sesi
            ");
            $this->db->bind(":sesi", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaByNamaAndNoTelefon($data)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NO_TELEFON = :notel AND VRPESERTA.NAMA LIKE :namapeserta
            ");
            $this->db->bind(":notel", $data["notel"]);
            $this->db->bind(":namapeserta", "%". $data["namapeserta"] . "%");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaByNamaAndSesi($data)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NAMA LIKE :namapeserta AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":namapeserta", "%". $data["namapeserta"] ."%");
            $this->db->bind(":sesi", $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaNoTelefonAndSesi($data)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NO_TELEFON = :notel AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":notel", $data["notel"]);
            $this->db->bind(":sesi", $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaNamaNoTelefonAndSesi($data)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.NAMA LIKE :namapeserta AND VRPESERTA.NO_TELEFON = :notel AND VRSESI.SESI = :sesi
            ");
            $this->db->bind(":namapeserta", "%". $data["namapeserta"] ."%");
            $this->db->bind(":notel", $data["notel"]);
            $this->db->bind(":sesi", $data["sesi"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaPembayaranAndAktivitiBySesi($val)
        {
            $this->db->query("
            SELECT 
                A.FK_ID_SESI, 
                A.NAMA, 
                A.NO_KAD_PENGENALAN,
                A.EMEL, 
                A.NO_TELEFON, 
                A.ALAMAT_PERTAMA, 
                A.ALAMAT_KEDUA, 
                A.ALAMAT_KETIGA, 
                A.POSKOD, 
                A.BANDAR, 
                A.NEGERI, 
                A.NEGARA, 
                A.NO_EBIB, 
                A.SAIZ_BAJU, 
                A.NO_RUJUKAN AS NO_RUJUKAN_PESERTA, 
                A.AMAUN, 
                B.FK_ID_NO_RUJUKAN_PESERTA, 
                B.NO_RUJUKAN, 
                B.STATUS, 
                B.TARIKH_KEMASKINI, 
                C.FK_ID_SESI, 
                C.NAMA_AKTIVITI
            FROM VRPESERTA A, VRPEMBAYARAN B, VRAKTIVITI C
                WHERE A.NO_RUJUKAN = B.FK_ID_NO_RUJUKAN_PESERTA AND A.FK_ID_SESI = C.FK_ID_SESI AND A.FK_ID_SESI = :sesi
            ");
            $this->db->bind(":sesi", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatPesertaById($val)
        {
            $this->db->query("
            SELECT 
                VRPESERTA.PK_ID AS PK_ID_PESERTA,
                VRPESERTA.FK_ID_SESI,
                VRPESERTA.NAMA,
                VRPESERTA.NO_KAD_PENGENALAN,
                VRPESERTA.EMEL,
                VRPESERTA.NO_TELEFON,
                VRPESERTA.ALAMAT_PERTAMA,
                VRPESERTA.ALAMAT_KEDUA,
                VRPESERTA.ALAMAT_KETIGA,
                VRPESERTA.POSKOD,
                VRPESERTA.BANDAR,
                VRPESERTA.NEGERI,
                VRPESERTA.NEGARA,
                VRPESERTA.NO_EBIB,
                VRPESERTA.SAIZ_BAJU,
                VRPESERTA.NO_RUJUKAN,
                VRPESERTA.AMAUN,
                VRSESI.PK_ID,
                VRSESI.SESI
            FROM VRPESERTA
            INNER JOIN VRSESI ON VRPESERTA.FK_ID_SESI = VRSESI.PK_ID
                WHERE VRPESERTA.PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatPesertaById($data)
        {
            $this->db->query("
            UPDATE VRPESERTA SET 
                NAMA = :nama, 
                NO_KAD_PENGENALAN = :noic,
                EMEL = :emel, 
                NO_TELEFON = :notel, 
                ALAMAT_PERTAMA = :alamat1,
                ALAMAT_KEDUA = :alamat2,
                ALAMAT_KETIGA = :alamat3,
                POSKOD = :poskod, 
                BANDAR = :bandar, 
                NEGERI = :negeri, 
                NEGARA = :negara, 
                NO_EBIB = :ebib, 
                SAIZ_BAJU = :saizbaju
            WHERE PK_ID = :id
            ");
            $this->db->bind(":nama", $data["nama"]);
            $this->db->bind(":noic", $data["noic"]);
            $this->db->bind(":emel", $data["emel"]);
            $this->db->bind(":notel", $data["notel"]);
            $this->db->bind(":alamat1", $data["alamat1"]);
            $this->db->bind(":alamat2", $data["alamat2"]);
            $this->db->bind(":alamat3", $data["alamat3"]);
            $this->db->bind(":poskod", $data["poskod"]);
            $this->db->bind(":bandar", $data["bandar"]);
            $this->db->bind(":negeri", $data["negeri"]);
            $this->db->bind(":negara", $data["negara"]);
            $this->db->bind(":ebib", $data["ebib"]);
            $this->db->bind(":saizbaju", $data["saizbaju"]);
            $this->db->bind(":id", $data["id"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function removeMaklumatPeserta($val)
        {
            $this->db->query("
            DELETE FROM VRPESERTA
                WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }