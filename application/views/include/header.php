<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= TITLE_TAG; ?></title>

    <link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    
    <link href="<?=base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"> -->

    <!-- Sweet Alert -->
    <link href="<?=base_url()?>public/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="<?=base_url()?>public/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
   <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->

   

    <!-- Toastr style -->
    <link href="<?=base_url()?>public/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?=base_url()?>public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?=base_url()?>public/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/style.css" rel="stylesheet">


    <!-- FOR SEARCHABLE SELECT OPTION TAGS -->
    <!--   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="<?=base_url()?>public/css/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- ERMS STYLES -->
    <link href="<?=base_url()?>public/css/erms_style.css" rel="stylesheet">

    <!-- Force Logout users if users are inactive for a certain period of time -->
    <script type="text/javascript">
        var timer = 0;
        function set_interval() {
          // the interval 'timer' is set as soon as the page loads
          timer = setInterval("auto_logout()", 3600000); //1hr on milliseconds
          // the figure '3600000' above indicates how many milliseconds the timer be set to.
          // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
          // So set it to 300000(30 seconds)
        }
        function reset_interval() {
          //resets the timer. The timer is reset on each of the below events:
          // 1. mousemove   2. mouseclick   3. key press 4. scroliing
          //first step: clear the existing timer
          if (timer != 0) {
            clearInterval(timer);
            timer = 0;
            // second step: implement the timer again
            timer = setInterval("auto_logout()", 3600000);//1hr on milliseconds
            // completed the reset of the timer
          }
        }
        function auto_logout() {
            window.location.href = "<?php echo base_url('login/logout')?>";
        }
    </script>
</head>
<body oncontextmenu="return false;" 
onload="set_interval()"
onmousemove="reset_interval()"
onclick="reset_interval()"
onkeypress="reset_interval()"
onscroll="reset_interval()">

<div id="wrapper"> 

    <!-- include sibebar -->
    <?php
          $this->load->view('include/sidebar');
    ?>

    <!-- include topbar -->
    <?php
          $this->load->view('include/topbar');
    ?>
      