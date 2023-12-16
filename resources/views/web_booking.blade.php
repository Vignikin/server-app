<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taxi</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <!-- Add this line to your HTML -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-FQUi9C-cnnnhGm9QtgjHRnUPDcfBiPg&libraries=places"></script>
    <style> 
.desktop-bg.p2p {
background-image: url(https://olawebcdn.com/images/v1/bg_city.jpg); 
}
body{
margin:0px;
} 
.desktop-bg {
position: absolute;
left: 550px;
right: 0;
background-size: cover;
top: 0;
bottom: 0;
background-color: #000;
}  
#head,#head1 {
height: 50px;
background: #f5f5f5;
position: fixed;
top: 0;
width: 100%;
z-index: 2;
max-width: var(--mobile-cont_-_max-width);
margin: var(--mobile-cont_-_margin);
display: var(--mobile-cont_-_display);
left: var(--mobile-cont_-_left);
}
#head1{
    background: none;
}
.logo {
width: 80px;
}
#head {
height: 50px;
background: #f5f5f5;
position: fixed;
top: 0;
width: 100%;
z-index: 2;
max-width: var(--mobile-cont_-_max-width);
margin: var(--mobile-cont_-_margin);
display: var(--mobile-cont_-_display);
left: var(--mobile-cont_-_left); 
}
.header-menu {
text-align: center;
width: 100% ; 
padding: 10px 0px 10px 0px;
background: #f7f7f7;
height:100%;
}
.head1{
    height:100% !important;
}
span#login {
position: absolute;
right: 11px;
padding: 10px;
cursor: pointer;
font-size: 13px;
}
span#menuIcon {
position: absolute;
padding: 15px; 
left: 0px; 
top: 5px;
cursor:pointer;
}
i.fa.fa-bars {
font-size: 24px;
color: #7c7a7a;
}
.content-wrapper,.content-wrapper1,.content-wrapper2 {
display: block;
width: 100%;
height: 100%;
--mobile-cont_-_max-width: 550px;
--mobile-cont_-_margin: 0;
--mobile-cont_-_display: block;
--mobile-cont_-_left: 0;
}
.content-initiate {
display: block;
height: 100%;
}         
.sidebar {
min-width: 100px;
max-width: 300px;
width: 80%;
background-color: #fff;
height: 100%;
position: absolute;
z-index: 2;
top: 0px;
transition: transform 0.3s;
box-shadow: 2px 0 16px 0 rgba(0, 0, 0, 0.4);
display: none;
}
.overlay {
display: block;
position: absolute;
top: 0px;
left: 0px;
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.6);
/* opacity: 0.2; */
z-index: 0;
display: none;
}
nav.navbar.navbar-light {
padding: 0px !important; 
padding-left: 10px;
}
.navbar {
position: relative;
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
-ms-flex-align: center;
align-items: center;
-ms-flex-pack: justify;
justify-content: space-between;
padding: 0.5rem 1rem;
}
ul.navbar-nav.flex-column {
width: 100%;
}
ul.navbar-nav.flex-column li:hover{
background-color:#ebebeb;
}
ul.navbar-nav.flex-column li.a{
padding: 5px;
}
.navbar-light .navbar-nav .nav-link {
color: rgba(0,0,0,.5);
}
.nav-link {
padding: 12px;
padding-left: 20px !important;
color: black !important;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
color: #495057; 
border:none !important;
}
.nav-tabs{
border:none !important;
}
li.nav-item {
width: 33.33%;
}
.container.mt-5 {
position: relative;
top: 10px;
}
.nav-tabs .nav-link {
border: none !important; 
}
.item-name.actv{
background-color: #0b4dd8;
border-radius: 12px;
}
.item-name {
color: #000;
font-weight: 600;
text-transform: uppercase;
font-size: 14px;
padding: 0px 8px;
height: 24px;
display: inline-block;
line-height: 24px;
position: relative; 
cursor:pointer;


}
.nav-list {  
width: 100%;
--mobile-cont_-_max-width: 550px;
--mobile-cont_-_margin: 0;
--mobile-cont_-_display: block;
--mobile-cont_-_left: 0;
max-width: var(--mobile-cont_-_max-width);
margin: var(--mobile-cont_-_margin);
display: var(--mobile-cont_-_display, block);
text-align: center;
height: 60px;

}
.nav-tab {
display: inline-block;
width: 32%;
padding: 18px 0px;
position:relative;
}
.tool-tips{
position: absolute;
top: 50px;
left: 0;
width: 100%;
min-height: 45px;
background: #000;
color: #fff;
font-size: 12px;
line-height: 1.2;
padding: 5px;
border-radius: 5px;
z-index: 1;
display: none;
}
.tool-tips:before {
top: -6px;
bottom: auto;
left: 50%;
right: auto;
border-width: 0 6px 6px;
content: "";
position: absolute;
border-style: solid;
border-color: #000 transparent;
display: block;
width: 0;
}
.detail-engine-data{

display: block;
background: #f5f5f5; 
position: absolute;
top: 0;
bottom: 0;
width: 100%;
--mobile-cont_-_max-width: 550px;
--mobile-cont_-_margin: 0;
--mobile-cont_-_display: block;
--mobile-cont_-_left: 0;
max-width: var(--mobile-cont_-_max-width);
margin: var(--mobile-cont_-_margin);
display: var(--mobile-cont_-_display, block);
left: var(--mobile-cont_-_left);
}
.detail-engine {
overflow: scroll;
height: 100%;
position: absolute;
width: 100%;
top: 0;
padding-top: 50px;
-webkit-overflow-scrolling: touch;
box-sizing: border-box;
display: block;
} 

@media (min-height: 550px) and (min-width: 550px){
.desktop-bg {
position: absolute;
left: 550px;
right: 0;
background-size: cover;
top: 0;
bottom: 0;
background-color: #000;
}
body{
display:block;
}


}
.from-details{
display: block;
height: 40px;
line-height: 20px;
position: relative;
padding: 20px 0px;
background: #e2e2e2;
cursor: pointer;
}
.from.text {
position: absolute;
/* left: 10px; */
top: 14px;
font-size: 10px;
color: #898989; 
padding-left: 8px;
line-height: 14px;
}
.from.location {
position: absolute;
left: 64px;
top: 0px;
font-size: 13px;
color: #4a4444;
font-weight: 550;
osition: absolute;
left: 57px;
right: 8px;
text-overflow: ellipsis;
overflow: hidden;
white-space: nowrap;
line-height: 40px;
}
.from-to-container {
position: relative;
padding: 8px 12px;
}
.from-container, .to-container{
padding: 7px 10px;
}
.from.location.text.placeholder {
color: #898989;
font-size: 15px;
}
.ride.title {
padding: 10px 10px 10px 11px;
color: #424242;
font-size: 12px;
letter-spacing: 1px;
}
.time-arrival {
line-height: 12px;
width: 40px;
font-size: 12px;
text-align: center;
top: -6px;
left: 3px;
position: relative;
}
.vehicle-image {
position: absolute;
width: 64px;
top: -4px;
}
.vehicle-image img{
width: 50px;
height: 50px;
position: relative;
top: -1px;
}
.vehicle-info {
position: absolute;
height: 60px;
top: 10px;
}
.available-vehicle-details {
padding: 10px;
position: relative;
height: 75px;
background: white;
cursor:pointer;
}
.vehicle-engine {
padding: 10px;
}
.vehicle-info-details {
position: absolute;
left: 80px;
top: 13px;
cursor:pointer;
}
.vehicle-names {
font-size: 18px;
font-weight: 600;
}
.vehicle-content {
font-size: 14px;
line-height: 19px;
color: #545252;
}
.right-arrow {
position: absolute;
right: 20px;
top: 24px;
}
.right-arrow1 {
    position: absolute;
    left: 19px;
    top: 24px;
    cursor: pointer;
}
i.fa.fa-arrow-right {
font-size: 21px;
font-weight: 100;
}
.horizontal-line {
height: 2px;
background: #e5e5e5;
text-align: center;
margin-left: 10px;
margin-right: 10px;
}
 
.bar {
content: "";
display: inline;
position: absolute;
width: 0;
height: 100%;
left: 50%;
text-align: center;
}
.bar.actv {
background-color: #0b4dd8;
animation: loading 0.5s linear infinite;
}
@keyframes loading {
from {left: 0; width: 0;z-index:100;}
33.3333% {left: 0; width: 100%;z-index: 10;}
to {left: 0; width: 100%;}
}
.ola-select {
background-color: transparent;
border-radius: 0;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border: none;
text-align: left;
font-size: 15px;
float: left;
left: auto;
top: auto;
position: relative;
padding-left: 0;
outline: none;
background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAAaCAYAAAAg0tunAAACN0lEQVRoge3YSU8UQRyG8R8YL95EgwqI8eKKOvhRjAsnY1y/G0biijHxbIIa4xYTY9x3hAHBux7KTpqhN6Z7YBp9LpOprq5/95O3urqLZI5jNOVYp9iPE6tcszQbEtrGcAD78B7zq3AdQziNfuzE01WoWQmtAk8JSYho4APmOngNg7gQ+9+HYTzpYM3KiAs8KSSvlSP4hGYH6g/jLHpa2jcLSXyO3x2oWxmRwDFLk9fKYbxT7XQewjnL5UX0YRceV1izcnr//r4s0PcMdldUdxDnC/R7UVG9jhEl8Bs+CtM1i4bySdwhyEtLXsS4Lk8fS5+Bc/gsTNcsGniLn23UGxAWjN6cfpfVIH0sX4WbikkctXKJA8IzL+nVKc64msgj+Waa+IpDOeeO4jUWCtTpx8WUenEmhJW3NqTd0Cy+yJd4VL7EflzKqBVxBc9y+nQdWTc1i+8YyRmjgTeSJW4Xpu3GnDEm1FAe+amYwTQOZvTpEZL4Coux9q3CtM2Td1VNvjqSyBMIPxRLYlziFmHaFpHX9a8qWRQRSEjijORPvYge4Zm5iGPYlDPmNTWXR/7LbCsjwlZXWa7jUQXjrDlFExgxLT+JedywTuSxcoEEiXOyNx/SuIWHbZzXtbQjkLCoNK1M4k3rTB7tCyRILJrESTwoUatrKSOQIHFe2P5P4zbul6zTtZQVSNgKS5M4aR3LoxqBBIkL2Btru4OpisbvWqoSSNjB+YU9uIt7FY79T7FtrS/gPzXiD0DhaBn4KEmPAAAAAElFTkSuQmCC);
background-position: right 0 center;
background-size: 18px 6px;
background-repeat: no-repeat;
width: 100%;
height: 100%;
cursor: pointer;
}
span.price {
font-weight: bold;
position: absolute;
right: 25px;
}
.drop_location {
    font-size: 19px;
    color: black;
    padding-top: 10px;
}
input#address,input#address1 {
    width: 100%;
    /* padding: 10px; */
    border: 1px solid #e5e5e5;
    background-color: #fff;
      outline: none;
    padding: 0 15px 0 30px;
    font-size: 16px;
    width: 100%;
    xtop: 64px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    box-sizing: border-box;
    border: none;
}
.drop-location.input {
    line-height: 46px;
    padding-top: 20px;
    padding: 20px 10px;
}
.content-wrapper1,.content-wrapper2 {
    background: #f5f5f5;
}           
.from.location.text.placeholder.search_pickup_location.actv {
    font-size: 13px;
    color: #4a4444;
}
.confirm_your_location,.confirm_your_location1 {
    position: absolute;
    bottom: 50px;
    padding: 10px;
    text-align: center;
    width: 100%;
    max-width: var(--mobile-cont_-_max-width);
    margin: var(--mobile-cont_-_margin);
    display: var(--mobile-cont_-_display);
    left: var(--mobile-cont_-_left);
    z-index:2;
}
.book_now{
       position: absolute;
    bottom: 0px;
    padding: 10px;
    text-align: center;
    width: 100%;
    max-width: var(--mobile-cont_-_max-width);
    margin: var(--mobile-cont_-_margin);
    display: var(--mobile-cont_-_display);
    left: var(--mobile-cont_-_left);
    z-index:2;
}
.book_now.actv{
     bottom: 50px;
     transition:3s;
}
.confirm_button {
    background-color: black;
    color: white;
    font-size: 20px;
    padding: 10px;
    border-radius: 6px;
    cursor:pointer;
    user-select: none; 
}
.login-page {
    --mobile-cont_-_max-width: 550px;
    --mobile-cont_-_margin: 0;
    --mobile-cont_-_display: block;
    --mobile-cont_-_left: 0;
    max-width: var(--mobile-cont_-_max-width);
    margin: var(--mobile-cont_-_margin);
    display: var(--mobile-cont_-_display);
    left: var(--mobile-cont_-_left);
    /* margin: 8% auto 16px; */
    /* margin: 10px 140px; */
}
.otp-number {
    text-align: center;
    margin: 8% auto 70px;
    width: 372px;
}
.otp-design,.verify-otps {
    position: relative;
    padding: 30px;
}
.mobile_no {
    padding-top: 14px;
    font-size: 17px;
    color: black;
    font-weight: 600;
}
.otp_content {
    opacity: .5;
    font-size: 14px;
    line-height: 1.21;
    letter-spacing: -0.2px;
}
.intel-input {
    position: relative;
    height: 51px;
    border: 1px solid #e5e5e5;
    background-color: #fff;
    margin-top: 18px;
}

.flag {
    position: absolute;
    left: 17px;
    top: 10px;
    padding-right: 16px;
    border-right: 1px solid #ebebeb;
}
.dial.code {
    position: absolute;
    left: 73px;
    top: 13px;
    /* color: #ebebeb; */
    display: inline-block;
    vertical-align: middle;
    opacity: .5;
    font-size: 16px;
    letter-spacing: -.3px;
}

.dial_number {
    position: absolute;
    right: 0px;
    height: 48px;
    left: 105px;
    top: 1px;
}

input#input-dial-number {
    height: 100%;
    width:100%;
    border: none;
    outline: none;
    user-select: none;
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button,
input[type="number"] {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield; /* Firefox */
}

.verify-otp {
    margin-top: 15px;
}
.opt-text-button-verify, .opt-text-button{
    padding: 10px 0px;
    background-color: #0b4dd8;
    cursor: pointer;
    color: black;
    font-weight: 600;
}

.back-to-home {
    position: absolute;
    top: 33px;
    left: 31px;
    cursor: pointer;
}
.text.opt-text-button.actv,.text.opt-text-button-verify.actv {
    background-color: #e3e3e3;
    color: white;
}
.otp-error-message,.otp-error-message-verify {
    margin-top: 10px;
    color: white;
    background: red;
    padding: 13px;
    font-weight: 600;
    transition: 3s;
}
input#input-name {
    height: 100%;
    border: none;
    outline: none;
    user-select: none;
    width: 100%;
    padding-left: 25px;
}
input#input-name::placeholder {
    opacity: 0.5;
}
.load-bar {
position: relative;
width: 100%;
height: 3px; 
}
.available-vehicle-details.actv {
    background: #ededed;
}
        </style>
    </head>
    <body> 
        <div class="load-bar"><div class="bar"></div> </div>
        <div class="content-initiate">
                        <div class="login-page"> 
                            <div class="otp-number">
                                <div class="verify-otps" style="display:none">
                                    <div><img class="logo" alt="Superbidding Logo" src="http://localhost/Tagxi-Super-App/public/images/email/logo1.jpeg"></div>
                                     <div class="back-to-home"><i class="fa fa-arrow-left"></i></div> 

                                    <div class="mobile_no">Verify OTP</div>
                                    <div class="otp_content">Enter the OTP sent to your mobile <span class="entered-no">9566754418</span></div>
                                    
                                    <div class="intel-input" style="margin-top: 16px;"> 
                                        <input type="text" id="input-name" style="/* height: 100%; */" placeholder="Enter 4-digit OTP"> 
                                        <div class="otp-error-message-verify" style="display:none">Please enter the mobile number</div>
                                    <div class="verify-otp">

                                    <div class="text opt-text-button-verify">VERIFY OTP</div>

                                    </div>
                                </div>
                                </div>
                                <div class="otp-design">
                                    <div><img class="logo" alt="Superbidding Logo" src="http://localhost/Tagxi-Super-App/public/images/email/logo1.jpeg"></div> 

                                    <div class="mobile_no"> Enter Your Mobile Number</div>
                                    <div class="otp_content"> A 4-digit OTP will be sent on SMS</div>
                                    <div class="name-opt" style=" text-align: left; margin-top: 15px;opacity: 0.7;">Name (optional)</div>
                                    <div class="intel-input" style="margin-top: 8px;"> 
                                        <input type="text" id="input-name" style="/* height: 100%; */">
                                    </div> 
                                    <div class="intel-input">

                                    <div class="flag"><img id="flag" src=""></div>

                                    <div class="dial code">+91</div><div class="dial_number">

                                    <input type="number" id="input-dial-number" style="
                                    /* height: 100%; */
                                    ">
                                    </div>
                                    </div>
                                    <div class="otp-error-message" style="display:none">Please enter the mobile number</div>

                                    <div class="verify-otp">

                                    <div class="text opt-text-button">NEXT</div>

                                    </div>
                                </div> </div>
                    </div>
            <div class="content-wrapper">
                <div id="head">
                    <div class="header-menu">
                      <!--   <span id="menuIcon" class="menu-icon"> 
                           <i class="fa fa-bars"></i> 

                        </span> -->
                        <a>
                            <img class="logo" alt="Superbidding Logo" src="http://localhost/Tagxi-Super-App/public/images/email/logo1.jpeg">
                        </a>
                    <!--     <span id="login">
                            LOG IN
                        </span>  -->
                    </div>
                </div> 
     
        </div>
           <div class="content-wrapper1" style="display: none;">
                <div id="head" class="head1">
                    <div class="header-menu"> 
                        <div class="right-arrow1"><i class="fa fa-arrow-left"></i></div> 
                        <div class="drop_location">Enter drop location</div>
                        <div class="drop-location input" style=" line-height: 46px;background: #f7f7f7;">
                            <input type="text" class="autocomplete" id="address" placeholder="Enter address..">
                            <input type="hidden" value="" id="lat">
                            <input type="hidden" value="" id="lng">
                            <input type="hidden" value="" id="formattedAddress">
                        </div>
                        <div id="map" style="height: 600px;">
                            
                        </div>
                       
                    </div>
                </div> 
                   <div class="confirm_your_location" style="display:none">

                <div class="confirm_button">
                      <input type="hidden" value="" id="confirm_lat">
                    <input type="hidden" value="" id="confirm_lng">
                    <input type="hidden" value="" id="confirm_formattedAddress">
                    Confirm your location
                    
                    </div>
                </div>
     
        </div>
           <div class="content-wrapper2" style="display: none;">
                <div id="head" class="head1">
                    <div class="header-menu"> 
                        <div class="right-arrow1"><i class="fa fa-arrow-left"></i></div> 
                        <div class="drop_location">Enter Pickup location</div>
                        <div class="drop-location input" style=" line-height: 46px;background: #f7f7f7;">
                            <input type="text" class="autocomplete" id="address1" placeholder="Enter address..">
                             <input type="hidden" value="" id="lat1">
                            <input type="hidden" value="" id="lng1">
                            <input type="hidden" value="" id="formattedAddress1">

                        </div>
                        <div id="map1" style="height: 600px;"></div>
                       
                    </div>
                </div> 
                <div class="confirm_your_location1" style="display:none">

                <div class="confirm_button">
                      <input type="hidden" value="" id="confirm_lat1">
                    <input type="hidden" value="" id="confirm_lng1">
                    <input type="hidden" value="" id="confirm_formattedAddress1">
                    Confirm your location
                    
                    </div>
                </div>
     
        </div>
        <div class="desktop-bg p2p"><div></div></div>
        <div class="detail-engine-data">
        <div class="detail-engine">
        <div class="nav-list">
            <div class="nav-tab">
                    <a class="item-name daily-ride actv">DAILY RIDES</a>
                    <span class="tool-tips">One-way and Round-trip options for inter-city travel</span>
            </div>
           <!--  <div class="nav-tab">
                 <a class="item-name out_station">OUTSTATION</a>
                 <span class="tool-tips">One-way and Round-trip options for inter-city travel</span>
            </div> -->
            <div class="nav-tab">
                 <a class="item-name rental">RENTALS</a>
                 <span class="tool-tips">One-way and Round-trip options for inter-city travel</span>
            </div>
        </div>
        <div class="book-details">
        <div class="from-container" >
            <div class="from-details" >
                <div class="from text">FROM</div>
                <div class="from location pickup_address"></div>
            </div>
        </div>
        <div class="to-container">
            <div class="from-details daily_rides">
                <div class="from text">TO</div>
                <div class="from location text placeholder search_pickup_location">Search Your pick up location</div>
            </div>
          <!--   <div class="from-details out_station" style="display: none;">
                <div class="from text">TO</div>
                <div class="from location text placeholder search_location">Enter a City,hotel or Address</div>
            </div> -->
            <div class="from-details rentals" style="display: none;">
                <div class="from text">Package</div>
                <div class="from location text placeholder">
                    <select id="packagePicker" class="depart-select ola-select">
            <option value="select" disabled="" selected="">Select a package</option>
            
              <option value="1H_10K">1 hrs 10 km</option>
            
              <option value="2H_20K">2 hrs 20 km</option>
            
              <option value="2H_30K">2 hrs 30 km</option>
            
              <option value="4H_40K">4 hrs 40 km</option>
            
              <option value="6H_60K">6 hrs 60 km</option>
            
              <option value="8H_80K">8 hrs 80 km</option>
            
              <option value="10H_100K">10 hrs 100 km</option>
            <dom-repeat style="display: none;"><template is="dom-repeat"></template></dom-repeat>
          </select>

                </div>
            </div>
        </div>
            
        </div>
        <div class="ride title available_ride" style="display:none">
            <div>AVAILABLE RIDES</div>
        </div>
        <div class="ride title rental_ride" style="display:none">
            <div>SELECT VEHILCLE TYPE</div>
        </div>
     
     <div class="vehicle-engine daily_ride_vehicle" style="display:none">
<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_auto.png">
<div class="time-arrival">2 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">Auto</div><div class="vehicle-content">Get an auto at your doorstep</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div>

<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_mini.png">
<div class="time-arrival">25 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">MIni</div><div class="vehicle-content">Comfy hatchbacks at pocket-friendly fares</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div>
<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_bike.png">
<div class="time-arrival">10 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">Bike</div><div class="vehicle-content">Zip through traffic at affordable fares</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div><div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_prime.png">
<div class="time-arrival">15 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">Prime Sedan</div><div class="vehicle-content">Sedans with free wifi and top drivers</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>

          <div class="horizontal-line"></div>
            </div>


<!--- Package Vechile types start -->

 <div class="vehicle-engine package" style="display:none">
<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_auto.png">
<div class="time-arrival">2 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">Auto</div><div class="vehicle-content">Get an auto at your doorstep</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div>

<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_mini.png">
<div class="time-arrival">25 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">MIni</div><div class="vehicle-content">Comfy hatchbacks at pocket-friendly fares</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div>
<div class="available-vehicle-details">
    <div class="vehicle-info">
        <div class="vehicle-image"><img src="https://olawebcdn.com/images/v1/cabs/sl/ic_bike.png">
<div class="time-arrival">10 min</div>
</div>
        
       
    </div><div class="vehicle-info-details">
        <div class="vehicle-names">Bike</div><div class="vehicle-content">Zip through traffic at affordable fares</div>
</div>
    
<div class="right-arrow">
     <span class="price">₹865</span> 

</div> 
    
          </div>
          <div class="horizontal-line"></div>  
            </div>
<!-- package vehile type End --> 
        </div>
       
        <div class="book_now" style="display: none;">

                <div class="confirm_button">
                      <input type="hidden" value="11.0168445" id="confirm_lat">
                    <input type="hidden" value="76.9558321" id="confirm_lng">
                    <input type="hidden" value="Coimbatore, Tamil Nadu, India" id="confirm_formattedAddress">
                    Book Now
                    
                    </div>
                </div>
        </div>
         </div>


    <!--     <div id="map" style="height: 600px;"></div>
<div id="marker-position"></div>
<div id="address"></div> -->


        <script> 
            var latitude;
                            var longitude;
                            let map;
                            let marker,marker1;
            $(document).on("click",".item-name",function(){
                $(".item-name").removeClass("actv");
                $(this).addClass("actv");
                $(".book_now").removeClass("actv");
                $(".book_now").hide();
            })
             $(document).on("hover",".item-name",function(){
                $(this).closest(".nav-tab").find(".tool-tips").show();
             })
              $('.item-name').hover(
                  function() { 
                     $(this).closest(".nav-tab").find(".tool-tips").show();
                  },
                  function() { 
                      $(this).closest(".nav-tab").find(".tool-tips").hide();
                  }
            );
              $(document).on("click",".daily-ride",function(){  
               
                $(".bar").addClass("actv"); 
                 setTimeout(function() { 
                    $(".available_ride").show();
                    $(".rental_ride").hide();
                    $(".daily_ride_vehicle").show();
                    $(".package").hide();
                    $(".bar").removeClass("actv"); 
                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_city.jpg")'); 
                     $(".from-details.out_station").hide();
                    $(".from-details.rentals").hide();
                    $(".from-details.daily_rides").show();
                  }, 200);  
              }) 
                    $(document).on("click",".rental",function(){ 
                        $(".bar").addClass("actv");  
                         setTimeout(function() {
                              $(".available_ride").hide();
                              $(".daily_ride_vehicle").hide();  
                        $(".bar").removeClass("actv"); 
                        $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_rentals.jpg")'); 
                        $(".from-details.out_station").hide();
                        $(".from-details.daily_rides").hide();
                    $(".from-details.rentals").show();
                  }, 200);  
                
              })

                    $(document).on("change","#packagePicker",function(){
                        $(".rental_ride").show();
                        $(".package").show();

                    });
                    $(document).on("click",".search_pickup_location",function(){ 
                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").show();
                        $(".content-wrapper2").hide();
                    });
                    $(document).on("click",".pickup_address",function(){

                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").show();

                    })
                     $(document).on("click",".fa-arrow-left",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide();

                    });
                      function initAutocomplete() { 
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address"),
                              { types: ['geocode'] }
                            );
                            
                            autocomplete.addListener('place_changed', function() { 

                              var place = autocomplete.getPlace();
                              console.log('Place selected:', place); 
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng(); 
                              $("#confirm_lat").val(latitude);
                              $("#confirm_lng").val(longitude);
                              $("#confirm_formattedAddress").val(formattedAddress);
                              $(".confirm_your_location").show(); 

                               var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        console.log(marker1.getPosition().lat()); 
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code2 = new google.maps.Geocoder(); 
                                        code2.geocode({ 'location': latLng1 }, function(results, status) { 

                                        if (status === 'OK') {  
                                             if (results[0]) { 
                                                 $("#confirm_lat").val(marker1.getPosition().lat());
                                                 $("#confirm_lng").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress").val(results[0].formatted_address);  
                                                 $(".confirm_your_location").show(); 
                                                 $("#address").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                                    }); 
                             
                            });
                            }
                             function initAutocomplete1() { 
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address1"),
                              { types: ['geocode'] }
                            );
                            
                            autocomplete.addListener('place_changed', function() { 
                              var place = autocomplete.getPlace();
                              console.log('Place selected:', place); 
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng();
                              $("#confirm_lat1").val(latitude);
                              $("#confirm_lng1").val(longitude);
                              $("#confirm_formattedAddress1").val(formattedAddress);  
                              $(".confirm_your_location1").show(); 
                                   // Create a map
                              var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map1'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        console.log(marker1.getPosition().lat());
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code1 = new google.maps.Geocoder()
                                        code1.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address);  
                                                 $(".confirm_your_location1").show();
                                                 $("#address1").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                                       
                                    });  
                            });
                            }
                            $(document).on("focus","#address",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                { 
                                    initAutocomplete("address");
                                }
                            })
                            $(document).on("focus","#address1",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                { 
                                    initAutocomplete1();
                                }
                            })

                            var status = true;
                            function getCurrentLocation() {
      var locationInfo = document.getElementById('location-info');

      // Check if geolocation is supported
      if (navigator.geolocation) {
        // Get current position
        navigator.geolocation.getCurrentPosition(
          function(position) {
            // Get latitude and longitude
             latitude = position.coords.latitude;
             longitude = position.coords.longitude;

            // Display location information
            // locationInfo.innerHTML = 'Latitude: ' + latitude + '<br>Longitude: ' + longitude;

            // Optionally, you can use the Google Maps Geocoder API to get a formatted address
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(latitude, longitude);
            console.log(latLng);

            geocoder.geocode({ 'location': latLng }, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                    if(status)
                    {
                         countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name; 
                         // alert("dfsdf");
                          $.ajax({
                                    url: 'get-country-data?countryCode='+countryCode+'', 
                                    method: 'GET',
                                    dataType: 'json', 
                                    // data:data, 
                                    success: function(response) {  
                                     console.log(response);
                                     if(response.status == "success")
                                     {
                                        // $("#flag").attr("src", response.flag.flag); 
                                        $(".dial code").html(response.flag.dial);
                                         $("#flag").attr("src", 'http://localhost/Tagxi-Super-App/public/images/country/flags/IN.png');
                                     }
                                     else{
                                        $("#flag").attr("src", 'http://localhost/Tagxi-Super-App/public/images/country/flags/AD.png');
                                     } 
                                   
                                    },
                                    error: function(error) {
                                    // Handle errors
                                    console.log('Error:', error);
                                    }
                            });
                          status = false;
                    }
                    

                                                
                 console.log(results[0].formatted_address);
                              $("#lat1").val(latitude);
                              $("#lng1").val(longitude);
                              $("#formattedAddress1").val(results[0].formatted_address);
                              $(".pickup_address").html(results[0].formatted_address);
                                var mapOptions = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };

                                    // Create a map
                                     map = new google.maps.Map(document.getElementById('map1'), mapOptions);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        console.log(marker1.getPosition().lat());
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        geocoder.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                // alert("dfdff");
                                                // var countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name;
                                                // alert(countryCode);
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address); 
                                                 $(".confirm_your_location1").show(); 
                                                 $("#address1").val(results[0].formatted_address);
                                             }

                                        }
                                    });
                                        console.log("sdff");
                                    }); 

                } else {
                  console.log('No results found');
                }
              } else {
                console.log('Geocoder failed due to: ' + status);
              }
            });
          },
          function(error) {
            console.log('Error getting location:', error.message);
          }
        );
      } else {
        locationInfo.innerHTML = 'Geolocation is not supported by this browser.';
      }
    } 
function updateMarkerPosition(latLng) {
    // Update the marker position on the UI
    document.getElementById('marker-position').innerHTML = `Marker Position: ${latLng.lat()}, ${latLng.lng()}`;
}

function updateAddress(latLng) {
    // Use the Geocoder to get the address based on the marker's position
    let geocoder = new google.maps.Geocoder();
    geocoder.geocode({'location': latLng}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                // Update the address on the UI
                document.getElementById('address').innerHTML = `Address: ${results[0].formatted_address}`;
            } else {
                console.error('No results found');
            }
        } else {
            console.error(`Geocoder failed due to: ${status}`);
        }
    });
}

 function initMap() {
    getCurrentLocation();  
  }
  $(document).on("click",".confirm_your_location",function(){
       $("#lat").val($("#confirm_lat").val());
       $("#lng").val($("#confirm_lng").val());
       $("#formattedAddress").val($("#confirm_formattedAddress").val());
       $(".bar").addClass("actv");  
                         setTimeout(function() {
                                $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                               $(".content-wrapper").show();
                                $(".detail-engine-data").show();
                                $(".content-wrapper1").hide();
                                $(".content-wrapper2").hide();
                                $(".bar").removeClass("actv"); 
                                 }, 200); 
                                 $(".search_pickup_location").addClass("actv"); 
                                 if($("#lat").val() != "" && $("#lat1").val() != "")
                                 {
                                    $(".available_ride").show();
                                    $(".daily_ride_vehicle").show(); 
                                 }
                                 else{
                                    $(".available_ride").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }

  })
   $(document).on("click",".confirm_your_location1",function(){
       $("#lat1").val($("#confirm_lat1").val());
       $("#lng1").val($("#confirm_lng1").val());
       $("#formattedAddress1").val($("#confirm_formattedAddress1").val());
                        $(".bar").addClass("actv");  

                         setTimeout(function() {
                            $(".pickup_address").html($("#confirm_formattedAddress1").val());
                                $(".content-wrapper").show();
                                $(".detail-engine-data").show();
                                $(".content-wrapper1").hide();
                                $(".content-wrapper2").hide();
                                $(".bar").removeClass("actv"); 
                                 }, 200);  
                          $(".pickup_address").addClass("actv");
                           if($("#lat").val() != "" && $("#lat1").val() != "")
                                 {
                                    $(".available_ride").show();
                                    $(".daily_ride_vehicle").show(); 
                                 }
                                 else{
                                    $(".available_ride").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }
  }) 
   $(document).on("click",".opt-text-button",function(){
    console.log($(".input-dial-number").val());
    if($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined){
     $(".bar").addClass("actv");  
      $(this).addClass("actv"); 
      setTimeout(function() { 
    $(".otp-design").hide();
    $(".verify-otps").show();
     $(".bar").removeClass("actv"); 
     $(this).removeClass("actv"); 
       }, 1000);  

   }
   else{
        $(".otp-error-message").show();
   } 
   });
   $(document).on("click",".back-to-home",function(){
     $(".verify-otps").hide();
     $(".otp-design").show();
     $(".content-wrapper").hide();
        $(".detail-engine-data").hide();
        $(".opt-text-button").removeClass("actv");
    });


   $(document).on("click",".opt-text-button-verify",function(){
     if($("#input-name").val() != "" && $("#input-name").val() !== undefined){
        $(".bar").addClass("actv");  
      $(this).addClass("actv"); 
      setTimeout(function() { 
        $(".otp-design").hide();
        $(".verify-otps").hide();
        $(".content-wrapper").show();
        $(".detail-engine-data").show();
        $(".content-wrapper1").hide();
        $(".content-wrapper2").hide();
        $(".bar").removeClass("actv"); 
        $(this).removeClass("actv"); 
       }, 3000);  
     }
     else{
            $(".otp-error-message-verify").show();
     }
   })
    $(document).on("click",".fa-arrow-left",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide(); 

                    });
      var result_status = true;
    $(document).ready(function(){
        if(result_status)
        {
             $(".content-wrapper").hide();
             $(".detail-engine-data").hide();
             $(".otp-design").show();

        }
        else{
            $(".otp-design").hide(); 
        }

    })
    $(document).on("click",".available-vehicle-details",function(){
        $(".book_now").addClass("actv");
        $(".book_now").show();
        $(".available-vehicle-details").removeClass("actv");
        $(this).addClass("actv"); 
    })

   
                            google.maps.event.addDomListener(window, 'load', initAutocomplete);
                            google.maps.event.addDomListener(window, 'load', initAutocomplete1);
                            google.maps.event.addDomListener(window, 'load', initMap);

        </script>

    </body>
</html>
