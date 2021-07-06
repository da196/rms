
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // KEY RISK INDICATOR
      // *************************************
      
      //CREATE BUTTON TO POPULATE A MODAL
      // $('#add_button_keyriskindicators').click(function(){  
      //      $('#keyriskindicators_form')[0].reset();  //reset form
      //      $('.modal-title').text("Add Key Risk Indicator");  //modal title
      //      //$('#submit').val("Add");  //assign value to input with submit ID, Button value
      //      $('#action').val("Add"); //assign value to input with action ID
      // })  

      //PULL AND DISPLAY DATA VIA AJAX
      // var dataTable_keyriskindicators = $('#keyriskindicators_data').DataTable({  //Initialize datatable
      //     "processing":true,  
      //     "stateSave": true,
      //     "serverSide":true,  
      //    // "order":[],  //removes initially enabled "order" on a table
      //     "ajax":{  
      //          url:"<?php echo base_url().'KeyRiskIndicator/fetch'; ?>",  
      //          type:"POST"  
      //     },  
      //     "rowReorder": true,
      //     // "order": [[ 3, "desc" ]],
      //     "columnDefs":[  
      //           { orderable: true, className: 'reorder', targets: 1 },
      //           { orderable: false, targets: '_all' },
      //           {  
      //               "targets":[8],
      //               "orderable":false,  
      //               "searchable":false  
      //           },  
      //     ],  
      // });  

      $('#risk_owner').select2({});

      //SUBMIT DATA VIA AJAX AND REDIRECT VIA - SAVE AS DRAFT BUTTON
      $("#saveasdraft").button().click(function(){ 
          $(document).on('submit', '#keyriskindicators_form', function(event){  
               event.preventDefault();            
               //var directorate = $('#directorate').val();  
               //if SUBMIT button is submitted,SAVEASDRAFT action as added
               $('#action').val('SaveAsDraft'); 
               var risk_owner = $('#risk_owner').val();
               if(risk_owner.trim().length > 0  == ''){
                   swal("", "Risk Owner is required!", "error");      //there is an issue when one gets an error wakati ana-submit..duplicate entries mtu akipata this error message                              
                   //die("");  
                   return false;            
               }

               // var objective_id = $('#objective_id').val(); 
               // if(objective_id.trim().length > 0  == ''){
               //     swal("", "Strategic Objective is required!", "error");                                    
               //     //die("");  
               //     return false;                
               // }



               var main_activity = $('#main_activity').val();  
               var key_performance_indicator = $('#key_performance_indicator').val();  
               var description = $('#description').val(); 
               //var risk_measurement = $('#risk_measurement').val(); 
               var kri_green_definition = $('#kri_green_definition').val(); 
               var kri_amber_definition = $('#kri_amber_definition').val(); 
               var kri_red_definition = $('#kri_red_definition').val(); 
               
               //directorate != '' &&              
                $.ajax({  
                     url:"<?php echo base_url().'keyRiskIndicator/action'?>",  
                     method:'POST',  
                     data:new FormData(this), //sends data from form inform of key-> value pairs 
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                        //on success on swal success button click
                        //1.reset form 2.redirect 3. reload view page
                        swal({title:"",text:data, type: "success"},
                           function(){ 
                               $('#keyriskindicators_form')[0].reset(); // reset form fields                        
                               window.location = "<?php echo base_url().'keyRiskIndicator/view'?>";
                               dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                           }
                        );                        
                     }  
                }); 
          });  
      }); 

      //SUBMIT DATA VIA AJAX AND REDIRECT - VIA SUBMIT BUTTON
      $("#submit").button().click(function(){  
          $(document).on('submit', '#keyriskindicators_form', function(event){  
      
             event.preventDefault(); 
             //var directorate = $('#directorate').val();  
             //if SUBMIT button is submitted,ADD action as added
             $('#action').val('Add'); 
             var risk_owner = $('#risk_owner').val();
             if(risk_owner.trim().length > 0  == ''){
                 swal("", "Risk Owner is required!", "error");                                    
                 //die("");  
                 return false;                
             }

             checked = $("input[type=checkbox]#objective_id:checked").length;
             if(!checked){
                swal("", "At least one Strategic Objective is required!", "error");                                    
                //die("");  
                return false;  
             }
             // var objective_id = $('#objective_id').val(); 
             // if(objective_id.trim().length > 0  == ''){
             //     swal("", "Strategic Objective is required!", "error");                                    
             //     //die("");  
             //     return false;                
             // }

             var main_activity = $('#main_activity').val();
             if(main_activity.trim().length > 0  == ''){
                 swal("", "Main Activity is required!", "error");                                    
                 //die("");  
                 return false;                
             }
             var key_performance_indicator = $('#key_performance_indicator').val();  
             if(key_performance_indicator.trim().length > 0  == ''){
                 swal("", "Key performance Indicator is required!", "error");                                    
                 //die("");  
                 return false;                
             }
             var resources = $('#resources').val(); 
             if(resources.trim().length > 0  == ''){
                 swal("", "Resources are required!", "error");                                    
                 //die("");  
                 return false;                
             }
             //var risk_measurement = $('#risk_measurement').val(); 
             var kri_green_definition = $('#kri_green_definition').val();
             if(kri_green_definition.trim().length > 0  == ''){
                 swal("", "Green is required!", "error");                                    
                 //die("");  
                 return false;                
             } 
             var kri_amber_definition = $('#kri_amber_definition').val(); 
             if(kri_amber_definition.trim().length > 0  == ''){
                 swal("", "Amber is required!", "error");                                    
                 //die("");  
                 return false;                
             }
             var kri_red_definition = $('#kri_red_definition').val(); 
             if(kri_red_definition.trim().length > 0  == ''){
                 swal("", "Red is required!", "error");                                    
                 //die("");  
                 return false;                
             }
             
             //directorate != '' &&  && objective_id != ''
             if( risk_owner != '' && objective_id != '' && main_activity != '' && key_performance_indicator != ''&& resources != '' && kri_green_definition != ''  && kri_amber_definition != '' && kri_red_definition != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url().'keyRiskIndicator/action'?>",  
                       method:'POST',  
                       data:new FormData(this), //sends data from form inform of key-> value pairs 
                       contentType:false,  
                       processData:false,  
                       success:function(data)  
                       {  
                          //on success on swal success button click
                          //1.reset form 2.redirect 3. reload view page
                          swal({title:"",text:data, type: "success"},
                             function(){ 
                                 $('#keyriskindicators_form')[0].reset(); // reset form fields                        
                                 window.location = "<?php echo base_url().'keyRiskIndicator/view'?>";
                                 dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                             }
                          );                        
                       }  
                  });  
             }  
             else  
             {  
                  //alert("All Fields are Required");
                  swal("", "All Fields are Required!", "error");  
             }  
          });  
      });       
      

      //POPS UP UPDATE MODAL
      $(document).on('click', '.updatekeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 
           
           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#keyriskindicatorsModal').modal('show');  
                     //$('#directorate').val(data.directorate);  
                     $('#risk_owner').val(data.risk_owner); 
                     $('#objective_id').val(data.objective_id);  
                     $('#main_activity').val(data.main_activity);  
                     $('#key_performance_indicator').val(data.key_performance_indicator); 
                     $('#description').val(data.description);  
                     // $('#risk_measurement').val(data.risk_measurement); 
                     $('#kri_green_definition').val(data.kri_green_definition); 
                     $('#kri_amber_definition').val(data.kri_amber_definition); 
                     $('#kri_red_definition').val(data.kri_red_definition); 
                     $('.modal-title').text("Edit Key Risk Indicator");  
                     $('#keyriskindicators_id').val(keyriskindicators_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      }); 

      //POPS UP DELETE MODAL
      //Soft Delete
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
                       //alert(data);   //swal("Deleted!", data, "success");
                       swal("", data, "success");
                       dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      //Actual Deletion
      // $(document).on('click', '.deletekeyriskindicators', function(){  
      //      var keyriskindicators_id = $(this).attr("id"); //id from delete button 
      //      swal({
      //          title: "Are you sure?",
      //          text: "Once deleted, you will not be able to recover this data!",
      //          type: "warning",
      //          icon: "warning",
      //          showCancelButton: true,
      //          confirmButtonColor: "#DD6B55",
      //          confirmButtonText: "Yes, delete it!",
      //          closeOnConfirm: false
      //      }, function () {
      //          $.ajax({  
      //               url:"<?php echo base_url(); ?>KeyRiskIndicator/delete_one",  
      //               method:"POST",  
      //               data:{keyriskindicators_id:keyriskindicators_id}, 
      //               success:function(data)  
      //               {  
      //                  //alert(data);  
      //                  swal("Deleted!", "Selected Key Risk Indicator has been deleted.", "success");
      //                  dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
      //               }  
      //          });                 
      //      });           
      // }); 

      //POPS UP A MODAL FOR VIEWING CONTENT
      $(document).on('click', '.viewkeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {                         
                     //disable all form inputs using form id
                     $("#keyriskindicators_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     //$("#keyriskindicators_form_viewonly input[name='directorate']").val(data.directorateNAME);
                     $("#keyriskindicators_form_viewonly input[name='risk_owner']").val(data.risk_owner);
                     $("#keyriskindicators_form_viewonly textarea[name='objective_id']").val(data.objectiveNAME);
                     $("#keyriskindicators_form_viewonly textarea[name='main_activity']").val(data.main_activity);
                     $("#keyriskindicators_form_viewonly textarea[name='key_performance_indicator']").val(data.key_performance_indicator);
                     $("#keyriskindicators_form_viewonly textarea[name='description']").val(data.description);
                     // $("#keyriskindicators_form_viewonly textarea[name='risk_measurement']").val(data.risk_measurement);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_green_definition']").val(data.kri_green_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_amber_definition']").val(data.kri_amber_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_red_definition']").val(data.kri_red_definition);
                     $('.modal-title').text("View Key Risk Indicator");  
                     $('#keyriskindicatorsModal_L').modal('show');  
                }  
           })  
      }); 


      // REPORTS FUNCTIONALITIES
      var dataTable_keyriskindicators_report = $('#keyriskindicators_data_report').DataTable({  //Initialize datatable
          'dom': 'Bfrtip',
          'buttons': [
             'excel', 'pdf'
          ],
          "processing":true,  
          "stateSave": true,
          "serverSide":true,  
         // "order":[],  //removes initially enabled "order" on a table
          "ajax":{  
               url:"<?php echo base_url().'KeyRiskIndicator/fetch'; ?>",  
               type:"POST"  
          },  
          "rowReorder": true,
          // "order": [[ 3, "desc" ]],
          "columnDefs":[  
                { orderable: true, className: 'reorder', targets: 1 },
                { orderable: false, targets: '_all' },
                {  
                    "targets":[8],
                    "orderable":false,  
                    "searchable":false  
                },  
          ],  
      });        


  });
</script> 


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>