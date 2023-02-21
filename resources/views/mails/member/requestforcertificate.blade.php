<!DOCTYPE html>
<html>

<head>
    <title>Request for Certificate of Good Standing</title>
<style>
.container {
    padding: 1.5rem;
}
.verify-wrapper {
    max-width: 350px;
    margin: auto;
    background-color: #fff;
    height: auto;
    padding: 2.5rem;
    box-shadow: 1px 1px 15px #A6A9AA;
}
.header-content {
    color: #474747;
    margin-top: 0;
}
.footer {
    margin: 0 auto;
    padding: 0;
    padding-bottom: .25rem;
    text-align: center;
    width: 570px;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 570px;
}
.footer p {
    color: #AEAEAE;
    font-size: 12px;
    text-align: center;
    font-family: 'Open Sans';
}
.bg-E4E7E9 {
    background-color: #E4E7E9;
}
.color-575757 {
    color: #575757;
}
.w-100 {
    width: 100px;
}
.h-100 {
    height: 100;
}
.m-auto {
    margin: auto;
}
.open-sans {
    font-family: 'Open Sans', 'Arial';
}
.lh-1-75 {
    line-height: 1.75;
}
.text-left {
    text-align: left!important;
}
</style>

</head>

<body class="bg-E4E7E9">
    <div class="container">
        <div class="verify-wrapper">
            <div class="verify-header text-center mb-3">
                <div class="w-100 h-100 m-auto">
                    <img class="w-100" src="{{ url('/storage/images/mdmsi-logo.png') }}">
                </div>
                <div class="text-left">
                    <h3 class="header-content open-sans">Good day,</h3>
                    <p>Dr. {{$pcr_member['last_name']}} has requested for a certificate of good standing.</p> <br/>
                </div>
            </div>

            <div class="verify-content text-center mb-3 open-sans color-575757 lh-1-75">
                The doctor's details are as follows:<br/>
                <b>Name: </b>{{$pcr_member['first_name']}} {{$pcr_member['middle_name']}} {{$pcr_member['last_name']}} <br/>
                <b>Contact No: </b>{{$pcr_member['contact_number']}} <br/>
                <b>Email: </b>{{$pcr_member['email']}} <br/>
                <b>PRC Number: </b>{{$pcr_member['prc_number']}} <br/>
                <b>Address: </b>{{$pcr_member['address']}} <br/><br/>
                
                <div class="text-left">
                    Regards, <br/>
                    Metropolitan Davao Medical Society
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
       <p> © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</p>
    </div>
</body>
</html>