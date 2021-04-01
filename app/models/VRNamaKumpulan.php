<?php

    class VRNamaKumpulan
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getMaklumatKumpulan()
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAKUMPULAN
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatKumpulanAktif()
        {
            $this->db->query("
            SELECT PK_ID, NAMA_KUMPULAN, STATUS 
            FROM VRNAMAKUMPULAN
            WHERE STATUS = 'Y'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatKumpulanByNamaKumpulan($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAKUMPULAN
                WHERE NAMA_KUMPULAN LIKE :kumpulan
            ");
            $this->db->bind(":kumpulan", "%".$val."%");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatKumpulanByStatus($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAKUMPULAN
                WHERE STATUS = :status
            ");
            $this->db->bind(":status", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatKumpulanByNamaKumpulanAndStatus($data)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAKUMPULAN
                WHERE NAMA_KUMPULAN LIKE :kumpulan AND STATUS = :status
            ");
            $this->db->bind(":kumpulan", "%".$data["kumpulan"]."%");
            $this->db->bind(":status", $data["status"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function setMaklumatKumpulan($data)
        {
            $this->db->query("
            INSERT INTO VRNAMAKUMPULAN (NAMA_KUMPULAN, STATUS)
            VALUES (:kumpulan, :status)
            ");
            $this->db->bind(":kumpulan", $data["kumpulan"]);
            $this->db->bind(":status", $data["status"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function getMaklumatKumpulanById($val)
        {
            $this->db->query("
            SELECT * 
            FROM VRNAMAKUMPULAN
                WHERE PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatKumpulanById($data)
        {
            $this->db->query("
            UPDATE VRNAMAKUMPULAN SET
                NAMA_KUMPULAN = :kumpulan, 
                STATUS = :status
            WHERE PK_ID = :id
            ");
            $this->db->bind(":kumpulan", $data["kumpulan"]);
            $this->db->bind(":status", $data["status"]);
            $this->db->bind(":id", $data["id"]);
            if($this->db->execute())
                return true;
            else
                return false;
        }

        public function removeMaklumatKumpulanById($val)
        {
            $this->db->query("
            DELETE FROM VRNAMAKUMPULAN
            WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }