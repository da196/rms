
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // KEY RISK INDICATOR - ASSESS
      // *************************************    

      var dataTable_keyriskindicators = $('#keyriskindicators_data').DataTable({  //Initialize datatable
          dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
          pagingType: 'full_numbers',
          "processing":true,  
          "stateSave": true,
          "serverSide":true,  
         // "order":[],  //removes initially enabled "order" on a table
          "ajax":{  
               url:"<?php echo base_url().'KeyRiskIndicator/fetch_assess'; ?>",  
               type:"POST"  
          } 
          //"rowReorder": true,
          // "order": [[ 3, "desc" ]],
          // "columnDefs":[  
          //       { orderable: true, className: 'reorder', targets: 1 },
          //       { orderable: false, targets: '_all' },
          //       {  
          //           "targets":[8],
          //           "orderable":false,  
          //           "searchable":false  
          //       },  
          // ],  
      });  
      
      $(document).on('submit', '#keyriskindicators_form', function(event){  
           event.preventDefault();  
           // var directorate = $('#directorate').val();  

           var risk_owner = $('#risk_owner').val();  
           //$("#risk_owner").prop('disabled', 'false');

           var objective_id = $('#objective_id').val(); 
           //alert(objective_id);

           var main_activity = $('#main_activity').val(); 
           //alert(main_activity);

           var key_performance_indicator = $('#key_performance_indicator').val();  
           var resources = $('#resources').val(); 
           //var risk_measurement = $('#risk_measurement').val(); 
           var kri_green_definition = $('#kri_green_definition').val(); 
           var kri_amber_definition = $('#kri_amber_definition').val(); 
           var kri_red_definition = $('#kri_red_definition').val(); 

           var year = $('#year').val(); 
           var quarter = $('#quarter').val(); 

           var kri_green_assessment = $('#kri_green_assessment').val(); 
           var kri_amber_assessment = $('#kri_amber_assessment').val(); 
           var kri_red_assessment = $('#kri_red_assessment').val(); 

           if(kri_green_assessment == '' && kri_amber_assessment == '' && kri_red_assessment == ''){ 
             swal({title:"",text:"Fill only one of the Risk Measurement to proceed", type: "error"});
             return false;
           }
     
           if(year == ''){ 
             swal({title:"",text:"Please select year", type: "error"});
             return false;
           }

           if(quarter == ''){ 
             swal({title:"",text:"Please select quarter", type: "error"});
             return false;
           }

           // if all 3 are filled..block
           if(kri_green_assessment != '' && kri_amber_assessment != '' && kri_red_assessment != ''){ 
             swal({title:"",text:"Fill only one of the Risk Measurement to proceed", type: "error"});
             return false;
           }
           // if  2 are field..block
           if((kri_green_assessment!='' && kri_amber_assessment!='') || (kri_green_assessment!='' && kri_red_assessment!='') || (kri_amber_assessment!='' && kri_red_assessment!='')){
              swal({title:"",text:"Fill only one of the Risk Measurement to proceed", type: "error"});
              return false;
           }  

            //directorate != '' &&   
           if(risk_owner != '' && objective_id != '' && main_activity != '' && key_performance_indicator != ''&& resources != '' && kri_green_definition != ''  && kri_amber_definition != '' && kri_red_definition != '')  
           {  
             
                $.ajax({  
                     url:"<?php echo base_url().'keyRiskIndicator/action'?>",  
                     method:'POST',  
                     data:new FormData(this), //sends data from form inform of key-> value pairs 
                     //data: { risk_owner: risk_owner} ,
                     // data: { risk_owner: risk_owner,main_activity:main_activity,key_performance_indicator:key_performance_indicator,description:description,kri_green_definition:kri_green_definition,kri_amber_definition:kri_amber_definition,kri_red_definition:kri_red_definition} ,
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {   
                        swal({title:"",text:data, type: "success"},
                           function(){ 
                               $('#keyriskindicators_form')[0].reset(); // reset form fields 
                               $('#keyriskindicatorsModal').modal('hide');  // hide modal
                               dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
                           }
                        );  
                     }  
                });  
           }  
           else  
           {  
                alert("All Fields are Required");  
           }  
      });  


      $(document).on('click', '.assesskeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one_assess'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {   
                     $('#keyriskindicatorsModal').modal('show');  
                     // $('#directorate').val(data.directorate); 

                     $("select#risk_owner").prop('disabled', true); 
                     $('#risk_owner').val(data.risk_owner); 
                    

                     //console.log(data.objective_id);
                     for (var i = 0; i < data.objective_id.length; i++) {
                         objective_id = data.objective_id[i];
                         $('input[type="checkbox"][value="'+objective_id+'"]#objective_id'). attr("checked", "checked");
                     }
                     //$('input[type="checkbox"][value=21]#objective_id'). attr("checked", "checked");
                     $("input#objective_id").prop('disabled', true);


                     $('#main_activity').val(data.main_activity);
                     $("textarea#main_activity").prop('disabled', true);
                     
                     $('#key_performance_indicator').val(data.key_performance_indicator); 
                     $("textarea#key_performance_indicator").prop('disabled', true);
                     
                     $('#resources').val(data.resources);  
                     $("textarea#resources").prop('disabled', true);
                     // $('#risk_measurement').val(data.risk_measurement); 
                     $('#kri_green_definition').val(data.kri_green_definition);
                     $("textarea#kri_green_definition").prop('disabled', true); 
                     $('#kri_amber_definition').val(data.kri_amber_definition); 
                     $("textarea#kri_amber_definition").prop('disabled', true);
                     $('#kri_red_definition').val(data.kri_red_definition); 
                     $("textarea#kri_red_definition").prop('disabled', true);


                     $('.previousassessment').hide(); //BY DEFAULT ITS HIDDENS
                     if(data.isYearPresent == true){
                        var container = $('<div />');
                        $('.previousassessment').show(); //SHOW DIV
                          for (var j = 0; j < data.alldata.length; j++) { 
                              if(data.alldata[j]["quarter"]==1){ var quarter='One'; }
                              else if(data.alldata[j]["quarter"]==4) { var quarter='Two'; }
                              else if(data.alldata[j]["quarter"]==8){ var quarter='Three'; }
                              else if(data.alldata[j]["quarter"]==9) { var quarter='Four'; }
                              else { var quarter='Error'; }
                              var overallhtml = '<div class="panel-group" id="accordion"><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'+j+'">'+data.alldata[j]["year"]+' - Quarter '+quarter+'</a></h4></div><div id="collapse'+j+'" class="panel-collapse collapse"><div class="panel-body"><div class="row"><div class="col-md-12"><div class="col-md-4"><label style="color:green;">Acceptable Level</label><textarea disabled class="form-control" rows="2" style="background:green; color: white;">'+data.alldata[j]["green"]+'</textarea></div><div class="col-md-4"><label style="color:#ffbf00;">Beyond Acceptable Level</label><textarea disabled class="form-control"  rows="2" style="background:#ffbf00; color: white;">'+data.alldata[j]["amber"]+'</textarea></div><div class="col-md-4"><label style="color:red;">Unacceptable Level</label><textarea disabled class="form-control"rows="2" style="background:red; color: white;">'+data.alldata[j]["red"]+'</textarea></div></div></div></div></div></div>';
                              container.append(overallhtml);                                                   
                        } 
                        $('.outer-accordion').html(container);                          
                     }
                     
                     $('.modal-title').text("Assess Key Risk Indicator");  
                     $('#keyriskindicators_id').val(keyriskindicators_id);   
                     $('#action').val("Assess"); //assign value to input with action ID
                }  
           })  
      });    

      // removes programmed checked ticks on closing the modal ...at present quick fixed it via reloading entire page
      $(document).on('click', '.closebtn', function(){  
        //$('input[type="checkbox"]#objective_id').prop("checked",false);
        //dataTable_keyriskindicators.ajax.reload();  // reload datatable without page refresh
         location.reload();
      }); 

      $(document).on('click', '.viewkeyriskindicators', function(){  
           var keyriskindicators_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'KeyRiskIndicator/fetch_one_assess'; ?>",  
                method:"POST",  
                data:{keyriskindicators_id:keyriskindicators_id},  
                dataType:"json",  
                success:function(data)  
                {                         
                     //disable all form inputs using form id
                     $("#keyriskindicators_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     // $("#keyriskindicators_form_viewonly input[name='directorate']").val(data.directorateNAME);
                     $("#keyriskindicators_form_viewonly input[name='risk_owner']").val(data.risk_owner);
                     $("#keyriskindicators_form_viewonly textarea[name='objective_id']").val(data.objectiveNAME);
                     $("#keyriskindicators_form_viewonly textarea[name='main_activity']").val(data.main_activity);
                     $("#keyriskindicators_form_viewonly textarea[name='key_performance_indicator']").val(data.key_performance_indicator);
                     $("#keyriskindicators_form_viewonly textarea[name='resources']").val(data.description);
                     // $("#keyriskindicators_form_viewonly textarea[name='risk_measurement']").val(data.risk_measurement);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_green_definition']").val(data.kri_green_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_amber_definition']").val(data.kri_amber_definition);
                     $("#keyriskindicators_form_viewonly textarea[name='kri_red_definition']").val(data.kri_red_definition);

                     // $("#keyriskindicators_form_viewonly textarea[name='kri_green_value']").val(data.kri_green_value);
                     // $("#keyriskindicators_form_viewonly textarea[name='kri_amber_value']").val(data.kri_amber_value);
                     // $("#keyriskindicators_form_viewonly textarea[name='kri_red_value']").val(data.kri_red_value);
                     $('.modal-title').text("Key Risk Indicator");  
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