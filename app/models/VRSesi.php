<?php

    class VRSesi
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getMaklumatSesiByStatusAktif()
        {
            $this->db->query("
            SELECT * 
            FROM VRSESI
                WHERE STATUS = 'Y'
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getAvailableSesiAktif()
        {
            $this->db->query("
            SELECT 
                VRAKTIVITI.FK_ID_SESI, 
                VRSESI.SESI, 
                VRSESI.PK_ID, 
                VRSESI.STATUS
            FROM VRSESI
            LEFT JOIN VRAKTIVITI ON VRSESI.PK_ID = VRAKTIVITI.FK_ID_SESI
                WHERE VRSESI.STATUS = 'Y' AND VRAKTIVITI.FK_ID_SESI IS NULL
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatSesiBySesiAndStatus($data)
        {
            $this->db->query("
            SELECT * FROM VRSESI
                WHERE SESI = :sesi AND STATUS = :status
            ");
            $this->db->bind(":sesi", $data["sesi"]);
            $this->db->bind(":status", $data["status"]);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatSesiBySesi($val)
        {
            $this->db->query("
            SELECT * FROM VRSESI
                WHERE SESI = :sesi
            ");
            $this->db->bind(":sesi", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatSesiByStatus($val)
        {
            $this->db->query("
            SELECT * FROM VRSESI
                WHERE STATUS = :status
            ");
            $this->db->bind(":status", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getMaklumatSesi()
        {
            $this->db->query("
            SELECT * FROM VRSESI
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function setMaklumatSesi($data)
        {
            $this->db->query("
            INSERT INTO VRSESI (SESI, STATUS)
            VALUES (:sesi, :status)
            ");

            try
            {
                $this->db->bind(':sesi', $data["sesi"]);
                $this->db->bind(':status', $data["status"]);
    
                if($this->db->execute())
                    return true;
                else
                    return false;
            }
            catch (Exception $e)
            {
                echo "<script>
                window.alert('Sesi ini telah wujud. Sila masukkan sesi lain');
                window.location.href='//". URLROOT ."/admin/tambahsesi';</script>";   
            } 
        }

        public function getMaklumatSesiById($val)
        {
            $this->db->query("
            SELECT * FROM VRSESI
                WHERE PK_ID = :id
            ");
            $this->db->bind(":id", $val);
            $result = $this->db->resultSet();
            return $result;
        }

        public function updateMaklumatSesiAndStatusById($data)
        {
            $this->db->query("
            UPDATE VRSESI SET 
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

        public function removeMaklumatSesi($val)
        {
            $this->db->query("
            DELETE FROM VRSESI
                WHERE PK_ID = :id
            ");

            $this->db->bind(':id', $val);
            if($this->db->execute())
                return true;
            else
                return false;
        }
    }