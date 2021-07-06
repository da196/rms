
<script type="text/javascript">
  $(document).ready(function() {
        // ************************************
        // CATALOGS - LIKELIHOOD
        // *************************************        
        $('#add_button_catalogslikelihoodscale').click(function(){  
             $('#catalogslikelihoodscale_form')[0].reset();  //reset form
             $('.modal-title').text("Add Likelihood Rating Scale");  //modal title
             //$('#submit').val("Add");  //assign value to input with submit ID, Button value
             $('#action').val("Add"); //assign value to input with action ID
        })  

        var dataTable_catalogslikelihoodscale = $('#catalogslikelihoodscale_data').DataTable({  //Initialize datatable
             "processing":true,  
             "serverSide":true,  
             "order":[],  //removes initially enabled "order" on a table
             "ajax":{  
                  url:"<?php echo base_url().'CatalogsLikelihoodScale/fetch'; ?>",  
                  type:"POST"  
             },  
             "columnDefs":[  
                {  
                     "targets":[0, 1, 2, 3], //
                     "orderable":false,  
                },  
             ],  
        });  
        
        $(document).on('submit', '#catalogslikelihoodscale_form', function(event){  
             event.preventDefault();  
             var like_hood_scale = $('#like_hood_scale').val();  
             var like_hood_scale_score = $('#like_hood_scale_score').val();  
             var color_code = $('#color_code').val();              
             
             if(like_hood_scale != '' && like_hood_scale_score != ''  && color_code != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url().'CatalogsLikelihoodScale/action'?>",  
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
                          $('#catalogslikelihoodscale_form')[0].reset(); // reset form fields 
                          $('#catalogslikelihoodscaleModal').modal('hide');  // hide modal
                          dataTable_catalogslikelihoodscale.ajax.reload();  // reload datatable without page refresh

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

        $(document).on('click', '.updatecatalogslikelihoodscale', function(){  
             var catalogslikelihoodscale_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsLikelihoodScale/fetch_one'; ?>",  
                  method:"POST",  
                  data:{catalogslikelihoodscale_id:catalogslikelihoodscale_id},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                       $('#catalogslikelihoodscaleModal').modal('show');  
                       $('#like_hood_scale').val(data.like_hood_scale);  
                       $('#like_hood_scale_score').val(data.like_hood_scale_score);  
                       $('#color_code').val(data.color_code);  
                       $('.modal-title').text("Edit Likelihood Rating Scale");  
                       $('#catalogslikelihoodscale_id').val(catalogslikelihoodscale_id);   
                       //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                       $('#action').val("Edit"); //assign value to input with action ID
                  }  
             })  
        });     


        //Soft Delete
        $(document).on('click', '.softdeletecatalogslikelihoodscale', function(){  
             var catalogslikelihoodscale_id = $(this).attr("id"); //id from Soft Delete button 
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
                      url:"<?php echo base_url().'CatalogsLikelihoodScale/action'; ?>",  
                      method:"POST",  
                      data:{catalogslikelihoodscale_id:catalogslikelihoodscale_id,action:action}, 
                      success:function(data)  
                      {  
                         //alert(data);  
                         swal("", data, "success");
                         dataTable_catalogslikelihoodscale.ajax.reload();  // reload datatable without page refresh
                      }  
                 });                 
             });   

        }); 

        $(document).on('click', '.viewcatalogslikelihoodscale', function(){  
             var catalogslikelihoodscale_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsLikelihoodScale/fetch_one'; ?>",  
                  method:"POST",  
                  data:{catalogslikelihoodscale_id:catalogslikelihoodscale_id},  
                  dataType:"json",  
                  success:function(data)  
                  {                           
                     //disable all form inputs using form id
                     $("#catalogslikelihoodscale_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     $("#catalogslikelihoodscale_form_viewonly input[name='like_hood_scale']").val(data.like_hood_scale);
                     $("#catalogslikelihoodscale_form_viewonly input[name='like_hood_scale_score']").val(data.like_hood_scale_score);
                     $("#catalogslikelihoodscale_form_viewonly input[name='color_code']").val(data.color_code);
                     
                     $('.modal-title').text("Likelihood Rating Scale");  
                     $('#catalogslikelihoodscaleModal_L').modal('show');   
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
