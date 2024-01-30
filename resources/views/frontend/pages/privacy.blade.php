@extends('frontend.layouts.master')
@section('title','Privacy Policy - Morsh Golf')

@section('main-content')
<section class="common-policy-sec">
    <h1>Privacy Policy</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/privacy-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            <h3>Privacy Policy</h3>
            <p>Morsh Golf is a brand of 9424-7285 QuébecInc. (hereinafter referred to as “we” only), pays close attention to the protection of personal data. This document provides information about what personal information we process, especially about our customers and users of our online store, whether we process this information on the basis of consent or other legal basis, for what specific purposes we use it to whom we may share it. and what your rights are in relation to the processing of your personal information.</p>
            <h3>What kind of personal information do we process?</h3>
            <p>When you use our services, we collect different types of your information, such as your username and password, your contact information, and other settings. We track what items you view in our online store, what device and which of our email offers you were interested in. Based on this, we create additional information so that we can provide you with the offers you want and that we can further improve our online store and services in the future. If you make a purchase or create an account with us, we also process your first and last name, your orders and the information you set on your account.</p>
            <h4>We process the following personal information:</h4>
            <ul>
                <li>Identification information, which includes primarily the first and last name, username and password;</li>
                <li>contact information that includes personal information that we can use to contact you, especially your email address, telephone number, shipping address, billing address;</li>
                <li>your settings, which include your account information, notably stored shipping addresses, profiles, newsletter subscriptions, loyalty program memberships, shopping lists, items searched for, your ratings and comments on items and services;</li>
                <li>information about your orders, which include, in particular, information about the items ordered and your payment method, including your bank account number, and claims information;</li>
                <li>information about your online habits, including when you are browsing the Web through our mobile app, especially information about the items and services you are looking for, the links you click on, how we search and navigate our site, and device information, which you access on the web, such as IP address and associated location, device ID, its technical parameters such as operating system, version, screen resolution, selected browser and version thereof, and information obtained from cookies and similar recognition technologies devices;</li>
                <li>information about your behavior in relation to reading the messages we send you, especially the time it takes to open the message and information about the devices from which you access the web, such as IP address and associated location, device ID, its technical parameters, such as is the operating system, version, screen resolution, browser selected, and version thereof;</li>
                <li>derived information, including personal information obtained from your preferences, information about items you buy from us, information about your online habits and behavior;</li>
                <li>information in connection with the use of a telephone number, which primarily includes telephone call center records, identification of the messages you send us, including identifiers such as IP addresses.</li>
            </ul>
            <h3>Why are we processing personal information and why are we entitled to it?</h3>
            <p>We process your personal information in different situations for different purposes. When you visit the websites of our online store, where we also use cookies, we use your information primarily to determine the number of visitors and improve our services. If you are registered with us, we use your information to manage your account and provide related functionality. If you make a purchase with us, we use your information to process your order, protect our legal claims, and fulfill our legal obligations. With the help of your contact information and other information, we can simultaneously display and send you our personalized offers. With your consent, we provide information to third parties to display the offer on other websites, as well as to give you access to certain additional services. We have the right to the processing of your personal data on the basis of the preparation or performance of a contract with you, compliance with legal obligations, our legitimate claims or your consent.</p>
            <h4>Within our activity we process personal data for different purposes and to a different extent, namely:</h4>
            <ul>
                <li>without your consent based on the performance of the contract, our legitimate interest or for the purpose of fulfilling our legal obligations, respectively</li>
                <li>On behalf of your consent.</li>
            </ul>
            <p>What kind of data processing we can perform without your consent depends on the purpose for which the relevant processing is related and how you treat us – whether you are just a visitor to our online store, register with us or buy something. We may also process your information if you are the recipient of the goods or services that have been subscribed to us, if you are communicating with us. </p>
        </div>
    </div>
</section>
@include('frontend.layouts.why_choose')

@include('frontend.layouts.call_to_action') 