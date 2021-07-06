<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/natural.js"></script>

<!-- Start View the Registry Data -->
<script text="javascript">
    function viewRegistryFunction(reg_id){

        viewRegistryObjectives_Function(reg_id);
        viewRegistryCauses_Function(reg_id);
        viewRegistryEvents_Function(reg_id);
        viewRegistryConsequences_Function(reg_id);
        viewRegistryExcontrols_Function(reg_id);
        viewRegistryADControls_Function(reg_id);

        
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/view_registry",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){	
				document.getElementById('view_activity').value = msg.activity;
				document.getElementById('view_risk_category').value = msg.objective_category;
                document.getElementById('view_risk_owner').value = msg.name;

                
                document.getElementById('view_remarks').value = msg.rem;
                document.getElementById('view_status').value = msg.sts;
                document.getElementById('view_trends').value = msg.trend_name;

                document.getElementById('view_quarter').value = msg.qua;
                document.getElementById('view_year').value = msg.year;

                var trend =  msg.trends;
                var trend_elem = document.querySelector('#view_trends');

                    //alert(msg.trend_name);

                    //#ffcccb : RED AND #90ee90 : GREEN
                    if(trend == 2){
                        trend_elem.style.backgroundColor  = 'red';
                        trend_elem.style.color  = 'white';
                       
                    }
                    else if(trend == 3){
                        trend_elem.style.backgroundColor  = '#feb204';
                        trend_elem.style.color  = 'white';
                      
                    }
                    else if(trend == 1){
                        trend_elem.style.backgroundColor  = '#008000';
                        trend_elem.style.color  = 'white';
                        
                    }
                    else if(trend == 9){
                        trend_elem.style.backgroundColor  = '#008000';
                        trend_elem.style.color  = 'white';
                       
                    } 
                    else if(trend == 10){
                        trend_elem.style.backgroundColor  = 'red';
                        trend_elem.style.color  = 'white';
                        
                    } 
                    else if(trend == 11){
                        trend_elem.style.backgroundColor  = '#feb204';
                        trend_elem.style.color  = 'white';
                        
                    }else{
                        trend_elem.style.backgroundColor  = '#feb204';  
                        trend_elem.style.color  = 'white';
                                          
                    }


                document.getElementById('view_impact_score').value = msg.impact_scale;
                document.getElementById('view_like_hood_score').value = msg.like_hood_scale;
                // Risk Magnitude 
                var riskMagnitude = (parseInt(msg.impact_scale_id) * parseInt(msg.like_hood_scale_id));
                    document.getElementById('view_risk_magnitude').value = riskMagnitude;
                    var elem = document.querySelector('#view_risk_magnitude');

                    if((1 <= riskMagnitude) && (riskMagnitude <= 7)){
                        elem.style.backgroundColor  = '#008000';
                        elem.style.color  = 'white';
                        document.getElementById("view_risk_magnitude").value = "Normal / Low";
                    }
                    else if((8 <= riskMagnitude) && (riskMagnitude <= 14)){
                        elem.style.backgroundColor  = '#feb204';
                        elem.style.color  = 'white';
                        document.getElementById("view_risk_magnitude").value = "Moderate";
                    }else{
                        elem.style.backgroundColor  = 'red';
                        elem.style.color  = 'white';
                        document.getElementById("view_risk_magnitude").value = "Key";
                    }
              
				document.getElementById('view_eff_controls').value = msg.controls_effectiveness_scale;
                // Residual Risk Score
                var residualRiskScore = (parseInt(riskMagnitude) / parseInt(msg.controls_effectiveness_scale_id));
                    document.getElementById('view_residual_risk_score').value = residualRiskScore;
                    var New_elem = document.querySelector('#view_residual_risk_score');

                    if((1 <= residualRiskScore) && (residualRiskScore <= 7)){
                        New_elem.style.backgroundColor  = '#008000';
                        New_elem.style.color  = 'white';
                        document.getElementById("view_residual_risk_score").value = "Low";
                    }
                    else if((8 <= residualRiskScore) && (residualRiskScore <= 14)){
                        New_elem.style.backgroundColor  = '#feb204';
                        New_elem.style.color  = 'white';
                        document.getElementById("view_residual_risk_score").value = "Medium";
                    }else{
                        New_elem.style.backgroundColor  = 'red';
                        New_elem.style.color  = 'white';
                        document.getElementById("view_residual_risk_score").value = "High";
                    }
                
			}
		});
	}
</script>


<script text="javascript">
    // Start Get All Objectives  
    function viewRegistryObjectives_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_objectives",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var objectives = '';
                    objectives += '<ol>';
                    // Start loop here
                    for(var i = 0; i < msg.length; i++) {                       
                        objectives += '<li>'+ msg[i].name +'</li>';
                    }
                    // End Loop here
                    objectives += '</ol>';
                $('#list_objectives').html(objectives);																	          
			}
		});
	}
    // End Get All Objectives  

    // Start Get All Registry Causes
    function viewRegistryCauses_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_causes",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var cau = '';
                    cau += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        cau += '<li>'+ msg[i].causes +'</li>';
                    }               
                    // End Loop here
                    cau += '</ol>';
                $('#list_causes').html(cau);
			}
		});
	}
    // End Get All Registry Causes

    // Start Get All Registry Events
    function viewRegistryEvents_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_events",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var eve = '';
                    eve += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        eve += '<li>'+ msg[i].events +'</li>';
                    }               
                    // End Loop here
                    eve += '</ol>';
                $('#list_events').html(eve);
			}
		});
	}
    // End Get All Registry Events

    // Start Get All Registry Consequences
     function viewRegistryConsequences_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_consequences",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var cons = '';
                    cons += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        cons += '<li>'+ msg[i].consequences +'</li>';
                    }               
                    // End Loop here
                    cons += '</ol>';
                $('#list_consequences').html(cons);
			}
		});
	}
    // End Get All Registry Consequences

    // Start Get All Registry Existing Controls
    function viewRegistryExcontrols_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_excontrols",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var exco = '';
                    exco += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        exco += '<li>'+ msg[i].excontrols +'</li>';
                    }               
                    // End Loop here
                    exco += '</ol>';
                $('#list_excontrols').html(exco);
			}
		});
	}
    // End Get All Registry Consequences

    // Start Get All Registry Additional Controls
    function viewRegistryADControls_Function(reg_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>registry/registry_view_adcontrols",
			data:{
				reg_id:reg_id, 
				}, 
			success:function(msg){
                var adco = '';
                    adco += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        adco += '<li>'+ msg[i].adcontrols +'</li>';
                    }               
                    // End Loop here
                    adco += '</ol>';
                $('#list_adcontrols').html(adco);
			}
		});
	}

  
    // End Get All Registry Consequences
</script>
<!-- End View the Registry Data -->

<!-- Start Javascript here --->
<script text="javascript">
    // Soft delete 
    $(document).on('click', '.delete_risk_register', function(){  
           var risk_registry_id = $(this).attr("id");
           var user_id = $(this).data("userid");

           //alert(user_id); 
           swal({
               title:"Are you sure?",
               text: "Once deleted, you will not be able to recover this data!",
               type: "warning",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }, function () {
               $.ajax({  
                    url:"<?php echo base_url().'registry/delete_registry'; ?>",  
                    method:"POST",  
                    data:{risk_registry_id:risk_registry_id,user_id:user_id}, 
                    success:function(msg){
                            swal({title:"",text:"Risk Register has been deleted successfully", type: "success"},
                                function(){ 
                                    window.location.reload();
                                });
                        },
                        error:function(){
                            swal({title:"",text:"Sorry, Risk Register was not deleted successfully", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                                                                       
                        }  
               });                 
           });  
      });

    $(document).ready(function () {
        // STRATEGIC  RISK CATEGORY
        $('#dataTable_riskEmerge').DataTable({
            //"ordering": false
            dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
            pagingType: 'full_numbers',
            columnDefs: [ //Sort alphanumeric string using natural.js
              { type: 'natural', targets: 0 }
            ],
            order: [[ 0, 'asc' ]]
        });

        // OPERATIONAL RISK CATEGORY
        // $('#dataTable2_riskEmerge').DataTable({
        //     "ordering": false
        // });

        $('#dataTable2_riskEmerge').DataTable({
           //"ordering": false
           dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
           pagingType: 'full_numbers',
           columnDefs: [ //Sort alphanumeric string using natural.js
             { type: 'natural', targets: 0 }
           ],
           order: [[ 0, 'asc' ]]
        });

        // PROJECT RISK CATEGORY
        $('#dataTable3_riskEmerge').DataTable({
            //"ordering": false
            dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
            pagingType: 'full_numbers',
            columnDefs: [ //Sort alphanumeric string using natural.js
              { type: 'natural', targets: 0 }
            ],
            order: [[ 0, 'asc' ]]
        });

    });

</script>
<!-- End Javascript here --->

<!-- EDIT RISK REGISTER -->
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // UPDATE - RISK REGISTER
      // ************************************* 

      
      // $(document).on('submit', '#catalogseffectivenessscale_form', function(event){  
      //      event.preventDefault();  
      //      var controls_effectiveness_scale = $('#controls_effectiveness_scale').val();  
      //      var controls_effectiveness_scale_score = $('#controls_effectiveness_scale_score').val();  
      //      var color_code = $('#color_code').val();              
      //      console.log(color_code);
      //      if(controls_effectiveness_scale != '' && controls_effectiveness_scale_score != ''  && color_code != '')  
      //      {  
      //           $.ajax({  
      //                url:"<?php echo base_url().'CatalogsEffectivenessScale/action'?>",  
      //                method:'POST',  
      //                data:new FormData(this), //sends data from form inform of key-> value pairs 
      //                contentType:false,  
      //                processData:false,  
      //                success:function(data)  
      //                {  
      //                   //alert(data);  
      //                   swal({title: "",text: data,type: "success"});
      //                   $('#catalogseffectivenessscale_form')[0].reset(); // reset form fields 
      //                   $('#catalogseffectivenessscaleModal').modal('hide');  // hide modal
      //                   dataTable_catalogseffectivenessscale.ajax.reload();  // reload datatable without page refresh
      //                }  
      //           });  
      //      }  
      //      else  
      //      {  
      //           //("All Fields are Required");  
      //           swal({title: "",text: "All Fields are Required!",type: "error"});
      //      }  
      // });  





      $(document).on('click', '.edit-btn-risk-register', function(){  
           var risk_registry_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'Registry/edit_risk_register'; ?>",  
                method:"POST",  
                data:{risk_registry_id:risk_registry_id},  
                dataType:"json",  
                success:function(data)  
                {  
                    //console.log(data[0].registry_id);
                    //console.log(data[0].trends); 
                    //alert(data[0].list_events);

                    let title = "<i class='fa fa-edit'></i>&nbsp;Edit Risk Register";
                    //$('.modal-title').text(title);  //modal title
                    $('.modal-title').html(title);
                    $('#action').val("Edit-Risk-Register"); //assign value to input with action ID


                    $('#edit_activity').val(data[0].activity); 
                    $('#edit_registry_id').val(data[0].registry_id); 
                    $('#edit_objective_category').val(data[0].objective_category); 
                    $('#edit_directorate_id').val(data[0].riskowner); 

                    //PULL EVENTS
                    let toAddEvents = document.getElementById('toAddEvents'); 
                    let toAddEventsHTML = "";
                    let events_count = data[0].list_events.length;
                    for (let i = 0; i < events_count; i++) {
                     //console.log(data[0].list_events[i].id);                     
                     toAddEventsHTML +="<div class='col-md-12 topdiv'><div class='col-md-10'><textarea id='edit_consequences"+(i+1)+"' class='form-control' placeholder='Event Assessment' Required>"+data[0].list_events[i].events+"</textarea></div><div class='col-md-2' style='text-align: center; vertical-align: middle;'><button  style='text-align: center; vertical-align: middle;' data-id='"+(i+1)+"' class='btn btn-danger btn-remove-events' type='button'><i class='glyphicon glyphicon-remove'></i>&nbsp;ReMOVEove</button></div></div><br>";
                    }
                    toAddEvents.innerHTML = toAddEventsHTML;
                    $('#eventscount').val(events_count); //ADD EVENTS COUNT AS INPUT FIELD




                    //ADD EVENT
                    let toAddEventsHTMLNEW = "";
                    $("#addEvents").click(function(e){
                          e.preventDefault();
                          //GRAB VALUE FROM eventscount INPUT FIELD
                          let events_count = $('#eventscount').val();
                         
                          events_count++;

                          $('#eventscount').val(events_count);   
                          toAddEventsHTMLNEW +="<div class='col-md-12 topdiv'><div class='col-md-10'><textarea id='edit_consequences"+(events_count)+"' class='form-control' placeholder='Event Assessment' Required></textarea></div><div class='col-md-2' style='text-align: center; vertical-align: middle;'><button data-id='"+events_count+"' style='text-align: center; vertical-align: middle;' class='btn btn-danger btn-remove-events' type='button'><i class='glyphicon glyphicon-remove'></i>&nbsp;Remove</button></div></div><br>";              
                          toAddEvents.innerHTML += toAddEventsHTMLNEW; //APPEND THIS TO THE PREVIOUS INNERHTML
                          events_count = 0; //clear this variable coz its used on remove button
                    });
                    //console.log(toAddEventsHTMLNEW);





                    //REMOVE EVENT
                    $(document).on('click', '.btn-remove-events',function(){
                        let events_count = $('#eventscount').val();
                        let btnremoveevents_id = $(this).data("id"); //id from remove button 
                       // events_countNEWAGAIN--;
                        alert(events_count);
                        if(events_count>0){
                            $('#eventscount').val(events_count);                            
                            //alert(btnremoveevents_id);
                            $(this).closest('.topdiv').remove(); 
                        }else{
                            $('.btn-remove-events').data('id', btnremoveevents_id).prop('disabled', true);
                        }
                        events_count = 0; //clear this variable coz its used on remove button
                    });

                    //CLOSE EVENT ...RELOAD PAGE

                  





                    $('#edit_impact_score').val(data[0].impact_scale_id); 
                    $('#edit_likehood').val(data[0].like_hood_scale_id); 
                    $('#edit_magnitude').val(data[0].magnitude); 

                    $('#edit_eff_excontrols').val(data[0].controls_effectiveness_scale_id); 
                    $('#edit_residual_score').val(data[0].residual_risk_score); 
                    
                       
                     
                    $('#previous_remarks').val(data[0].remarks);                     
                    $('#previous_status').val(data[0].status);                    
                    $('#previous_trends').val(data[0].trends);                     
                    $('#previous_quarter').val(data[0].quarter);                     
                    $('#previous_year').val(data[0].year); 
                    
                    
                    

                }  
           }); 
      });     



      // $(document).on('click', '.viewcatalogseffectivenessscale', function(){  
      //      var catalogseffectivenessscale_id = $(this).attr("id"); //id from update button 
      //      $.ajax({  
      //           url:"<?php echo base_url().'CatalogsEffectivenessScale/fetch_one'; ?>",  
      //           method:"POST",  
      //           data:{catalogseffectivenessscale_id:catalogseffectivenessscale_id},  
      //           dataType:"json",  
      //           success:function(data)  
      //           {                           
      //              //disable all form inputs using form id
      //              $("#catalogseffectivenessscale_form_viewonly :input").prop('disabled', true);

      //              //add value to form input using input name attribute
      //              $("#catalogseffectivenessscale_form_viewonly input[name='controls_effectiveness_scale']").val(data.controls_effectiveness_scale);
      //              $("#catalogseffectivenessscale_form_viewonly input[name='controls_effectiveness_scale_score']").val(data.controls_effectiveness_scale_score);
      //              $("#catalogseffectivenessscale_form_viewonly input[name='color_code']").val(data.color_code);

      //              $('.modal-title').text("Control Effectiveness Rating Scale");  
      //              $('#catalogseffectivenessscaleModal_L').modal('show');   
      //           }  
      //      })  
      // }); 
  });
</script>


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>