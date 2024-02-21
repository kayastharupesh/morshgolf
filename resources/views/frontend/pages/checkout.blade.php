@php
$settings=DB::table('settings')->get();
@endphp 
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
@section('title','Morsh Golf 2 Wood | 10 Degree 3 Wood Golf Club || Checkout')
@section('main-content')
<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Checkout</a></li>
        </ul>
    </div>
</section>
<!--MORSH OFFERS SEC-->
<section class="checkout-sec">
    <div class="checkout-body">
        <h2>Checkout</h2>
        {{-- <p>Please register in order to checkout more quickly</p> --}}
        @include('frontend.layouts.notification')
        @if(!empty(Helper::getAllProductFromCart()))
        <div class="checkout-product-list">
        @foreach(Helper::getAllProductFromCart() as $key=>$cart)
            <div class="checkout-product-box">
                <div class="checkout-p">
                    @php
                    $checkout_photo=explode(',',$cart->product['photo']);
                    @endphp
                    <div class="checkout-product-img" style="background: url('{{ url('/public/product/') }}/{{ $checkout_photo[0] }}')"></div>
                    <h3><a href="{{ route('product-detail',$cart->product['slug']) }}">{{$cart->product['title']}} {{$cart->product['product_sub_title']}} @if(!empty($cart->product['size'])) – {{$cart->product['size']}} @endif </a></h3>
                </div>
                <div class="c-product-qty">{{$cart->quantity}}</div>
                <div class="c-product-price">	@if($cart['is_cross_sell']=='1')
														Price : $ <strike class="text-danger">{{number_format($cart['price'],2)}}</strike> $0.00 @else Price : ${{number_format($cart['price'],2)}}
														@endif</div>
            </div>
            @endforeach
        </div>
        @endif


      
        <div class="billing-details-sec">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissable fade show text-center">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                {{session('error')}}
            </div>
        @endif

            <h3>Billing Details</h3>
            <div class="billing-details-body">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="billing-details-form">
                        <div class="form-group">
                            <label for="">First Name *</label>
                            <input type="text" class="form-control" placeholder="" name="first_name" id="" value="{{old('first_name')}}" required>
                            @error('first_name')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Last Name *</label>
                            <input type="text" class="form-control" placeholder="" name="last_name" id="" value="{{old('lat_name')}}" required>
                            @error('last_name')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email Address *</label>
                            <input type="email" class="form-control" placeholder="" name="email"  id="" value="{{old('email')}}" required>
                            @error('email')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Phone no *</label>
                            <input type="number" class="form-control" placeholder="" name="phone" id="" value="{{old('phone')}}" required>
                            @error('phone')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Country *</label>
                            @if(Helper::country())
                            <select class="nice-select-country form-control" id="country" name="country" required>
                                <option value=""> - select country - </option>
                                @foreach(Helper::country() as $cn)
                                <option value="{{ $cn->id }}">{{ $cn->country_name }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>

                         <div class="form-group" id="image_loader">
                            <label for="">&nbsp;</label>
                            <img src="{{asset('public/frontend/images/loader.gif')}}"  alt="Loader">
                        </div>
                        <div class="form-group child_cat_hide">
                            <label for="">State *</label>
                            <select class="form-control" id="child_cat_id" name="state_id" >
                                <option value=""> - select state - </option>
                            </select>

                            <input type="text" name="state_id" class="form-control show_state_name">
                        </div>
                        {{-- <div class="form-group full-width-f-g">
                            <label for="">Postcode Lookup *</label>
                            <input type="text" class="form-control" placeholder="" name="post_code" id="" value="{{old('post_code')}}">
                            @error('post_code')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div> --}}

                        {{-- <div class="form-group full-width-f-g">
                            <button type="button" class="checkout-f-btn">Find My Address</button>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Street Address *</label>
                            <input type="text" class="form-control" placeholder="" name="address1" id="" value="{{old('address1')}}" required>
                            @error('address1')
                            <span class='text-danger'>{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Address Details (Optional) </label>
                            <input type="text" class="form-control" placeholder="" name="address2" id="" value="{{old('address2')}}">
                            @error('address2')
                            <span class='text-danger'>{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Postcode / Zip *</label>
                            <input type="text" class="form-control" placeholder="" name="post_code" id="post_code_shipping" value="{{old('post_code')}}" required>
                            @error('post_code')
                            <span class='text-danger'>{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Town / City *</label>
                            <input type="text" class="form-control" placeholder="" name="city" id="city_shipping_data" value="{{old('city')}}">
                            @error('city')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group full-width-f-g defferent_add">
                            <label for="defferent_add"> <input type="checkbox"  id="defferent_add"> Ship to a Defferent Address?</label>
                            <div class="billing-details-form shipping_address d-none">
                                <div class="form-group">
                                    <label for="">First Name *</label>
                                    <input type="text" class="form-control" placeholder="" name="first_name_shipping" id="" value="{{old('first_name_shipping')}}" >
                                    @error('first_name_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name *</label>
                                    <input type="text" class="form-control" placeholder="" name="last_name_shipping" id="" value="{{old('last_name_shipping')}}" >
                                    @error('last_name_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email Address *</label>
                                    <input type="email" class="form-control" placeholder="" name="email_shipping"  id="" value="{{old('email_shipping')}}" >
                                    @error('email_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Phone no *</label>
                                    <input type="number" class="form-control" placeholder="" name="phone_shipping" id="" value="{{old('phone_shipping')}}" >
                                    @error('phone_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Country *</label>
                                    @if(Helper::country())
                                    <select class="nice-select-country_shipping form-control" name="country_shipping" >
                                    <option value=""> - select country - </option>
                                    @foreach(Helper::country() as $cn)
                                    <option value="{{ $cn->id }}">{{ $cn->country_name }}</option>
                                    @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group" id="image_loader_shipping">
                                    <label for="">&nbsp;</label>
                                    <img src="{{asset('public/frontend/images/loader.gif')}}"  alt="Loader">
                                    </div>
                                    <div class="form-group child_cat_hide_shipping">
                                    <label for="">State *</label>
                                    <select class="form-control" id="child_cat_id_shipping" name="state_id_shipping" >
                                    <option value=""> - select state - </option>
                                    </select>
                                    <input type="text" name="state_id" class="form-control show_state_name_shipping">
                                </div>
                                <div class="form-group full-width-f-g">
                                    <label for="">Postcode Lookup *</label>
                                    <input type="text" class="form-control" placeholder="" name="post_code_shipping" value="{{old('post_code_shipping')}}" >
                                    @error('post_code')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group full-width-f-g">
                                    <button type="button" class="checkout-f-btn">Find My Address</button>
                                </div>
                                <div class="form-group">
                                    <label for="">Street Address *</label>
                                    <input type="text" class="form-control" placeholder="" name="address1_shipping" id="" value="{{old('address1_shipping')}}"  >
                                    @error('address1_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address Details (Optional) </label>
                                    <input type="text" class="form-control" placeholder="" name="address2_shipping" id="" value="{{old('address2_shipping')}}">
                                    @error('address2_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Postcode / Zip *</label>
                                    <input type="text" class="form-control" placeholder="" name="post_code_shipping" id="" value="{{old('post_code_shipping')}}">
                                    @error('post_code')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Town / City *</label>
                                    <input type="text" class="form-control" placeholder="" name="city_shipping" value="{{old('city_shipping')}}">
                                    @error('city_shipping')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group full-width-f-g">
                            <label for="">Order Notes (Optional) </label>
                            <textarea class="form-control" name="order_note" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="billing-details-sidebar">
                        <div class="your-order-box">
                            <h3>Your Order</h3>
                            <ul>
                                <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Sub Total <span>${{number_format(Helper::totalCartPrice(),2)}}</span></li>
                                {{-- <li class="shipping">&Shipping; <span>
                                    @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                    {{-- <select name="shipping" class="nice-select">
                                                        <option value="">Select your address</option>
                                                        @foreach(Helper::shipping() as $shipping)
                                                        <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                        @endforeach
                                                    </select> 
                                                @else 
                                                    <span>Free</span>
                                                @endif    
                                </span></li> --}}

                                @if(session('coupon'))
                                <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>${{number_format(session('coupon')['value'],2)}}</span></li>
                                @endif

                                @php
                                    $total_amount=Helper::totalCartPrice();
                                    if(session('coupon')){
                                        $total_amount=$total_amount-session('coupon')['value'];
                                    }
                                @endphp
                            </ul>
                            

                           
                                                
                            {{-- shipping code start here --}}
                            <div class="billing-details-form cart-coupon shipping_calculation" style="background:none;">
                                <div id="shipping_method" style="display: none;">
                                    <div class="cart-c-title">Shipping&nbsp;
                                        <span style="float:right"><span id="shipping_country_name"></span> @if(Helper::totalCartPrice()>='500') {{ "( Free )" }}@else $ <span id="shipping_charge">{{ number_format($total_amount, 2) }}</span>@endif</span>
                                    </div>
                                </div>
                                <div id="shipping_method_1" style="display: block;">                        
                                    <div class="cart-c-title">Shipping<span style="float:right;margin: 0px 0 25px 0;padding: 0;
                                        position: relative;font-size: 13px;font-weight: 500;color: #686868;" id="shipping_log">Enter your address to view shipping options.</span>
                                    </div>
                                </div>
                                
                                {{-- <div class="cart-c-title text-right" onclick="calculateShipping()"><a class="shipping_btns_checkout">Calculate Shipping</a></div><br><br> --}}
                            </div>
                            {{-- shipping code end here --}}                        

                            <p>{{$settings[0]->checkout_note_text}}</p>
                            <input type="hidden" id="total_amount_data" value="{{$total_amount}}">
                            @if(session('coupon'))
                                <div class="total-price last" id="order_total_price">Total <span> $ 
                                    @if (Helper::totalCartPrice() >= '500')
                                        {{ number_format($total_amount, 2) }}
                                    @else                                        
                                        <span class="shipping_charge_data">{{ number_format($total_amount, 2) }}</span>
                                    @endif
                                </span></div>
                            @else
                                <div class="total-price last">Total <span> $ 
                                    @if (Helper::totalCartPrice() >= '500')
                                        {{ number_format($total_amount, 2) }}
                                    @else                                        
                                        <span class="shipping_charge_data">{{ number_format($total_amount, 2) }}</span>
                                    @endif
                                </span></div>
                            @endif


                        </div>

                        <div class="card-details">
                            <h3>Payment</h3>
                            <div class="payment-list">
                                <label><input type="radio" name="payment_method" id="byPaypal" class="paypal active" checked value="paypal"> Paypal <img src="{{ asset('frontend/images/checkout/paypal.jpg') }}" alt="Pay with Paypal"></label>
                            </div>

                            <p>You will be redirected to PayPal to finish your payment.</p>
                            <div class="payment-list">
                                <label><input type="radio" id="credit_card" class="credit"  name="payment_method" value="stripe"> Stripe <img src="{{ asset('frontend/images/checkout/card.jpg') }}" alt="Pay with Stripe"></label>
                            </div>

                            <p>Your personal data will be used to process your order and for other purposes described in our privacy policy.</p>
                            <div class="terms-and-conditions-checkbox-text">
                                <label for="terms-and-conditions-checkbox-text"><input type="checkbox" name="terms_and_condition" required> I HAVE READ AND AGREE TO THE WEBSITE PRIVACY POLICY AND TERMS AND CONDITIONS *</label>
                                @error('terms_and_condition')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="place-order-btn">Place Order</button>



                              <!-- Start Div for Stripe Details -->
                              {{-- <div class="row" id="stripeDtls">
                                <div class="col-md-9 offset-md-3">                                
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="pk_test_zapJ2uuFCB532ofzOwu6lofM00SdaGVTyO"
                                        data-amount="200"
                                        data-name="new"
                                        data-description="Pay with Stripe"
                                        data-image="{{url('/')}}/public/images/favicon.png"
                                        data-locale="auto"
                                        data-zip-code="true">
                                    </script>
                                    <input type="hidden" name="paymentTypeId" value="2">
                                    <input type="hidden" name="source" value="stripe">
                                    <input type="hidden" name="amount" value="200.00">
                                </div>
                            </div> --}}
                            <!-- End Div for Stripe Details -->

                            <!-- Start div for Paypal Details -->
                            <!--
							* Pay with paypal Button
						    -->
						    <!--<div id="paypal-button-container" class="showPaypal" style="display:none;"></div> -->
                            <!-- End Div for Paypal Details -->

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--MORSH OFFERS SEC--> 
@include('frontend.layouts.facilities')
@endsection


