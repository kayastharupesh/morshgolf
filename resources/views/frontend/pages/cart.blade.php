@php

$settings=DB::table('settings')->get();
//dd(Helper::getAllProductFromCart());
@endphp 

@extends('frontend.layouts.master')
@section('title','Cart - Morsh Golf')
@section('main-content')

<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/add-to-cart/banner-bg.jpg') }}') center center no-repeat;">
	<div class="all-inner-banner-body">
			<div class="inner-banne-left"><h1>Add To Cart</h1></div>
			<div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="Free Shipping Worldwide" /> </div>
	</div>
</section>
<!--BANNER SEC-->
<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Add To Cart</a></li>
        </ul>
    </div>
</section>
<section class="add-to-cart-sec">
	<div class="add-to-cart-img">
			<img src="{{ asset('/public/frontend/images/add-to-cart/add-to-cart-offer-img.png') }}" class="img-fluid" alt="Add To Cart" >
			@include('frontend.layouts.notification')
		
			<!--@if(Helper::totalCartPrice() > $settings[0]->free_shipping_cost)-->
			<!--	<div class="alert alert-success alert-dismissable fade show text-center">-->
			<!--		<button class="close" data-dismiss="alert" aria-label="Close">×</button>-->
			<!--		YOU ARE ELIGIBLE FOR FREE SHIPPING WORLD WIDE AND 1 DOZEN FREE GOLF BALLS-->
			<!--	</div>-->
			<!--@endif-->
	</div>

	@if(is_object(Helper::getAllProductFromCart()) && count(Helper::getAllProductFromCart()) > 0)
			<div class="add-to-cart-body">
				<form action="{{route('cart.update')}}" method="POST">
					@csrf
					<div class="add-to-cart-list">
							<h3>Cart</h3>
							{{-- cart product listing start here --}}	
							@foreach(Helper::getAllProductFromCart() as $key=>$cart)
							<div class="add-to-cart-box">
									@php
									$cart_photo=explode(',',$cart->product['photo']);
									// echo '<pre>';
									// print_r($cart_photo);
									@endphp
									<div class="cart-img" style="background-image: url('{{ url('/public/product/') }}/{{ $cart_photo[0] }}')"></div>
									<div class="cart-details">
											<div class="cart-header">
													<div class="cart-p-title"><a class="cart-p-title" href="{{ route('product-detail',$cart->product['slug']) }}">{{$cart->product['title']}} {{$cart->product['product_sub_title']}} @if(!empty($cart->product['size'])) – {{$cart->product['size']}} @endif </a></div>
													<div class="qty-container">
															<button class="qty-btn-minus btn-light" type="button" data-type="minus" data-field="quant[{{$key}}]"><i class="fa fa-minus"></i></button>
															<input type="text" name="quant[{{$key}}]" value="{{$cart->quantity}}" class="input-qty input-number" data-min="1" data-max="100"/>
															<input type="hidden" name="qty_id[]" value="{{$cart->id}}">
															<button class="qty-btn-plus btn-light" type="button" data-type="plus" data-field="quant[{{$key}}]"><i class="fa fa-plus"></i></button>
													</div>
													<div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal 
															@if($cart['is_cross_sell']=='1')
																	<span>$0.00</span>
															@else
																	<span>${{number_format($cart['amount'],2)}}</span>
															@endif
													</div>
											</div>
											<div class="cart-p-footer">
													<div class="cart-p-price">
														@if($cart['is_cross_sell']=='1')
														Price : $ <strike class="text-danger">{{number_format($cart['price'],2)}}</strike> $0.00 @else Price : ${{number_format($cart['price'],2)}}
														@endif
													</div>
													<div class="cart-delete" data-title="Remove"><a class="cart-delete" href="{{route('cart-delete',$cart->id)}}" title="Delete Item">Delete</a></div>
											</div>
									</div>
							</div>
							@endforeach
							{{-- cart product listing end here --}}	


							{{-- cross sell code start here 

							@foreach(Helper::crosssell() as $key=>$cross)

							<div class="add-to-cart-box">

								<div class="cart-img" style="background-image: url('{{ url('/public/product/') }}/{{ $cross['photo'] }}')"></div>

								<div class="cart-details">

										<div class="cart-header">

												<div class="cart-p-title"><a class="cart-p-title" href="{{ route('product-detail',$cross['slug']) }}">{{$cross['title']}} {{$cross['product_sub_title']}} @if(!empty($cross['size'])) – {{$cross['size']}} @endif </a></div>

												<div class="qty-container">

														<button class="qty-btn-minus btn-light" type="button" data-type="minus" data-field=""><i class="fa fa-minus"></i></button>

														

														<input type="text" name="cross_sell_quant" value="1" class="input-qty input-number" data-min="1" data-max="100"/>

													

														<button class="qty-btn-plus btn-light" type="button" data-type="plus" data-field=""><i class="fa fa-plus"></i></button>

												</div>

												<div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal <span>$ 0.00</span></div>

										</div>

										<div class="cart-p-footer">

												<div class="cart-p-price">Price : <strike style='color:#eb0000; text-decoration:line-through'>${{number_format($cross['price'],2)}}</strike> &nbsp; $0.00</div>

												{{-- <div class="cart-delete" data-title="Remove"><a class="cart-delete" href="{{route('cart-delete',$cross->id)}}" title="Delete Item">Delete</a></div> 

										</div>

								</div>

							</div>

							@endforeach

							cross sell code end here  --}}

							{{-- cart update start --}}

							<div class="cart-btn-part">
								<button class="btn  updatebtns" type="submit">Update</button>
							</div>
							{{-- cart update end --}}
					</div>
				</form>


					<div class="add-to-cart-details">
							<h3>Cart Details</h3>
							{{-- <div class="cart-d-title">Morsh 2 Wood GEN. 2 RH – Regular, Stiff, and X-Stiff Shaft
							</div> --}}

								{{-- coupon code start here --}}

							<div class="cart-coupon">
								<div class="cart-c-title">Coupon
									<br> @if(!empty(Session::get('coupon')['code']))
									<span >{{ Session::get('coupon')['code'] }}</span> @endif </div>
								@if(!empty(Session::get('coupon')['value']))
									<div class="cart-c-discount">${{number_format(Session::get('coupon')['value'],2)}} 
									 <a href="{{route('coupon-delete',Session::get('coupon')['code'])}}" class="text-danger">Remove</a> 
									</div>
								@endif

								<form action="{{route('coupon-store')}}" method="POST">
									@csrf
											<input type="text" name="code" class="form-control" placeholder="Type Coupon Code">
											<button  class="coupon-btn">Apply Coupon Code</button>
									</form>
							</div>

							{{-- coupon code end here --}}
							
							{{-- shipping code start here --}}

							
							{{-- <form action="{{route('shipping-store')}}" method="POST">
								@csrf
								<div class="billing-details-form cart-coupon shipping_calculation">
									@if(session()->has('getshipping'))
										<div class="cart-c-title">Shipping<span style="float:right">{{ Session::get('getshipping')['shipping_country_name'] }} &nbsp; @if(Helper::totalCartPrice()>= $settings[0]->free_shipping_cost)  ( FREE )  @else {{ number_format(Session::get('getshipping')['shipping_charge'],2) }} @endif
											
										</span></div>
									<ul>
										<li class="text-right">Shipping to <b>{{ Session::get('getshipping')['shipping_state_name'] }}</b></li>
										<li class="text-right"><b>{{ Session::get('getshipping')['shipping_city_name'] }}</b></li>
										<li class="text-right"><b>{{ Session::get('getshipping')['shipping_zip_code'] }}</b></li>					
									</ul>
									@else

									<div class="cart-c-title">Shipping<span style="float:right">Enter your address to view shipping options.</span>
									</div>
									@endif

									<br>
									<div class="cart-c-title text-right"><a class="shipping_btns">Calculate Shipping</a></div>
									<div class="shippings_details" style="display: none;">
										<div class="form-group">
											<label for="">Country *</label>
											@if(Helper::country())
												<select class="nice-select-country form-control" name="calc_shipping_country">
													<option value=""> - select country - </option>
													@foreach(Helper::country() as $cn)
													<option value="{{ $cn->id }}">{{ $cn->country_name }}</option>
													@endforeach
												</select>
											@endif
										</div>

										<div class="form-group" id="image_loader">
												<img src="{{asset('public/frontend/images/loader.gif')}}"  alt="Loader">
										</div>
										<div class="form-group child_cat_hide" >
											<label for="">State *</label>
											<select class="nice-select form-control" name="calc_shipping_state" id="child_cat_id">
												<option value=""> - select state - </option>
											</select>
											<input type="text" name="calc_shipping_state_text" class="form-control show_state_name">
										</div>

										<div class="form-group">
											<label for="">City *</label>
											<input type="text" name="calc_shipping_city" class="form-control">
										</div>

										<div class="form-group">
											<label for="">Zip Code *</label>
											<input type="text" name="calc_shipping_zip_code" class="form-control">					
										</div>

										<div class="form-group" >
										<button class="btn  updatebtns" type="submit">Update Shipping</button>		
										</div>
									</div>
								</div>
							</form> --}}
						
							{{-- shipping code end here --}}


							<form action="{{route('cart.update')}}" method="POST">
								@csrf
								<div class="cart-total-part">
										<div class="cart-t-title">Cart Totals</div>
									

										<ul>
												<li><span class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Sub Total</span> <span>${{number_format(Helper::totalCartPriceWithCrossSell(),2)}}</span></li>
                                                @foreach(Helper::crosssell() as $key=>$cross)  
                                                    <li>Discount <span>${{$cross['price']}} </span></li> 
                                                @endforeach

												@if(isset(Session::get('getshipping')['fuel_surcharge']) && Session::get('getshipping')['fuel_surcharge']>0) 
													<li>Fuel Surcharge
													<span> {{ number_format(Session::get('getshipping')['fuel_surcharge'],2) }}											
													</span>
													</li>
												@endif

												{{-- <div class="checkbox">`

											@php

												$shipping=DB::table('shippings')->where('status','active')->limit(1)->get();

											@endphp

											<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox" onchange="showMe('shipping');"> Shipping</label>

										</div> --}}


											{{-- <li>Tax <span>$0.00</span></li> --}}
											@if(session()->has('coupon'))
												<li class="coupon_price" data-price="{{Session::get('coupon')['value']}}">Discount<span>${{number_format(Session::get('coupon')['value'],2)}}</span></li>
											@endif
										
											
                                            @php
                                            $total_amount=Helper::totalCartPrice();
                                            //coupon calculation
                                            if(session()->has('coupon')){
                                            $total_amount = $total_amount-Session::get('coupon')['value'];
                                            }
                                            
                                            //fuel surcharge calculation
                                            if(isset(Session::get('getshipping')['fuel_surcharge']) && Session::get('getshipping')['fuel_surcharge']>0){
                                            $total_amount = $total_amount+Session::get('getshipping')['fuel_surcharge'];
                                            }
                                            @endphp
	
											@if(session()->has('coupon'))
												<li class="last" id="order_total_price">Total<span>${{number_format($total_amount,2)}}</span></li>
											@else
												<li class="last" id="order_total_price">Total<span>${{number_format($total_amount,2)}}</span></li>
											@endif
										</ul>

				
								</div>
								<div class="cart-total-btn-part">
										<a href="{{route('checkout')}}" class="cart-total-btn">PROCEED TO CHECKOUT</a>
										<a href="{{ route('fairway-wood') }}" class="cart-total-btn btn-2">CONTINUE TO SHOPPING</a>
								</div> 
						</form>
					</div>
			</div>
			@else

			<div class="add-to-cart-body">
				<div class="add-to-cart-list" style="width: 100%;">
						<h3>Cart</h3>
						<div class="add-to-cart-box">
								<div class="cart-details">
										<div class="cart-header">
												<div class="cart-p-title">There are no any carts available. <a href="{{route('fairway-wood')}}" style="color:blue;">Continue shopping</a></div>
										</div>
								</div>
						</div>
				</div>
		</div>
	@endif
</section>

@include('frontend.layouts.facilities')
@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection

<!--<div class="offer-popup-sec">-->
<!--    <div class="offer-popup-body">-->
<!--        <div class="popup-content">-->
<!--            <h3>LIMITED TIME OFFER</h3>-->
<!--            <h2>Free Shipping Worldwide Plus Free Dozen Golf Balls With Any 2 Wood Order</h2>-->
<!--            <p>DO NOT FORGET A <span>30 DAY</span> MONEY BACK GUANRANTEE.</p>-->
<!--            <a href="#" class="book-now-btn">Book Now <i class="fa-solid fa-arrow-right"></i></a>-->
<!--        </div>-->
<!--        <div class="popup-img">-->
<!--            <img src="{{ asset('frontend/images/popup-img.png') }}" alt="LIMITED TIME OFFER">-->
<!--        </div>-->
<!--    <a href="javascript:void(0)" class="popup-close-btn"><i class="fa-solid fa-xmark"></i></a>-->
<!--    </div>-->
<!--</div>-->

@push('scripts')
<script>
	$(document).ready(function(){
		$('.shipping select[name=shipping]').change(function(){
			let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
			let subtotal = parseFloat( $('.order_subtotal').data('price') );
			let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
			// alert(coupon);
			$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
		});
	});
</script>
@endpush





