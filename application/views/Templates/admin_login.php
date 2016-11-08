        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Ticket - <?php echo $title; ?></title>
        <base href="<?php echo base_url(); ?>">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/style.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/admin/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand">
               <i class="icon-ticket position-left"></i>
                Support Ticket System
            </a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

            <!-- Page content -->
            <div class="page-content">
                <?php echo $body; ?>
            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

    </body>
</html>
