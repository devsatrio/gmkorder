<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/viewer.js')}}"></script>
<script src="{{asset('frontend/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="{{asset('frontend/assets/js/smoothproducts.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/theme.js')}}"></script>
<script src="{{asset('frontend/assets/swal/sweetalert2.min.js')}}"></script>
<script>
    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    });
    function countC() {
        var ct="<?php echo CekNotif::countKeranjang() ?>";
         $('#countC').html(ct);
         if(ct>0){
             var totl=$('#ttl').text();
            $('#basket').attr('style','display:inherit');
            $('#totalbl').html(totl);
         }
        }
</script>
