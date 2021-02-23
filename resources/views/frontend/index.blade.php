@extends('frontend.base.base')
@section('content')
<div class="offsetmenu">
    <div class="offsetmenu__inner">
        <div class="offsetmenu__close__btn">
            <a href="#"><i class="zmdi zmdi-close"></i></a>
        </div>
        <div class="off__contact">
            <div class="logo">
                <a href="index.html">
                    <img src="images/logo/logo.png" alt="logo">
                </a>
            </div>
            <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
        </div>
        <ul class="sidebar__thumd">
            <li><a href="#"><img src="images/sidebar-img/1.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/2.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/3.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/4.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/5.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/6.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/7.jpg" alt="sidebar images"></a></li>
            <li><a href="#"><img src="images/sidebar-img/8.jpg" alt="sidebar images"></a></li>
        </ul>
        <div class="offset__widget">
            <div class="offset__single">
                <h4 class="offset__title">Language</h4>
                <ul>
                    <li><a href="#"> Engish </a></li>
                    <li><a href="#"> French </a></li>
                    <li><a href="#"> German </a></li>
                </ul>
            </div>
            <div class="offset__single">
                <h4 class="offset__title">Currencies</h4>
                <ul>
                    <li><a href="#"> USD : Dollar </a></li>
                    <li><a href="#"> EUR : Euro </a></li>
                    <li><a href="#"> POU : Pound </a></li>
                </ul>
            </div>
        </div>
        <div class="offset__sosial__share">
            <h4 class="offset__title">Follow Us On Social</h4>
            <ul class="off__soaial__link">
                <li><a class="bg--twitter" href="#"  title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                
                <li><a class="bg--instagram" href="#" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                <li><a class="bg--facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                <li><a class="bg--googleplus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                <li><a class="bg--google" href="#" title="Google"><i class="zmdi zmdi-google"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Offset MEnu -->
<!-- End Offset Wrapper -->
<!-- Start Feature Product -->
<section class="categories-slider-area bg__dark pb--100" >
<div class="container">
    <div class="row">
        <!-- Start Left Feature -->
        <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
            <!-- Start Slider Area -->
            <div class="slider__container slider--one">
                <div class="slider__activation__wrap owl-carousel owl-theme">
                    <!-- Start Single Slide -->
                    <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/1.png) no-repeat scroll center center / cover ;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                    <div class="slider__inner">
                                        <h1>New Product <span class="text--theme">Collection</span></h1>
                                        <div class="slider__btn">
                                            <a class="htc__btn" href="cart.html">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Slide -->
                    <!-- Start Single Slide -->
                    <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/2.png) no-repeat scroll center center / cover ;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                    <div class="slider__inner">
                                        <h1>New Product <span class="text--theme">Collection</span></h1>
                                        <div class="slider__btn">
                                            <a class="htc__btn" href="cart.html">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Slide -->
                </div>
            </div>
            <!-- Start Slider Area -->
        </div>
        <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
            <div class="categories-menu mrg-xs">
                <div class="category-heading">
                   <h3>Katalog</h3>
                </div>
                <div class="category-menu-list">
                    <ul>
                        @foreach ($kat as $item)
                            <li><a href="#"><img alt="" src="images/icons/thum7.png"> {{$item->nama}}</a></li>    
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Left Feature -->
    </div>
</div>
</section>

<section class="htc__product__area bg__dark pb--130">
    <div class="container">
        <div class="row">
            <div class="row">
                @foreach ($prod as $p)
                <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-3 col-xs-12 pb--30">
                    <div class="categories-menu">
                        <div class="category-menu-list">
                            <div class="product pb--50">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="#">
                                            <img src="{{asset('img/produk').'/'.$p->gambar_utama}}" alt="product images">
                                        </a>
                                    </div>
                                    <div class="product__hover__info">
                                        <ul class="product__action">
                                            <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                            <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__details text-center">
                                    <h2><a href="product-details.html">{{$p->nama}}</a></h2>
                                    {{-- <p class="new__price">{{}}</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- End Blog Area -->
<!-- Start Footer Area -->
<footer class="htc__foooter__area gray-bg">
<div class="container">
   
    <!-- Start Copyright Area -->
    <div class="htc__copyright__area">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="copyright__inner">
                    <div class="copyright">
                        {{-- <p>© 2017 <a href="https://freethemescloud.com/">Free themes Cloud</a> --}}
                        <p>&copy;{{date('Y')}} GROSIR MURAH KEDIRI&trade;</p>
                    </div>
                    <ul class="footer__menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="shop.html">Product</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area -->
</div>
</footer>
<!-- End Footer Area -->
<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal__container" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <!-- Start product images -->
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="big images" src="images/product/big-img/1.jpg">
                            </div>
                        </div>
                        <!-- end product images -->
                        <div class="product-info">
                            <h1>Simple Fabric Bags</h1>
                            <div class="rating__and__review">
                                <ul class="rating">
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                                <div class="review">
                                    <a href="#">4 customer reviews</a>
                                </div>
                            </div>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price">$17.20</span>
                                    <span class="old-price">$45.00</span>
                                </div>
                            </div>
                            <div class="quick-desc">
                                Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                            </div>
                            <div class="select__color">
                                <h2>Select color</h2>
                                <ul class="color__list">
                                    <li class="red"><a title="Red" href="#">Red</a></li>
                                    <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                </ul>
                            </div>
                            <div class="select__size">
                                <h2>Select size</h2>
                                <ul class="color__list">
                                    <li class="l__size"><a title="L" href="#">L</a></li>
                                    <li class="m__size"><a title="M" href="#">M</a></li>
                                    <li class="s__size"><a title="S" href="#">S</a></li>
                                    <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                    <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                </ul>
                            </div>
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Share this product</h3>
                                    <ul class="social-icons">
                                        <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                        <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="addtocart-btn">
                                <a href="#">Add to cart</a>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    <!-- END Modal -->
</div>
@endsection