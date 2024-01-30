<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['short_des','long_des','logo','photo','address','phone','email','country','state','city','postcode','meta_title','meta_keyword','meta_description','extra_code','free_shipping_cost','facebook_url','instagram_url','twitter_url','youtube_url','location_map','checkout_note_text'];
}
