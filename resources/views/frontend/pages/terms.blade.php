@php $settings=DB::table('settings')->first(); @endphp
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

@section('title','Terms and Conditions - Morsh Golf')
@section('main-content')
<section class="common-policy-sec">
    <h1>Terms and Conditions</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/common-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            {!! (stripslashes($settings->terms_and_conditions)) !!}
        </div>
    </div>
</section>
    
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action')
@endsection 
