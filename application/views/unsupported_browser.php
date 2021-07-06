<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsupported Browser</title>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ERMS STYLES -->
    <link href="<?=base_url()?>public/css/erms_style.css" rel="stylesheet">
    <!-- End  ALL CSS Files --> 
</head>
 <body class="gray-bg" oncontextmenu="return true;">

     <div class="loginColumns animated fadeInDown">
         <div class="row">
            <div class="col-md-12" class="text-center">
                <div class="text-center">
                   <img src="<?php echo base_url(); ?>public/img/logo.png" class="img-fluid rounded mx-auto d-block" alt="TCRA Logo">
                </div>
            </div>

             <div class="col-md-12" >  
                <div class = 'unsupported-desktop-browser text-center'>
                    <h2 class = 'unsupported-desktop-browser__title text-center'>
                        It looks like you're using a browser we don't fully support.
                    </h2>
                    <p class ='unsupported-desktop-browser__description text-center'>
                        We recommend to try with the latest version of&nbsp;
                        <a
                            className = 'unsupported-desktop-browser__link'
                            href = 'https://www.google.com/chrome/'
                            target='_blank'>Chrome</a>&nbsp;or&nbsp;
                        <a
                            class = 'unsupported-desktop-browser__link'
                            href = 'https://www.mozilla.org/en-US/firefox/new/'
                            target='_blank'>Firefox</a>&nbsp;or&nbsp;
                        <a
                            class = 'unsupported-desktop-browser__link'
                            href = 'https://www.microsoft.com/en-us/edge/'
                            target='_blank'>Microsoft Edge</a>
                    </p>
                </div>
             </div>
         </div>
         <hr/>
         <div class="row">
             <div class="col-md-12 text-center">
                 &copy;  Tanzania Communications Regulatory Authority <script>document.write(new Date().getFullYear())</script>. All Rights Reserved
             </div>
         </div>
     </div>
 </body>
<!-- START ALL JS FILES HERE --> 
        <!-- Mainly scripts -->
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
                    swal("", "Sorry the email you provided, doesnot end with @tcra.go.tz", "error");                                     
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
        //alert(getSection);
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
                var newTextBoxDiv = $(document.createElement('div'))
                                    .attr("id", 'TextBoxDiv' + counter);
                        newTextBoxDiv.after().html('<div class="col-sm-10"> <textarea class="form-control" name="Cons_textBoxs" '+                                             
                                                '" id="textbox' +counter+'_"></textarea></div>'+
                                                '<div class="col-sm-2"><button name="remove" id="textbox' +counter+ '" class="col-2 btn-xs btn-danger btn-remove"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
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
                    newTextBoxDiv.after().html('<div class="col-sm-10"><textarea class="form-control" name="Mtg_textBoxs" '+                                               
                                            '" id="Mit_textbox' +counter+'_"></textarea></div>'+
                                            '<div class="col-sm-2"><button name="remove" id="Mit_textbox' +counter+ '" class="col-2 btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
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
