@extends('frontend.layouts.master')
@section('title','Morsh Golf 2 Wood | 10 Degree 3 Wood Golf Club')
@section('main-content') 
<!--BANNER SEC--> 
@if(count($banners)>0)
<section class="banner-sec">
    <div class="banner-slider owl-carousel"> @foreach($banners as $key=>$banner)
        <div class="banner-item" style="background: url('{{('public/frontend/images/banner/'.$banner->photo)}}')">
            <div class="banner-item-details">
                <h1>{{ $banner->main_heading }}</h1>
                <p>{{ $banner->sub_heading }}</p>
                <a href="{{ $banner->link }}">{{ $banner->readmore_text }}</a> </div>
        </div>
        @endforeach </div>
</section>
@endif 
<!--BANNER SEC--> 
@php 
$settings=DB::table('settings')->get();
$golfinfors=DB::table('golf_information')->where('status','1')->get();
@endphp
<!--MORSH_2-WOOD SEC-->
<section class="morsh-2-wood-sec">
    <div class="morsh-2-wood-body">
        <div class="morsh-2-wood-left">
            {!! (stripslashes($settings[0]->home_page_heding)) !!}
        </div>
        <div class="morsh-2-wood-right"> <img src="{{ url('/public/product/') }}/{{$settings[0]->home_page_heding_image}}" class="img-fluid" alt="" /> </div>
    </div>
    <div class="morsh-2-wood-list">
        @foreach ($golfinfors as $golfinfor)
            <div class="morsh-2-wood-box">
                <div class="two-wood-icon"><img src="{{ url('public/frontend/images/banner/') }}/{{ $golfinfor->image }}" alt="{{ $golfinfor->image }}"></div>
                <div class="two-wood-content">
                    {!! (stripslashes($golfinfor->content)) !!}
                </div>
            </div>
        @endforeach
    </div>
</section>
<!--MORSH_2-WOOD SEC--> 

<!--MORSH OFFERS SEC-->

<section class="offers-sec">
    <div class="offer-body">
        <div class="offers-title-sec">
            <div class="offers-title">
                <h2>MorshGolf Top Offers</h2>
                <p>Choose MorshGolf and Elevate Your Golf Game! </p>
            </div>
            <div class="offers-link"> <a href="#">ORDER NOW <i class="fa-solid fa-arrow-right"></i></a> </div>
        </div>
        <div class="offer-list"> @if($product_lists)
            @foreach($product_lists as $key=>$product)
            <div class="offer-box"> <a href="{{route('product-detail',$product->slug)}}">
                <div class="offer-box-img"> @if($product->photo)
                    @php
                    $photo=explode(',',$product->photo);
                    @endphp <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid" alt="{{$product->title}}" /> @endif
                    <div class="offer-discount"> @if(!empty($product->discount))
                        <div class="offer-d-box"><span>{{ $product->discount }}%</span> OFF</div>
                        @endif
                        @if($product->condition)
                        <div class="offer-d-box">{{ strtoupper($product->condition) }}</div>
                        @endif </div>
                </div>
                <h3>{{$product->title}} <!-- <span>GEN.  RH</span> --> <span>{{$product->size}} </span></h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <!--<span>320 Reviews</span>--> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">${{ number_format((float)$product->price, 2, '.', '') }}</div>
                    @if(!empty($product->size)) <a class="offer-box-btn" title="Add to cart" href="{{route('product-detail',$product->slug)}}">Select Options <i class="fa-solid fa-arrow-right"></i></a> @else <a class="offer-box-btn" title="Add to cart" href="{{route('product-detail',$product->slug)}}">View Details <i class="fa-solid fa-arrow-right"></i></a> @endif </div>
                </a> </div>
            @endforeach
            @endif
            {{--
            <div class="offer-box"> <a href="#">
                <div class="offer-box-img"> <img src="{{ asset('frontend/images/offers-img-2.png') }}" class="img-fluid" alt="" /> </div>
                <h3>Morsh 2 Wood <span>GEN. 2 LH</span> <span>Regular, Stiff and X-Stiff Shaft</span></h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <span>256 Reviews</span> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">$299.90</div>
                    <button class="offer-box-btn">Add to Cart <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </a> </div>
            <div class="offer-box"> <a href="#">
                <div class="offer-box-img"> <img src="{{ asset('frontend/images/offers-img-3.png') }}" class="img-fluid" alt="" />
                    <div class="offer-discount">
                        <div class="offer-d-box"><span>30%</span> OFF</div>
                        <div class="offer-d-box">NEW</div>
                    </div>
                </div>
                <h3>Senior 2 Wood <span>RH/LH</span> </h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <span>85 Reviews</span> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">$299.90</div>
                    <button class="offer-box-btn">Add to Cart <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </a> </div>
            <div class="offer-box"> <a href="#">
                <div class="offer-box-img"> <img src="{{ asset('frontend/images/offers-img-4.png') }}" class="img-fluid" alt="" /> </div>
                <h3>Ladies 2 Woods <span>RH/LH</span> </h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <span>99 Reviews</span> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">$299.90</div>
                    <button class="offer-box-btn">Add to Cart <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </a> </div>
            <div class="offer-box"> <a href="#">
                <div class="offer-box-img"> <img src="{{ asset('frontend/images/offers-img-4.png') }}" class="img-fluid" alt="" /> </div>
                <h3>4 Piece Urethane Cover Pro <span>Golf Ball</span></h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <span>233 Reviews</span> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">$299.90</div>
                    <button class="offer-box-btn">Add to Cart <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </a> </div>
            <div class="offer-box"> <a href="#">
                <div class="offer-box-img"> <img src="{{ asset('frontend/images/offers-img-5.png') }}" class="img-fluid" alt="" />
                    <div class="offer-discount">
                        <div class="offer-d-box"><span>30%</span> OFF</div>
                        <div class="offer-d-box">NEW</div>
                    </div>
                </div>
                <h3>Morsh 2 Wood <span>GEN. 2</span> <span>DEMO</span></h3>
                <div class="ratings">
                    <div class="r-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star-half-stroke"></i> </div>
                    <span>162 Reviews</span> </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">$299.90</div>
                    <button class="offer-box-btn">Add to Cart <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </a> </div>
            --}} </div>
    </div>
</section>
@php
$home_popup=DB::table('homepage_popup')->where('id','1')->get();
@endphp 
@if($home_popup[0]->popup_enable=='1')
<div class="offer-popup-sec">
    <div class="offer-popup-body">
        <div class="popup-content">
            <h3>{{ $home_popup[0]->main_heading1 }}</h3>
            <h2>{{ $home_popup[0]->sub_heading1 }}</h2>
            <p>{{ $home_popup[0]->sub_title1 }} <span>{{ $home_popup[0]->main_heading2 }}</span> {{ $home_popup[0]->sub_heading2 }}</p>
            <a href="{{ $home_popup[0]->main_heading3 }}" class="book-now-btn">Order Now <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        @if(!empty($home_popup[0]->photo1))
        <div class="popup-img">
            <img src="{{ asset('public/frontend/images/banner/'.$home_popup[0]->photo1) }}" alt="LIMITED TIME OFFER">
        </div>
        @endif
        <a href="javascript:void(0)" class="popup-close-btn"><i class="fa-solid fa-xmark"></i></a>
    </div>
</div>
@endif

@include('frontend.layouts.facilities')
@include('frontend.layouts.morsh_info')
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection 