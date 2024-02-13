@extends('frontend.layouts.master')
@section('title','Privacy Policy - Morsh Golf')

@section('main-content')

@php $settings=DB::table('settings')->first(); @endphp
<section class="common-policy-sec">
    <h1>Privacy Policy</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/privacy-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            {!! (stripslashes($settings->privacy_policy)) !!}
        </div>
    </div>
</section>
@include('frontend.layouts.why_choose')

@include('frontend.layouts.call_to_action') 