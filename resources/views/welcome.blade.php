@extends('layouts.app')

@section('content')

    <body>

    <div id="image1" class="container-fluid" style='text-align:center; background-image: url("http://citadelnyc.com/wp-content/uploads/2015/04/background-outer-wrapper2.png");background-repeat:repeat;height:155px;' align="center" >

    </div>

        <div class="containerimg" >
            <img src="{{ asset('img/cover.jpg') }}" style="overflow: hidden ; height: 100%; width: 100% ; position:static;  "/>
<script>
    $(window).load(function(){
        $('.containerimg').find('img').each(function(){
            var imgClass = (this.width/this.height > 1) ? 'wide' : 'tall';
            $(this).addClass(imgClass);
        })
    })
</script>
        </div>



    <!-- First Container -->
    <div  class="container-fluid bg-1 text-center">

        <div class="row">
            <div class="col-sm-6" style="padding-left: 0px;  padding-right: 0px; padding-top: 0px; padding-bottom: 0px">

                <img src="http://media.istockphoto.com/photos/cheering-hiking-woman-sunrise-seaside-picture-id463785425?k=6&m=463785425&s=612x612&w=0&h=UBUeh5au_M9pXg72kcqLhD4JVhH1t_ZEmq2Bns_Efnk=" class="img-responsive" alt="Full Size Background Image" >

            </div>


            <div id="about" class="col-sm-6">
                <h3>About Us </h3>
                <p class="text-center">CommunityQ helps caring business managers in streamlining contributions to
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
    <div id="where" class="container-fluid bg-3 text-center">
        <div class="row">

        </div>
        <div class="col-sm-6" id="sign">
            <h2 class="margin">Sign Up Today!</h2>
            <p class="text-center">It only takes a few minutes to register your business and get started with Q.  Once you have registered, add our easy Donation Request Form to your business’ web page.  Requests for donation are entered online by the organization making the request and then filtered based on priorities set by your business.  This makes it easy to track requests made and respond accordingly.</p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
             <h4><a href="{{ route('register') }}" class="w3-bar-item w3-button ">Sign Up !</a></h4>
            <br>

        </div>
        <div class="col-sm-6">
            <h2>Save Time = Save Money</h2>
            <p class="text-center">  Request management can be delegated to multiple users within your organization.
                Filters can be enabled to sort donation requests to ensure your business supports causes important to you.
                As a business user, you will be able to approve or reject requests in bulk and respond within the
                application.
                Custom or generic responses can communicate instructions to approved organizations, and gently inform
                other organizations when requests are rejectd.
                Q Reports can enable your business to easily organize donations and figure out potential tax advantages.

            </p>

            <br>
<br><br><br><br><br>
            <br>
            <br>

        </div>

    </div>


    <div  class="container-fluid bg-2 text-center">

        <div class="row">

            <div id="how" class="col-sm-6">
                <h2>How the process works:</h2>
                <br>
                <p style="list-style-type:disc">
                <h1> <li align="left">Step 1 - Register your business</li></h1>
                <h1><li align="left">Step 2 - Set business rules to filter requests based on the type of requesting organization, size of event, and type of donation request.
                    </li></h1>
                <h1><li align="left">Step 3 - Regularly visit your company dashboard to view the sorted list of donation requests awaiting your decision.</li></h1>
                <h1><li align="left">Step 4 - Decide to contribute or not with a push of a button.</li></h1>
                <h1><li align="left">Step 5 - An email will be generated and ready to send or available to edit.</li></h1>
                <br>
                </p>

            </div>

            <div class="col-sm-6">

                <img src="https://flickerleap.com/wp-content/uploads/2017/05/5-steps-to-create-effective-content.jpg" class="img-responsive" alt="Full Size Background Image" >

            </div>
        </div>
    </div>





    </body>
@endsection