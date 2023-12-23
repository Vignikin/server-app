@if(count($booking_data) > 0)
<div class="model-init" style="display: none;">
   <div class="model-wrapper">
      <div class="model-content1" style="display: none;">
         <div class="model-head">
            update additional Information
         </div>
         <div class="model-head name">
            Name
         </div>
         <div class="model-input1 data1">
            <input type="text" id="model-promo-input-name" value="{{$user_detail->name}}">
         </div>
         <div class="model-head name">
            Phone number
         </div>
         <div class="model-input1 data1">
            <input type="number" id="model-promo-input-number" value="{{$user_detail->mobile}}">
         </div>
         <div class="model-head name">
            Instruction
         </div>
         <div class="model-input1 data1" style="height: 65px;">
            <textarea id="model-promo-input-ins" style="height: 100%;width: 100%;border: none;outline: none;"></textarea>
         </div>
         <div class="promocode">
            <div class="promocode-cancel"> 
               Cancel
            </div>
            <div class="receiver-add">  
               Add
            </div>
         </div>
      </div>
   </div>
</div>
<div id="head" class="head1">
   <div class="header-menu">
      <div class="right-arrow1 "><i class="fa fa-arrow-left booking-back"></i></div>
      <div class="drop_location" style="padding-bottom: 10px;">Booking Information</div>
      <div class="booking_info">
         <div id="mapImageContainer">
            <img id="mapImage" style="width:100%" src="https://maps.googleapis.com/maps/api/staticmap?center={{$request->lat}},{{$request->lng}}&amp;zoom=15&amp;size=600x300&amp;markers=icon:http://maps.google.com/mapfiles/ms/icons/blue-dot.png|{{$request->lat}},{{$request->lng}}&amp;key=AIzaSyA-n6_B74MUzv2walwhMHqyfWqH92J6Nno">
         </div>
         <div class="pick_ups_location" style="padding-top:10px">
            <div class="left-text">Pickup </div>
            <div class="pickup_loc_name pickup">{{$request->pickup_address}}</div>
         </div>
         <div class="pick_ups_location">
            <div class="left-text">Drop</div>
            <div class="pickup_loc_name drop">{{$request->drop_address}}</div>
         </div>
         <div class="vehicle-details">
            <div class="price-details" style="padding: 10px 0px;">
               <div class="vehicle-type-text">
                  {{$booking_data[0]->name}} 
                  <div class="price-vehicle-desc">{{$booking_data[0]->short_description}}</div>
               </div>
               <div class="price-data-value" style="top: 0px;right:5px"><img src="{{$booking_data[0]->vehicle_icon}}" id="vehicle-image"></div>
            </div>
         </div>
         <div class="fare-breaup-details">
            <div class="price-details-head">Fare Breakup</div>
            <div class="price-details1">
               <div class="price-data">Base Price</div>
               <div class="price-data-value" >{{$booking_data[0]->currency}}{{number_format($booking_data[0]->base_price,2,'.',',')}}</div>
            </div>
            <div class="price-details2">
               <div class="price-data">Ditstance Price</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->distance_price,2,'.',',')}}</div>
            </div>
             <div class="price-details1">
               <div class="price-data">Time Price</div>
               <div class="price-data-value" >{{$booking_data[0]->currency}}{{number_format($booking_data[0]->time_price,2,'.',',')}}</div>
            </div>
            <div class="price-details3">
               <div class="price-data">service tax</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->tax_amount,2,'.',',')}}</div>
            </div>
            <div class="price-details4">
               <div class="price-data">convenience Fee</div>
               <div class="price-data-value">
                  @if($booking_data[0]->has_discount)
                  {{$booking_data[0]->currency}}{{number_format($booking_data[0]->with_discount_admin_commision,2,'.',',')}}
                  @else
                  {{$booking_data[0]->currency}}{{number_format($booking_data[0]->without_discount_admin_commision,2,'.',',')}}
                  @endif
               </div>
            </div>

            <div class="price-details5">
               <div class="price-data">Total Price</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->total,2,'.',',')}}</div>
            </div>
         </div>
         <div class="payment-mode-details">
            <div class="payment-mode">
               <div class="payment-text">Payment Method</div>
               <div class="price-data-value" style="top: 0px;">Cash</div>
            </div>
         </div>
         <!--   <div class="fare-breaup-details">
            <div class="payment-mode" style="padding-top: 20px";>
             <div class="payment-text">Apply coupon code</div>
             <div class="price-data-value" style="/* right: 25px; */top: 20px;color: blue;text-decoration: underline;cursor: pointer;">Add</div>
             </div> 
            </div> --> 
         @if(isset($request->booking_type))
         <div class="data">
            <div class="payment-mode">
               <div class="payment-text">Date</div>
               <div class="price-data-value" >{{$request->date}} <i class="fa fa-pencil-square-o date-edit"  style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
            </div>
         </div>
         @endif
         @if($transport_type == "delivery")
         <div class="data">
            <div class="payment-mode">
               <div class="payment-text">Receivers Information</div>
               <div class="price-data-value receiver-dt" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;"><i class="fa fa-pencil-square-o" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
            </div>
         </div>
         <div class="goods-details">
            <div class="goods_types">
               <div class="goods text">Good type</div>
               <div class="from location text placeholder goods_type">
                  <select id="goods_type" class="depart-select ola-select">
                     <option value="select">Select goods Type</option>
                     @foreach($goods_type as $key=>$value)
                     <option value="{{$value->id}}" @if($key ==0) Selected @endif>{{$value->goods_type_name}}</option> 
                     @endforeach
                     <template is="dom-repeat"></template>
                  </select>
               </div>
            </div>
            <div class="loose-goods" style=" margin-top:10px">
               <input type="radio" id="loose" name="goods_types" value="loose" class="radio-option" checked>
               &nbsp; <label for="loose">Loose</label>
               &nbsp; <input type="radio" id="qty" name="goods_types" value="qty" class="radio-option">
               &nbsp; <label for="qty">Quantity</label>
               <div class="model-input1 data1 qunatity-input" style="display:none">
                  <input type="text" id="model-promo-input-qty">
               </div>
            </div>
         </div>
         @endif
         <div class="confirm_your_location3 confirm_to_book" onclick="confirm_booking()" style="bottom: 10px;">
            <div class="confirm_button" style="width: 90%;"> 
               Confirm to Book
            </div>
         </div>
      </div>
   </div>
</div>
 
@endif