@extends('frontend.layouts.master')
@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection

@section('title','About us - Morsh Golf')
@section('main-content')
@php $aboutus=DB::table('about_us')->first(); @endphp
<section class="inner-about-us-sec">
    <h1>About Us</h1>
    <div class="inner-about-body">
        <div class="inner-about-left">
            <h3>{{ $aboutus->head_line1 }}</h3>

            <p>{{ $aboutus->head_line_content1 }}</p>
        </div>
        <div class="inner-about-middle">
            <img src="{{url('public/frontend/images/banner/'.$aboutus->image1)}}" class="img-fluid" alt="" >
        </div>
        <div class="inner-about-right">
            <p>{{ $aboutus->sub_head_line_content }}</p>
        </div>
    </div>
</section>
    
    
<section class="our-story-sec">
    <div class="our-story-body">
        <div class="our-story-title">
            <h2>{{ $aboutus->head_line2 }} <span>{{ $aboutus->head_line_content2 }}</span></h2>
            <img src="{{url('public/frontend/images/banner/'.$aboutus->image2)}}" alt="" class="img-fluid" />
        </div>
        <div class="story-content">
            {!! (stripslashes($aboutus->content)) !!}
        </div>
    </div>
</section>    
    
<!--MORSH WHY CHOOSE SEC--> 
<section class="morsh-why-choose-sec inner-why-choose-sec">
    <h2>Don't Rely on a Driver for Long Shots!</h2>
    <p>Are you struggling with driver accuracy or finding enough distance on the fairway?</p>
    <div class="morsh-why-choose-body">
        <div class="why-choose-left">
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Unmatched Accuracy</h3>
                    <p>Achieve unmatched accuracy off the tee with the Morsh 2 wood, surpassing your driver's performance for good.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-1.png') }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Master Control</h3>
                    <p>Experience superior control with the compact 183cc clubhead, giving you the edge you need on every swing.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-2.png') }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Adjustable Wood</h3>
                    <p>Tailor your 2 wood to suit your preferences and trajectory. This allows for a personalized feel, ranging from 10.5 degrees.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-3.png') }}')"></div>
            </div>
        </div>
        <div class="why-choose-img" style="background: url('{{ asset('frontend/images/why-choose-img.jpg') }}')"></div>
        <div class="why-choose-right">
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-4.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Maximum Distance</h3>
                    <p>Unleash maximum distance from the fairway with the 10.5-degree loft, reaching greens that were once out of your range. </p>
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-5.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Effortless Swing</h3>
                    <p>Swing it with ease, just like a 3 wood, but prepare for a massive increase in distance that will leave you astonished.</p>
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-6.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Conquer Greens</h3>
                    <p>Conquer greens you never thought possible. Embrace the opportunity for more birdie putts, elevating your game to new heights.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--MORSH WHY CHOOSE SEC--> 
    
<!--MORSH CALL TO ACTION SEC-->
<section class="morsh-call-to-action-sec">
    <div class="morsh-call-to-action-body">
        <div class="morsh-call-to-action-left"> <img src="{{ asset('frontend/images/logo-2.png') }}" alt="" />
            <h2>Get Your 2 Wood Today! <span></span></h2>
            <p>Upgrade Your Golf Game Today <span>with our professionally designed adjustable 2 wood.</span></p>
            <p>You've nothing to loose to try it.</p>
            <a href="#">ORDER NOW <span class="material-symbols-outlined">arrow_right_alt</span></a> </div>
        <div class="morsh-call-to-action-right">
            <img src="{{ asset('frontend/images/get-morsh-today.webp') }}" alt="Right to action" >
        </div>
    </div>
</section>
<!--MORSH CALL TO ACTION SEC--> 
@endsection
