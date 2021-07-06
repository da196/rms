<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERMS | 404 Error</title>
    <link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>
        <div class="error-desc">
            Sorry, the page you are looking for has not been found <br/>            
            <b>Click the below button to return to home page.</b><br/>
            <button class="btn btn-success" type="submit">
                <a href="<?php echo base_url();?>login/logout" style="color:white;">Home page</a>
            </button>           
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?=base_url()?>public/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
</body>
</html>
