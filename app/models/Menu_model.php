<?php

class Menu_model
{
    private $table = 'menus';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMenus()
    {
        $this->db->query("SELECT *, discount.disc AS disc, menus.menu_id as id,
                            (menus.price - (menus.price * discount.disc / 100)) AS discounted_price,
                            discount.start_date,
                            discount.end_date
                            FROM menus
                            LEFT JOIN discount
                            ON discount.menu_id = menus.menu_id");
        $this->db->execute();
    
        return $this->db->resultSet();
    }

    public function getAllMenusWithoutDiscount()
    {
        $this->db->query("SELECT * FROM menus WHERE menu_id NOT IN (SELECT menu_id FROM discount)");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getSelectedMenus()
    {
        $this->db->query("SELECT * FROM " . $this->table . " LIMIT 4");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addMenu($menu)
    {
        $filename = $_FILES["image"]["name"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $newFileName = time() . "-" . $filename;

        move_uploaded_file($tmpName, '../public/img/dashboard/menu/' . $newFileName);

        $query = "INSERT INTO " . $this->table . " (title, price, image, kategori)
                    VALUES
                    (:title, :price, :image, :kategori)";

        $this->db->query($query);
        $this->db->bind('title', $menu['title']);
        $this->db->bind('price', $menu['price']);
        $this->db->bind('image', $newFileName);
        $this->db->bind('kategori', $menu['kategori']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getMenuById($id)
    {
        $this->db->query("SELECT * FROM menus WHERE menu_id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateMenu($menu)
    {
        // Cek apakah ada gambar yang diunggah
        if (!empty($_FILES["image"]["name"])) {
            // Menghapus gambar lama dari storage jika ada
            $oldMenu = $this->getMenuById($menu['id']);
            $oldImage = $oldMenu['image'];
            if (!empty($oldImage)) {
                unlink('../public/img/dashboard/menu/' . $oldImage);
            }

            // Mengunggah gambar yang baru
            $filename = $_FILES["image"]["name"];
            $tmpName = $_FILES["image"]["tmp_name"];
            $newFileName = time() . "-" . $filename;
            move_uploaded_file($tmpName, '../public/img/dashboard/menu/' . $newFileName);
        } else {
            // Jika tidak ada gambar yang diunggah, gunakan gambar lama
            $newFileName = $menu['image'];
        }

        $query = "UPDATE " . $this->table . " SET title = :title, price = :price, image = :image, kategori = :kategori WHERE menu_id = :id";
        $this->db->query($query);
        $this->db->bind('title', $menu['title']);
        $this->db->bind('price', $menu['price']);
        $this->db->bind('image', $newFileName);
        $this->db->bind('kategori', $menu['kategori']);
        $this->db->bind('id', $menu['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }


    public function deleteMenu($id)
    {
        $menuInfo = $this->getMenuById($id);

        if ($menuInfo) {
            $imagePath = '../public/img/dashboard/menu/' . $menuInfo['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file gambar
            }

            $query = "DELETE FROM menus WHERE menu_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}
