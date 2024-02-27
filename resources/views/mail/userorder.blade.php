<!DOCTYPE html>
<html>

<head>
    <style>
      /* Add inline styles for better email client compatibility */
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
  
      table {
        width: 100%;
      }
  
      td {
        padding: 20px;
      }
  
      .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
      }
  
      .header {
        background-color: #010101;
        color: #fff;
        text-align: center;
        padding: 20px;
      }
  
      .content {
        padding: 20px;
      }
  
      .footer {
        background-color: #010101;
        color: #fff;
        text-align: center;
        padding: 10px;
      }
  
      .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
  
      .styled-table thead tr {
        background-color: #ffc107;
        color: #ffffff;
        text-align: left;
      }
  
      .styled-table th,
      .styled-table td {
        padding: 12px 15px;
      }
  
      .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
      }
  
      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }
  
      .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #ffc107;
      }
  
      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #ffc107;
      }
    </style>
</head>

<body>
  <table>
    <tr>
      <td class="header">
        <img src="https://polosoftech.com/staging/morshgolf/public/storage/photos/1/General%20Settings/logo.png"
          alt="morshgolf">
        <h1>New Order Details</h1>
      </td>
    </tr>
    <tr>
      <td class="content">
        <h2>Hello, {{ $name }}</h2>
        <p>Thank you for ordering from MorshGolf.</p>
        <p>Your order number #{{ $order_number }} has been shipped.</p>
        <p>Woo hoo! Your order is on its way. Your order details can be found below.</p>
        <p><b>ORDER SUMMARY:</b></p>
        <p>Order ID: #{{ $order_number }}</p>
        <p>Order Date: {{ $date }}</p>
        <p>Payment Method: {{ $payment_method }}</p>
        <p>Sub Total: {{ $sub_total }}</p>
        <p>coupon: {{ $coupon }}</p>
        <p>Shipping Charge: {{ $shipping_charge }}</p>
        <p>Order Total: {{ $total_amount }}</p>
        <p><b>We hope you enjoyed your shopping experience with us and that you will visit us again soon.</b></p>
        <br>
        @if ($orderDetails != null)
          <p>Product Details</p>
          <table class="styled-table">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach (json_decode($orderDetails, true) as $orderDetail)
                <tr>
                  <td>{{ $orderDetail['title'] }}</td>
                  @php
                    $cart_photo = explode(',', $orderDetail['photo']);
                  @endphp
                  <td><img src="{{ url('/public/product/') }}/{{ $cart_photo[0] }}" class="img-fluid zoom"
                      style="max-width:80px" alt="{{ $cart_photo[0] }}"></td>
                  <td>{{ $orderDetail['quantity'] }}</td>
                  <td>${{ $orderDetail['amount'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
        <h2>BILLING DETAILS:</h2>
        <p>Name: {{ $billing->first_name . ' ' . $billing->last_name }}</p>
        <p>Email: {{ $email }}</p>
        <p>Phone Number: {{ $phone }}</p>
        <p>Country: {{ $country }}</p>
        <p>Address: {{ $billing->address1 }}</p>
        <p><a href=" {{ route('login.form') }} ">Click here</a> to visit our website.</p>
      </td>
      <p><a href="{{ route('order.pdf', $pdf) }} ">Click here</a> to downlode PDF.</p>
    </tr>
    <tr>
      <td class="footer">
        &copy; @php echo date('Y'); @endphp MorshGolf | Development: Polosoftech
      </td>
    </tr>
  </table>
</body>

</html>
