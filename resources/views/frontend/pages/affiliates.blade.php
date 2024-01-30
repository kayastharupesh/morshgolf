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

@section('title','Affiliates - Morsh Golf')
@section('main-content')
<section class="common-policy-sec">
    <h1>Affiliates</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/privacy-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            <h3>Would you like to become our affiliate?</h3>
            <p>To become our affiliate please fill out the form below. We will review your information and get back to you as soon as possible.</p>
            <form class="common-form"  method="post" action="{{route('affiliates.store')}}">
                @csrf
                <input type="hidden" class="form-control" name="type"  value="A" />
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name"  placeholder="Full Name" value="{{old('first_name')}}" />
                    @error('first_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email"  placeholder="Email Address" value="{{old('email')}}" />
                     @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <input type="text" class="form-control"  name="company_name_address" placeholder="Company Name & Address *" value="{{old('company_name_address')}}" />
                    @error('company_name_address')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <input type="text" class="form-control"  name="subject" placeholder="Subject" value="{{old('subject')}}" />
                     @error('subject')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <textarea class="form-control"  name="message" placeholder="Message">{{old('message')}}</textarea>
                    @error('message')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="contact-form-btn">Submit</button>
            </form>
        </div>
    </div>
</section>
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action') 
@endsection 