<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.layouts.head')	
</head>
<body @if($_SERVER['REQUEST_URI'] == '/') class="" @else class="inner-page-sec" @endif>
	@section('meta')
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name='copyright' content=''>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
		{{-- <meta name="description" content="{{$product_detail->summary}}">
		<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}"> --}}
		<meta property="og:type" content="article">
		{{-- <meta property="og:title" content="{{$product_detail->title}}">
		<meta property="og:image" content="{{$product_detail->photo}}">
		<meta property="og:description" content="{{$product_detail->description}}"> --}}
	@endsection

	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')

</body>
</html>