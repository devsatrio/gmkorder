<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <a href="https://api.whatsapp.com/send?phone={{CekNotif::getNoTelp()->telp}}&text=Saya Perlu Bantuan" target="_blank">  <h5><i class="icon-user-following"></i> Kontak Admin</a> </h5>
            </div>
            <div class="col-sm-3">
                <a href="https://instagram.com/{{CekNotif::namaWeb()->ig}}" target="_blank"><h5><i class="icon-social-instagram" ></i> Instagram</a> </h5>
            </div>
            <div class="col-sm-3">
                <a href="https://facebook.com/{{CekNotif::namaWeb()->fb}}" target="_blank"><h5><i class="icon-social-facebook" ></i> Facebook</a> </h5>
            </div>
            <div class="col-sm-3">
                <a href="https://play.google.com/store/apps/details?id={{CekNotif::namaWeb()->link_android}}" target="_blank"><h5><i class="icon-control-play"></i> Download Di Playstore</a> </h5>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© 2021 {{CekNotif::namaWeb()->nama}}</p>
    </div>
</footer>
