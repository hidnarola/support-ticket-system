<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Support Ticket System </title>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,400italic,700,700italic,600,600italic' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body	 {background-color: #eee; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Georgia, Times, serif;padding:0 15px;}
            table {border-collapse: collapse;}	  
        </style>
    </head>
    <body>
        <div class="wrapper" style="border: 1px solid;background-color:#fff;padding:0;max-width: 550px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);margin: 20px auto;border-radius:3px;overflow:hidden;">
            <div style="background-color: #009688;padding:30px; margin:0; display: block;">
                <!--<h3 style="color:#fff;font-size:24px;margin:0;padding:0;font-family:Arial, Helvetica, sans-serif;font-weight:400;"><center><img src="http://bw.chekadaa.com/ChekaDaa/assets/frontend/images/ChekaDaa_logo_gray.png"></center></h3>-->
                <h3 style="color:#fff;font-size:24px;margin:0;padding:0;font-family:Arial, Helvetica, sans-serif;font-weight:400;"><center>Support Ticket System</center></h3>
            </div>

           <div style="padding:30px;margin:0; display: block;vertical-align:top; text-align:left;">
                <p style="padding:0; text-align:center; margin:0; color:#000; font-size:18px; font-weight:400; font-family:Arial, Helvetica, sans-serif; line-height:22px;">
                    <strong> <p>Here is your details for Support Ticket System.</p></strong><br><br>
                </p>
                
                
                <hr>
                <p style='margin: 1em 0; '>
                    <strong>Name:</strong>
                    <!--Reema Patel-->
                    <?php echo $firstname. " ". $lastname; ?>
                </p>
                <p style='margin: 1em 0; '>
                    <strong>E-mail:</strong>
                    <!--rep.narola@narolainfotech.com-->
                    <?php echo $email; ?>
                </p>
                <hr>
                <p style='margin: 1em 0; '>
                    Please click this link to enter your password:
                    <br>
                    <br>
                    <a href="<?php
                       echo base_url() . 'home/verify?' .
                       'key=' . urlencode('http://dev.supportticket.com/home/verify?key='.$email);
                       ?>"
                       style="padding: 6px 20px;display:inline-block;color:#fff;text-decoration: none; background-color: #555;border-bottom: 3px solid #000;border-radius: 20px;font-size: 16px;line-height: 16px; text-transform: uppercase;"
                       >Click me!</a>
                </p>
            </div>

            <div style="padding:30px; margin:0; text-align:center; background:#ddd;" >
                <p style="font-family:Arial, Helvetica, sans-serif; color:#666; font-size:13px; font-weight:400; line-height:16px; padding:0; margin:0 0 15px;">
                    CheckDaa 	&copy; 2016
                </p>
            </div>
        </div>
    </body>
</html>