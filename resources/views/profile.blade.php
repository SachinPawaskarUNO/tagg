<!doctype html>
<html>
<head>
    <title> Profile Management Page</title>

{{--  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" />  --}}
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<a href="#myModal" role="button" class="btn" data-toggle="modal">Open</a>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <textarea name="content"></textarea>
    </div>

    <div class="modal-footer">
        <button class="btn btn-basic" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<script>
tinymce.init({
    selector:   "textarea",
    width:      '100%',
    height:     270,
    plugins:    "link",
    statusbar:  false,
    menubar:    false,
    toolbar:    "link"
});

// Prevent bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

$('#open').click(function() {
    $("#dialog").dialog({
        width: 800,
        modal: true
    });
});
</script>



</head>
<body>


</body>
</html>

<form class="form-horizontal">
    <fieldset>
        <h2> Manage Your Profile Here </h2>

        <h3> Change Username</h3>


        <div class="form-group">

            <label for="inputOldUsername" class="col-lg-2 control-label">Enter Old User Name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="user_name" name="username">
            </div>

            <label for="inputNewUsername" class="col-lg-2 control-label">Enter New User Name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="user_name" name="username">
            </div>

            <label for="inputNewUsernameAgain" class="col-lg-2 control-label">Confirm New User Name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username">
                <button type="submit" class="btn btn-">Save Changes</button>
            </div>


            <h3> Update Contact Information</h3>

            <div class="form-group">

                <label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputlastname" class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputstreetaddress" class="col-lg-2 control-label">Street Address</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputcity" class="col-lg-2 control-label">City</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputstate" class="col-lg-2 control-label">State</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputZipcode" class="col-lg-2 control-label">Zip Code</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputphone" class="col-lg-2 control-label">Phone Number</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <label for="inputorganizationname" class="col-lg-2 control-label">Business Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                    <button type="submit" class="btn btn-basic">Save Changes</button>
                </div>
            </div>
            <pre></pre>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn backbtn">Cancel</button>
                    <button type="submit" class="btn btn-basic">Submit</button>
                    <h3> Thank You!!!</h3>

                </div>
            </div>
        </div>
    </fieldset>
</form>
