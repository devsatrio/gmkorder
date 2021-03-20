<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/viewer.js')}}"></script>
<script src="{{asset('frontend/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="{{asset('frontend/assets/js/smoothproducts.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/theme.js')}}"></script>
<script src="{{asset('frontend/assets/swal/sweetalert2.min.js')}}"></script>
<script src="{{asset('frontend/loading/jquery.loading.js')}}"></script>
<script>
    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    });
    // loading
      function loadingf() {
        $("#loadData").loading({
            stoppable: true,
            theme: "dark",
            message: 'Proses Simpan....',
          });
      }
      function loadingawal() {
        $(".ading").loading({
            stoppable: true,
            theme: "dark",
            message: 'Please Wait....',
          });
      }
      function sloadingawal() {
        $(".ading").loading('stop');
      }
      function stoploadingf() {
        $("#loadData").loading('stop');
      }

</script>
