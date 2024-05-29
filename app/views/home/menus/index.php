<?php
if (isset($_SESSION['cart_item_count'])) {
?>
    <div class="cart-container z-index-3" id="cart-button">
        <div class="cart-icon">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="badge"><?= isset($_SESSION['cart_item_count']) ? $_SESSION['cart_item_count'] : 0 ?></span>
        </div>
    </div>
<?php
}
?>


<!-- Loader -->
<div class="preloader">
    <div class="wrapper-triangle">
        <div class="pen">
            <div class="line-triangle">
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
            </div>
            <div class="line-triangle">
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
            </div>
            <div class="line-triangle">
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
                <div class="triangle"></div>
            </div>
        </div>
    </div>
</div>

<div class="page">
    <div class="container">

        <h3 class="mt-5">Menu Kami</h3>

        <div class="form-group mt-5">
            <label for="filterByKategori">Filter by Kategori</label>
            <select class="form-control" id="filterByKategori">
                <option value="all" id="all">Semua</option>
                <option value="minuman" id="minuman">Minuman</option>
                <option value="makanan" id="makanan">Makanan</option>
            </select>
        </div>
        <div class="row row-lg row-30" id="menuContainer">
            <?php foreach ($data['menus'] as $menu) : ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <form class="mt-2 mb-5" action="<?= BASE_URL; ?>/cart/add" method="post">
                        <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
                        <article class="product wow fadeInLeft" data-wow-delay=".15s">
                            <div class="product-figure">
                                <img src="<?= BASE_URL ?>/img/dashboard/menu/<?= $menu['image'] ?>" alt="Menu Image" />
                            </div>

                            <h6 class="product-title"><?= $menu['title'] ?></h6>
                            <small><?= ucfirst($menu['kategori']) ?></small>

                            <div class="product-price-wrap">
                                <?php if ($menu['show_discount']) : ?>
                                    <small class="product-price"><s>Rp <?= $menu['price'] ?></s></small>
                                    <div class="product-price text-danger">Rp
                                        <?= number_format($menu['discounted_price'], 3, '.', ',') ?></div>
                                    <small class="text-danger"><?= $menu['disc'] ?>% Discount</small>
                                <?php else : ?>
                                    <div class="product-price">Rp <?= $menu['price'] ?></div>
                                <?php endif ?>
                            </div>
                            <div class="product-button">
                                <div class="button-wrap"><button type="submit" class="btn button button-xs button-primary button-winona">Add to cart</button>
                                </div>
                            </div>
                        </article>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cart Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content" id="cartModalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-borderless" id="cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Item</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col"><i class="fa-solid fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center position-relative mb-5">
                            <p class="right-0 text-dark" id="grandTotal"><strong>Grand Total
                                    :</strong>
                            </p>
                        </div>
                        <form action="<?= BASE_URL ?>/orders/add" method="POST" id="submitForm">
                            <input type="hidden" id="grandTotalInput">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Nama Customer" id="customer_name" name="customer_name">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" placeholder="Nomor Meja" id="table_number" name="table_number">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i>
                            Pesan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Cart Modal -->

        <!-- Rating Modal -->
        <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content" id="ratingModalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ratingModalLabel">Rating and Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= BASE_URL ?>/orders" method="POST">
                        <div class="modal-body">
                            <p>Please give us a rating and review, this is opsional</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" name="rating" placeholder="Rating" id="rating" class="form-control" min="0" max="5">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Review" name="review" id="review" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i>
                                Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Rating Modal -->
        <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#filterByKategori').change(function() {
            const selectedCategory = $(this).val();

            if (selectedCategory == 'all') {
                // Jika "Semua" dipilih, arahkan ke semua menu
                window.location.href = 'http://localhost/milson-coffee/public/orders/';
            } else {
                $.ajax({
                    url: 'http://localhost/milson-coffee/public/orders/menuByCategory/' +
                        selectedCategory,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#menuContainer').empty();

                        data.forEach(function(menu) {
                            var menuItemHtml = `
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <form class="mt-2 mb-5" action="${menu.url}" method="post">
                                <input type="hidden" name="menu_id" value="${menu.menu_id}">
                                <article class="product wow fadeInLeft" data-wow-delay=".15s">
                                    <div class="product-figure">
                                        <img src="<?= BASE_URL ?>/img/dashboard/menu/${menu.image}" alt="" />
                                    </div>
                                    <h6 class="product-title">${menu.title}</h6>
                                    <small>${menu.kategori}</small>
                                    <div class="product-price-wrap">
                                    ${menu.show_discount ? `<small class="product-price"><s>Rp ${menu.price}</s></small>
                                                            <div class="product-price text-danger">Rp ${menu.discounted_price}</div>
                                                            <small class="text-danger">${menu.disc}% Discount</small>`
                                                        : `<div class="product-price">Rp ${menu.price}</div>`
                                    }
                                    </div>
                                    <div class="product-button">
                                        <div class="button-wrap">
                                            <button type="submit" class="btn button button-xs button-primary button-winona">Add to cart</button>
                                        </div>
                                    </div>
                                </article>
                            </form>
                        </div>`;

                            $('#menuContainer').append(menuItemHtml);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Kesalahan dalam permintaan AJAX: " + error);
                    }
                });
            }
        });


        $('#cart-button').on('click', function() {
            let menuIds = [];
            let qtyData = [];
            let subTotalData = [];
            let cartId = [];
            let grandTotal = 0;

            function generateOrderId() {
                const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                let orderId = 'OD-';
                for (let i = 0; i < 6; i++) {
                    const randomChar = chars[Math.floor(Math.random() * chars.length)];
                    orderId += randomChar;
                }
                return orderId;
            }

            // Tampilkan modal
            $('#cartModal').modal('show');
            $.ajax({
                url: 'http://localhost/milson-coffee/public/cart/detail',
                method: 'GET',
                success: function(data) {
                    try {
                        var parsedData = JSON.parse(data);
                        var cartData = parsedData.cart;

                        // Mengumpulkan menu_id dari setiap item dalam keranjang
                        cartData.forEach(function(item) {
                            menuIds.push(item.menu_id);
                            qtyData.push(item.quantity);
                            subTotalData.push(item.sub_total);
                            cartId.push(item.cart_id);
                        });


                        // Mengecek apakah data tidak kosong
                        if (cartData && cartData.length > 0) {
                            $('#cart-table tbody').empty();
                            $.each(cartData, function(index, item) {
                                grandTotal += parseFloat(item.sub_total);
                                $('#cart-table tbody').append(
                                    '<tr>' +
                                    '<td><strong>' + (index + 1) +
                                    '</strong></td>' +
                                    '<td>' + item.title + '<small> x' + item
                                    .quantity + '</small></td>' +
                                    '<td> Rp ' + item.price + '</td>' +
                                    '<td> Rp ' + item.sub_total + '</td>' +
                                    '<td><button class="btn btn-danger btn-delete" data-cart-id="' +
                                    item.cart_id +
                                    '"><i class="fa-solid fa-trash"></i></button></td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            // Tampilkan pesan jika keranjang kosong
                            $('#cart-table tbody').html(
                                '<tr><td colspan="6">Keranjang masih kosong</td></tr>');
                        }

                        // Memperbarui Grand Total
                        const grandTotalValue = formatCurrency(grandTotal);
                        $('#grandTotal').html(
                            '<strong id="grandTotalFix">Grand Total: Rp ' +
                            grandTotalValue +
                            '</strong>');

                        $('#grandTotalInput').val(grandTotalValue);
                    } catch (error) {
                        console.log("Kesalahan dalam mengurai data JSON:", error);
                    }
                },
                error: function(error) {
                    // Tangani kesalahan jika ada
                    console.log(error);
                }
            });

            $('#submitForm').submit(function(event) {
                event.preventDefault();

                // Mendapatkan data dari form
                const order_id = generateOrderId();
                const customer_name = $('#customer_name').val();
                const table_number = $('#table_number').val();
                const grandTotal = $('#grandTotalInput').val();

                // Data yang akan dikirimkan
                const orderData = {
                    order_id: order_id,
                    customer_name: customer_name,
                    table_number: table_number,
                    grand_total: grandTotal,
                    menuIds: menuIds,
                    quantities: qtyData,
                    subTotals: subTotalData,
                    cartIdData: cartId,
                };

                // Melakukan request Ajax
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/milson-coffee/public/orders/add',
                    data: orderData,
                    dataType: 'json',
                    success: function(response) {
                        updateCartTable2();
                        $('#customer_name').val('');
                        $('#table_number').val('');
                        updateCartTable2();
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Pesanan anda akan segera diproses.",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#cartModal').modal('hide');
                                $('#ratingModal').modal('show');
                            }
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).on('click', '.btn-delete', function() {
            let cartId = $(this).data('cart-id');
            deleteCartItem(cartId);
        });

        function deleteCartItem(cartId) {
            $.ajax({
                url: 'http://localhost/milson-coffee/public/cart/delete/' + cartId,
                method: 'GET',
                success: function(data) {
                    $.ajax({
                        url: 'http://localhost/milson-coffee/public/cart/detail',
                        method: 'GET',
                        success: function(data) {
                            try {
                                var parsedData = JSON.parse(data);
                                var cartData = parsedData.cart;
                                updateCartTable(cartData);
                            } catch (error) {
                                console.log("Kesalahan dalam mengurai data JSON:",
                                    error);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        }

        function updateCartTable(cartData) {
            if (cartData && cartData.length > 0) {
                $('#cart-table tbody').empty();
                let grandTotal = 0;
                $.each(cartData, function(index, item) {
                    let subTotal = item.price * item.quantity;
                    grandTotal += subTotal;

                    $('#cart-table tbody').append(
                        '<tr>' +
                        '<td><strong>' + (index + 1) + '</strong></td>' +
                        '<td>' + item.title + '<small> x' + item.quantity + '</small></td>' +
                        '<td> Rp ' + item.price + '</td>' +
                        '<td> Rp ' + item.sub_total + '</td>' +
                        '<td><button class="btn btn-danger btn-delete" data-cart-id="' +
                        item.cart_id + '"><i class="fa-solid fa-trash"></i></button></td>' +
                        '</tr>'
                    );
                });

                const grandTotalValue = grandTotal.toFixed(3);
                $('#grandTotal').html('<strong>Grand Total: Rp ' + grandTotalValue + '</strong>');
                $('#grandTotalInput').val(grandTotalValue);
            } else {
                $('#cart-table tbody').html('<tr><td colspan="6">Keranjang masih kosong</td></tr>');
                $('#grandTotal').hide();
            }
        }

        function updateCartTable2() {
            $.ajax({
                type: 'GET', // Gunakan metode GET untuk mengambil data keranjang yang terbaru
                url: 'http://localhost/milson-coffee/public/cart/detail', // Gantilah URL ini sesuai dengan endpoint Anda
                dataType: 'json',
                success: function(cartData) {
                    console.log('success');
                    if (cartData && cartData.cart.length > 0) {
                        $('#cart-table tbody').empty();
                        let grandTotal = 0;
                        $.each(cartData.cart, function(index, item) {
                            let subTotal = item.price * item.quantity;
                            grandTotal += subTotal;

                            $('#cart-table tbody').append(
                                '<tr>' +
                                '<td><strong>' + (index + 1) + '</strong></td>' +
                                '<td>' + item.title + '<small> x' + item.quantity +
                                '</small></td>' +
                                '<td> Rp ' + item.price + '</td>' +
                                '<td> Rp ' + item.sub_total + '</td>' +
                                '<td><button class="btn btn-danger btn-delete" data-cart-id="' +
                                item.cart_id +
                                '"><i class="fa-solid fa-trash"></i></button></td>' +
                                '</tr>'
                            );
                        });

                        const grandTotalValue = grandTotal.toFixed(3);
                        $('#grandTotal').html('<strong>Grand Total: Rp ' + grandTotalValue +
                            '</strong>');
                        $('#grandTotalInput').val(grandTotalValue);
                    } else {
                        $('#cart-table tbody').html(
                            '<tr><td colspan="6">Keranjang masih kosong</td></tr>');
                        $('#grandTotal').hide();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function formatCurrency(value) {
            return value.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
    });
</script>