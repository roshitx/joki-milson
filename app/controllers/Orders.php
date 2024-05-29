    <?php

    class Orders extends Controller
    {
        // menu models
        public function index($uniqueId = null)
        {
            if ($uniqueId !== null) {
                $tableData = $this->model('Table_model')->getTableByUuId($uniqueId);

                $data['nomor_meja'] = $tableData['nomor_meja'];
                $data['uuid_table'] = $tableData['uuid'];
                // echo "<pre>";
                // var_dump($nomorMeja);
                // echo "</pre>";
                // die;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rating = $_POST['rating'];
                $review = $_POST['review'];
                $ordersModel = $this->model('Orders_model');
                $ordersModel->addReview($rating, $review);
            }

            // Get all menus
            $data['judul'] = 'Milson Coffee | Semua Menu';
            $data['menus'] = $this->model('Orders_model')->getAllMenus();

            // Apply discount logic
            foreach ($data['menus'] as &$menu) {
                if (
                    isset($menu['discounted_price']) &&
                    strtotime(date('Y-m-d')) >= strtotime($menu['start_date']) &&
                    strtotime(date('Y-m-d')) <= strtotime($menu['end_date'])
                ) {
                    $menu['show_discount'] = true;
                } else {
                    $menu['show_discount'] = false;
                }
            }

            // Load views
            $this->view('templates/header', $data);
            $this->view('home/menus/index', $data);
            $this->view('templates/footer');
        }

        public function menuByCategory($category)
        {
            $data['judul'] = 'Milson Coffee | Menu by ' . $category;
            $data['menus'] = $this->model('Orders_model')->getMenusByCategory($category);

            // Terapkan logika diskon
            foreach ($data['menus'] as &$menu) {
                if (
                    isset($menu['discounted_price']) &&
                    strtotime(date('Y-m-d')) >= strtotime($menu['start_date']) &&
                    strtotime(date('Y-m-d')) <= strtotime($menu['end_date'])
                ) {
                    $menu['show_discount'] = true;
                } else {
                    $menu['show_discount'] = false;
                }
            }

            // Ubah data menu menjadi format yang sesuai dengan JSON
            $menuData = [];
            foreach ($data['menus'] as $menu) {
                $menuData[] = [
                    'menu_id' => $menu['menu_id'],
                    'title' => $menu['title'],
                    'price' => $menu['price'],
                    'kategori' => ucfirst($menu['kategori']),
                    'image' => $menu['image'],
                    'url' => BASE_URL . '/cart/add', // Ganti dengan URL yang sesuai
                    'discounted_price' => $menu['discounted_price'],
                    'disc' => $menu['disc'],
                    'show_discount' => $menu['show_discount'], // Tambahkan variabel show_discount
                ];
            }

            // Mengirimkan data dalam format JSON
            header('Content-Type: application/json');
            echo json_encode($menuData);
        }


        public function add()
        {
            $data = [
                'order_id' => $_POST['order_id'],
                'customer_name' => $_POST['customer_name'],
                'table_number' => $_POST['table_number'],
                'uuid_table' => $_POST['uuid_table'],
                'grand_total' => $_POST['grand_total'],
            ];

            $menuIds = $_POST['menuIds'];
            $quantities = $_POST['quantities'];
            $subTotals = $_POST['subTotals'];
            $cartIds = $_POST['cartIdData'];

            $itemCount = count($menuIds);

            if ($this->model('Orders_model')->addOrder($data) > 0) {
                try {
                    for ($i = 0; $i < $itemCount; $i++) {
                        $orderItemData = [
                            'order_id' => $data['order_id'],
                            'menu_id' => $menuIds[$i],
                            'quantity' => $quantities[$i],
                            'sub_total' => $subTotals[$i]
                        ];

                        $this->model('OrdersItems_model')->addItemToOrder($orderItemData);
                        $this->model('Cart_model')->deleteItemFromCart($cartIds[$i]);
                    }

                    // Transaksi berhasil
                    $response = [
                        'status' => 'success',
                        'message' => 'Pesanan anda sudah terkirim!',
                    ];
                } catch (Exception $e) {
                    // Terjadi kesalahan saat memproses transaksi
                    $response = [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat memproses transaksi.',
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal menambahkan pesanan.',
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
