<?php

use App\Models\Message;

use App\Models\Category;

use App\Models\PostTag;

use App\Models\PostCategory;

use App\Models\Product;

use App\Models\Order;

use App\Models\Wishlist;

use App\Models\Country;

use App\Models\Shipping;

use App\Models\Cart;

use App\Models\Menu;

// use Auth;

class Helper{

    public static function messageList()

    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    } 

    public static function getAllCategory(){
        $category=new Category();
        $menu=$category->getAllParentWithChild();
        return $menu;
    } 

    
    public static function getHeaderCategory(){
        $category = new Category();
        // dd($category);
        $menu=$category->getAllParentWithChild();
        if($menu){
            ?>

            <li>
            <a href="javascript:void(0);">Category<i class="ti-angle-down"></i></a>
                <ul class="dropdown border-0 shadow">
                <?php
                    foreach($menu as $cat_info){
                        if($cat_info->child_cat->count()>0){
                            ?>
                            <li><a href="<?php echo route('product-cat',$cat_info->slug); ?>"><?php echo $cat_info->title; ?></a>
                                <ul class="dropdown sub-dropdown border-0 shadow">
                                    <?php
                                    foreach($cat_info->child_cat as $sub_menu){
                                        ?>
                                        <li><a href="<?php echo route('product-sub-cat',[$cat_info->slug,$sub_menu->slug]); ?>"><?php echo $sub_menu->title; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        else{

                            ?>
                                <li><a href="<?php echo route('product-cat',$cat_info->slug);?>"><?php echo $cat_info->title; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </li>
        <?php
        }
    }



    public static function productCategoryList($option='all'){
        if($option='all'){
            return Category::orderBy('id','DESC')->get();
        }
        return Category::has('products')->orderBy('id','DESC')->get();
    }



    public static function postTagList($option='all'){
        if($option='all'){
            return PostTag::orderBy('id','desc')->get();
        }
        return PostTag::has('posts')->orderBy('id','desc')->get();
    }


    public static function postCategoryList($option="all"){
        if($option='all'){
            return PostCategory::orderBy('id','DESC')->get();
        }
        return PostCategory::has('posts')->orderBy('id','DESC')->get();
    }

    // Cart Count
    
    public static function cartCount($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('user_type','reg')->where('order_id',null)->sum('quantity');
        }
        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Cart::where('user_id',$current_sess_value)->where('user_type','non-reg')->where('order_id',null)->sum('quantity');
        }
    }

    // relationship cart with product

    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }

    public static function getAllProductFromCart($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::with('product')->where('user_id',$user_id)->where('order_id',null)->get();
        }

        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Cart::with('product')->where('user_id',$current_sess_value)->where('order_id',null)->get();
        }
    }

    // Total amount cart
    public static function totalCartPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->where('is_cross_sell','<>','1')->sum('amount');
        }

        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Cart::where('user_id',$current_sess_value)->where('order_id',null)->where('is_cross_sell','<>','1')->sum('amount');
        }
    }


    public static function totalCartPriceWithCrossSell($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->sum('amount');
        }
        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Cart::where('user_id',$current_sess_value)->where('order_id',null)->sum('amount');
        }
    }



    // Wishlist Count

    public static function wishlistCount($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('quantity');
        }
        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Wishlist::where('user_id',$current_sess_value)->where('cart_id',null)->sum('quantity');
        }
    }

    function getUserTempId(){
        if(session()->has('USER_TEMP_ID')===null){
            $rand=rand(111111111,999999999);
            session()->put('USER_TEMP_ID',$rand);
            return $rand;
        }else{
            return session()->has('USER_TEMP_ID');
        }
    }

    public static function getAllProductFromWishlist($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::with('product')->where('user_id',$user_id)->where('cart_id',null)->get();
        }
        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Wishlist::with('product')->where('user_id',$current_sess_value)->where('cart_id',null)->get();
        }
    }

    public static function totalWishlistPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('amount');
        }
        else{
            $current_sess_value = session('USER_TEMP_ID');
            return Wishlist::where('user_id',$current_sess_value)->where('cart_id',null)->sum('amount');
        }
    }

    // Total price with shipping and coupon
    public static function grandPrice($id,$user_id){
        $order=Order::find($id);
        dd($id);
        if($order){
            $shipping_price=(float)$order->shipping->price;
            $order_price=self::orderPrice($id,$user_id);
            return number_format((float)($order_price+$shipping_price),2,'.','');
        }else{
            return 0;
        }
    }

    // Admin home
    public static function earningPerMonth(){
        $month_data=Order::where('status','delivered')->get();
        // return $month_data;
        $price=0;
        foreach($month_data as $data){
            $price = $data->cart_info->sum('price');
        }
        return number_format((float)($price),2,'.','');
    }

    public static function shipping(){
        return Shipping::orderBy('id','DESC')->get();
    }

    public static function country(){
        return Country::orderBy('country_name','ASC')->where('status','active')->get();
    }
    public static function crosssell(){
        return Product::orderBy('id','DESC')->where('status','active')->where('is_cross_sell','1')->get();
    }

    public static function subMenus($id){
        $SubMenu = Menu::where('sub_menu',$id)->orderBy('order_by','asc')->get();
        return $SubMenu;
    }

}



?>