<?php

class VRBuktiGambar
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMaklumatGambarPesertaAndSenaraiPeserta($val)
    {
        $this->db->query("
        (
            SELECT 
            A.PK_ID,
            A.FK_ID_SESI, 
            A.NAMA, 
            A.NO_KAD_PENGENALAN,
            A.EMEL, 
            A.NO_TELEFON, 
            A.NO_EBIB,
            B.FK_ID_PESERTA,
            B.URL_GAMBAR,
            CASE
                WHEN B.TARIKH_KEMASKINI IS NULL THEN NULL
                WHEN B.TARIKH_KEMASKINI IS NOT NULL THEN B.TARIKH_KEMASKINI
            END AS TARIKH_KEMASKINI,
            CASE
                WHEN B.URL_GAMBAR IS NOT NULL THEN 'Y'
                WHEN B.URL_GAMBAR IS NULL THEN 'N'
            END AS STATUS
            FROM VRPESERTA A
            LEFT JOIN VRBUKTILARIAN B ON A.PK_ID = B.FK_ID_PESERTA
            WHERE A.FK_ID_SESI = :sesi
        )
        UNION
        (
            SELECT 
            C.PK_ID,
            C.FK_ID_SESI, 
                C.NAMA, 
                C.NO_KAD_PENGENALAN,
                C.EMEL, 
                C.NO_TELEFON, 
                C.NO_EBIB,
                D.FK_ID_PESERTA,
                D.URL_GAMBAR,
                CASE
                    WHEN D.TARIKH_KEMASKINI IS NULL THEN NULL
                    WHEN D.TARIKH_KEMASKINI IS NOT NULL THEN D.TARIKH_KEMASKINI
                END AS TARIKH_KEMASKINI,
                CASE
                    WHEN D.URL_GAMBAR IS NOT NULL THEN 'Y'
                    WHEN D.URL_GAMBAR IS NULL THEN 'N'
                END AS STATUS
            FROM VRPESERTA C
        RIGHT JOIN VRBUKTILARIAN D ON C.PK_ID = D.FK_ID_PESERTA
        WHERE C.FK_ID_SESI = :sesi
        )
        ORDER BY NO_EBIB ASC
        ");
        $this->db->bind(":sesi", $val);
        $result = $this->db->resultSet();
        return $result;
    }
}
