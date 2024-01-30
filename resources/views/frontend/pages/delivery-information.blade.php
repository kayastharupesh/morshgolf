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



@section('title','Delivery information - Morsh Golf')

@section('main-content')
<section class="common-policy-sec">
    <h1>Delivery information</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/delevery-img.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            <h3>Delivery information</h3>
            <p>Delivery costs are calculated in checkout process, depends on delivery address. For orders over 250€ the delivery is free of charge.</p>
            <p><strong>NOTE:</strong> Orders from outside Europe and specific European countries can cause import charges & taxes. If you’re not sure please contact your government tax department. The products are shipped from the warehouse in Slovenia, Europe.</p>
            <ul>
                <li><strong>Europe delivery:</strong> it usually takes 3-5 days. We deliver with DHL logistics. The cost of the delivery is calculated on the checkout.</li>
                <li><strong>Worldwide DHL delivery:</strong> it usually takes in 5-7 days. The cost of the delivery is calculated on the checkout.</li>
            </ul>
            <p>Beside this, all the information about delivery time etc. will customers receive over an email after completed order and dispatch of the package from our courier. We do our best to ship the products as soon as possible, usually in 1-2 days.</p>
            <h4>Here are the quick points most customers need to know:</h4>
            <ul>
                <li>Most orders are delivered to your door on weekdays between 8:30am to 6:00pm. In some cases the time can be more specific, such as a morning delivery, afternoon delivery, or delivery before a certain time.</li>
                <li>Most items require a signature upon delivery.</li>
                <li>We do not dispatch orders on weekends and bank holidays.</li>
                <li>We carry nearly all of the items in-stock as advertised on-line. However in an event when an item is not in stock, we advise customers if there would be any delay in meeting the dispatch deadline. In most cases, this can add 5 to 10 days to your dispatch date.  If the delay is longer than this, we will advise you so you can either choose to wait longer or you can cancel if the order is no longer convenient for you.</li>
                <li>The delivery times stated here are generally accurate, but can vary by postcode and location.</li>
                <li>Goods in transit are the responsibility of the courier, however you can track the delivery online through each courier’s website.  We normally send the tracking number upon dispatch by email.</li>
            </ul>
            <p>Please note that delivery times provided to you are accurate, but not guaranteed. This is because MorshGolf use the third party couriers like DHL, GLS, UPS etc. to deliver products to your home or work. As such, factors that influence the ability of these companies to be on time, also affect us, and occasionally, you.  Previous examples include extreme weather conditions or staff strikes or parcel sorting error at depot. We work closely with all of our delivery partners to ensure that such occurrences are rare and make a minimal impact on our customers. If you have any questions or suggestions, we welcome you to contact us.</p>
            <p>We will get in touch if an item in your order is out of stock.</p>
            <p>In the rare event when a certain item in your order has ran out of stock, (such as two customers ordering the last item at once), and we are unable to dispatch your goods to you, we shall contact you via e-mail/telephone to advise you of the situation. You will of course have the option to select a different product, choose to wait whilst we re-order, or cancel your order if it is not convenient for you.</p>
        </div>
    </div>
</section>
@include('frontend.layouts.why_choose')

@include('frontend.layouts.call_to_action')

@endsection 