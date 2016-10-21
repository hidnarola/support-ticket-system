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
        <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/forms/validation/validate.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/styling/uniform.min.js"></script>

        <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/login_validation.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/form_validation.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/ui/ripple.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/validation/validate.min.js"></script>
        <!-- /theme JS files -->

    </head>

    <body class="login-container login-cover">

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
