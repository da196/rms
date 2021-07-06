<script text="javascript">
        $(document).ready(function(){   
                // COLOR CHANGES IN TRENDS   == [Constant:3, Upward:1 and Downward: 2]
                $('#trends').on('change', function() {
                    var trends_Selected = $(this).find("option:selected"); 
                    
                        if(trends_Selected.val() == '1'){
                            $('#trends').css("background-color","#008000");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '9'){
                            $('#trends').css("background-color","#008000");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '3'){
                            $('#trends').css("background-color","#feb204");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '11'){
                            $('#trends').css("background-color","#feb204");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '12'){
                            $('#trends').css("background-color","#feb204");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else if(trends_Selected.val() == '2'){
                            $('#trends').css("background-color","red");
                            $('#trends').css("color","white");
                            $('#trends').css("font-weight","bold");
                        }else{
                             $('#trends').css("background-color","red");
                             $('#trends').css("color","white");
                             $('#trends').css("font-weight","bold");
                        }   
                });


                // INHERENT ANALYSIS CALCULATION
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
                        .css("background","#008000")
                        .css("font-weight","bold");
                    }else if((8 <= magnitude) && (magnitude <= 14)){
                        $('#magnitude').val("Moderate - " + magnitude)
                        .css("background","#feb204")
                        .css("font-weight","bold");
                    }else{
                        $('#magnitude').val("Key - " + magnitude)
                        .css("background","red")
                        .css("color","white")
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
                        .css("background","#008000")
                        .css("font-weight","bold");
                    }else if((8 <= magnitude) && (magnitude <= 14)){
                        $('#magnitude').val("Moderate - " + magnitude)
                        .css("background","#feb204")
                        .css("font-weight","bold");
                    }else{
                        $('#magnitude').val("Key - " + magnitude)
                    .css("background","red")
                    .css("color","white")
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
                        .css("background","#008000")
                        .css("color","white")
                        .css("font-weight","bold");
                    }else if((8 <= residual_score) && (residual_score <= 14)){
                        $('#residual_score').val("Medium - " + residual_score)
                        .css("background","#feb204")
                        .css("color","white")
                        .css("font-weight","bold");
                    }else{
                        $('#residual_score').val("High - " + residual_score)
                        .css("background","red")
                        .css("color","white")
                        .css("font-weight","bold");
                    }         
                });

                // ADD BUTTON IN CAUSES
                var counterA = 1;
                    $("#addCauses").click(function(e){
                    var newTextBoxDivA = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv' + counterA);
                            newTextBoxDivA.after().html('<div class="col-sm-11"> <textarea class="form-control" name="causes_textBoxs" '+	                                           
                                                    '" id="textbox' +counterA+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterA+ '" class="btn-xs btn-danger btn-remove-causes"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivA.appendTo("#toAddCauses");
                	counterA++;
                });

                
                // REMOVE BUTTON IN CAUSES
                $(document).on('click', '.btn-remove-causes',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                // ADD BUTTON IN EVENTS
                   var counterB = 1;
                    $("#addEvents").click(function(e){
                    var newTextBoxDivB = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv2' + counterB);
                            newTextBoxDivB.after().html('<div class="col-sm-11"><textarea class="form-control" name="events_textBoxs" '+	                                           
                                                    '" id="textbox' +counterB+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterB+ '" class="btn-xs btn-danger btn-remove-events"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivB.appendTo("#toAddEvents");
                	counterB++;
                });
               // REMOVE BUTTON IN EVENTS
                $(document).on('click', '.btn-remove-events',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                // ADD BUTTON IN CONSEQUENCES
                var counterC = 1;
                    $("#addConsequences").click(function(e){
                    var newTextBoxDivC = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv3' + counterC);
                            newTextBoxDivC.after().html('<div class="col-sm-11"><textarea class="form-control" name="cons_textBoxs" '+	                                           
                                                    '" id="textbox' +counterC+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterC+ '" class="btn-xs btn-danger btn-remove-consequences"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDivC.appendTo("#toAddConsequences");
                	counterC++;
                });
               // REMOVE BUTTON IN EVENTS
                $(document).on('click', '.btn-remove-consequences',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                 // ADD BUTTON IN EXISTING CONTROLS
                 var counterD = 1;
                    $("#addExControls").click(function(e){
                    var newTextBoxDivD = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv4' + counterD);
                            newTextBoxDivD.after().html('<div class="col-sm-11"><textarea class="form-control" name="Excontrols_textBoxs" '+	                                           
                                                    '" id="textbox' +counterD+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterD+ '" class="btn-xs btn-danger btn-remove-ExControls"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
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
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counterE+ '" class="btn-xs btn-danger btn-remove-consequences"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
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
                    
                    var activity = $('#activity').val().trim();
                    var risk_category = $('#risk_category').val();
                    var objectives = [];
                    var causes = [];
                    var events = [];
                    var consequences = [];
                    var ex_controls = [];
                    var ad_controls = [];  
                    var riskOwner_id = $('#riskOwner_id').val();                 
                    var impact_scale = $('#temp_impact_score').val();
                    var likehood_scale = $('#temp_likehood').val();
                    var eff_control_scale = $('#temp_eff_excontrols').val();    

                    var remarks = $('#remarks').val().trim(); 
                    var status = $('#status').val().trim();
                    var trends = $('#trends').val();                 
                    var quarter = $('#quarter').val();
                    var year = $('#year').val();

                    var reporter_id = $('#reporter_id').val(); 



                    // Initializing array with list of objectives....
                    $.each($("input[name='objectives']:checked"), function(){
                        objectives.push($(this).val());
                    });
                           
                    // Initializing array with list of causes
                    $("textarea[name='causes_textBoxs']").each(function(){
                        causes.push(this.value);
                    });
                 
                    // Initializing array with list of events
                     $("textarea[name='events_textBoxs']").each(function(){
                        events.push(this.value);
                    });
                   
                    // Initializing array with list of consequences
                    $("textarea[name='cons_textBoxs']").each(function(){
                        consequences.push(this.value);
                    });
                   
                    // Initializing array with list of existing controls
                    $("textarea[name='Excontrols_textBoxs']").each(function(){
                        ex_controls.push(this.value);
                    });
                   
                    // Initializing array with list of existing controls
                    $("textarea[name='adControls_textBoxs']").each(function(){
                        ad_controls.push(this.value);
                    });


                    // Start check if empty
                    if(activity.trim().length > 0 == '' ){
                        swal(" ", "Activity/Risk Name is required!", "error");                                    
                        return false;
                    }
                    if(risk_category.trim() > 0 == '' ){
                        swal(" ", "Risk Category is required!", "error");                                    
                        return false;
                    }
                    if(riskOwner_id.trim() > 0 == '' ){
                        swal(" ", "Risk Owner is required!", "error");                                    
                        return false;
                    }
                    
                    if(objectives.length > 0 == '' ){
                        swal(" ", "Affected Objective(s) is/are required!", "error");                                    
                        return false;
                    }
                    if(causes.length > 0 == '' ){
                        swal(" ", "Cause is required!", "error");                                    
                        return false;
                    }
                    if(events.length > 0 == '' ){
                        swal(" ", "Event is required!", "error");                                    
                        return false;
                    }
                    if(consequences.length > 0 == '' ){
                        swal(" ", "Consequence is required!", "error");                                    
                        return false;
                    }

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
                    // End check if empty

                                      
                   $.ajax({
                        url:"<?php echo base_url();?>registry/registry_insert",
                        method:"POST",
                        data:{
                            activity:activity,
                            risk_category:risk_category,
                            riskOwner_id:riskOwner_id,
                            objectives:objectives,
                            causes:causes,
                            events:events,
                            reporter_id:reporter_id,
                            consequences:consequences,
                            ex_controls:ex_controls,
                            ad_controls:ad_controls,
                            impact_scale:impact_scale,
                            likehood_scale:likehood_scale,
                            eff_control_scale:eff_control_scale,

                            remarks:remarks,
                            trends:trends,
                            status:status,
                            quarter:quarter,
                            year:year
                            },
                        success:function(msg){
                            swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location = "<?php echo base_url(); ?>registry/view";
                                });
                        },
                        error:function(){
                            swal({title:"",text:"No Risk Register was Assessed!", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                                                                       
                        }
                   });
                });
          });
    </script>

<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
