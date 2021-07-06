
<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // RISK MATURITY MODEL
      // *************************************    
      $('#add_button_riskmaturitymodel').click(function(){  
           $('#riskmaturitymodel_form')[0].reset();  //reset form
           $('.modal-title').text("Add to Risk Maturity Model");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_riskmaturitymodel = $('#riskmaturitymodel_data').DataTable({  //Initialize datatable
           "processing":true,  
           "serverSide":true,  
           "order":[],  //removes initially enabled "order" on a table
           "ajax":{  
                url:"<?php echo base_url().'RiskMaturityModel/fetch'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
              {  
                   "targets":[0,2,3,4], // columns shown on datatable view
                   "orderable":false,  
              },  
           ],  
      });  
      
      $(document).on('submit', '#riskmaturitymodel_form', function(event){  
           event.preventDefault();  
           var reporting_unit = $('#reporting_unit').val();  
           var process_id = $('#process_id').val();  
           var risk_level_id = $('#risk_level_id').val(); 
           var risk_level_description = $('#risk_level_description').val(); 
           
           if(reporting_unit != '' && process_id != '' && risk_level_id != ''&& risk_level_description != '' )  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'RiskMaturityModel/action'?>",  
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
                        $('#riskmaturitymodel_form')[0].reset(); // reset form fields 
                        $('#riskmaturitymodelModal').modal('hide');  // hide modal
                        dataTable_riskmaturitymodel.ajax.reload();  // reload datatable without page refresh
                     }  
                });  
           }  
           else  
           {  
                alert("All Fields are Required");  
           }  
      });  

      $(document).on('click', '.updateriskmaturitymodel', function(){  
           var riskmaturitymodel_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'RiskMaturityModel/fetch_one'; ?>",  
                method:"POST",  
                data:{riskmaturitymodel_id:riskmaturitymodel_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#riskmaturitymodelModal').modal('show');  
                     $('#reporting_unit').val(data.reporting_unit);  
                     $('#process_id').val(data.process_id); 
                     $('#risk_level_id').val(data.risk_level_id);  
                     $('#risk_level_description').val(data.risk_level_description);
                     $('.modal-title').text("Edit Risk Maturity Model Record");  
                     $('#riskmaturitymodel_id').val(riskmaturitymodel_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      }); 

      //Soft Delete
      $(document).on('click', '.softdeleteriskmaturitymodel', function(){  
           var riskmaturitymodel_id = $(this).attr("id"); //id from Soft Delete button 
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
                    url:"<?php echo base_url().'RiskMaturityModel/action'; ?>",  
                    method:"POST",  
                    data:{riskmaturitymodel_id:riskmaturitymodel_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("Deleted!", data, "success");
                       dataTable_riskmaturitymodel.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      //Actual Deletion
      // $(document).on('click', '.deleteriskmaturitymodel', function(){  
      //      var riskmaturitymodel_id = $(this).attr("id"); //id from delete button 
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
      //               url:"<?php echo base_url(); ?>RiskMaturityModel/delete_one",  
      //               method:"POST",  
      //               data:{riskmaturitymodel_id:riskmaturitymodel_id}, 
      //               success:function(data)  
      //               {  
      //                  //alert(data);  
      //                  swal("Deleted!", "Selected Risk Maturity Model Record has been deleted.", "success");
      //                  dataTable_riskmaturitymodel.ajax.reload();  // reload datatable without page refresh
      //               }  
      //          });                 
      //      });           
      // }); 


      $(document).on('click', '.viewriskmaturitymodel', function(){  
           var riskmaturitymodel_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'RiskMaturityModel/fetch_one'; ?>",  
                method:"POST",  
                data:{riskmaturitymodel_id:riskmaturitymodel_id},  
                dataType:"json",  
                success:function(data)  
                {     
                    
                     //disable all form inputs using form id
                     $("#riskmaturitymodel_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     $("#riskmaturitymodel_form_viewonly input[name='reporting_unit']").val(data.reporting_unitNAME);
                     $("#riskmaturitymodel_form_viewonly input[name='process_id']").val(data.process_idNAME);
                     $("#riskmaturitymodel_form_viewonly input[name='risk_level_id']").val(data.risk_level_idNAME);
                     $("#riskmaturitymodel_form_viewonly textarea[name='risk_level_description']").val(data.risk_level_description);
                     $('.modal-title').text("Risk Maturity Model");  
                     $('#riskmaturitymodelModal_L').modal('show');  
                }  
           })  
      }); 
  });

</script>





<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
