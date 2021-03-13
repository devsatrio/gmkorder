
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/backend/data-list-transaksi',
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
                    return 'Rp.'+rupiah(row['total'])
                },
                "data":'total',
                "className": 'text-right',
            },
            {
                render: function (data, type, row) {
                    return '<button class="btn btn-secondary" onclick="lihatdetail(' + row['id'] + ')"><i class="fa fa-eye"></i></button>'
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

function lihatdetail(kode){
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
          url: '/backend/list-transaksi/get-detail/'+kode,
          success: function (data) {
            $.each(data['trx'], function(key, value) {
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
                $('#tampilsubtotal').html('Rp. '+rupiah(value.subtotal));
                $('#tampilongkir').html('Rp. '+rupiah(value.ongkir));
                $('#tampilpotongan').html('Rp. '+rupiah(value.diskon));
                $('#tampiltotal').html('Rp. '+rupiah(value.total));
            });
            var rows ='';
            $.each(data['detail'],function(key, value){
              rows = rows + '<tr>';
              rows = rows + '<td>' +value.jumlah+' Pcs</td>';
              rows = rows + '<td>' +value.namaproduk+' ( '+ value.namawarna+' - '+ value.namasize+')</td>';
              rows = rows + '<td>'+value.diskon+' %</td>';
              rows = rows + '<td class="text-left"> Rp. ' +rupiah(value.harga)+'</td>';
              rows = rows + '<td class="text-left"> Rp. ' +rupiah(value.subtotal)+'</td>';
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
function rupiah(bilangan){
    if(bilangan=='' || bilangan==null){
        bilangan=0;
    }
    var number_string = bilangan.toString(),
    sisa    = number_string.length % 3,
    rupiah  = number_string.substr(0, sisa),
    ribuan  = number_string.substr(sisa).match(/\d{3}/gi);
    
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return rupiah;
  }