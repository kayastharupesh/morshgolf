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
@section('title','Stripe Payment Gateway - Morsh Golf')
@section('main-content')

<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Stripe</a></li>
        </ul>
    </div>
</section>


<section class="checkout-sec">
    <div class="checkout-body">
    <h2>Stripe Payment</h2>


    @if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif

    <div class="billing-details-sec">

        <div class="billing-details-body">

            <form  action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <div class="billing-details-form">
                        <div class="form-group">
                            <label for="">Name on Card *</label>
                            <input class='form-control' size='4' type='text'>
                        </div>
  
                        <div class="form-group">
                                <label >Card Number</label> 
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' >
                            </div>
                            <div class="form-group">
                                <label>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class="form-group">
                                <label >Expiration Month/Year</label> 
                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>&nbsp;  <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type="text">
                            </div>
                            <div class="col-md-12 error form-group d-none">
                                <div class="alert-danger alert">Please correct the errors and try
                                    again.</div>
                            </div>
                            <div class="form-group">
                                <button class="place-order-btn" type="submit">Pay Now </button>
                            </div>
                </div> 
            </form>
        </div>
    </div>
</div>
</section>
@endsection

