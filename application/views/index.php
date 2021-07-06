<!DOCTYPE html>
<html>
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <title><?php //echo $title; ?></title> -->
    <title><?= TITLE_TAG; ?></title>

    <!-- Start ALL CSS Files --> 
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
    <!-- End  ALL CSS Files --> 

    <!-- FAQ STYLE -->
    <style>
        .accordion_faq {
          background-color: #eee;
          color: #444;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
          transition: 0.4s;
        }
        .active_faq, .accordion_faq:hover {
          background-color: #ccc;
        }
        .accordion_faq:after {
          content: '\002B';
          color: #777;
          font-weight: bold;
          float: right;
          margin-left: 5px;
        }
        .active_faq:after {
          content: "\2212";
        }
        .panel_faq {
          padding: 0 18px;
          background-color: white;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.2s ease-out;
        }
    </style>
</head>
 <body class="gray-bg" oncontextmenu="return false;">
     <div class="loginColumns animated fadeInDown">
         <div class="row">
             <div class="col-md-6" class="text-center">                     
                 <div class="text-center">
                    <h2 class="font-bold">Welcome to <?=APPLICATION_NAME_ABBREVIATION; ?></h2>
                 </div>
                 <div class="text-center">
                    <img src="<?php echo base_url(); ?>public/img/logo.png" class="img-fluid rounded mx-auto d-block" alt="TCRA Logo">
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="ibox-content">
                     <form class="m-t" method="post"  action="<?php echo base_url()?>login/login_validation">
                         <div class="form-group">
                             <input type="text" name="username" class="form-control" placeholder="Username"></br> 
                             <?php if(form_error("username")) {?>
                                 <div class="alert alert-danger "><b> <?php echo form_error("username");?></b></div>
                             <?php } ?>
                         </div>
                         <div class="form-group">
                             <input type="password" name="password" class="form-control" placeholder="Password"></br>
                             <?php if(form_error("password")) {?>
                                 <div class="alert alert-danger "><b> <?php echo form_error("password");?> </b></div>
                             <?php } ?>               
                         </div>
                         <button type="submit" class="btn btn-success block full-width m-b"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Login</button></br>
                             <?php if($this->session->flashdata("error")) {?>
                                 <div class="alert alert-danger "><b> <?php echo $this->session->flashdata("error");?></b></div>
                             <?php } ?>   
                         <p class="text-muted text-center"><small>Do you want to  report a new risk?</small></p>
                         <a class="btn btn-sm btn-white btn-block" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal" >
                             <b><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;Report a risk</b>
                         </a>
                        <br/>
                         <p class="text-muted text-center"><small>Do you want to  report a new incident?</small></p>
                         <a class="btn btn-sm btn-white btn-block" class="btn btn-primary" data-toggle="modal" data-target="#incidentExampleModal" >
                             <b><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;Report an incident</b>
                         </a>
                         <div id="success"></div>
                     </form>
                    </br>

                     <!-- Start User Manual and FAQ -->
                    <div class="row">
                        <div class="col-md-4">  
                            <a href="<?php echo base_url(); ?>public/erms_doc/System_User_Guide.pdf" class="btn btn-xs" download>
                                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;User Guide 
                            </a>
                           <!--  <a  href="#" class="btn btn-xs">
                                <i class="fa fa-book" aria-hidden="true"></i>User Guide 
                            </a> -->
                        </div>
                        <div class="col-md-8">
                            <a data-toggle="modal" href="#faqmodal" class="btn btn-xs">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Frequently Asked Questions 
                            </a>                                                                       
                        </div>
                    </div>
                    <!-- End User Manual and FAQ --> 
                 </div>
             </div>
         </div>
         <hr/>
         <div class="row">
             <div class="col-md-12 text-center">
                 &copy;&nbsp;Tanzania Communications Regulatory Authority <script>document.write(new Date().getFullYear())</script>. All Rights Reserved
             </div>
         </div>
     </div>
 </body>


<!-- Start Risk Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
               <button type="button" class="close" data-dismiss="modal">&times;</button>  
               <h4 class="modal-title" id="exampleModalLabel">Report New Risk</h4> 
            </div> 
            <div class="modal-body">  
                <div class="form-group" id="risk_modal_body_id"><!-- Make Unknown user as:  6 -->
                    <label><strong>Risk Name&nbsp;<span class="text-danger">*</span></label> </strong></label>
                    <textarea name="name" id="name" class="form-control"></textarea> 
                    <label><strong>Source of the risk&nbsp;<span class="text-danger">*</span></label> </strong></label>
                    <textarea name="information_source"  id="information_source" class="form-control"></textarea>                        
                    <label><strong>Risk Detail&nbsp;<span class="text-danger">*</span></label></strong></label>
                    <textarea name="remarks"  id="remarks"  class="form-control"></textarea>                        
                    <label><strong>Responsible Officer&nbsp;</strong></label>
                    <select class="form-control"  name="responsible_officer" id="responsible_officer" style="width: 100%">
                        <option class="form-control" value=" ">-- Select --</option>
                        <?php 
                        foreach($list_responsible_officers->result() as $row){
                            $fullname = $row->first_name .' '. $row->middle_name .'  '.$row->last_name. ' - '.$row->designation; 
                            ?>                         
                        <option class="form-control" value="<?php echo $row->id; ?>"> <?php echo $fullname; ?> </option>
                        <?php } ?>
                    </select></br>
                    <label for="feedback">Do you want any feedback ?&nbsp;<small style="color:grey;"><em> (Click the checkbox below)</em></small></label><br>
                    <input type="checkbox" id="test"/>
                        <div id="feedback_Prompt">
                            <label for="feedback_Prompt">Type your <em>Email Address</em>&nbsp;<span class="text-danger">* <small style="color:grey;"><em> (Email should end with @tcra.go.tz)</em></small></span></label></strong></label><br>
                            <input type="text" id="reporter_id" class="form-control" name="reporter_id" />
                        </div><br>
                        <!-- <button type="submit" id="report" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-check"></i> <b>Submit</b> </button>-->
                </div> 
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>CLOSE</b></button>
                <button type="submit" id="report" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-check"></i>&nbsp;<b>SUBMIT</b></button>   
            </div>
        </div>
    </div>
</div>
<!-- End Risk Modal -->



<!-- Start Incident Modal -->
<div class="modal fade" id="incidentExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">    
        <div class="modal-content">  
            <div class="modal-header">  
               <button type="button" class="close" data-dismiss="modal">&times;</button>  
               <h4 class="modal-title" id="exampleModalLabel">Report New Incident</h4> 
            </div> 
            <div class="modal-body">
                <!-- Start Modal Body Make Unknown user as:  6 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Incident</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Possible Consequences</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Possible Mitigation Proposals</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="tab-1" class="tab-pane active">
                                    <div class="panel-body">                                        
                                        <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="6"><!-- Reporter_id as 6 -->
                                        <div class="form-group" id="incident_modal_body_id">
                                            <div class="col-sm-6">
                                                <label><strong>Directorate&nbsp;<span class="text-danger">*</span></label> </strong></label>
                                                <select class="form-control"  name="directorate" id="directorate" style="width: 100%">
                                                    <option value=" "> -- Select -- </option>
                                                    <?php
                                                     foreach($list_directorate->result() as $row)
                                                      { ?>
                                                        <option value="<?php echo $row->id; ?>"> <?php echo $row->directorate_abbreviation; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label><strong>Section&nbsp;<span class="text-danger">*</span></label> </strong></label>
                                                <select class="form-control" name="section" id="section" style="width: 100%">
                                                    <option value=" ">-- Select --</option>
                                                </select>  
                                            </div>
                                            <div class="col-sm-12">
                                                <label><strong>Incident Description&nbsp;<span class="text-danger">*</span></label> </strong></label>
                                                <textarea name="description" id="description" class="form-control"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label><strong> Escalated to&nbsp;<span class="text-danger">*</span></label> </strong></label>
                                                <select class="form-control" name="esc_to" id="esc_to" style="width: 100%">
                                                    <option value=" "> -- Select -- </option>
                                                    <option value="RMU">RMU</option>
                                                    <option value="Risk Champion">Risk Champion</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                </select> 
                                            </div>                       
                                            <div class="col-sm-6">
                                                <label><strong> Officer's  Name&nbsp;<span class="text-danger">*</span></label> </strong></label>
                                                <select class="form-control" name="esc_to_success" id="esc_to_success" style="width: 100%">
                                                    <option value=" ">-- Select --</option>
                                                </select> 
                                            </div>                
                                        </div>
                                    </div>
                                </div>           
                                <div role="tabpanel" id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <label><strong>All Possible Consequences&nbsp;<span class="text-danger">*</span></label></strong>                      
                                        <button type="submit" id="addConsequences" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button>
                                        </br></br></br>
                                        <div id="toAddConsequences"><!-- <textarea name="consequences" id="consequences" class="form-control"></textarea> --></div>                      
                                    </div>
                                </div>          
                                <div role="tabpanel" id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <label><strong>All Possible Mitigation Proposals&nbsp;<span class="text-danger">*</span></strong></label>                       
                                        <button type="submit" id="addMitigation" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button>
                                        </br></br></br>
                                        <div id="toAddMitigation"><!-- <textarea  name="mitigations"  id="mitigations"  class="form-control"></textarea> --></div></br>
                                        <!-- <button type="submit" id="submitIncidence" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-check"></i>  <b> SUBMIT </b></button> -->
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>                                        
                </div>
            </div>
            <!-- End Modal Body--> 
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>CLOSE</b></button>
                <button type="submit" id="submitIncidence" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-check"></i>&nbsp;<b>SUBMIT</b></button>
            </div>
        </div>
    </div>
</div>
<!-- End Incident Modal -->




<!-- Start FAQ Model -->
<div class="modal inmodal fade" id="faqmodal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><img src="<?php echo base_url(); ?>public/img/faq.png" class="img-fluid rounded mx-auto d-block" width="10%" height="1%" alt="TCRA FAQ">Frequently Asked Questions</h4>
            </div>
            <div class="modal-body">
                <?php foreach($list_faq as $key => $faq){ ?>
                <button class="accordion_faq"><?php echo ($key+1).'. '. $faq->faq_question; ?></button>
                <div class="panel_faq">
                 <p><?php echo  $faq->faq_answer; ?></p>
                </div><br>
               <?php } ?>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End FAQ Model -->


<!-- START ALL JS FILES HERE --> 
<!-- Main scripts -->
<script src="<?=base_url()?>public/js/jquery-2.1.1.js"></script>
<script src="<?=base_url()?>public/js/popper.min.js"></script>
<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>public/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>      
<script src="<?=base_url()?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=base_url()?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Datatable -->
<script src="<?=base_url()?>public/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="<?=base_url()?>public/js/plugins/dataTables/datatables.min.js"></script>
<!--  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>    -->  

<!-- Flot -->
<script src="<?=base_url()?>public/js/plugins/flot/jquery.flot.js"></script>
<script src="<?=base_url()?>public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url()?>public/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?=base_url()?>public/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?=base_url()?>public/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="<?=base_url()?>public/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?=base_url()?>public/js/demo/peity-demo.js"></script>

<!-- FOR SEARCHABLE SELECT OPTION TAGS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
<script src="<?=base_url()?>public/js/plugins/select2/Select2_4.1.0.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url()?>public/js/inspinia.js"></script>
<script src="<?=base_url()?>public/js/plugins/pace/pace.min.js"></script>

<!-- Sweet alert -->
<script src="<?=base_url()?>public/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- jQuery UI -->
<script src="<?=base_url()?>public/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="<?=base_url()?>public/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="<?=base_url()?>public/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?=base_url()?>public/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="<?=base_url()?>public/js/plugins/chartJs/Chart.min.js"></script>


<!-- Toastr -->
<script src="<?=base_url()?>public/js/plugins/toastr/toastr.min.js"></script>

<!-- ERMS Scripts -->
<script src="<?=base_url()?>public/js/erms.js"></script>
<!-- END ALL JS FILES HERE -->



<script text="javascript">
    $(document).ready(function(){
        //SELECT2 on BOOTSTRAP MODALS
        $('#responsible_officer').select2({
            dropdownParent: $('#risk_modal_body_id')
        });
        $('#directorate').select2({
            dropdownParent: $('#incident_modal_body_id')
        });
        $('#section').select2({
            dropdownParent: $('#incident_modal_body_id')
        });
        $('#esc_to').select2({
            dropdownParent: $('#incident_modal_body_id')
        });
        $('#esc_to_success').select2({
            dropdownParent: $('#incident_modal_body_id')
        });


        //START  RISK
        // Start check box 
         $('#feedback_Prompt').hide();
         $('#test').change(function(){
            if($(this).prop('checked')){
                $('#feedback_Prompt').show();         
            }else{
                $('#feedback_Prompt').hide();   
            }
         });
        // End check box

        $('#report').click(function(event){
          event.preventDefault();
            var reporter = '';
            var name = $("#name").val().trim();         
            var information_source = $("#information_source").val().trim();
            var remarks = $("#remarks").val().trim();
            var responsible_officer = $("#responsible_officer").val();
            var reporter_id =  $("#reporter_id").val();


            // Start checks if the email ends with @tcra.go.tz
            if($('#test').prop('checked')){
                if(reporter_id.trim().length > 0 == ''){                     
                    swal("", "Please fill the email Address for feeback!", "error");                                     
                    return false;
                }

                const substring = "@tcra.go.tz";
                if(reporter_id.includes(substring)){
                   reporter = reporter_id;
                }else{
                    swal("", "Sorry the email you provided, does not end with @tcra.go.tz", "error");                                     
                    return false;
                }                  
            }
            // Ends checks if the email ends with @tcra.go.tz          
            if(name.trim().length > 0 == ''){  
                swal("", "Risk Name is required!", "error");                                     
                return false;              
            }
            if(information_source.trim().length > 0  == ''){
                swal("", "Source of the risk is required!", "error");                                     
                return false;
            }
            if(remarks.trim().length > 0 == ''){
                swal("", "Detail of the risk is required!", "error");                                     
                return false;
            }
            
            if(reporter_id.trim().length > 0 == ''){
                reporter = '6';
            }else{
                reporter = reporter_id;
            }    

            if(responsible_officer.trim().length > 0 == ''){
                responsible_officer = '227';
            }else{
                responsible_officer = responsible_officer;
            }

            //alert(reporter);     
                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url();?>risk/risk_public_insert",
                    data:{
                        name:name,
                        information_source:information_source,
                        remarks:remarks,
                        responsible_officer:responsible_officer,
                        reporter_id:reporter                         
                    },
                    success:function(msg){
                            swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location.reload();
                                });                                                                                            
                    },
                    error:function(){
                        swal({title:"",text:"Sorry the risk was not reported successfully!..", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                                                                                              
                    }
                });                     
        });
        //END  RISK


        //START INCIDENT
        // Get Risk Champion and Supervisor
        $('#esc_to').on('change', function(e){
            var getSection = $('#section').val();
            var getDirectorate = $('#directorate').val();

            var optionSelected = $(this).find("option:selected");
            var esc_to_val = optionSelected.val();
            
            if(esc_to_val == 'Supervisor'){
                esc_to_val = '10';
            }
            else if(esc_to_val == 'Risk Champion'){
                esc_to_val = '23';
            }else{
                // ESC USER AS RMU OFFICER
                esc_to_val = '7';    
            }
            $.ajax({
                type:"POST",
                url:"<?php echo base_url();?>incident/incident_get_escTo",
                data:{
                    esc_to_val:esc_to_val,
                    getSection:getSection,
                    getDirectorate:getDirectorate
                },
                success:function(msg){                           
                        var obj = JSON.parse(msg);
                        $('#esc_to_success').html('');
                        var content  = ' ';
                        $.each(obj, function(key, value) {                                   
                            content +='<option value="'+value.id+'">'+value.email.toUpperCase()+'</option>';
                        });
                        $('#esc_to_success').append(content);    
                },
                error:function(){
                        swal("", "Sorry, Supervisors/Champions  were not found!", "error");
                        return false;
                        window.location.reload();                                                                        
                }
            });                       
        });

        // Get Section in a choosen Directorate
        $('#directorate').on('change', function(e){
            var optionSelected = $(this).find("option:selected");
            var directorate_id = optionSelected.val();
            $.ajax({
                type:"POST",
                url:"<?php echo base_url();?>incident/incident_section_get",
                data:{
                    directorate_id:directorate_id
                },
                success:function(msg){                           
                        var obj = JSON.parse(msg);
                        $('#section').html('');
                        var content  = ' ';
                        $.each(obj, function(key, value) {
                            content +='<option value="'+value.id+'">'+value.section_name+'</option>';
                        });
                        $('#section').append(content);    
                },
                error:function(){
                        swal("", "The risk was not saved properly!", "error");
                        return false;
                        window.location.reload();                                                                                                        
                }
            });
        });

        // ADD BUTTON IN CONSEQUENCES
        var counter = 1;
        $("#addConsequences").click(function(e){
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div class="col-sm-10"> <textarea class="form-control" name="Cons_textBoxs" '+ '" id="textbox' +counter+'_"></textarea></div>'+'<div class="col-sm-2"><button name="remove" id="textbox' +counter+ '" class="col-2 btn-xs btn-danger btn-remove"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
            newTextBoxDiv.appendTo("#toAddConsequences");
            counter++;
        });
        // REMOVE BUTTON IN CONSEQUENCES
        $(document).on('click', '.btn-remove',function(){
            var btn = $(this).attr('id');
            $('#'+btn+'').remove();
            $('#'+btn+'_').remove();
        });

        // ADD BUTTON IN MITIGATION
        var counter = 1;
        $("#addMitigation").click(function(e){
            var newTextBoxDiv = $(document.createElement('div'))
                        .attr("id", 'TextBoxDiv2' + counter);
            newTextBoxDiv.after().html('<div class="col-sm-10"><textarea class="form-control" name="Mtg_textBoxs" '+'" id="Mit_textbox' +counter+'_"></textarea></div>'+'<div class="col-sm-2"><button name="remove" id="Mit_textbox' +counter+ '" class="col-2 btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
            newTextBoxDiv.appendTo("#toAddMitigation");
            counter++;
        });

       // REMOVE BUTTON IN MITIGATION
        $(document).on('click', '.btn-delete',function(){
            var btn = $(this).attr('id');
            $('#'+btn+'').remove();
            $('#'+btn+'_').remove();
        });
       
        // Insert Incidence Data in the  Database
        $('#submitIncidence').click(function(){
            var directorate = $('#directorate').val();
            var section = $('#section').val();
            var description = $('#description').val().trim();
            var esc_to = $('#esc_to').val();
            var esc_user  = $('#esc_to_success').val();
            var reporter_id = $('#reporter_id').val();
            var consequences = [];
            var mitigation = [];

            // Initializing array with list of consequences
            $("textarea[name='Cons_textBoxs']").each(function(){
                consequences.push(this.value);
            });

              // Initializing array with list of mitigation
              $("textarea[name='Mtg_textBoxs']").each(function(){
                mitigation.push(this.value);
            });


            // Start check if empty                
            if(directorate.trim().length > 0  == ''){
                swal("", "Directorate is required!", "error");
                return false;
            }

            if(section.trim().length > 0  == ''){
                swal("", "Section is required!", "error");
                return false;
            }

            if(description.trim().length > 0  == ''){
                swal("", "Incident Description is required!", "error");
                die(""); 
            }

            if(esc_to.trim().length > 0  == ''){
                swal("", "Escalation To is required!", "error");
                return false;
            }

            if(consequences.length > 0  == ''){
                swal("", "Consequences is required!", "error");
                return false;
            }

            if(mitigation.length > 0  == ''){
                swal("", "Consequences is required!", "error");
                return false;
            }
            // End check if empty

            if(reporter_id.trim().length > 0 == ''){
                reporter_id = '6';
            }else{
                reporter_id = reporter_id;
            } 

           $.ajax({
                url:"<?php echo base_url();?>incident/incident_insert",
                method:"POST",
                data:{
                    reporter_id:reporter_id,
                    directorate:directorate,
                    section:section,
                    esc_user:esc_user,
                    description:description,
                    esc_to:esc_to,
                    consequences:consequences,
                    mitigation:mitigation},
                success:function(msg){
                    swal({title:"",text:msg, type: "success"},
                        function(){ 
                            window.location.reload();
                        });                        
                },                    
                error:function(){
                    swal({title:"",text:"No Comment was inserted!", type: "error"},
                    function(){ 
                        window.location.reload();
                    });                                                                                            
                }
           });
        });
        //END INCIDENT


        // FAQ SCRIPTS
        var acc = document.getElementsByClassName("accordion_faq");
        var i;
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active_faq");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          });
        }
    });
</script>
</html>
