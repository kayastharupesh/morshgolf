@php
$settings=DB::table('settings')->get();
$productList=DB::table('products')->where('status','active')->orderBy('id', 'desc')->get();
$menus=DB::table('menu')->where(['status' => 1, 'sub_menu' => 0,])->orderBy('order_by', 'asc')->get();
@endphp 

<!--HEADER SEC-->

<header class="header-part">
    <div class="header-body">
        <div class="header-logo"> <a href="{{ route('home') }}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach " class="img-fluid" alt="" /></a> </div>
        <div class="header-menu">
            <ul>
                @foreach ($menus as $menu)
                    @php $submenus = Helper::subMenus($menu->id); @endphp
                    @if ($submenus->isNotEmpty())
                    <li class="product-list"><a href="{{ route($menu->url) }}">{{ $menu->name }}</a>
                        <div class="product-menu">
                            <div class="product-menu-left">
                                @foreach ($submenus as $submenu)
                                    @php $urlData = explode('/', $submenu->url); @endphp
                                    @if($urlData[0] == 'shop')
                                    <a class="product-paragraf" href="{{ url('shop/') }}/{{ $urlData[1] }}">{{ $submenu->name }}</a>
                                    @else
                                        <a href="{{ route($submenu->url) }}">{{ $submenu->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="product-menu-right">
                                <img src="{{asset('/frontend/images/menu-img.jpg')}}" alt="">
                            </div>
                        </div>
                        <button type="button" class="mob-btn"><i class="fa-regular fa-circle-chevron-down"></i></button>
                    </li>
                    @else
                        <li><a href="{{ route($menu->url) }}">{{ $menu->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="header-contact">
            <ul>
                <li><a href="{{route('cart')}}"><i class="fa-regular fa-cart-shopping"></i>
                    <div class="cart-num"> @if(Helper::cartCount()>0){{Helper::cartCount()}}@endif </div>
                    </a></li>
                <li class="account-login"> <a href="#" class="account-login-link"><i class="fa-regular fa-user"></i></a>
                    <div class="account-popup "> @auth                        
                        @if(Auth::user()->role=='admin')
                        <div class="acc-details"> <a href="{{route('admin')}}"><i class="fa-regular fa-user-large"></i> Welcome Admin</a> </div>
                        @else
                        <div class="acc-details"> <a href="{{route('user')}}"><i class="fa-regular fa-user-large"></i> Welcome {{ Auth::user()->name }}</a> </div>
                        @endif <a href="{{route('user.logout')}}"><span class="material-symbols-outlined">logout</span> Logout</a> @else
                        <div class="acc-login"> <a href="{{route('login.form')}}"><i class="fa-solid fa-right-from-bracket"></i> Login</a> <a href="{{route('register.form')}}"><i class="fa-solid fa-user-plus"></i> Sign Up</a> </div>
                        @endauth </div>
                </li>
                <li><a href="{{route('contact')}}">Contact Us</a></li>
                {{-- <li id="google_translate_element"></li> --}}
            </ul>
            <button type="button" class="mobile-menu-btn"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>
{{-- <div id="translate"></div> --}}
<style>
#translate {
    margin: 0;
    padding: 0;
    position: absolute;
    top: 100px;
    z-index: 99;
    right: 60px;
}
#translate:before {
    position: absolute;
    content: '\f0ac';
    left: 6px;
    top: 1px;
    bottom: 0;
    margin: auto;
    font-family: "Font Awesome 6 Pro";
    font-size: 14px;
    color: #000;
    z-index: 99;
    line-height: initial;
    height: fit-content;
}
#translate select.goog-te-combo {
    margin: 0;
    padding: 0 9px 0 20px;
    position: relative;
    height: 34px;
    width: 160px;
    background: #ffffff;
    color: #000;
    border: 2px solid #c3c3c3;
    border-radius: 5px;
    cursor: pointer;
}
#translate select.goog-te-combo option {
    background: #fff;
    color: #000;
}
</style>

<!--HEADER SEC--> 