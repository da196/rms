
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // KEY RISK INDICATOR - VIEW
      // *************************************    

      // PULLS DATA VIA AJAX
      var dataTable_keyriskindicators = $('#keyriskindicators_data').DataTable({  //Initialize datatable
          dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
          pagingType: 'full_numbers',
          "processing":true,  
          "stateSave": true,
          "serverSide":true, 
         // "order":[],  //removes initially enabled "order" on a table
          "ajax":{  
               url:"<?php echo base_url().'KeyRiskIndicator/fetch_view'; ?>",  
               type:"POST"  
          }
          // "rowReorder": true,
          // "order": [[ 3, "desc" ]],
          // "columnDefs":[  
          //       { orderable: true, className: 'reorder', targets: 1 },
          //       { orderable: false, targets: '_all' },
          //       {  
          //           "targets":[8],
          //           "orderable":false,  
          //           "searchable":false  
          //       },  
          // ]
      });  


      // VIEW BUUTON
      $(document).on('click', '.viewkeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one_view'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {                         
                     //disable all form inputs using form id
                     $("#keyriskindicators_form_viewonly :input").prop('disabled', true);

                     //HIDE ASSESSMENT DIV
                     $( "#kri_assessment_div" ).hide();

                     //add value to form input using input name attribute
                     // $("#keyriskindicators_form_viewonly input[name='directorate']").val(data.directorateNAME);
                     $("#keyriskindicators_form_viewonly input[name='risk_owner']").val(data.risk_owner);

                     
                     $("#keyriskindicators_form_viewonly textarea[name='objective_id']").val(data.objectiveNAME);


                     $("#keyriskindicators_form_viewonly textarea[name='main_activity']").val(data.main_activity);
                     $("#keyriskindicators_form_viewonly textarea[name='key_performance_indicator']").val(data.key_performance_indicator);
                     $("#keyriskindicators_form_viewonly textarea[name='resources']").val(data.resources);
                     // $("#keyriskindicators_form_viewonly textarea[name='risk_measurement']").val(data.risk_measurement);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_green_definition']").val(data.kri_green_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_amber_definition']").val(data.kri_amber_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_red_definition']").val(data.kri_red_definition);

                     // var isAssessed = data.is_assessed;                     
                     // if(isAssessed == 1){
                     //    $("#keyriskindicators_form_viewonly textarea[name='kri_green_value']").val(data.kri_green_value);
                     //    $("#keyriskindicators_form_viewonly textarea[name='kri_amber_value']").val(data.kri_amber_value);
                     //    $("#keyriskindicators_form_viewonly textarea[name='kri_red_value']").val(data.kri_red_value);
                     //    //SHOW ASSESSMENT DIV ONCE ASSESSMENT IS DONE
                     //    $( "#kri_assessment_div" ).show();
                     // }

                     $('.previousassessment').hide(); //BY DEFAULT ITS HIDDENS
                     if(data.isYearPresent == true){
                        var container = $('<div />');
                        $('.previousassessment').show(); //SHOW DIV
                          for (var z= 0; z < data.alldata.length; z++) { 
                              if(data.alldata[z]["quarter"]==1){ var quarter='One'; }
                              else if(data.alldata[z]["quarter"]==4) { var quarter='Two'; }
                              else if(data.alldata[z]["quarter"]==8){ var quarter='Three'; }
                              else if(data.alldata[z]["quarter"]==9) { var quarter='Four'; }
                              else { var quarter='Error'; }
                              var overallhtml = '<div class="panel-group" id="accordion"><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'+z+'">'+data.alldata[z]["year"]+' - Quarter '+quarter+'</a></h4></div><div id="collapse'+z+'" class="panel-collapse collapse"><div class="panel-body"><div class="row"><div class="col-md-12"><div class="col-md-4"><label style="color:green;">Acceptable Level</label><textarea disabled class="form-control" rows="2" style="background:green; color: white;">'+data.alldata[z]["green"]+'</textarea></div><div class="col-md-4"><label style="color:#ffbf00;">Beyond Acceptable Level</label><textarea disabled class="form-control"  rows="2" style="background:#ffbf00; color: white;">'+data.alldata[z]["amber"]+'</textarea></div><div class="col-md-4"><label style="color:red;">Unacceptable Level</label><textarea disabled class="form-control"rows="2" style="background:red; color: white;">'+data.alldata[z]["red"]+'</textarea></div></div></div></div></div></div>';
                              container.append(overallhtml);                                                   
                          } 
                        $('.outer-accordion').html(container);                          
                     }




                     $('.modal-title').text("View Key Risk Indicator");  
                     $('#keyriskindicatorsModal_L').modal('show');  
                }  
           })  
      }); 

      // SUBMIT INSERT FORM
      $(document).on('submit', '#keyriskindicators_form', function(event){  
           event.preventDefault();  


            var risk_owner = $('#risk_owner').val();
            if(risk_owner.trim().length > 0  == ''){
                swal("", "Risk Owner is required!", "error");  
                return false;                
            }
            checked = $("input[type=checkbox]#objective_id:checked").length;
            if(!checked){
               swal("", "At least one Strategic Objective is required!", "error"); 
               return false;  
            }
            var main_activity = $('#main_activity').val();
            if(main_activity.trim().length > 0  == ''){
                swal("", "Main Activity is required!", "error");  
                return false;                
            }
            var key_performance_indicator = $('#key_performance_indicator').val();  
            if(key_performance_indicator.trim().length > 0  == ''){
                swal("", "Key performance Indicator is required!", "error"); 
                return false;                
            }
            var resources = $('#resources').val(); 
            if(resources.trim().length > 0  == ''){
                swal("", "Resources are required!", "error");
                return false;                
            }
            var kri_green_definition = $('#kri_green_definition').val();
            if(kri_green_definition.trim().length > 0  == ''){
                swal("", "Green is required!", "error"); 
                return false;                
            } 
            var kri_amber_definition = $('#kri_amber_definition').val(); 
            if(kri_amber_definition.trim().length > 0  == ''){
                swal("", "Amber is required!", "error");         
                return false;                
            }
            var kri_red_definition = $('#kri_red_definition').val(); 
            if(kri_red_definition.trim().length > 0  == ''){
                swal("", "Red is required!", "error");  
                return false;                
            }


           // var risk_owner = $('#risk_owner').val();  
           var objective_id = $('#objective_id').val(); 
           // var main_activity = $('#main_activity').val();  
           // var key_performance_indicator = $('#key_performance_indicator').val();  
           // var resources = $('#resources').val(); 
           // var kri_green_definition = $('#kri_green_definition').val(); 
           // var kri_amber_definition = $('#kri_amber_definition').val(); 
           // var kri_red_definition = $('#kri_red_definition').val(); 
           
           //directorate != '' &&
           if( risk_owner != '' && objective_id != ''&& main_activity != '' && key_performance_indicator != ''&& resources != '' && kri_green_definition != ''  && kri_amber_definition != '' && kri_red_definition != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'keyRiskIndicator/action'?>",  
                     method:'POST',  
                     data:new FormData(this), //sends data from form inform of key-> value pairs 
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                        //alert(data);  
                        swal({
                            title: "",
                            text: data,
                            type: "success"
                        });
                        $('#keyriskindicators_form')[0].reset(); // reset form fields 
                        $('#keyriskindicatorsModal').modal('hide');  // hide modal
                        dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                     }  
                });  
           }  
           else  
           {  
                //alert("All Fields are Required");
                swal({
                    title: "",
                    text: "All Fields are Required!",
                    type: "Danger"
                });  
           }  
      });  


      //COMPLETE BUTTON
      $(document).on('click', '.updatekeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 

           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {  
                  console.log(data);
                     $('#keyriskindicatorsModal').modal('show');  
                     //$('#directorate').val(data.directorate);  
                     $('#risk_owner').val(data.risk_owner); 

                     //$('#objective_id').val(data.objective_id); 
                     for (var i = 0; i < data.objective_id.length; i++) {
                         objective_id = data.objective_id[i];
                         $('input[type="checkbox"][value="'+objective_id+'"]#objective_id'). attr("checked", "checked");
                     } 


                     $('#main_activity').val(data.main_activity);  
                     $('#key_performance_indicator').val(data.key_performance_indicator); 
                     $('#resources').val(data.resources);  
                     // $('#risk_measurement').val(data.risk_measurement); 
                     $('#kri_green_definition').val(data.kri_green_definition); 
                     $('#kri_amber_definition').val(data.kri_amber_definition); 
                     $('#kri_red_definition').val(data.kri_red_definition); 
                     $('.modal-title').text("Complete Key Risk Indicator");  
                     $('#keyriskindicators_id').val(keyriskindicators_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      }); 

      //SOFT DELETE BUTTON
      $(document).on('click', '.softdeletekeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from Soft Delete button 
           var action = "SoftDelete";

           swal({
               title: "Are you sure?",
               text: "Once deleted, you will not be able to recover this data!",
               type: "warning",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }, function () {
               $.ajax({  
                    url:"<?php echo base_url().'KeyRiskIndicator/action'; ?>",  
                    method:"POST",  
                    data:{keyriskindicators_id:keyriskindicators_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 


  });
</script> 


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>