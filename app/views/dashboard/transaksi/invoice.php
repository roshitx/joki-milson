<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= BASE_URL ?>/img/landing/favicon.ico" type="image/x-icon">
    <title>Struk Transaksi</title>
    <!-- Font & Bootstrap -->
    <link rel="stylesheet" type="text/css"
          href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style type="text/css">
        body {
            background-color: #f8f9fa;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
        }

        .invoice {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            width: 75mm;
            box-shadow: 0px 0px 10px #ccc;
            text-align: center;
            display: inline-block;
            vertical-align: top;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        #detail_menu td {
            padding: 3px;
            text-align: left;
            border-bottom: 0.5px solid #ccc;
        }

        th, td {
            padding: 3px;
            text-align: left;
        }

        tfoot td {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        @media print {
            @page {
                size: 55mm 150mm;
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            .invoice, .invoice * {
                visibility: visible;
            }

            .invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="no-print" style="margin-bottom: 1em; margin-top: 1em;">
    <a href="<?= BASE_URL ?>/transaksi" class="btn btn-secondary"><i class="fa fa-desktop mr-2"></i><b>Kembali</b></a>
</div>
<div class="invoice" id="invoice">
    <div class="row">
        <div class="col-12">
            <img src="<?= BASE_URL ?>/img/landing/logo.png" alt="" width="100%">
        </div>
    </div>
    <div class="py-2">
        <p>Teman kafein anda</p>
    </div>
    <table>
        <tr>
            <td class="mb-0">No :</td>
            <td class="mb-0 text-right"><?= $data['data_transaksi']['transaction_id'] ?></td>
        </tr>
        <tr>
            <td class="mb-0">Kasir :</td>
            <td class="mb-0 text-right"><?= $data['data_transaksi']['cashier_name'] ?></td>
        </tr>
        <tr>
            <td class="mb-0">Nama Customer :</td>
            <td class="mb-0 text-right"><?= $data['order_detail']['customer_name'] ?></td>
        </tr>
        <tr>
            <td class="mb-0">Nomor Meja :</td>
            <td class="mb-0 text-right"><?= $data['order_detail']['table_number'] ?></td>
        </tr>
        <tr>
            <td class="mb-0">Tanggal :</td>
            <td class="mb-0 text-right"><?= date('H:i A, j M Y') ?></td>
        </tr>

        <tr id="detail_pesanan">
            <td>Jumlah :</td>
            <td class="text-right"><?= count($data['detail_menu']) ?> Item</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <?php foreach ($data['detail_menu'] as $menu) : ?>
            <tr id="detail_menu">
                <?php if ($menu['show_discount']): ?>
                    <td><?= $menu['title'] ?> <small class="text-danger">x<?= $menu['quantity'] ?></small></td>
                    <td class="text-right">Rp. <?= number_format($menu['discounted_price'] * $menu['quantity'], 3, '.', '.') ?></td>
                <?php else: ?>
                    <td><?= $menu['title'] ?> <small class="text-danger">x<?= $menu['quantity'] ?></small></td>
                    <td class="text-right">Rp. <?= number_format($menu['price'] * $menu['quantity'], 3, '.', '.') ?></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
        <?php
        if ($data['data_transaksi']['ppn'] == null) {
            ?>
            <tr>
                <td class="text-right" colspan="2">Total : <strong>Rp <?= $data['order_detail']['grand_total'] ?>,00</strong></td>
            </tr>
        <?php
        } else {
            $totalAmount = $data['order_detail']['grand_total'];
            $totalPPN = $totalAmount * ($data['data_transaksi']['ppn'] / 100);
            $grandTotal = $totalAmount + $totalPPN;
            ?>
            <tr>
                <td class="text-right" colspan="2"><small>PPN 11% : <strong>Rp <?= number_format($totalPPN, 3, '.', '.') ?>,00</strong></small></td>
            </tr>
            <tr>
                <td class="text-right" colspan="2">Grand Total : <strong>Rp <?= number_format($grandTotal, 3, '.', '.') ?>,00</strong></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="text-center">Terima kasih sudah berkunjung!</div>
    <div class="text-center">Have A Nice Day :)</div>
</div>

<script>
    let invoice = document.getElementById('invoice');
    invoice.style.display = 'block';
    window.print();
</script>
</body>
</html>
