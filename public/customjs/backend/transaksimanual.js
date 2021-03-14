const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})
$(function () {

  $('.select2').select2();

  $(".select2").val(null).trigger('change');

  //===============================================================================================
  $('#caripelanggan').select2({
    placeholder: 'Cari Nama Pelanggan',
    ajax: {
      url: '/backend/transaksi-manual/caripelanggan',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              id: item.id,
              text: item.nama
            }
          })
        }
      },
      cache: true
    }
  });

  //===============================================================================================
  $('#produk').select2({
    placeholder: 'Cari Data Produk',
    ajax: {
      url: '/backend/transaksi-manual/cari-produk',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              id: item.id,
              text: item.produk_kode + ' - ' + item.nama + ' || ' + item.namawarna + ' || ' + item.namasize,
            }
          })
        }
      },
      cache: true
    }
  });

  //===============================================================================================
  $('#produk').on('select2:select', function (e) {
    $('#panelnya').loading('toggle');
    var kode = $(this).val();
    $.ajax({
      type: 'GET',
      url: '/backend/transaksi-manual/cari-detail-barang/' + kode,
      success: function (data) {
        return {
          results: $.map(data, function (item) {
            $("#stok").val(item.stok);
            $("#diskon").val(item.diskon);
            $("#harga").val(item.harga);
            $("#harga").focus();
          })
        }
      }, complete: function () {
        $('#panelnya').loading('stop');
      }
    });
  });

  //===============================================================================================
  $('#vocher').on('select2:select', function (e) {
    $('#paneldua').loading('toggle');
    var kode = $(this).val();
    $.ajax({
      type: 'GET',
      url: '/backend/transaksi-manual/cari-detail-vocher/' + kode,
      success: function (data) {
        return {
          results: $.map(data, function (item) {
            $("#potongan").val(item.jumlah);
            hitungtotal();
          })
        }
      }, complete: function () {
        $('#resetvocher').show();
        $('#paneldua').loading('stop');
      }
    });
  });

  //===============================================================================================
  $('#caripelanggan').on('select2:select', function (e) {
    $('#panelnya').loading('toggle');
    var kode = $(this).val();
    $.ajax({
      type: 'GET',
      url: '/backend/transaksi-manual/caridetail-pelanggan/' + kode,
      success: function (data) {
        return {
          results: $.map(data, function (item) {
            $("#namapenerima").val(item.nama);
            $("#telppenerima").val(item.telp);
            $("#alamat").html(item.alamat);
          })
        }
      }, complete: function () {
        $('#panelnya').loading('stop');
      }
    });
  });

  //===============================================================================================
  $('#add-pelanggan').click(function (e) {
    $('#addpelanggan').modal('toggle');
  });

  //===============================================================================================
  $('#simpanbtn').click(function (e) {
    if ($('#caripelanggan').val() == null || $('#caripelanggan').val() == '' || parseInt($('#subtotal').val()) == 0 || $('#subtotal').val() == '') {
      swalWithBootstrapButtons.fire(
        'Error!',
        'Data tidak boleh kosong',
        'warning'
      )
    } else {
      $('#paneldua').loading('toggle');
      $('#panelnya').loading('toggle');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: '/backend/transaksi-manual/simpan-transaksi',
        data: {
          '_token': $('input[name=_token]').val(),
          'resi': $('#resi').val(),
          'pembeli': $('#caripelanggan').val(),
          'vocher': $('#vocher').val(),
          'metode': $('#metode').val(),
          'kurir': $('#kurir').val(),
          'telppenerima': $('#telppenerima').val(),
          'namapenerima': $('#namapenerima').val(),
          'alamat': $('#alamat').val(),
          'potongan': $('#potongan').val(),
          'subtotal': $('#subtotal').val(),
          'ongkir': $('#ongkir').val(),
          'keterangan': $('#keterangan').val(),
        },
        success: function (data) {
          var divToPrint = document.getElementById('hidden_div');
          var newWin = window.open('', 'Print-Window');
          newWin.document.open();
          newWin.document.write('<html><body onload="window.print();window.close()">' + divToPrint.innerHTML + '</body></html>');
          newWin.document.close();
          location.reload();
        },
        complete: function () {
          $('#paneldua').loading('stop');
          $('#panelnya').loading('stop');
        }
      });
    }
  });
  //===============================================================================================
  $('#resetvocher').click(function (e) {
    $("#vocher").val(null).trigger('change');
    $('#potongan').val('');
    hitungtotal();
    $('#resetvocher').hide();
  });

  //===============================================================================================
  $('#btnsimpan').click(function (e) {
    if ($('#caripelanggan').val() == null || $('#caripelanggan').val() == '' || $('#produk').val() == '' || $('#stok').val() == '' || $('#harga').val() == '' || $('#jumlah').val() == '') {
      swalWithBootstrapButtons.fire(
        'Error!',
        'Data tidak boleh kosong',
        'warning'
      )
    } else {
      if (parseInt($('#stok').val()) < parseInt($('#jumlah').val())) {
        swalWithBootstrapButtons.fire(
          'Error!',
          'Stok tidak cukup',
        )
      } else {
        $('#panelnya').loading('toggle');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'POST',
          url: '/backend/transaksi-manual/add-detail-produk',
          data: {
            '_token': $('input[name=_token]').val(),
            'produk': $('#produk').val(),
            'stok': $('#stok').val(),
            'harga': $('#harga').val(),
            'diskon': $('#diskon').val(),
            'jumlah': $('#jumlah').val(),
          },
          success: function () {
            $('#produk').val('');
            $('#stok').val('');
            $('#harga').val('');
            $('#diskon').val('');
            $('#jumlah').val('');
            $("#produk").val(null).trigger('change');
            getproduk();
          }, complete: function () {
            $('#panelnya').loading('stop');
          }
        });
      }
    }
  });
  //===============================================================================================
  $('#simpanpelanggan').click(function (e) {
    if ($('#usernamepelanggan').val() == '' || $('#namapelanggan').val() == '' || $('#alamatpelanggan').val() == '' || $('#telppelanggan').val() == '') {
      swalWithBootstrapButtons.fire(
        'Error!',
        'Data tidak boleh kosong',
        'warning'
      )
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: '/backend/transaksi-manual/add-new-pengguna/',
        data: {
          '_token': $('input[name=_token]').val(),
          'nama': $('#namapelanggan').val(),
          'username': $('#usernamepelanggan').val(),
          'telp': $('#telppelanggan').val(),
          'alamat': $('#alamatpelanggan').val(),
        },
        success: function () {
          swalWithBootstrapButtons.fire(
            'Success!',
            'Data pelanggan berhasil disimpan',
            'success'
          )
          $('#namapelanggan').val('');
          $('#usernamepelanggan').val('');
          $('#telppelanggan').val('');
          $('#alamatpelanggan').val('');
          $('#addpelanggan').modal('hide');
        }
      });
    }
  });

});
function gantimetode() {
  if ($('#metode').val() == 'Kirim') {
    $('#formkirim').show();
  } else {
    $('#formkirim').hide();
  }
}
//===============================================================================================
function getproduk() {
  $('#paneldua').loading('toggle');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'GET',
    url: '/backend/transaksi-manual/get-data-produk',
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function (data) {
      var rows = '';
      var rowcetak = '';
      var totalpcs = 0;
      var totalharga = 0;
      var no = 0;
      $.each(data, function (key, value) {
        no += 1;
        rows = rows + '<tr>';
        rows = rows + '<td>' + value.produk_kode + '</td>';
        rows = rows + '<td>' + value.nama + '</td>';
        rows = rows + '<td>' + value.varian + '</td>';
        rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.harga) + '</td>';
        rows = rows + '<td>' + value.diskon + ' %</td>';
        rows = rows + '<td>' + value.jumlah + ' Pcs </td>';
        rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.subtotal) + '</td>';
        rows = rows + '<td><button type="button" onclick="hapusproduk(' + value.id + ')" class="btn btn-dark btn-sm"><i class="fas fa-trash"></i></button></td>';
        rows = rows + '</tr>';

        rowcetak = rowcetak + '<tr style="font-size:10px;">';
        rowcetak = rowcetak + '<td>' + value.nama + ' ( '+value.varian+' )</td>';
        rowcetak = rowcetak + '<td>' + value.jumlah + ' Pcs</td>';
        rowcetak = rowcetak + '<td class="text-left"> Rp. ' + rupiah(value.harga) + '</td>';
        rowcetak = rowcetak + '<td>' + value.diskon + ' %</td>';
        rowcetak = rowcetak + '<td class="text-left"> Rp. ' + rupiah(value.subtotal) + '</td>';
        rowcetak = rowcetak + '</tr>';

        totalpcs += value.jumlah;
        totalharga += value.subtotal;
      });
      $('#tubuh').html(rows);
      $('#cetaktabel').html(rowcetak);
      $('#totalpcs').html(totalpcs + ' Pcs');
      $('#total').html('Rp. ' + rupiah(totalharga));
      $('#subtotal').val(totalharga);

    }, complete: function () {
      hitungtotal();
      $('#paneldua').loading('stop');
    }
  });
}
window.getproduk = getproduk;
//===============================================================================================
function rupiah(bilangan) {
  var number_string = bilangan.toString(),
    sisa = number_string.length % 3,
    rupiah = number_string.substr(0, sisa),
    ribuan = number_string.substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  return rupiah;
}

//===============================================================================================
function hitungtotal() {
  var final_ongkir = 0;
  var final_potongan = 0;
  if ($('#ongkir').val() != '') {
    final_ongkir = parseInt($('#ongkir').val());
  }
  if ($('#potongan').val() != '') {
    final_potongan = parseInt($('#potongan').val());
  }
  var total = parseInt($('#subtotal').val()) + final_ongkir - final_potongan;
  $('#tampilsubtotal').html('Rp. ' + rupiah($('#subtotal').val()));
  $('#tampilpotongan').html('Rp. ' + rupiah(final_potongan));
  $('#tampilongkir').html('Rp. ' + rupiah(final_ongkir));
  $('#totalakhir').html('Rp. ' + rupiah(total));

  $('#notasubtotal').html('Rp. ' + rupiah($('#subtotal').val()));
  $('#notapotongan').html('Rp. ' + rupiah(final_potongan));
  $('#notaongkir').html('Rp. ' + rupiah(final_ongkir));
  $('#notatotal').html('Rp. ' + rupiah(total));
}
window.hitungtotal = hitungtotal;
//===============================================================================================
function hapusproduk(kode) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'DELETE',
    url: '/backend/transaksi-manual/hapusproduk/' + kode,
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function () {
      getproduk();
    }
  });
}
