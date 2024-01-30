@php $settings=DB::table('settings')->get(); @endphp
<footer class="morsh-footer-sec">
    <div class="footer-body">
        <div class="footer-left">
            <div class="footer-menu">
                <div class="footer-menu-list">
                    <h3>INFORMATION</h3>
                    <ul>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('story') }}">Our Story</a></li>
                        <li><a href="{{ route('delivery-information') }}">Delivery information</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms & conditions</a></li>
                    </ul>
                </div>
                <div class="footer-menu-list">
                    <h3>CUSTOMER SERVICE</h3>
                    <ul>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                        <li><a href="{{ route('guarantee') }}">Guarantee</a></li>
                        <li><a href="{{ route('returns') }}">Returns</a></li>
                    </ul>
                </div>
                <div class="footer-menu-list">
                    <h3>EXTRAS</h3>
                    <ul>
                        <li><a href="{{ route('affiliates') }}">Affiliates</a></li>
                        <li><a href="{{ route('partners') }}">Partners</a></li>
                    </ul>
                </div>
            </div>
            <div class="about-footer">
                <h3>ABOUT US</h3>
                <p>Since 2015 we try very hard to fulfil every golfer’s dreams – long shots off the tee and fairway. Not
                    with a driver, but with a 2 wood.</p>
            </div>
        </div>
        <div class="footer-right">
            <div class="footer-news-letter">
                <h2>@foreach($settings as $data) {{$data->newletter_heading}} @endforeach</h2>
                <p>@foreach($settings as $data) {{$data->newsletter_subheading}} @endforeach</p>
                <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                    @csrf
                    <input type="text" class="form-control" name="email" placeholder="Enter your e-mail here">
                    <input type="submit" class="sub-btn" value="Yes, I love a good deal">
                </form>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© {{ date('Y') }} MorshGolf | Development: <a href="https://www.polosoftech.com/"
                target="_blank">Polosoftech</a></p>
        <div class="footer-payment"> <a href=""><img src="{{ asset('frontend/images/payment-method.png') }}" alt=""></a>
        </div>
    </div>
</footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick-lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script>
    new WOW().init(); 
</script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>-->

<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->

<script>
    $(document).ready(function() {
      $('.header-part:contains("Powered by")').html('');
    $('#image_loader').hide();
    $('#image_loader_checkout').hide();

    $('.show_state_name').hide();
    $('.show_state_name_checkout').hide();

       

    // $("select.select2").select2(); 

    // $('select.nice-select').niceSelect();



    //shipping calculation

    $('.shipping select[name=shipping]').change(function(){

			let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;

			let subtotal = parseFloat( $('.order_subtotal').data('price') );

			let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;

			// alert(coupon);

			$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));

		});

	// show state in cart page
  $('.nice-select-country').on('change', function() {
    var cat_id=$(this).val();
    if(cat_id !=null){
      //console.log(cat_id);
      // Ajax call
      $.ajax({
        url:"{{url('/')}}/country/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        beforeSend: function() {
        	$('#image_loader').show();
        },
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          //console.log(response);
          var html_option="<option value=''>---select state---</option>"
          if(response.status===true){
              $('#image_loader').hide();
            var data=response.data;
              //alert(data);
            if(response.data){
                //console.log(response);
              $('.child_cat_hide').removeClass('d-none');
              $('.show_state_name').hide();
              $('#child_cat_id').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_id').addClass('d-none');
            $('#image_loader').hide();
            $('.show_state_name').show();
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })	


// show state in cart page
$('.nice-select-country_checkout').on('change', function() {
    var cat_id=$(this).val();
    if(cat_id !=null){
      //console.log(cat_id);
      // Ajax call
      $.ajax({
        url:"{{url('/')}}/country/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        beforeSend: function() {
        	$('#image_loader_checkout').show();
        },
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          //console.log(response);
          var html_option="<option value=''>---select state---</option>"
          if(response.status===true){
              $('#image_loader_checkout').hide();
            var data=response.data;
              //alert(data);
            if(response.data){
                //console.log(response);
              $('.child_cat_hide_checkout').removeClass('d-none');
              $('.show_state_name_checkout').hide();
              $('#child_cat_id_checkout').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_id_checkout').addClass('d-none');
            $('#image_loader_checkout').hide();
            $('.show_state_name_checkout').show();
          }
          $('#child_cat_id_checkout').html(html_option);
        }
      });
    }
    else{
    }
  })	
  });

    $(".shipping_btns").click(function(){
        $(".shippings_details").slideToggle("slow");
    });
    
    $(".shipping_btns_checkout").click(function(){
        $(".shippings_details_checkout").slideToggle("slow");
    });
    
    var accountClass = true;
    $(".account-login .account-login-link").click(function () {
        $(".account-popup").addClass('account-popup-open');
        $('.account-popup').toggleClass('account-popup-open');
        accountClass = false;
    });


  $(".account-popup").click(function () {
    accountClass = false;
  });

  $("html").click(function () {
    if (accountClass) {
      $(".account-popup").removeClass('account-popup-open');
    }
    accountClass = true;
  });    

    
  //check attribute has value or not
  $(".add-to-cart").click(function(){
      var selected_value = $('.attributes').val();
      if($('.attributes').val()===""){
          $("#showerror").html("Please select options before adding this product to your cart.").addClass("showerror");
          $(".attributes").addClass("highlightattribute");
          return false;
      }
  });

</script>
{{--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
    var $form         = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script> --}}
{{-- <script src="{{ asset('frontend/js/jquery.form.js') }}"></script> --}}
{{-- <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script> --}}
{{-- <script src="{{ asset('frontend/js/contact.js') }}"></script> --}}
<script>
    var Cookie = {
    set: function (name, value, days) {
        var domain, domainParts, date, expires, host;

        if (days) {
            date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }

        host = location.host;
        if (host.split(".").length === 1) {
            // no "." in a domain - it's localhost or something similar
            document.cookie = name + "=" + value + expires + "; path=/";
        } else {
            // Remember the cookie on all subdomains.
            //
            // Start with trying to set cookie to the top domain.
            // (example: if user is on foo.com, try to set
            //  cookie to domain ".com")
            //
            // If the cookie will not be set, it means ".com"
            // is a top level domain and we need to
            // set the cookie to ".foo.com"
            domainParts = host.split(".");
            domainParts.shift();
            domain = "." + domainParts.join(".");

            document.cookie =
                name + "=" + value + expires + "; path=/; domain=" + domain;

            // check if cookie was successfuly set to the given domain
            // (otherwise it was a Top-Level Domain)
            if (Cookie.get(name) == null || Cookie.get(name) != value) {
                // append "." to current domain
                domain = "." + host;
                document.cookie =
                    name + "=" + value + expires + "; path=/; domain=" + domain;
            }
        }
    },

    get: function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ") {
                c = c.substring(1, c.length);
            }

            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    },

    erase: function (name) {
        Cookie.set(name, "", -1);
    }
};


function googleTranslateElementInit() {
    let url = new URL(window.location);
    let lang = url.searchParams.get("lang");
    
    if (lang) {
        console.log(lang);
        Cookies.set("googtrans", `/en/${lang}`, {
            path: "",
            domain: location.host
        });
    } else {
        Cookie.erase("googtrans");
    }

    // Wait for Google Translate API to load before initializing
    function initializeTranslate() {
        new google.translate.TranslateElement({
            pageLanguage: 'auto', // or set it to a specific default language code
        }, 'translate');

        // Add event listener to change URL param on language selection change
        let langSelector = document.querySelector(".goog-te-combo");
        langSelector.addEventListener("change", function () {
            let lang = langSelector.value;
            var newurl =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname +
                "?lang=" +
                lang;
            window.history.pushState({
                path: newurl
            }, "", newurl);
        });
    }

    // Check if the Google Translate API is already loaded
    if (typeof google !== 'undefined' && google.translate) {
        initializeTranslate();
    } else {
        // If not loaded, wait for the API to load
        window.onGoogleTranslateApiLoad = initializeTranslate;

        // Load the Google Translate API script
        var googleTranslateScript = document.createElement("script");
        googleTranslateScript.type = "text/javascript";
        googleTranslateScript.src =
            "//translate.google.com/translate_a/element.js?cb=onGoogleTranslateApiLoad";
        (
            document.getElementsByTagName("head")[0] ||
            document.getElementsByTagName("body")[0]
        ).appendChild(googleTranslateScript);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    (function () {
        googleTranslateElementInit();
    })();
});
</script>
<script>
    $(document).ready(function() {
        var offerClass = true;    
        $(window).on('load', function() {
            $('.offer-popup-sec').addClass('offer-popup-sec-open');
            offerClass = false;
        });

        $(".offer-popup-body").click(function () {
            offerClass = false;
        });

        $("html").click(function () {
            if (offerClass) {
                $(".offer-popup-sec").removeClass('offer-popup-sec-open');
            }
            offerClass = true;
        });    
        
        $(".popup-close-btn").click(function () {
            if (offerClass) {
                $(".offer-popup-sec").removeClass('offer-popup-sec-open');
            }
            offerClass = true;
        });   
	});
    
    function calculateShipping() {
        var country   = $('#country').val();
        var stateData = $('#child_cat_id').val();
        var state     = $('input[name="state_id"]').val();
        var city      = $('#city_shipping_data').val();
        var postcode  = $('#post_code_shipping').val();
        var state_id;

        if (stateData > 0) {
            state_id = stateData;
        } else {
            state_id = state;
        }

        $.ajax({
            url: "{{ route('shipping-store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                shipping_country: country,
                shipping_state: state_id,
                shipping_city: city,
                shipping_zip_code: postcode
            }
        })
        .done(function(response) {
            $("#shipping_method").show();
            $("#shipping_method_1").hide();

            var total_amount_data  = $('#total_amount_data').val();
            var resultData = parseFloat(response[0].shipping_charge) + parseFloat(total_amount_data);
            resultData = resultData.toFixed(2);

            $("#shipping_charge").html(response[0].shipping_charge);
            $("#shipping_state_name").html(response[0].shipping_state_name);
            $("#shipping_city_name").html(response[0].shipping_city_name);
            $("#shipping_zip_code").html(response[0].shipping_zip_code);
            $(".shipping_charge_data").html(resultData);
        })
        .fail(function(response) {
            $("#shipping_method").hide();
            $("#shipping_method_1").show();
        });
    }

</script>
<style>
    body {
        top: 0px !important;
        position: unset !important;
    }

    body>.skiptranslate {
        display: none;
    }

    #translate .goog-te-gadget {
        font-size: 0;
    }

    #translate .goog-te-gadget span {
        display: none;
    }

    .offer-popup-sec {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #0000007a;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: all 0.3s ease-in-out;
        visibility: hidden;
        opacity: 0;
    }

    .offer-popup-sec.offer-popup-sec-open {
        visibility: visible;
        opacity: 1;
    }

    .offer-popup-sec .offer-popup-body {
        margin: 0;
        padding: 30px;
        background: #FFF;
        max-width: 800px;
        width: 100%;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0 10px;
        position: relative;
        transform: scale(0.8);
        visibility: hidden;
        opacity: 0;
    }

    .offer-popup-sec.offer-popup-sec-open .offer-popup-body {
        transform: scale(1);
        visibility: visible;
        opacity: 1;
        transition: all 0.3s ease-in-out;
    }

    .offer-popup-sec .offer-popup-body a.popup-close-btn {
        margin: 0;
        padding: 0;
        position: absolute;
        top: 30px;
        right: 30px;
        font-size: 26px;
        line-height: 16px;
        color: #000;
        height: fit-content;
        width: fit-content;
    }

    .offer-popup-body .popup-content {
        margin: 0;
        padding: 0;
        position: relative;
        max-width: 460px;
    }

    .offer-popup-body .popup-content h3 {
        margin: 0 0 20px 0;
        padding: 0;
        position: relative;
        font-size: 18px;
        font-weight: 700;
        color: #ff8401;
        letter-spacing: 2px;
    }

    .offer-popup-body .popup-content h2 {
        margin: 0 0 20px 0;
        padding: 0 0 20px 0;
        position: relative;
        font-size: 22px;
        font-weight: 700;
        line-height: 32px;
        color: #000;
    }

    .offer-popup-body .popup-content h2:before {
        position: absolute;
        content: '';
        left: 0;
        bottom: 0;
        width: 202px;
        height: 3px;
        background: #ff8401;
    }

    .offer-popup-body .popup-content p {
        margin: 40px 0;
        padding: 0;
        position: relative;
        font-size: 15px;
        font-weight: 500;
        color: #000;
    }

    .offer-popup-body .popup-content p span {
        position: relative;
        display: block;
        font-size: 58px;
        font-weight: 700;
        color: #00895e;
        line-height: 66px;
    }

    .offer-popup-body .popup-content a.book-now-btn {
        position: relative;
        background: #ffd800;
        height: 60px;
        width: 210px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-weight: bold;
        border-radius: 100px;
        font-size: 16px;
        gap: 0 13px;
    }
</style>
</body>

</html>