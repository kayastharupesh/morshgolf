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
@section('title','Fairway Wood')
@section('main-content')

<style>
  #category{
    position: absolute;
    right: 0;
    border: 1px solid gainsboro;
    border-radius: 5px;
    padding: 5px
  }
</style>
<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Product</h1>
        </div>
        <div class="inner-banne-img">
            <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" />
        </div>
    </div>
</section>
<!--BANNER SEC--> 


<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
      <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="#">Product</a></li>
          @php $clist=DB::table('categories')->where('status', 'active')->get(); @endphp
          <form action="{{ route('product_category') }}" method="post" id="category_form">
            @csrf
            <select name="category" id="category" class="offer-box" onchange="$('#category_form').submit();">
              <option value="">Select Category</option>
              @foreach($clist as $cdata)
                <option value="{{ $cdata->id }}" {{ (isset($category) && $category == $cdata->id) ? 'selected' : '' }}>{{ $cdata->title }}</option>
              @endforeach
            </select>
          </form>
      </ul>
    </div>
</section>

<!--MORSH OFFERS SEC-->
<section class="offers-sec product-listing-sec">
    <div class="offer-body">
        <div class="offer-list">
            @foreach($plist as $p)
            <div class="offer-box"> <a href="{{ route('product-detail',$p->slug) }}">
                <div class="offer-box-img">
                    @if($p->photo)
                    @php
                    $photo=explode(',',$p->photo);
                    @endphp
                    <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid" alt="{{ $p->title }}" />
                    @endif
                    <div class="offer-discount">
                        @if(!empty($p->discount))
                        <div class="offer-d-box"><span>{{ $p->discount }}%</span> OFF</div>
                        @endif
                    </div>
                </div>
                <h3>{{ $p->title }}  <span> {{ $p->product_sub_title }}</span>  <span>{{ $p->size }}</span></h3>
                <div class="ratings">
                    <div class="r-star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
                    </div>
                    <!--<span>320 Reviews</span>-->
                </div>
                <div class="offer-box-bottom">
                    <div class="offer-p">${{ number_format((float)$p->price, 2, '.', '') }}</div>
                    @if(!empty($p->size))
                        <a class="offer-box-btn" title="Select Option" href="{{route('product-detail',$p->slug)}}">Select Options <i class="fa-solid fa-arrow-right"></i></a>
                    @else
                    <a class="offer-box-btn" title="View Details" href="{{ route('product-detail',$p->slug) }}">View Details <i class="fa-solid fa-arrow-right"></i></a>
                        <!--<a class="offer-box-btn" title="Add to cart" href="{{route('add-to-cart',$p->slug)}}">Add to Cart <i class="fa-solid fa-arrow-right"></i></a>-->
                    @endif
                </div>
                </a> 
            </div>
           @endforeach
            </div>
    </div>
</section>
<!--MORSH OFFERS SEC--> 

@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection
