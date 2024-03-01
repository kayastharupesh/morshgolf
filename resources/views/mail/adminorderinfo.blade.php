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
    p, th{
      font-size: 15px !important;
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
    .table-font td{
      font-size: 14px !important;
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
        <h2>ORDER SUMMARY:</h2>
        <p>Order ID: #{{ $order_number }}</p>
        <p>Order Date: {{ $date }}</p>
        <p>Payment Method: {{ $payment_method }}</p>
        <p>Sub Total: {{ $sub_total }}</p>
        <p>coupon: {{ $coupon }}</p>
        <p>Shipping Charge: {{ $shipping_charge }}</p>
        <p>Order Total: {{ $total_amount }}</p>
        <p>Name: {{ $name }}</p>
        <p>Email: {{ $email }}</p>
        <p>Phone Number: {{ $phone }}</p>
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
                <tr class="table-font">
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

        <h2>SHIPPING INFORMATION:</h2>
        <p>Name: {{ $billing->first_name . ' ' . $billing->last_name }}</p>
        <p>Email: {{ $email }}</p>
        <p>Phone Number: {{ $phone }}</p>
        <p>Country: {{ $country }}</p>
        <p>Address: {{ $billing->address1 }}</p>
        <p>Order notes: {{ $billing->order_note }}</p>

        @if ($billing->ship_to_different == 1)
          <h2>SHIPPING DIFFERENT ADDRESS INFORMATION:</h2>
          <p>Name: {{ $billing->first_name_shipping . ' ' . $billing->last_name_shipping }}</p>
          <p>Email: {{ $billing->email_shipping }}</p>
          <p>Phone Number: {{ $billing->phone_shipping }}</p>
          <p>Country: {{ $countryShip }}</p>
          <p>Post code: {{ $billing->post_code_shipping }}</p>
          <p>Address: {{ $billing->address1_shipping . ', ' . $billing->address2_shipping }}</p>
        @endif


        <p><a href=" {{ route('admin') }} ">Click here</a> to visit website.</p>
      </td>
    </tr>
    <tr>
      <td class="footer">
        &copy; @php echo date('Y'); @endphp MorshGolf
      </td>
    </tr>
  </table>
</body>

</html>
