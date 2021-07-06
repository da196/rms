<script text="javascript">
        $(document).ready(function(){  
              $('#evaluate_trends,#evaluate_quarter,#evaluate_year').select2({});

               // Color changes in the Trends 
               $('#evaluate_trends').on('change', function() {
                    var trends_Selected = $(this).find("option:selected"); 
                    
                    //color: #90ee90  ==> 1/9
                    //color: yellow   ==> 3/11/12
                    //color: #ffcccb  ==> 2/10
                         if(trends_Selected.val() == '1'){
                            $('#evaluate_trends').css("background-color","#008000");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '9'){
                            $('#evaluate_trends').css("background-color","#008000");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '3'){
                            $('#evaluate_trends').css("background-color","#feb204");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '11'){
                            $('#evaluate_trends').css("background-color","#feb204");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '12'){
                            $('#evaluate_trends').css("background-color","#feb204");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '2'){
                            $('#evaluate_trends').css("background-color","red");
                            $('#evaluate_trends').css("color","white");
                            $('#evaluate_trends').css("font-weight","bold");
                        }else{
                             $('#evaluate_trends').css("background-color","red");
                             $('#evaluate_trends').css("color","white");
                             $('#evaluate_trends').css("font-weight","bold");
                        }  
                });  
                /* INHERENT ANALYSIS CALCULATION
                $('#impact_score').on('change', function() {
                    var impact_Selected = $(this).find("option:selected");
                    var impact_score = parseInt(impact_Selected.val());
                    $('#temp_impact_score').val(impact_score); 

                    var lik_score =  parseInt($('#temp_likehood').val());
                    var magnitude = (impact_score * lik_score); 
                    if(isNaN(magnitude)){
                         magnitude = 0;
                    }   

                    if((1 <= magnitude) && (magnitude <= 7)){
                        $('#magnitude').val("Normal/Low - " + magnitude)
                    .css("background","#90ee90")
                    .css("font-weight","bold");
                    }else if((8 <= magnitude) && (magnitude <= 14)){
                        $('#magnitude').val("Moderate - " + magnitude)
                    .css("background","yellow")
                    .css("font-weight","bold");
                    }else{
                        $('#magnitude').val("Key - " + magnitude)
                    .css("background","#ffcccb")
                    .css("font-weight","bold");
                    }       
                   
                });

                $('#likehood').on('change', function() {
                    var likehood_Selected = $(this).find("option:selected");
                    var likehood =  parseInt(likehood_Selected.val()); 
                    $('#temp_likehood').val(likehood);  

                    var imp_score =  parseInt($('#temp_impact_score').val());
                    var magnitude = (imp_score * likehood);  
                    if(isNaN(magnitude)){
                         magnitude = 0;
                    } 
                    $('#hidden_magnitude').val(magnitude);  

                     if((1 <= magnitude) && (magnitude <= 7)){
                        $('#magnitude').val("Normal/Low - " + magnitude)
                    .css("background","#90ee90")
                    .css("font-weight","bold");
                    }else if((8 <= magnitude) && (magnitude <= 14)){
                        $('#magnitude').val("Moderate - " + magnitude)
                    .css("background","yellow")
                    .css("font-weight","bold");
                    }else{
                        $('#magnitude').val("Key - " + magnitude)
                    .css("background","#ffcccb")
                    .css("font-weight","bold");
                    }          
                });

                $('#eff_excontrols').on('change', function() {
                    var eff_excontrols_Selected = $(this).find("option:selected");
                    var eff_excontrols =  parseFloat(eff_excontrols_Selected.val()); 

                    $('#temp_eff_excontrols').val(eff_excontrols);

                    var magnitude =  parseFloat($('#hidden_magnitude').val());
                    var residual_score = Math.round(magnitude / eff_excontrols); 
                    if(isNaN(residual_score)){
                        residual_score = 0;
                    }  
                    $('#hidden_residual_score').val(residual_score);   

                    if((1 <= residual_score) && (residual_score <= 7)){
                        $('#residual_score').val("Low - " + residual_score)
                    .css("background","#90ee90")
                    .css("font-weight","bold");
                    }else if((8 <= residual_score) && (residual_score <= 14)){
                        $('#residual_score').val("Medium - " + residual_score)
                    .css("background","yellow")
                    .css("font-weight","bold");
                    }else{
                        $('#residual_score').val("High - " + residual_score)
                    .css("background","#ffcccb")
                    .css("font-weight","bold");
                    }         
                });
                */

                // ADD BUTTON IN CAUSES
                var counterA = 1;
                    $("#addCauses").click(function(e){
                    var newTextBoxDivA = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv' + counterA);
                            newTextBoxDivA.after().html('<div class="col-sm-11"> <textarea class="form-control" placeholder="Cause"  name="causes_textBoxs" '+	                                           
                                                    '" id="textbox' +counterA+'_"></textarea></div>'+                                             
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterA+ '" class="col-2 btn-xs btn-danger btn-remove-causes"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivA.appendTo("#toAddCauses");
                	counterA++;
                });


                // ADD BUTTON IN CAUSES REASON
                var maxField = 1;
                var counterReason = 1;
                    $("#addCausesReason").click(function(e){
                    if(counterReason <= maxFields){ 
                        var newTextBoxDivP = $(document.createElement('div'))
                                            .attr("id", 'TextBoxDivp' + counterReason);
                                            newTextBoxDivP.after().html('<div class="col-sm-11"> <textarea class="form-control" placeholder="Cause Reason"  name="causesReason_textBoxs" '+	                                           
                                                        '" id="textbox' +counterReason+'_"></textarea></div>'+                                             
                                                        '<div class="col-sm-1"><button name="remove" id="textbox' +counterReason+ '" class="col-2 btn-xs btn-danger btn-remove-causes-reason"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
                        newTextBoxDivP.appendTo("#toAddCausesReason");
                        counterReason++;
                    }
                });
                
                // REMOVE BUTTON IN CAUSES
                $(document).on('click', '.btn-remove-causes',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();

                });

                // REMOVE BUTTON IN CAUSES REASON
                $(document).on('click', '.btn-remove-causes-reason',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                    counterReason = counterReason-1;
                });

                // ADD BUTTON IN EVENTS
                   var counterB = 1;
                    $("#addEvents").click(function(e){
                    var newTextBoxDivB = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv2' + counterB);
                            newTextBoxDivB.after().html('<div class="col-sm-11"><textarea class="form-control" placeholder="Event" name="events_textBoxs" '+	                                           
                                                    '" id="textbox' +counterB+'_"></textarea></div>'+                           
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterB+ '" class="col-2 btn-xs btn-danger btn-remove-events"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivB.appendTo("#toAddEvents");
                	counterB++;
                });

                 // ADD BUTTON IN EVENTS REASON
                var maxFields = 1;
                var counterReasons = 1;
                    $("#addEventsReason").click(function(e){
                    if(counterReasons <= maxFields){ 
                        var newTextBoxDivW = $(document.createElement('div'))
                                            .attr("id", 'TextBoxDiv9' + counterReasons);
                                newTextBoxDivW.after().html('<div class="col-sm-11"> <textarea class="form-control" placeholder="Event Reason"  name="eventsReason_textBoxs" '+	                                           
                                                        '" id="textbox' +counterReasons+'_"></textarea></div>'+                                             
                                                        '<div class="col-sm-1"><button name="remove" id="textbox' +counterReasons+ '" class="col-2 btn-xs btn-danger btn-remove-events-reason"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
                        newTextBoxDivW.appendTo("#toAddEventsReason");
                        counterReasons++;
                    }
                });
               // REMOVE BUTTON IN EVENTS
                $(document).on('click', '.btn-remove-events',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                    counterReasons = counterReasons-1;
                });

                // REMOVE BUTTON IN EVENTS REASON
                $(document).on('click', '.btn-remove-events-reason',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                // ADD BUTTON IN CONSEQUENCES
                var counterC = 1;
                    $("#addConsequences").click(function(e){
                    var newTextBoxDivC = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv3' + counterC);
                            newTextBoxDivC.after().html('<div class="col-sm-11"><textarea class="form-control" placeholder="Consequences" name="cons_textBoxs" '+	                                           
                                                    '" id="textbox' +counterC+'_"></textarea></div>'+                                       
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterC+ '" class="col-2 btn-xs btn-danger btn-remove-consequences"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivC.appendTo("#toAddConsequences");
                	counterC++;
                });

                // ADD BUTTON IN CONSEQUENCES REASON
                var maxFieldsTo = 1;
                var counterReasonTo = 1;
                    $("#addConsequencesReason").click(function(e){
                    if(counterReasonTo <= maxFieldsTo){ 
                        var newTextBoxDivTo = $(document.createElement('div'))
                                            .attr("id", 'TextBoxDiv8' + counterReasonTo);
                                newTextBoxDivTo.after().html('<div class="col-sm-11"> <textarea class="form-control" placeholder="Consequence Reason"  name="consReason_textBoxs" '+	                                           
                                                        '" id="textbox' +counterReasonTo+'_"></textarea></div>'+                                             
                                                        '<div class="col-sm-1"><button name="remove" id="textbox' +counterReasonTo+ '" class="col-2 btn-xs btn-danger btn-remove-consequences-reason"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
                                newTextBoxDivTo.appendTo("#toAddConsequencesReason");
                        counterReasonTo++;
                    }
                });
               // REMOVE BUTTON IN CONSEQUENCES
                $(document).on('click', '.btn-remove-consequences',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                 // REMOVE BUTTON IN CONSEQUENCES REASON
                 $(document).on('click', '.btn-remove-consequences-reason',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                    counterReasonTo = counterReasonTo-1;
                });

                 // ADD BUTTON IN EXISTING CONTROLS
                 var counterD = 1;
                    $("#addExControls").click(function(e){
                    var newTextBoxDivD = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv4' + counterD);
                            newTextBoxDivD.after().html('<div class="col-sm-11"><textarea class="form-control" name="Excontrols_textBoxs" '+	                                           
                                                    '" id="textbox' +counterD+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterD+ '" class="col-2 btn-xs btn-danger btn-remove-ExControls"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivD.appendTo("#toAddExControls");
                	counterD++;
                });
               // REMOVE BUTTON IN EXISTING CONTROLS
                $(document).on('click', '.btn-remove-ExControls',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                  // ADD BUTTON IN ADDITIONAL CONTROLS
                  var counterE = 1;
                    $("#addADControls").click(function(e){
                    var newTextBoxDivE = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv5' + counterE);
                            newTextBoxDivE.after().html('<div class="col-sm-11"><textarea class="form-control" name="adControls_textBoxs" '+	                                           
                                                    '" id="textbox' +counterE+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterE+ '" class="col-2 btn-xs btn-danger btn-remove-consequences"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivE.appendTo("#toAddADControls");
                	counterE++;
                });
               // REMOVE BUTTON IN ADDITIONAL CONTROLS
                $(document).on('click', '.btn-remove-ADControls',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });
                 
                // Insert Risk Registry Data in the  Database
                $('#submit_Registry').click(function(){
                    var causes = [];     
                    var causes_reason = [];     
                    var events = [];    
                    var events_reason = [];             
                    var consequences = []; 
                    var consequences_reason = [];                   
                    var ex_controls = [];
                    var ad_controls = [];                   
                    //var impact_scale = $('#temp_impact_score').val();
                    //var likehood_scale = $('#temp_likehood').val();
                    //var eff_control_scale = $('#temp_eff_excontrols').val(); 

                    var remarks = $('#evaluate_remarks').val().trim(); 
                    var status = $('#evaluate_status').val().trim(); 
                    var trends = $('#evaluate_trends').val();                 
                    var quarter = $('#evaluate_quarter').val();
                    var year = $('#evaluate_year').val();

                    var registry_id = $('#registry_id').val();
                    var reporter_id = $('#reporter_id').val();          
                    /* Initializing array with list of objectives....
                    $.each($("input[name='objectives']:checked"), function(){
                        objectives.push($(this).val());
                    });
                    */      
                    // Initializing array with list of causes
                    $("textarea[name='causes_textBoxs']").each(function(){
                        causes.push(this.value);
                    });                

                    $("textarea[name='causesReason_textBoxs']").each(function(){
                        causes_reason.push(this.value);
                    });
                 
                    // Initializing array with list of events
                     $("textarea[name='events_textBoxs']").each(function(){
                        events.push(this.value);
                    });

                    $("textarea[name='eventsReason_textBoxs']").each(function(){
                        events_reason.push(this.value);
                    });
                   
                    // Initializing array with list of consequences
                    $("textarea[name='cons_textBoxs']").each(function(){
                        consequences.push(this.value);
                    });

                    $("textarea[name='consReason_textBoxs']").each(function(){
                        consequences_reason.push(this.value);
                    });
                   
                    // Initializing array with list of existing controls
                    $("textarea[name='Excontrols_textBoxs']").each(function(){
                        ex_controls.push(this.value);
                    });
                   
                    // Initializing array with list of existing controls
                    $("textarea[name='adControls_textBoxs']").each(function(){
                        ad_controls.push(this.value);
                    });


                    var causes = causes.filter(item => item);
                    var causes_reason = causes_reason.filter(item => item);
                  
                    var events = events.filter(item => item);
                    var events_reason = events_reason.filter(item => item);
                    
                    var consequences = consequences.filter(item => item);
                    var consequences_reason = consequences_reason.filter(item => item);
                  
                    // start Checks if all the additional causes, events and consequences have reasons.
                    if(causes.length >= 1){
                        if(causes_reason.length > 0 == '' ){
                            swal(" ", "Sorry add a reason for on the additional causes!", "error");                                    
                            return false;
                        }
                    }
                    //alert(causes_reason.length);

                    if(causes_reason.length >= 1){
                        if(causes.length > 0 == '' ){
                            swal(" ", "Sorry a reason should have additional cause!", "error");                                    
                            return false;
                        }
                    }
              
                    if(events.length >= 1){
                        if(events_reason.length > 0 == '' ){
                            swal(" ", "Sorry add a reason for on the additional events!", "error");                                    
                            return false;
                        }
                    }

                    if(events_reason.length >= 1){
                        if(events.length > 0 == '' ){
                            swal(" ", "Sorry a reason should have  additional event!", "error");                                    
                            return false;
                        }
                    }

                    if(consequences.length >= 1){
                        if(consequences_reason.length > 0 == '' ){
                            swal(" ", "Sorry add a reason for on the additional consequences!", "error");                                    
                            return false;
                        }
                    }

                    if(consequences_reason.length >= 1){
                        if(consequences.length > 0 == '' ){
                            swal(" ", "Sorry add a reason for on the additional consequences!", "error");                                    
                            return false;
                        }
                    }
                    // end Checks 

                    // Start Checks of the input empty fields
                    if(status.trim().length > 0 == '' ){
                        swal(" ", "Status is required!", "error");                                    
                        return false;
                    }

                    if(remarks.trim().length > 0 == '' ){
                        swal(" ", "Remarks is required!", "error");                                    
                        return false;
                    }

                    if(trends.trim() > 0 == '' ){
                        swal(" ", "Trends is required!", "error");                                    
                        return false;
                    }

                    if(quarter.trim() > 0 == '' ){
                        swal(" ", "Quarter is required!", "error");                                    
                        return false;
                    }

                    if(year.trim() > 0 == '' ){
                        swal(" ", "Year is required!", "error");                                    
                        return false;
                    } 
                    //End checks
                                                       
                   $.ajax({
                        url:"<?php echo base_url();?>registry/registry_update",
                        method:"POST",
                        data:{
 
                            registry_id:registry_id,
                            causes:causes,
                            causes_reason:causes_reason,
                            events:events,

                            events_reason:events_reason,
                            consequences:consequences,
                            consequences_reason:consequences_reason,

                            reporter_id:reporter_id,                          
                            ex_controls:ex_controls,
                            ad_controls:ad_controls,
                         
                            remarks:remarks,
                            status:status,
                            trends:trends,
                            quarter:quarter,
                            year:year
                            },
                        success:function(msg){
                            var test = JSON.parse(msg);

                            if(test.Status_code == 404){ 
                                swal(" ", test.Message, "error"); 
                            }                   
                            else if(test.Status_code == 200){   
                                swal({title:"",text:test.Message, type: "success"},
                                function(){ 
                                    window.location = "<?php echo base_url(); ?>registry/view";
                                });
                            }
                            else{                                                       
                                swal(" ", test.Message, "error"); 
                            }                                                                                                 
                        },
                        error:function(){
                            swal({title:"",text:"No Risk Register was evaluated!", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                 
                        }
                   });
                });


                    // START DELETE DURING THE EDIT PROCESS
                       

                    // Delete Registry Causes
                    $('.delete_cause').click(function(event){
                        event.preventDefault();
                        var id = $(this).attr("id");
                        var reg_id = $(this).attr("data-id");

                        swal({
                            title: " Reason for deletion ",
                            text: " Write a reason for cause deletion: ",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "Type here..."
                            }, function (inputValue) {
                            // Onclick cancel button
                            if (inputValue === false) return false;
                            // Onclick ok button
                            if (inputValue === "") {
                                swal.showInputError("Sorry, you need to write reason!");
                                return false;
                            }
                            window.location = "<?php echo base_url(); ?>registry/delete_registry_causes/"+id+"/"+reg_id+"/"+inputValue; 
                            swal(" ", "You have successfully deleted the cause", "success");
                        });
                       
                    });


                // Delete Registry Events
                $('.delete_event').click(function(event){
                    event.preventDefault();
                    var id = $(this).attr("id");
                    var reg_id = $(this).attr("data-id");

                    swal({
                            title: " Reason for deletion ",
                            text: " Write a reason for event deletion: ",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "Type here..."
                            }, function (inputValue) {
                            // Onclick cancel button
                            if (inputValue === false) return false;
                            // Onclick ok button
                            if (inputValue === "") {
                                swal.showInputError("Sorry, you need to write reason!");
                                return false;
                            }
                            window.location = "<?php echo base_url(); ?>registry/delete_registry_events/"+id+"/"+reg_id+"/"+inputValue; 
                            swal(" ", "You have successfully deleted the event", "success");
                        });

                        
                });

                // Delete Registry Consequences
                $('.delete_consequence').click(function(event){
                    event.preventDefault();
                    var id = $(this).attr("id");
                    var reg_id = $(this).attr("data-id");
                    swal({
                            title: " Reason for deletion ",
                            text: " Write a reason for consequence deletion: ",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "Type here..."
                            }, function (inputValue) {
                            // Onclick cancel button
                            if (inputValue === false) return false;
                            // Onclick ok button
                            if (inputValue === "") {
                                swal.showInputError("Sorry, you need to write reason!");
                                return false;
                            }
                            window.location = "<?php echo base_url(); ?>registry/delete_registry_consequences/"+id+"/"+reg_id+"/"+inputValue; 
                            swal(" ", "You have successfully deleted the consequences", "success");
                        });
                });


                // Delete Registry EX_Controls
                $('.delete_excontrol').click(function(event){
                    event.preventDefault();
                    var id = $(this).attr("id");
                    var reg_id = $(this).attr("data-id");
                    if(confirm(" Do you want to delete this Registry Existing Control ? ")){
                        window.location = "<?php echo base_url(); ?>registry/delete_registry_excontrols/"+id+"/"+reg_id;
                    }else{
                        window.location.reload(); 
                    }
                });


                // Delete Registry AD_Controls
                 $('.delete_adcontrol').click(function(event){
                    event.preventDefault();
                    var id = $(this).attr("id");
                    var reg_id = $(this).attr("data-id");
                    if(confirm(" Do you want to delete this Registry Additional Control ? ")){
                        window.location = "<?php echo base_url(); ?>registry/delete_registry_adcontrols/"+id+"/"+reg_id;
                    }else{
                        window.location.reload(); 
                    }
                });


                // END DELETE DURING THE EDIT PROCESS
               
          });
    </script>


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
