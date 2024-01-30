@extends('frontend.layouts.master')
{{-- @section('meta')
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
@endsection --}}

@section('title','About us - Morsh Golf')
@section('main-content')

<section class="inner-about-us-sec">
    <h1>About Us</h1>
    <div class="inner-about-body">
        <div class="inner-about-left">
            <h3>Let us introduce ourselves:</h3>

            <p>We love to play golf and share our passion for golf, this is why we decided to contribute our part to the worldwide golf. We started our idea a bit earlier, but the company was born in the start of 2015. We saw that there are still so many things we can improve in the game of golf and its equipment, that we couldn’t resist it. What we love the most is to see satisfied golfers with the passion for the game and the desire to manage “seen only on tv” shots. There’s no better feeling that doing what you love to do.</p>
        </div>
        <div class="inner-about-middle">
            <img src="{{ asset('frontend/images/about-us/about-image.png') }}" class="img-fluid" alt="" >
        </div>
        <div class="inner-about-right">
            <p>How we came up with the idea for our company and our first product is another story. It was quite spontaneous, so take a look at <a href="#">Our Story</a> 😉</p>
        </div>
    </div>
</section>
    
    
<section class="our-story-sec">
    <div class="our-story-body">
        <div class="our-story-title">
            <h2>Our Story <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</span></h2>
            <img src="{{ asset('frontend/images/about-us/story-img.jpg') }}" alt="" class="img-fluid" />
        </div>
        <div class="story-content">
            <p>It all began five years ago. Our central figure, Žiga Mlakar from Slovenia (27, and a golf player for over 10 years), has been thinking about how to enable golfers to hit longer shots when they cannot find sufficient accuracy with the driver. He began to notice that many amateur golfers do not even carry a driver, but use woods and hybrids instead. There would be nothing questionable about that, if the first stroke wouldn’t put them so far from the green that their making par seems highly unlikely from the start. Žiga has a clear vision of how to help the players of golf with this problematic part of the game, which is why he decided to find some answers and got the idea that brought us to this point.</p>

            <p>In golf, the precision of the tee shots is incredibly important, but so is their length. The simple fact is that greater distance and accuracy grants us a better starting position for the next shot. This also presents the greatest challenge – the further we want to hit, the less accurate we are, mostly due to the difficulty of using the driver. Drivers are designed to maximize distance, but do so at a high potential loss of accuracy. With the use of a slightly modified club, however, we could achieve a much improved accuracy at only a minimal cost to distance.</p>

            <p>This is the purpose of the Morsh 2 wood, the club designed for all golfers. As stated above, many golfers don’t want to use the driver because of its inaccuracy. Every one of us was in this position once, when you simply don’t hit precisely enough with the driver to opt for it or you feel more confident with another club. This is precisely why we carefully designed and crafted the club that enables shots nearly as long as those made with a driver, while being far more accurate.</p>

            <p>To everyone who asks how we knew that such a club would work, we reply: ‘We didn’t, but we tried anyway.’ It turns out that there is still room in the game of golf for improvements and advances which improve the player’s game. We hope that our story has sparked your interest and curiosity, and we will be delighted if you join us in the Morsh community and try a different kind of golf.</p>
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
