<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>A CharityQ Intiative</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {
      font: 16px Montserrat, sans-serif;
      line-height: 1.8;
      color: #f5f6f7;
    }

    h5 {
      display: block;
      font-size: 5em;
      margin-top: 0;
      margin-bottom: 1em;
      margin-left: 0;
      margin-right: 0;
      font-weight: bold;
      font-family:"parchment";
    }

      p {font-size: 16px;}
    .margin {margin-bottom: 45px;}
    .bg-1 {
      background-color: #0097a7; /* Green */
      color: #ffffff;
    }
    .bg-2 {
      background-color: #ffab40; /* Dark Blue */
      color: #ffffff;
    }
    .bg-3 {
      background-color: #ffffff; /* White */
      color: #555555;
    }
    .bg-4 {
      background-color: #ffab00; /* Black Gray */
      color: #fff;
    }
    .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
    }
    .navbar {
      padding-top: 15px;
      padding-bottom: 15px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0;
      font-size: 12px;
      letter-spacing: 5px;
    }
    .navbar-nav  li a:hover {
      color: #1abc9c !important;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="row">
        <div class="col-sm-1">

      <a class="navbar-brand" href="#">
        <img src="https://lh3.googleusercontent.com/CX19HnxKORNf-d50GC_fQR9kdfnstSX08ZV2GTr7ryOG6UvPgxbu5O3-WI7KfUsfsnibTg=s151" alt="TAGG" id="logo" height="120" width="160" />
      </a>
    </div>
        <div class="col-sm-11 col-md-offset-6">
    <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
        <li><a href="#who">WHO</a></li>
        <li><a href="#what">HOW</a></li>
        <li><a href="#where">WHY</a></li>
        @if (Route::has('login'))
                 @auth
         <li> <a href="{{ url('/home') }}">HOME</a></li>
          @else
         <li> <a href="{{ route('login') }}">LOGIN</a></li>
          <li><a href="{{ route('register') }}">REGISTER</a></li>
          @endauth
                @endif
      </ul>
              </div>
    </div>
    </div>
  </div>
  </div>
</nav>

<!-- First Container -->
<div id="who" class="container-fluid bg-1 text-center">
  <h5 class="margin">Q </h5>
   <p><font face="parchment" size="50">Q</font> helps caring business managers in streamlining contributions to their community, charities, non-profits, and other organizations.  This allows our business partners to operate more efficiently and successfully within their community.
  </p>
</div>

<!-- Second Container -->
<div id="what" class="container-fluid bg-2 text-center">
  <h3 class="margin">Sign Up Today!</h3>
  <p>It only takes a few minutes to register your business and get started with Q.  Once you have registered, add our easy Donation Request Form to your business’ web page.  Requests for donation are entered online by the organization making the request and then filtered based on priorities set by your business.  This makes it easy to track requests made and respond accordingly.</p>

</div>

<!-- Third Container (Grid) -->
<div id="where" class="container-fluid bg-3 text-center">
  <h3 class="margin">Why To Choose <font face="parchment" size="50">Q</font> ?</h3><br>
  <div class="row">
    <div class="col-sm-4">
      Save Time = Save Money <br>
      <p>  It only takes a few minutes to register your business and get started with Q.
        Once you have registered, add our easy Donation Request Form to your business’ web page.  Requests for donation are entered online by the organization making the request and then filtered based on priorities set by your business.  This makes it easy to track requests made and respond accordingly.
      </p>

    </div>
    <div class="col-sm-4">
      <p> How the process works:
      <p style="list-style-type:disc">
        <li align="left">Step 1 - Register your business</li>
        <li align="left">Step 2 - Set business rules to filter requests based on the type of requesting organization, size of event, and type of donation request.
        </li>
        <li align="left">Step 3 - Regularly visit your company dashboard to view the sorted list of donation requests awaiting your decision.</li>
      <li align="left">Step 4 - Decide to contribute or not with a push of a button.</li>
      <li align="left">Step 5 - An email will be generated and ready to send or available to edit.</li>
    </p>
    </ul>


    </div>
    <div class="col-sm-4">
      <p>Delivering Care Together !</p>
      <p>When we take one step ahead, you can join us to take multiple steps ahead. Our help together can make a difference in society.
       </p>
      <br>
      <br>
      <br>
      <br>

    </div>
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <h3><a href="http://www.togetheragreatergood.com/">A CharityQ Initiative</a></h3>
  <img src="http://www.unhcr.ca/wp-content/uploads/2016/04/icon-partner.png" class="rounded sm-auto d-block" style="width:20%" alt="Image" align="middle">


</footer>

</body>
</html>
