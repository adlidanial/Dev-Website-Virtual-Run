<?php

    class VRNamaParameter
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getNegeri()
        {
            $this->db->query("
            SELECT 
                A.PK_ID AS PK_ID_NAMA_PARAMETER, 
                A.NAMA_PARAMETER, 
                A.STATUS, 
                A.FK_ID_NAMA_KUMPULAN, 
                B.PK_ID, 
                B.NAMA_KUMPULAN
            FROM VRNAMAPARAMETER A, VRNAMAKUMPULAN B
                WHERE B.NAMA_KUMPULAN = 'NEGERI' AND B.PK_ID = A.FK_ID_NAMA_KUMPULAN AND A.STATUS = 'Y'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getNegara()
        {
            $this->db->query("
            SELECT 
                A.PK_ID AS PK_ID_NAMA_PARAMETER, 
                A.NAMA_PARAMETER, 
                A.STATUS, 
                A.FK_ID_NAMA_KUMPULAN, 
                B.PK_ID, 
                B.NAMA_KUMPULAN
            FROM VRNAMAPARAMETER A, VRNAMAKUMPULAN B
                WHERE B.NAMA_KUMPULAN = 'NEGARA' AND B.PK_ID = A.FK_ID_NAMA_KUMPULAN AND A.STATUS = 'Y'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getSaizBaju()
        {
            $this->db->query("
            SELECT 
                A.PK_ID AS PK_ID_NAMA_PARAMETER, 
                A.NAMA_PARAMETER, 
                A.STATUS, 
                A.FK_ID_NAMA_KUMPULAN, 
                B.PK_ID, 
                B.NAMA_KUMPULAN
            FROM VRNAMAPARAMETER A, VRNAMAKUMPULAN B
                WHERE B.NAMA_KUMPULAN = 'SAIZ BAJU' AND B.PK_ID = A.FK_ID_NAMA_KUMPULAN AND A.STATUS = 'Y'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatParameter()
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAPARAMETER
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatParameterByParameter($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAPARAMETER
                WHERE NAMA_PARAMETER LIKE :parameter
            ");
            $this->db->bind(":parameter", "%".$val."%");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatParameterByStatus($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAPARAMETER
                WHERE STATUS = :status
            ");
            $this->db->bind(":status", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatParameterByParameterAndStatus($data)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAPARAMETER
                WHERE NAMA_PARAMETER LIKE :parameter AND STATUS = :status
            ");
            $this->db->bind(":parameter", "%".$data["parameter"]."%");
            $this->db->bind(":status", $data["status"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function setMaklumatParameter($data)
        {
            $this->db->query("
            INSERT INTO VRNAMAPARAMETER (FK_ID_NAMA_KUMPULAN, NAMA_PARAMETER, STATUS)
                VALUES (:kumpulan, :parameter, :status)
            ");
            $this->db->bind(":kumpulan", $data["kumpulan"]);
            $this->db->bind(":parameter", $data["parameter"]);
            $this->db->bind(":status", $data["status"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getMaklumatParameterById($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAPARAMETER
                WHERE PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatParameterById($data)
        {
            $this->db->query("
            UPDATE VRNAMAPARAMETER SET
                FK_ID_NAMA_KUMPULAN = :kumpulan,
                NAMA_PARAMETER = :parameter,
                STATUS = :status
            WHERE PK_ID = :id
            ");
            $this->db->bind(":kumpulan", $data["kumpulan"]);
            $this->db->bind(":parameter", $data["parameter"]);
            $this->db->bind(":status", $data["status"]);
            $this->db->bind(":id", $data["id"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function removeMaklumatParameterById($val)
        {
            $this->db->query("
            DELETE FROM VRNAMAPARAMETER
            WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }