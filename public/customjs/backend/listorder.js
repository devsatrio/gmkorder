
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
  })
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/backend/data-list-order',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'faktur', name: 'faktur' },
            { data: 'nama', name: 'nama' },
            { data: 'tgl', name: 'tgl' },
            { data: 'jns_ambil', name: 'jns_ambil' },
            { data: 'kurir', name: 'kurir' },
            {
                render: function (data, type, row) {
                    return 'Rp.' + rupiah(row['total'])
                },
                "data": 'total',
                "className": 'text-right',
            },
            // {
            //     render: function (data, type, row) {
            //         return '<button class="btn btn-sm btn-secondary" onclick="lihatdetail(' + row['id'] + ')"><i class="fa fa-eye"></i></button> <a href="transaki-online/'+row['id']+'"><button class="btn btn-sm btn-primary" type="button"><i class="fa fa-wrench"></i></button></a> <button class="btn btn-sm btn-success" onclick="acctrx(' + row['id'] + ')"><i class="fa fa-check"></i></button> <button class="btn btn-sm btn-danger" onclick="cancel(' + row['id'] + ')"><i class="fa fa-ban"></i></button>'
            //     },
            //     "className": 'text-center',
            //     "orderable": false,
            //     "data": null,
            // },
            {
                render: function (data, type, row) {
                    return '<button class="btn btn-sm btn-secondary" onclick="lihatdetail(' + row['id'] + ')"><i class="fa fa-eye"></i></button> <button class="btn btn-sm btn-danger" onclick="hapussatudata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>'
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
            {
                render: function (data, type, row) {
                    return `<input onclick="ceksatudata()" type="checkbox" name="subcheck" class="subcheck" value="`+row['id']+`">`;
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 50,
        lengthMenu: [[50, 80, 100, 200, 500], [50, 80, 100, 200, 500]]
    });

});

//===============================================================================================
function lihatdetail(kode) {
    $('#modaltransaksi').modal('toggle');
    $('#loadingdetail').show();
    $('#tampildetail').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: '/backend/list-transaksi/get-detail/' + kode,
        success: function (data) {
            $.each(data['trx'], function (key, value) {
                $('#tampilkode').html(value.faktur);
                $('#tampiltgl').html(value.tgl);
                $('#tampilnamapembeli').html(value.nama);
                $('#tampilalamatpembeli').html(value.alamat);
                $('#tampiltelppembeli').html(value.telp);
                $('#tampilnamapenerima').html(value.nama_penerima);
                $('#tampilalamatpenerima').html(value.alamat_penerima);
                $('#tampiltelppenerima').html(value.telp_penerima);
                $('#tampiladmin').html(value.username);
                $('#tampilmetode').html(value.jns_ambil);
                $('#tampilkurir').html(value.kurir);
                $('#tampilketerangan').html(value.keterangan);
                $('#tampilsubtotal').html('Rp. ' + rupiah(value.subtotal));
                $('#tampilongkir').html('Rp. ' + rupiah(value.ongkir));
                $('#tampilpotongan').html('Rp. ' + rupiah(value.diskon));
                $('#tampiltotal').html('Rp. ' + rupiah(value.total));
            });
            var rows = '';
            $.each(data['detail'], function (key, value) {
                rows = rows + '<tr>';
                rows = rows + '<td>' + value.jumlah + ' Pcs</td>';
                rows = rows + '<td>' + value.namaproduk + ' ( ' + value.namawarna + ' - ' + value.namasize + ')</td>';
                rows = rows + '<td>' + value.diskon + ' %</td>';
                rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.harga) + '</td>';
                rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.subtotal) + '</td>';
                rows = rows + '</tr>';
            });
            $('#tubuhdetailtrx').html(rows);
            $('#loadingdetail').hide();
            $('#tampildetail').show();
        }
    });
}
window.lihatdetail = lihatdetail;

//===============================================================================================
function hapussatudata(kode) {
    swalWithBootstrapButtons.fire({
        title: 'Hapus Transaksi ?',
        text: "Data yang di hapus tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus !',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/backend/data-list-order/cancel-trx/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Transaksi berhasil hapus',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        }
    })
}
window.hapussatudata = hapussatudata;

//===============================================================================================
function acctrx(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Terima Transaksi ?',
        text: "Anda yakin transaksi ini sudah benar ?",
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        if (result.value) {
            swalWithBootstrapButtons.fire({
                title: 'Cetak Transaksi ?',
                text: "Pastikan telah mencetak transaksi sebagai bukti pembelian",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: 'Ya, Cetak',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                    $.ajax({
                        type: 'GET',
                        url: '/backend/list-transaksi/get-detail/' + kode,
                        success: function (data) {
                            $.each(data['trx'], function (key, value) {
                                $('#notafaktur').html(value.faktur);
                                $('#notatgl').html(value.tgl);
                                $('#notasubtotal').html('Rp. ' + rupiah(value.subtotal));
                                $('#notapotongan').html('Rp. ' + rupiah(value.diskon));
                                $('#notaongkir').html('Rp. ' + rupiah(value.ongkir));
                                $('#notatotal').html('Rp. ' + rupiah(value.total));
                            });
                            var rows = '';
                            $.each(data['detail'], function (key, value) {
                                rows = rows + '<tr style="font-size:10px;">';
                                rows = rows + '<td>' + value.namaproduk + ' ( ' + value.namawarna + ' - ' + value.namasize + ')</td>';
                                rows = rows + '<td>' + value.jumlah + ' Pcs</td>';
                                rows = rows + '<td>' + value.diskon + ' %</td>';
                                rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.harga) + '</td>';
                                rows = rows + '<td class="text-left"> Rp. ' + rupiah(value.subtotal) + '</td>';
                                rows = rows + '</tr>';
                            });
                            $('#cetaktabel').html(rows);

                            var divToPrint = document.getElementById('hidden_div');
                            var newWin = window.open('', 'Print-Window');
                            newWin.document.open();
                            newWin.document.write('<html><body onload="window.print();window.close()">' + divToPrint.innerHTML + '</body></html>');
                            newWin.document.close();
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/backend/data-list-order/acc-trx/' + kode,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function () {
                            swalWithBootstrapButtons.fire(
                                'Sukses!',
                                'Transaksi berhasil diterima',
                                'success'
                            )
                            $('#list-data').DataTable().ajax.reload();
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/backend/data-list-order/acc-trx/' + kode,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function () {
                            swalWithBootstrapButtons.fire(
                                'Sukses!',
                                'Transaksi berhasil diterima',
                                'success'
                            )
                            $('#list-data').DataTable().ajax.reload();
                        }
                    });
                }
            })
        }
    })
}
window.acctrx = acctrx;

//===============================================================================================
function rupiah(bilangan) {
    if (bilangan == '' || bilangan == null) {
        bilangan = 0;
    }
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
function cekaalldata() {
    if($('#csdata').is(':checked', true)){
        $(".subcheck").prop('checked', true);
        $('#hapusbtn').attr('style', "display:inline");
    }else{
        $(".subcheck").prop('checked', false);
        $('#hapusbtn').attr('style', "display:none");
    }
}

//======================================================================================================================
function ceksatudata() {
    if ($('.subcheck').is(':checked', true)) {
        $('#hapusbtn').attr('style', "display:inline");
    } else {
        $('#hapusbtn').attr('style', "display:none");
    }
}

//======================================================================================================================
function hapusbanyak() {

    swalWithBootstrapButtons.fire({
        title: 'Hapus Transaksi ?',
        text: "Data yang di hapus tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus !',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var id = [];
            $('input[name="subcheck"]:checked').each(function(i){
            id[i] = $(this).val();
            });
            if(id.length === 0){
                swalWithBootstrapButtons.fire(
                    'Error!',
                    'Pilih minimal satu data',
                    'error'
                )
            }else{
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                $.ajax({
                    url:'/backend/list-order/hapus-much-data',
                    method:'POST',
                    data:{
                        '_token': $('input[name=_token]').val(),
                        id:id,
                    },
                    success:function(){
                        swalWithBootstrapButtons.fire(
                            'Sukses!',
                            'Data berhasil dihapus',
                            'success'
                        )
                        $('#list-data').DataTable().ajax.reload();
                    }
                });
            }
        }
    })
}
window.hapusbanyak = hapusbanyak;
