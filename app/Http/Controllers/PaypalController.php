<?php



namespace App\Http\Controllers;

use Srmklive\PayPal\Services\ExpressCheckout;

use Illuminate\Http\Request;

use NunoMaduro\Collision\Provider;

use App\Models\Cart;

use App\Models\Product;

use DB;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class PaypalController extends Controller

{
    public function payment(){
        $order_sql_id = session()->get('order_sql_id');

        $order_data = Order::select('*')->Where('id',$order_sql_id)->first();

       // echo $order_data['order_number'];exit; 

        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->where('is_cross_sell','<>','1')->get()->toArray();
        
        //dd($cart);
        $data = [];
        // return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => number_format($item['price'], 2, '.', ''),   
                'desc'  => 'Thank you for using paypal',
                'qty' => $item['quantity']
            ];
        }, $cart);
        //$data['invoice_id'] ='INV-'.strtoupper(uniqid());
        $data['invoice_id'] = $order_sql_id;
        $data['invoice_description'] = "Order #{$order_data['order_number']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = number_format($total, 2, '.', '');
        //dd($data);
        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }

        // Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

         //return session()->get('id');
        $provider = new ExpressCheckout;
       // $response = $provider->setExpressCheckout($data);
       
        $response = $provider->setExpressCheckout($data, true);
        //return $response;
        if($response['paypal_link'] == null) {
            // custom redirection
            return redirect()->back()->with(['error'=>'paypal link no set']);
         }
         return redirect()->away($response['paypal_link']);
    }

   

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function cancel() {
        return redirect('/checkout')->with('error', $response['message'] ?? 'Your PayPal Transaction has been Canceled');
    }

  

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function success(Request $request){

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
      
        $desc_arr = explode(' ',$response['DESC']);

       $order_no= trim(str_replace('#','',$desc_arr[1]));

       //update product stock
       $get_product_stock = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get();

       $cart_prod_id = array();
       $cart_prod_qnt = array();

       if(count($get_product_stock)>0)
       {
            // Product stock deduct after successfully checkout 
            foreach($get_product_stock as $res_cart)
            {
                    $cart_prod_id[] = $res_cart->product_id;
                    $cart_prod_qnt[] = $res_cart->quantity;
            }

            if(count($cart_prod_id)>0)
            {
                foreach($cart_prod_id as $ky=>$val)
                {
                     $prod_stock = Product::where('id',$val)->first();
                    $updated_stock =  $prod_stock->stock - $cart_prod_qnt[$ky];
                    $updated_prod_sold = $prod_stock->no_of_product_sold + $cart_prod_qnt[$ky];
            
                    Product::where('id',$val)->update(['stock'=>$updated_stock,'no_of_product_sold'=>$updated_prod_sold]);
                }
            }
       }


        $order_id = $order_no;
        $order_id_arr = array('order_id'=>$order_id,'user_type'=>'reg');

        $cart_order_id_update = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->update($order_id_arr);

        $data_order= array('payment_status'=>'paid','pg_response'=>$response);
        
        $order_data_update = Order::where('user_id',auth()->user()->id)->where('order_number',$order_id)->update($data_order);

        $order_data_mail = Order::where('user_id', auth()->user()->id)->where('order_number', $order_id)->first();
        
        $datais = [
            'to' => auth()->user()->email,
            'subject' => "Thank You for your purchase of product. || Morshgolf",
            'order_number' => $order_id,
            'name' => $order_data_mail->first_name . " " . $order_data_mail->last_name,
            'payment_method' => $order_data_mail->payment_method,
            'date' => $order_data_mail->created_at,
            'total_amount' => $order_data_mail->total_amount,
        ];

        Mail::send('mail.userorder',$datais, function($messages) use ($datais){
            $messages->to($datais['to']);
            $messages->subject($datais['subject']);
        });
        //print_r($response);exit;
        //$response_payer_id = $provider->getExpressCheckoutDetails($request->PayerID);
         //return $response_payer_id;


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success','You successfully pay from Paypal! Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('thankyou');
        }

        request()->session()->flash('error','Something went wrong please try again!!!');
        return redirect()->back();

    }

}

