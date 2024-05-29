<div class="page">
    <div class="container">
        <!--  Ini nanti -->
        <!-- <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="customer_name">Nama Customer</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name">
                </div>
                <div class="form-group col-md-6">
                    <label for="table_number">Nomor Meja</label>
                    <input type="number" class="form-control" id="table_number" name="table_number">
                </div>
            </div> -->
                <div class="row row-lg row-30">
            <?php foreach($data['menus'] as $menu) : ?>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <form class="mt-5" action="<?= BASE_URL; ?>/cart/add" method="post">
                    <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
                    <article class="product wow fadeInLeft" data-wow-delay=".15s">
                        <div class="product-figure">
                            <img src="<?= BASE_URL ?>/img/dashboard/menu/<?= $menu['image'] ?>" alt="" />
                        </div>
                        <h6 class="product-title"><?= $menu['title'] ?></h6>
                        <div class="product-price-wrap">
                            <div class="product-price">Rp <?= $menu['price'] ?></div>
                        </div>
                        <div class="product-button">
                            <div class="button-wrap"><button type="submit"
                                    class="btn button button-xs button-primary button-winona">Add to cart</button>
                            </div>
                        </div>
                    </article>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
    </div>
</div>