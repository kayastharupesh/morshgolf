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
        <h1>You miss your ordet process</h1>
      </td>
    </tr>
    <tr>
      <td class="content">
        <p>Dear {{ $name }}</p>
        <p>  We noticed that you added some items to your cart on MorshGolf. Please complete your order as for below product details.</p>
        <p>Here's a quick reminder of what you had in your cart:</p>
        <br>
        @if ($data != null)
          <p>Product Details</p>
          <table class="styled-table">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
                <th>Product Total Price</th>
              </tr>
            </thead>
            <tbody>
              @php
                $product = DB::table('products')->where('id', $data['product_id'])->first();
                $cart_photo = explode(',', $product->photo);
              @endphp
              <tr class="table-font">
                <td>{{ $product->title }}</td>
                <td><img src="{{ url('/public/product/') }}/{{ $cart_photo[0] }}" class="img-fluid zoom"
                    style="max-width:80px" alt="{{ $cart_photo[0] }}"></td>
                <td>{{ $data['quantity'] }}</td>
                <td>${{ $data['price'] }}</td>
                <td>${{ $data['amount'] }}</td>
              </tr>
            </tbody>
          </table>
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
