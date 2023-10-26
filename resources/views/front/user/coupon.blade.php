@extends('front.master.master')

@section('title')
{{ $shop_info->shop_name }} | Coupon
@endsection

@section('meta')
    <!-- Twitter Card  -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@my_twitter">
    <meta name="twitter:creator" content="@my_twitter">

    <!-- Open Graph  -->
    <meta property="og:title" content="{{ $seo_info->title }}" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="{{ url('register') }}" />
    <meta property="og:image" content="{{ url('images/setting/seo/'.$seo_info->meta_image) }}" />
    <meta property="og:description" content="{{ $seo_info->description }}" />

@endsection
@section('content')

<section class="bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 ">
                            <div class="breadcrumb clearfix">
                                <div class=" col col-lg-6 col-sm-6">
                                    <div class="float-l">
                                        <a href="#"><span><b>My Coupon</b></span></a>
                                    </div>
                                </div>
                                <div class=" col col-lg-6 col-sm-6">
                                    <div class="float-r">
                                        <div class="breadcrumbs">
                                            <a href="#"><b>Home</b> <i class="lni lni-chevron-right"></i></a>
                                            <a href="{{ route('user.profile') }}">My Coupon</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
</section>
 <!--  end breadcrumn-->

<section class="user-profile mt30 mb30">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                @include('front.user.user-menu')
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="deshboard ">

                    <div class="row">

                    <div class="offset-lg-3 col-lg-6 col-sm-12">
                        @if(count($coupon) > 0)
                        @php 
                        $currency = getCurrentCurrency();
                        @endphp 
                        <div class="form row">
                            @foreach($coupon as $value)
                          <div class="col-md-12 mb15">
                              <div  style="padding: 10px;" class="bg-shadow bg-white">
                              <input type="text" value="{{ $value->coupon_code }}" class="form-control"  readonly>
                               <p style="margin-top:10px;" class="text-center">Apply <span class="theme-color"><b>{{ $value->coupon_code }}</b></span> during checkout  to Get <br>
                               {{ $value->amount }}
                               @if($value->amount_type == 1)
                               <span>{{ $currency->symbol }}</span>
                               @else
                               <span>% Up To {{  $value->max_amount_limit }}{{ $currency->symbol }}</span>
                               @endif
                               Discount
                              </p>
                              <p style="margin-top:10px;" class="text-center">Valid Date : {{ $value->valid_date }}</p>
                              </div>
                          </div>
                          @endforeach
                        </div>

                        @else
                        <div class="form bg-white text-center" style="color:gray;margin-top:30px;">
                             <h3 class="bg-blue-op-10 p10 color-black br5">No coupons available 🥺  , please shop with us to get coupons</h3>
                        </div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script src="{{ asset('public/js/front.js') }}"></script>
@endpush
