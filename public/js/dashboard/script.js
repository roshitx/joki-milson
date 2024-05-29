$(function () {
  // active link sidebar
  const currentUrl = window.location.href;

  // Cek apakah URL mengandung kata "cashier"
  if (currentUrl.includes('/cashier')) {
    $('#cashierLink').addClass('active');
  } else if (currentUrl.includes('/dashboard')) {
    $('#dashboardLink').addClass('active');
  } else if (currentUrl.includes('/menu') || currentUrl.includes('/discount')) {
    $('#menuLink').addClass('active');
  } else if (currentUrl.includes('/transaksi')) {
    $('#transaksiLink').addClass('active');
  } else if (currentUrl.includes('/salary')) {
    $('#gajiLink').addClass('active');
  } else if (currentUrl.includes('/pengeluaran')) {
    $('#pengeluaranLink').addClass('active');
  } else if (currentUrl.includes('/laporan')) {
    $('#laporanLink').addClass('active');
  } else if (currentUrl.includes('/stok')) {
    $('#stokLink').addClass('active');
  } else if (currentUrl.includes('/table')) {
    $('#mejaLink').addClass('active');
  }

  // edit logic in cashier
  $('.addButtonCashier').click(function () {
    $('#formModalLabel').html('Add data cashier');
    $('.modal-footer button[type="submit"]').html('Add cashier');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/cashier/add'
    );
    $('#name').val('');
    $('#username').val('');
    $('#email').val('');
    $('#password').val('');
  });

  $('.editButtonCashier').click(function () {
    $('#formModalLabel').html('Edit data cashier');
    $('.modal-footer button[type="submit"]').html('Edit cashier');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/cashier/update'
    );

    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/milson-coffee/public/cashier/getedit',
      data: { id: id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#name').val(data.name);
        $('#username').val(data.username);
        $('#email').val(data.email);
        $('#id').val(data.id);
      },
    });
  });

  $('.addButtonMenu').click(function () {
    $('#formModalLabel').html('Add data menu');
    $('.modal-footer button[type="submit"]').html('Add menu');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/menu/add'
    );
    $('#imageInput').val('');
    $('#title').val('');
    $('#price').val('');
    $('.edit-info').hide();
  });

  $('.editButtonMenu').click(function () {
    $('#formModalLabel').html('Edit data menu');
    $('.modal-footer button[type="submit"]').html('Edit menu');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/menu/update'
    );
    $('.edit-info').show();

    const id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/milson-coffee/public/menu/getedit',
      data: { id: id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        console.log(data);
        try {
          $('#imageInput').next('.custom-file-label').html(data.image);
          $('#title').val(data.title);
          $('#price').val(data.price);
          $('#kategori').val(data.kategori);
          $('#id').val(id);
        } catch (e) {
          console.error('Error parsing JSON:', e);
        }
      },
    });
  });

  $('.addButtonSalary').click(function () {
    $('#formModalLabel').html('Add data gaji');
    $('.modal-footer button[type="submit"]').html('Add gaji');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/salary/add'
    );
    $('#cashier_name').val('');
    $('#gaji_bulanan').val('');
    $('#present').val('');
    $('#salary').val('');
    $('#month').val('');
  });

  $('.editButtonSalary').click(function () {
    $('#formModalLabel').html('Edit data gaji');
    $('.modal-footer button[type="submit"]').html('Edit salary');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/salary/update'
    );

    const id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/milson-coffee/public/salary/getedit',
      data: { id: id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        try {
          $('#cashier_name').val(data.cashier_name);
          $('#gaji_bulanan').val(data.monthly_sal);
          $('#present').val(data.present);
          $('#salary').val(data.salary);
          $('#month').val(data.month);
          $('#id').val(id);
        } catch (e) {
          console.error('Error parsing JSON:', e);
        }
      },
    });
  });

  $('.addButtonPengeluaran').click(function () {
    $('#formModalLabel').html('Add data biaya pengeluaran');
    $('.modal-footer button[type="submit"]').html('Add biaya pengeluaran');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/pengeluaran/add'
    );
    $('#type').val('');
    $('#description').val('');
    $('#amount').val('');
    $('#id').val('');
  });

  $('.editButtonPengeluaran').click(function () {
    $('#formModalLabel').html('Edit data biaya pengeluaran');
    $('.modal-footer button[type="submit"]').html('Edit pengeluaran');
    $('.modal-body form').attr(
      'action',
      'http://localhost/milson-coffee/public/pengeluaran/update'
    );

    const id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/milson-coffee/public/pengeluaran/getedit',
      data: { id: id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        try {
          $('#type').val(data.type);
          $('#description').val(data.description);
          $('#amount').val(data.amount);
          $('#id').val(data.id);
        } catch (e) {
          console.error('Error parsing JSON:', e);
        }
      },
    });
  });
});
