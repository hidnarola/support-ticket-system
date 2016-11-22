<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="<?php echo base_url(); ?>">
        <title>Support Ticket</title>
        <!--bootstrap css-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <!--font-awesome css-->
        <style>
            body{
                background:#eeeeee;	
                font-family: 'Open Sans', sans-serif;
            }
            section.container{
                background:#fff;
                max-width:600px;
                margin:0 auto;	
                height:100%;
                border: 1px solid;
            }
            header{
                background:#2b333a;	
                padding: 0 25px;
            }
            header .content{
                padding-top:30px;
                padding-bottom:30px;	
            }

             p.banner-icon img{
              height: 70px;
              width: 250px;
              margin: 0 150px;
            } 

            header p.title{color:#fff;text-align:center;font-size:30px;margin:0px;font-weight: 100;}
            .lead-content {
                margin: 0 auto;
                width: 85%;
                padding-bottom: 50px;
                padding-top: 30px;
            }
            .lead-content h3,
            .lead-content p.main-title1,
            .lead-content p.sub-title1,
            .lead-content p.main-title2,
            .lead-content p.sub-title2 {
                color: #636e80;
                font-size: 14px;
                font-weight: 400;
            } 
            .lead-content a.btn-default {
                background-color: #1abc9c;
                border: medium none;
                border-radius: 4px;
                color: #ffffff;
                padding: 8px 18px;
                font-size:14px;
                text-decoration: none;
            }
            .lead-content p a {
                color: #3696cc;
                text-decoration: none;
                font-size: 15px;
            }
            .footer .copy-right {
                color: #2b333a;
                font-size: 13px;
                font-weight: bold;
                text-align: center;
            }
            .footer .address {
                color: #636e80;
                font-size: 14px;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <section class="container">
            <header>
                <div class="content">
<!--                 <p class="banner-icon">
                     <img src="http://dev.supportticket.com/assets/frontend/images/favicon (1).ico"/>
                </p> -->
                    <p class="title">Welcome to Manazel Specialists</p>
                </div>
            </header>
            <div class="lead-content">
                <h3>Hello <?php echo $firstname. " ". $lastname; ?>,</h3>
                <p class="main-title1">Thank you for registering.</p>
                <p class="sub-title1">To get Started, please verify Your email address.</p>
                <a href="<?php echo $url; ?>" class="btn btn-default">Click Here</a>
                <br/>
                <br/>
                <p class="sub-title2">Thanks,</p>
                <p class="sub-title2">Support Ticket</p>
                <p class="sub-title2"><a href="<?php echo base_url();?>">Support Ticket.com</a></p>
            </div>
        </section>
        <div class="footer">
            <p class="copy-right">2016 &copy; Support Ticket System, Inc.</p>
        </div>
    </body>
</html>
