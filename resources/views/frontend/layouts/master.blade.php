<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.layouts.head')	
</head>
<body @if($_SERVER['REQUEST_URI'] == '/') class="" @else class="inner-page-sec" @endif>

	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')

</body>
</html>