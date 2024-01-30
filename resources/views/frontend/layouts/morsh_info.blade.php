@php
$settings=DB::table('settings')->get();
@endphp 
<section class="morsh-info-sec">
    <div class="morsh-info-body">
        <div class="morsh-info-box">
            
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner1) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>Ladies! Play A Winning Golf Shot with 2 Wood and Take Victories Into Your Own Hand</h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner2) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>Maintain Your Golf Game Performance With Senior 2 Wood</h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner3) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>Nurture Talent for All Ages with 2 Wood and Inspire a Lifelong Love for Golf </h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner4) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>Morsh 2 Wood is Perfect for Low Handicap and Young Golfers!</h3>
            </div>
        </div>
    </div>
</section>