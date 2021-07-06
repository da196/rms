
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // KEY RISK INDICATOR
      // *************************************
      
      $('#add_button_keyriskindicators').click(function(){  
           $('#keyriskindicators_form')[0].reset();  //reset form
           $('.modal-title').text("Add Key Risk Indicator");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_keyriskindicators = $('#keyriskindicators_data').DataTable({  //Initialize datatable
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
      
      $(document).on('submit', '#keyriskindicators_form', function(event){  
           event.preventDefault();  
           //var directorate = $('#directorate').val();  
           var risk_owner = $('#risk_owner').val();  
           var objective_id = $('#objective_id').val(); 
           var main_activity = $('#main_activity').val();  
           var key_performance_indicator = $('#key_performance_indicator').val();  
           var description = $('#description').val(); 
           //var risk_measurement = $('#risk_measurement').val(); 
           var kri_green_definition = $('#kri_green_definition').val(); 
           var kri_amber_definition = $('#kri_amber_definition').val(); 
           var kri_red_definition = $('#kri_red_definition').val(); 
           
           //directorate != '' &&
           if( risk_owner != '' && objective_id != ''&& main_activity != '' && key_performance_indicator != ''&& description != '' && kri_green_definition != ''  && kri_amber_definition != '' && kri_red_definition != '')  
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
                            title: "Good job!",
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
                alert("All Fields are Required");  
           }  
      });  

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
                       //alert(data);  
                       swal("Deleted!", data, "success");
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
      


      // var resultDataTable = $('#keyriskindicators_data').DataTable({
      //    'responsive': true,
      //    'dom': 'Bfrtip',
      //    // 'buttons': [
      //    //    'excel', 'pdf'
      //    // ],
      //    'buttons': [
      //      { extend: 'excelHtml5',

      //        text : '<i class="fa fa-file-excel-o"> Excel</i>'
      //      },
      //      {
      //          extend : 'pdfHtml5',
      //          customize: function (doc) {
      //              doc.content[1].table.widths = 
      //                  Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                 

      //              doc.styles = {
      //                    subheader: {
      //                        fontSize: 10,
      //                        bold: true,
      //                        color: 'black'
      //                    },
      //                    tableHeader: {
      //                        bold: true,
      //                        fontSize: 10.5,
      //                         background: 'grey',
      //                        //alignment: 'center'
      //                        color: 'black'
      //                    },
      //                    lastLine: {
      //                        bold: true,
      //                        fontSize: 11,
      //                        color: 'blue'
      //                    },
      //                    defaultStyle: {
      //                        fontSize: 10,
      //                        color: 'black'
      //                    }
      //              }
      //            },
               
      //          orientation : 'landscape',
      //          pageSize : 'legal',
      //          text : '<i class="fa fa-file-pdf-o"> PDF</i>',
      //          titleAttr : 'PDF',
      //          exportOptions: {
      //                              columns: ':visible'
      //                          }
      //      }
      //    ],
      //   'paging': true,
      //   'ordering': true,
      //   'processing': true,
      //   'serverSide': true,
      //   'serverMethod': 'post',
      //   'searching': false, // Remove default Search Control
      //   // 'ajax': {
      //   //    "url":"<?php echo base_url().'Risk/emergingRiskList'; ?>",  
      //   //    "data": function(data){    //custom search fields  
      //   //       data.reporter_id = $('#reporter_id').val();
      //   //       data.status_id = $('#status_id').val();
      //   //       data.startDate = $('#startDate').val();
      //   //       data.endDate = $('#endDate').val();
      //   //    }
      //   // },
      //   // 'columns': [ //specify the key names to be read on successful callback...display on form
      //   //    { data: 'name' },
      //   //    { data: 'reporter_id' },
      //   //    { data: 'date_reported' },
      //   //    { data: 'status_id' },
      //   // ]
      // });


  });
</script> 


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>