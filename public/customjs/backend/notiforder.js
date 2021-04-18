
$(function () {
    setInterval(function () {
        cektransaksibaru();
    }, 8000);
})
var jumlahnotif = 0;
$('#btnbell').click(function (e) {
    jumlahnotif=0;
    $('#tandanotif').html(jumlahnotif);
    $('#tandanotif').hide();
});
function cektransaksibaru() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        type: 'GET',
        url: '/backend/cek-transaksi-baru',
        success: function (data) {
            var rows='';
            $.each(data['datanew'], function (key, value) {
                rows = rows + '<a href="/backend/list-order" class="dropdown-item"><i class="fas fa-shopping-cart mr-2"></i><b>';
                rows = rows + value.nama+'</b>  <br> <span class="text-muted text-sm">Membuat Order Baru '+value.created_at+'</span>';
                rows = rows + '</a><div class="dropdown-divider"></div>';
            });
            $('#listnotif').html(rows);
            $.each(data['datanotif'], function (key, value) {
                jumlahnotif += 1;
                $(document).Toasts('create', {
                    title: 'Yuhuu Orderan Baru',
                    autohide: true,
                    delay: 2000,
                    body: 'Anda mendapat order baru dari ' + value.nama
                })
                var audio = new Audio('../notif.mp3');
                var playPromise = audio.play();
                $('#tandanotif').html(jumlahnotif);
                $('#tandanotif').show();
            });
        }, complete: function () {
            bersihnotif();
        }
    });
}

function bersihnotif() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        type: 'GET',
        url: '/backend/bersih-notif',
        success: function (data) {
        }
    });
}