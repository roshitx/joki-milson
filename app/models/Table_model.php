<?php
include __DIR__ . '../../../public/vendor/phpqrcode/qrlib.php';
class Table_model
{
    private $table = "table";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTable()
    {
        $this->db->query("SELECT * FROM `" . $this->table . "`");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getLastId()
    {
        $this->db->query("SELECT MAX(nomor_meja) AS last_id FROM `" . $this->table . "`");
        $this->db->execute();
        return $this->db->single();
    }
    public function storeMeja($data)
    {
        $uniqueId = $data['uuid'];
        $QRContent = BASE_URL . '/orders/' . $uniqueId;

        if ($uniqueId != null) {
            $storage = "qrcode/";

            if (!file_exists($storage)) {
                mkdir($storage);
            }

            $qrFileName = "tableQr_" . $uniqueId . ".png";
            QRcode::png($QRContent, $storage . $qrFileName, QR_ECLEVEL_L, 3, 2);
        }

        $query = "INSERT INTO `" . $this->table . "` (uuid, nomor_meja, qr) VALUES (:uuid, :nomor_meja, :qr)";
        $this->db->query($query);

        $this->db->bind(':uuid', $data['uuid']);
        $this->db->bind(':nomor_meja', $data['nomor_meja']);
        $this->db->bind(':qr', $qrFileName);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getTableById($id)
    {
        $this->db->query("SELECT * FROM `" . $this->table . "` WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getTableByUuid($uniqueId)
    {
        $this->db->query("SELECT * FROM `" . $this->table . "` WHERE uuid = :uuid");
        $this->db->bind(':uuid', $uniqueId);
        return $this->db->single();
    }

    public function deleteTable($id)
    {
        $tableInfo = $this->getTableById($id);

        if ($tableInfo) {
            $imagePath = 'qrcode/' . $tableInfo['qr'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // delete  qr code
            }

            $query = "DELETE FROM `" . $this->table . "` WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}
