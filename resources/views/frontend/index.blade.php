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

<!--MORSH_2-WOOD SEC-->
<section class="morsh-2-wood-sec">
    <div class="morsh-2-wood-body">
        <div class="morsh-2-wood-left">
            <h2>Morsh 2 Wood Fairway <span>And/ Or Driver and Its Benefits</span></h2>
            <p>Choose Fairway Wood For An Indefinite Win</p>
        </div>
        <div class="morsh-2-wood-right"> <img src="{{ asset('frontend/images/morrsh-2-wood-img.jpg') }}" class="img-fluid" alt="" /> </div>
    </div>
    <div class="morsh-2-wood-list">
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-1.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Clubhead Design</h3>
                <p>The larger club head of these fairway woods, combined with a shallow face design, offers a distinct advantage for all golfers.</p>
            </div>
        </div>
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-2.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Optimal Control</h3>
                <p>Have better control with a smaller 183cc club head. A smaller club head with better swing impact at the right position.</p>
            </div>
        </div>
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-3.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Distance off the Fairway & Tee</h3>
                <p>Make the most of your distance with just a 10.5-degree lofted 2 wood. The swing is exactly the same as when using your 3 wood.</p>
            </div>
        </div>
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-4.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Accuracy</h3>
                <p>Many golfers choose to utilize a 3w instead of their driver because they lack confidence in it.  You can increase distance with a 2-wood with accuracy.</p>
            </div>
        </div>
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-5.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Shot Shaping and Versatility</h3>
                <p>Adjustable lower loft swing and clubhead design for long, and straight shots.</p>
            </div>
        </div>
        <div class="morsh-2-wood-box">
            <div class="two-wood-icon"><img src="{{ asset('frontend/images/2-wood-icon-6.png') }}" alt=""></div>
            <div class="two-wood-content">
                <h3>Forgiveness</h3>
                <p>Forgiveness on off-center hits is a crucial feature that golfers can rely on to preserve their distance and accuracy. </p>
            </div>
        </div>
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