<!DOCTYPE html>
<html>

<head>
    <title>Thank You Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.btn {
    margin-top: 1.5rem;
    color: #fff !important;
    background-color: #007bff;
    display: inline-block;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #007bff;
    font-family: 'Open Sans';
    padding: 10px;
    padding-left: 40px;
    padding-right: 40px;
    box-shadow: 1px 2px 15px #ABABAB;
    border-radius: 20px;
}

.btn:hover {
    background-color: #2E93FF;
    transition: 0.5s;
}

.btn:active {
    background-color: #0065D1;
    transition: 0.5s;
}

.container {
    padding: 1.5rem;
}

.verify-wrapper {
    text-align: center;
    max-width: 350px;
    margin: auto;
    background-color: #fff;
    height: auto;
    padding: 2.5rem;
    box-shadow: 1px 1px 15px #A6A9AA;
}

.header-content {
    font-family: 'Open Sans';
    text-align: center;
    color: #474747;
    margin-top: 0;
    font-size: 2rem;
}

.text-left {
    text-align: left;
}
.text-indent-2 {
    text-indent: 1cm;
}
.mb-0 {
    margin-bottom: 0px;
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
</style>

</head>

<body style="background-color: #e4e7e9;">
    <div class="container">
        <div class="verify-wrapper text-center">
            <div class="verify-header text-center mb-3">
                <div style="width: 100px;
                    height: 100px;
                    margin: auto;">
                    <img style="width:100%" src="{{ url('/storage/images/mdmsi-logo.png') }}">
                </div>
            </div>

            <div class="greeting text-left">
                Good day,<br/>
                <p class="text-indent-2 mb-0">
                    Dr. {{$pcr_member['first_name']}} {{$pcr_member['middle_name']}} {{$pcr_member['last_name']}} has updated their member details as follows and is now active:
                </p><br/><br/>
            </div>

            @php
                $raw_date = new DateTime($pcr_member['prc_expiration']);
                $prc_expiration_date = $raw_date->format('F j, Y');
            @endphp

            <div class="verify-content text-center mb-3" style="font-family: Open Sans; color: #575757; line-height: 1.75;">
                <b>Name: </b>{{$pcr_member['first_name']}} {{$pcr_member['middle_name']}} {{$pcr_member['last_name']}} <br/>
                <b>Contact No: </b>{{$pcr_member['contact_number']}} <br/>
                <b>Email: </b>{{$pcr_member['email']}} <br/>
                <b>PRC Number: </b>{{$pcr_member['prc_number']}} <br/>
                <b>PRC Expiration Date: </b>{{$prc_expiration_date}} <br/>
                <b>Address: </b>{{$pcr_member['address']}} <br/><br/>   
            </div>

            <div class="closing text-left">
                Please be advised, <br/>
                Metropolitan Davao Medical Society
            </div>
        </div>


    </div>
    <div class="footer">
       <p> © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</p>
    </div>
</body>

</html>