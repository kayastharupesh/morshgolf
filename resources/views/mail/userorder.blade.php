
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
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="header">
                <img src="https://polosoftech.com/staging/morshgolf/public/storage/photos/1/General%20Settings/logo.png" alt="morshgolf">
                <h1>New Order Details</h1>
            </td>
        </tr>
        <tr>
          <td class="content">
            <h2>Hello, {{ $name }}</h2>
            <p>Thank you for ordering from MorshGolf.</p>
            <p>Your order number #{{$order_number}} has been shipped.</p>
            <p>Woo hoo! Your order is on its way. Your order details can be found below.</p>
            <p><b>ORDER SUMMARY:</b></p>
            <p>Order ID: #{{$order_number}}</p>
            <p>Order Date: {{$date}}</p>
            <p>Payment Method: {{$payment_method}}</p>
            <p>Order Total: {{$total_amount}}</p>
            <p><b>We hope you enjoyed your shopping experience with us and that you will visit us again soon.</b></p>
            <br>
            @if ($orderDetails != null)
              <p>Product Details</p>
              <table border="1">
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
                              <td><img src="{{ url('/public/product/') }}/{{ $orderDetail['photo'] }}" class="img-fluid zoom" style="max-width:80px" alt="{{$orderDetail['photo']}}"></td>
                              <td>{{ $orderDetail['quantity'] }}</td>
                              <td>${{ $orderDetail['amount'] }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            @endif
            <p><a href=" {{route('login.form')}} ">Click here</a> to visit our website.</p>
          </td>
          <p><a href="{{route('order.pdf',$pdf)}} ">Click here</a> to downlode PDF.</p>
        </tr>
        <tr>
            <td class="footer">
                &copy; @php echo date('Y'); @endphp MorshGolf | Development: Polosoftech
            </td>
        </tr>
    </table>
</body>
</html>
