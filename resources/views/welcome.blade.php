@extends('layouts.app')

@section('content')


        <div class="containerimg" >
            <img src="{{ asset('img/home-page-image.jpg') }}" class="wide img-responsive" />
                <script>
                    $(window).load(function(){
                        $('.containerimg').find('img').each(function(){
                            var imgClass = (this.width/this.height > 1) ? 'wide' : 'tall';
                            $(this).addClass(imgClass);
                        })
                    })
                </script>
        </div>
        
        <div id="about" class="containerimg" >
            <img src="{{ asset('img/HomePage2.png') }}" class="wide img-responsive" />
            <img src="{{ asset('img/HomePage3.png') }}" class="wide img-responsive" />
        </div>

    <link href="{!! asset('css/custom.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <! ========================  
    Pricing Table  	 
  ========================	!>
<div id="generic_price_table">   
<section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--PRICE HEADING START-->
                    <div class="price-heading clearfix">
                    </div>
                    <!--//PRICE HEADING END-->
                </div>
            </div>
        
        <div class="well well-sm text-center">
            <h1 class="toggle-font">Choose your plan</h1>
                <div id='pln' class="plan toggle-font ">
                        
                        <input type="radio" class="toggle-font" value= "monthly" name="options" id="option1" checked="checked">
                        Monthly                    
                        <input type="radio" class="toggle-font" value= "yearly"name="options" id="option2">
                        Yearly (Save upto 20%)
                              
                </div>
        </div>
    </div>
        <div id='plan1' class="container">
            
            <!--BLOCK ROW START Monthy-->
            <div class="row">
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Small</span>
                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Up to 5 Locations</li>
                                            
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">19</span>
                                    <span class="month">/MO&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='small' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Medium</span>
                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Up to 25 Locations</li>
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">49</span>
                                    <span class="month">/MO&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                                            
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='medium' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Large</span>
                               <!--FEATURE LIST START-->
                                <div class="generic_feature_list">
                                    <ul>
                                        <li>Up to 100 Locations</li>
                                        
                                    </ul>
                                </div>
                                <!--//FEATURE LIST END-->
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">199</span>
                                    
                                    <span class="month">/MO&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='large' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Unlimited</span>
                                                <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                        	<ul>
                                <li>Unlimited Locations</li>
                                
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">249</span>                                    
                                    <span class="month">/MO&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='unlimited' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
            </div>	
            <!--//BLOCK ROW END-->
    
        </div>
        <div id='plan2' style="display: none" class="container">
            
            <!--BLOCK ROW START Monthy-->
            <div class="row">
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Small</span>
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Up to 5 Locations</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">180</span>
                                    <span class="month">/YR&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->

                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='Small' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Medium</span>
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Up to 25 Locations</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">470</span>
                                    <span class="month">/YR&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->

                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='Medium' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Large</span>
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Up to 100 Locations</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">1900</span>
                                    <span class="month">/YR&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->

                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='Large' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                <div class="col-md-3">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Unlimited</span>
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li>Unlimited Locations</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">2390</span>                       
                                    <span class="month">/YR&#42;</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->

                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                        	<a id='Unlimited' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
            </div>	
            <!--//BLOCK ROW END-->
    
        </div>
        <script>

        $("input[name='options']:radio").change(function() {
                $("#plan1").toggle($(this).val() == "monthly");
                $("#plan2").toggle($(this).val() == "yearly"); 
                });
        </script>

</section>
           
	<footer>
        <div id="contact" class="" >
            <img src="{{ asset('img/HomePage4.png') }}" class="img-responsive center-block" width="60%" height="60%" />
               
        </div>
    </footer>
</div>

@endsection
