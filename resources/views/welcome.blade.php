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

    <link href="{!! asset('css/custom.css') !!}" media="all" rel="stylesheet" type="text/css" />


    <!-- First Container -->
    <div  class="container-fluid bg-1 text-center">

        <div class="row">
            <div class="col-sm-6" style="padding-left: 0px;  padding-right: 0px; padding-top: 0px; padding-bottom: 0px">

                <img src="http://media.istockphoto.com/photos/cheering-hiking-woman-sunrise-seaside-picture-id463785425?k=6&m=463785425&s=612x612&w=0&h=UBUeh5au_M9pXg72kcqLhD4JVhH1t_ZEmq2Bns_Efnk=" class="img-responsive" alt="Full Size Background Image">

            </div>


            <div id="about" class="col-sm-6">
                <h3>About Us </h3>
                <p class="text-center">CharityQ helps caring business managers in streamlining contributions to
                    their community, charities, non-profits, and other organizations.  This allows our business partners to operate more
                    efficiently and successfully within their community.
                </p>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>




    <!-- Third Container (Grid) -->
    <div  class="container-fluid bg-2 text-center">

        <div class="row">

            <div id="how" class="col-sm-6" style="padding-left:5%">
                <h2>How the process works:</h2>
                <br>
                <p style="color: black">
                <h1 align="left" style="font-size: 18px; color: black"><b>Step 1</b> - Register your business</h1>
                <h1 align="left" style="font-size: 18px; color: black"><b>Step 2</b> - Set business rules to filter requests based on the type of requesting organization, size of event, and type of donation request.</h1>
                <h1 align="left" style="font-size: 18px; color: black"><b>Step 3</b> - Regularly visit your company dashboard to view the sorted list of donation requests awaiting your decision.</h1>
                <h1 align="left" style="font-size: 18px; color: black"><b>Step 4</b> - Decide to contribute or not with a push of a button.</h1>
                <h1 align="left" style="font-size: 18px; color: black"><b>Step 5</b> - An email will be generated and ready to send or available to edit.</h1>
                <br>
                </p>

            </div>

            <div class="col-sm-6">

                <img src="https://flickerleap.com/wp-content/uploads/2017/05/5-steps-to-create-effective-content.jpg" class="img-responsive" alt="Full Size Background Image" >

            </div>
        </div>
    </div>


    <!-- Third Container (Grid) -->
    <div id="where" class="container-fluid text-center" >

        <div class="col-sm-6" id="sign" style="padding: 2%; background-color: #90a4ae">
            <h2 style="color: white" class="margin">Sign Up Today!</h2>
            <p style="text-align: left">It only takes a few minutes to register your business and get started with CharityQ. Once
                you have registered, add our easy Donation Request Form to your business’ web page. Requests for
                donation are entered online by the organization making the request and then filtered based on priorities
                set by your business. This makes it easy to track requests made and respond accordingly.</p>
            <br>
            <br>
            <br>
            <br>
            <a href="{{ route('register') }}" class="btn savebtn " title="Signup"><span class="glyphicon glyphicon-user"></span>&nbsp;Sign Up !</a>
        </div>
        <div class="col-sm-6" style="padding: 2%">
            <h2>Save Time = Save Money</h2>
            <p style="text-align: left">Request management can be delegated to multiple users within your organization.
                Filters can be enabled to sort donation requests to ensure your business supports causes important to you.
                As a business user, you will be able to approve or reject requests in bulk and respond within the
                application. Custom or generic responses can communicate instructions to approved organizations, and gently inform
                other organizations when requests are rejected. CharityQ Reports can enable your business to easily organize donations and figure out potential tax advantages.
            </p>
        </div>
    </div>
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
            <h1 class="toggle-font">Choose you plan</h1>        
                <div id='pln' class="plan toggle-font" data-toggle="buttons"> 
                        
                        <input type="radio" class="toggle-font" name="options" id="option1">
                        Monthly                    
                        <input type="radio" class="toggle-font" name="options" id="option2">
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
                        	<a id='small1' class="" href="{{ route('register') }}">Start Free Trial</a>
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
                        	<a id='unlimited1' class="" href="{{ route('register') }}">Start Free Trial</a>
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
            </div>	
            <!--//BLOCK ROW END-->
    
        </div>
        <script>
                $('input:radio[name=options]').click(function() {
                  $( "#plan1" ).toggle();
                  $( "#plan2" ).toggle();
                });
        </script>
</section>
           
	{{--  <footer>
    	<a class="bottom_btn" href="#">&copy; CharityQ</a>
    </footer>  --}}
</div>
</body>
@endsection
