<?php
   
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;  
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;



class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        
        $order_sql_id = Crypt::Decrypt($request->order_sql_id);

        $order_data = Order::select('*')->Where('id',$order_sql_id)->first();

        $order_id = $order_data['order_number'];

        return view('frontend.pages.stripe',['order_id'=>$order_id]);
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {   
        $order_id = $request->order_id;
        $email = auth()->user()->email;
        $user_id = auth()->user()->id;

        $ord_dtl = Order::where('order_number','ORD-49PLZADOUM')->first();
        
       // $user = User::where('id',auth()->user()->id)->first();

      // echo $user_email=$user['email'];exit; 

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source' => $request->stripeToken,
            'description' => 'Customer of Order ID #'.$order_id,
            ]);

        $get_product_stock = Cart::where('user_id',$user_id)->where('order_id',null)->get();

        $cart_prdo_price = 0;    
        foreach($get_product_stock as $res_cart_prod)
        {
            $cart_prdo_price = $cart_prdo_price + $res_cart_prod['price'];
        }
        $checkout_amount =  $cart_prdo_price *100; 

       $response =  Stripe\Charge::create ([
                "amount" => $checkout_amount,
                "currency" => "usd",
                'customer' => $customer->id,
                "description" => 'Invoice of Order ID #'.$order_id 
        ]);

        $pg_json = str_replace('Stripe\Charge JSON: ','',$response);

        $stripe_data_arr = json_decode($pg_json, true);

        //print_r($stripe_data_arr);exit;

        if(isset($stripe_data_arr['status']))
        {
            if($stripe_data_arr['status']=='succeeded')
            {
                $payment_status =  $stripe_data_arr['status'];

            //------------Product Stock Updation cod start-----------//

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
                    
                    $order_id_arr = array('order_id'=>$order_id,'user_type'=>'reg');
            
                    $cart_order_id_update = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->update($order_id_arr);
            
                    $data_order= array('payment_status'=>'paid','pg_response'=>$response);
                    
                    $order_data_update = Order::where('user_id',auth()->user()->id)->where('order_number',$order_id)->update($data_order);
            

                    //------------Product Stock Updation cod end-----------//

                    
            
                    Session::flash('success', 'Payment successful!');
                    
                    session()->forget('cart');
                    session()->forget('coupon');
                    return redirect()->route('thankyou');

            }

        } // if payment success conditon end
        else
        {
            return redirect('/checkout')->with(['error'=>'Payment Failed. Please, try again']);
        }
        

       

        
    }
}