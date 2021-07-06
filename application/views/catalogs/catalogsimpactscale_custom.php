<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // CATALOGS - IMPACTS
      // *************************************
      
      $('#add_button_catalogsimpactscale').click(function(){  
           $('#catalogsimpactscale_form')[0].reset();  //reset form
           $('.modal-title').text("Add Impact Rating Scale");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_catalogsimpactscale = $('#catalogsimpactscale_data').DataTable({  //Initialize datatable
           "processing":true,  
           "serverSide":true,  
           "order":[],  //removes initially enabled "order" on a table
           "ajax":{  
                url:"<?php echo base_url().'CatalogsImpactScale/fetch'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
              {  
                   "targets":[0, 1, 2, 3], //
                   "orderable":false,  
              },  
           ],  
      });  
      
      $(document).on('submit', '#catalogsimpactscale_form', function(event){  
           event.preventDefault();  
           var impact_scale = $('#impact_scale').val();  
           var impact_scale_score = $('#impact_scale_score').val();  
           var color_code = $('#color_code').val();              
           
           if(impact_scale != '' && impact_scale_score != ''  && color_code != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'CatalogsImpactScale/action'?>",  
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
                        $('#catalogsimpactscale_form')[0].reset(); // reset form fields 
                        $('#catalogsimpactscaleModal').modal('hide');  // hide modal
                        dataTable_catalogsimpactscale.ajax.reload();  // reload datatable without page refresh
                     }  
                });  
           }  
           else  
           {  
                //alert("All Fields are Required");  
                swal({
                    title: "",
                    text: "All Fields are Required!",
                    type: "error"
                });
           }  
      });  

      $(document).on('click', '.updatecatalogsimpactscale', function(){  
           var catalogsimpactscale_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsImpactScale/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsimpactscale_id:catalogsimpactscale_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#catalogsimpactscaleModal').modal('show');  
                     $('#impact_scale').val(data.impact_scale);  
                     $('#impact_scale_score').val(data.impact_scale_score);  
                     $('#color_code').val(data.color_code);  
                     $('.modal-title').text("Edit Impact Rating Scale");  
                     $('#catalogsimpactscale_id').val(catalogsimpactscale_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      });     


      //Soft Delete
      $(document).on('click', '.softdeletecatalogsimpactscale', function(){  
           var catalogsimpactscale_id = $(this).attr("id"); //id from Soft Delete button 
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
                    url:"<?php echo base_url().'CatalogsImpactScale/action'; ?>",  
                    method:"POST",  
                    data:{catalogsimpactscale_id:catalogsimpactscale_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_catalogsimpactscale.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      $(document).on('click', '.viewcatalogsimpactscale', function(){  
           var catalogsimpactscale_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsImpactScale/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsimpactscale_id:catalogsimpactscale_id},  
                dataType:"json",  
                success:function(data)  
                {                           
                   //disable all form inputs using form id
                   $("#catalogsimpactscale_form_viewonly :input").prop('disabled', true);

                   //add value to form input using input name attribute
                   $("#catalogsimpactscale_form_viewonly input[name='impact_scale']").val(data.impact_scale);
                   $("#catalogsimpactscale_form_viewonly input[name='impact_scale_score']").val(data.impact_scale_score);
                   $("#catalogsimpactscale_form_viewonly input[name='color_code']").val(data.color_code);
                   $('.modal-title').text("Impact Rating Scale");  
                   $('#catalogsimpactscaleModal_L').modal('show');   
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
