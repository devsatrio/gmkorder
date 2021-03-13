
<main class="page shopping-cart-page">
    <section class="clean-block clean-cart">
            <div id="mb-4"></div>
            <div class="content">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            @php
                                $data=Session::get('cart');
                                $total=0;
                            @endphp
                            @if ($data==null)

                            @else
                            @foreach ($data as $key=>$item)
                                <div class="product">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2 col-md-2">
                                            <img class="img-fluid d-block mx-auto image" src="{{asset('img/gambarproduk/'.$item['gambar'])}}">
                                        </div>
                                        <div class="col-4 col-md-4 ">{{$item['prod'].' - '.$item['varian']}}</div>
                                        <div class="col-2 col-md-2 "><input readonly type="number" id="number" class="form-control quantity-input" value="{{$item['qty']}}"></div>
                                        <div class="col-2 col-md-2"><span>Rp. {{number_format($item['harga'])}}</span></div>
                                        <div class="col-2 col-md-2"><span><a href="#" onclick="hapusItem('{{$key}}')"><i class="fa fa-trash fa-sm"></i></a></span></div>
                                    </div>
                                </div>
                                @php
                                    $total=$total+$item['total'];
                                @endphp
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="items">

                                        <form class="form-inline">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Masukan Kode Voucher" >
                                                    <div class="input-group-append">
                                                      <button class="btn btn-outline-primary" type="button" id="button-addon2"><span class="fa fa-check"></span> Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="summary">
                                    <h3>Detail Total</h3>
                                    <h4><span class="text">Subtotal</span><span class="price" id="subttl">Rp. {{number_format($total)}}</span></h4>
                                    {{-- <h4><span class="text">Discount</span><span class="price">$0</span></h4> --}}
                                    {{-- <h4><span class="text">Shipping</span><span class="price">$0</span></h4> --}}
                                    <h4><span class="text">Total</span><span class="price" id="ttl">Rp. {{number_format($total)}}</span></h4>
                                    <form class="mt-3">
                                        <div class="form-group">
                                            <label for="">Nama Anda</label>
                                            <input type="text" id="fnama" class="form-control" placeholder="Isikan Nama Anda">
                                        </div>
                                        <div class="form-group">
                                            <label for="">No Telp</label>
                                            <input type="number" id="ftelp" class="form-control" placeholder="Contoh : 08xx">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pengambilan : </label> <br>
                                            <input onclick="cekToko()" value="Toko" type="radio" name="radio" id="rtoko" class="input-control"> Toko <br>
                                            <input onclick="cekKirim()" value="Kirim" type="radio" name="radio" id="rkirim" class="input-control"> Dikirim
                                        </div>
                                        <div id="fkirim" style="display: none" class="form-group">
                                            <label for="">Alamat Tujuan Atau Alamat Sendiri</label>
                                            <textarea  id="falamat" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </form>
                                    <button class="btn btn-primary btn-block btn-lg" onclick="checkout()" id="bcheckout" type="button">Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
