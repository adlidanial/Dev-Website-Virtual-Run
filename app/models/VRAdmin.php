<?php

    class VRAdmin
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getMaklumatAdmin($val)
        {
            $this->db->query("
            SELECT 
                KATA_NAMA, 
                KATA_LALUAN
            FROM VRADMIN
                WHERE KATA_NAMA = :katanama
            ");
            $this->db->bind(':katanama', $val);
            $result = $this->db->resultSet();
            return $result;
        }

        

        
    }