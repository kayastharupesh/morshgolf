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
@section('title','Contact us - Morsh Golf')
@section('main-content')
@php
$settings=DB::table('settings')->get();
// echo '<pre>';
// print_r($settings);
@endphp 
<section class="contact-us-sec">
    <div class="contact-us-body">
        <div class="contact-us-left">
            <ul>
                <li><span><i class="fa-regular fa-location-dot"></i></span> <a href="#"> <small>Visit us </small> {{ $settings[0]->address }}</a></li>
                <li><span><i class="fa-regular fa-square-envelope"></i></span> <a href="mailto:{{ $settings[0]->email }}"><small>Email Us</small> {{ $settings[0]->email }}</a></li>
                <li><span><i class="fa-regular fa-location-dot"></i></span> <a href="tel:{{ $settings[0]->phone }}"><small>Call Us</small> {{ $settings[0]->phone }}</a></li>
            </ul>
            <?php echo $settings[0]->contactus_map_location; ?>
        </div>
        <div class="contact-us-right">
            <h2>Get in touch with us for more information</h2>
            <p>If you need help or have a  question, we're here for you</p>
            <form class="common-form" method="post"  action="{{route('contact.store')}}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name"   />
                    @error('first_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <input type="hidden" class="form-control" name="type"  value="C" />
                    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"  />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" maxlength="30"  />
                     @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="phone" placeholder="Phone"  maxlength="15"/>
                </div>
                <div class="form-group full-width">
                    <input type="text" class="form-control" name="subject" placeholder="Subject"   maxlength="100"/>
                    @error('subject')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <textarea class="form-control" placeholder="Message" name="message"  maxlength="400"></textarea>
                     @error('message')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="contact-form-btn">Submit</button>
            </form>
        </div>
    </div>
</section>

<!--MORSH CALL TO ACTION SEC-->
<section class="morsh-call-to-action-sec">
    <div class="morsh-call-to-action-body">
        <div class="morsh-call-to-action-left"> <img src="{{ asset('frontend/images/logo-2.png') }}" alt="" />
            <h2>Get Your 2 Wood Today! <span></span></h2>
            <p>Upgrade Your Golf Game Today <span>with our professionally designed adjustable 2 wood.</span></p>
            <p>You've nothing to loose to try it.</p>
            <a href="#">ORDER NOW <span class="material-symbols-outlined">arrow_right_alt</span></a> </div>
        <div class="morsh-call-to-action-right"> <img src="{{ asset('frontend/images/get-morsh-today.webp') }}" alt="Right to action" > </div>
    </div>
</section>
<!--MORSH CALL TO ACTION SEC--> 


<!--================Contact Success  =================-->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-success">Thank you!</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-success">Your message is successfully sent...</p>
        </div>
      </div>
    </div>
</div>

<!-- Modals error -->
<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-warning">Sorry!</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-warning">Something went wrong.</p>
        </div>
      </div>
    </div>
</div>
@endsection 
@push('styles')
<style>
	.modal-dialog .modal-content .modal-header{
		position:initial;
		padding: 10px 20px;
		border-bottom: 1px solid #e9ecef;
	}
	.modal-dialog .modal-content .modal-body{
		height:100px;
		padding:10px 20px;
	}
	.modal-dialog .modal-content {
		width: 50%;
		border-radius: 0;
		margin: auto;
	}
</style>
@endpush
