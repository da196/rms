<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // CATALOGS - QUARTERS
      // *************************************
      
      $('#add_button_catalogsquarters').click(function(){  
           $('#catalogsquarters_form')[0].reset();  //reset form
           $('.modal-title').text("Add Quarter");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_catalogsquarters = $('#catalogsquarters_data').DataTable({  //Initialize datatable
           "processing":true,  
           "serverSide":true,  
           "order":[],  //removes initially enabled "order" on a table
           "ajax":{  
                url:"<?php echo base_url().'CatalogsQuarters/fetch'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
              {  
                   "targets":[0, 1, 2, 3], //
                   "orderable":false,  
              },  
           ],  
      });  
      
      $(document).on('submit', '#catalogsquarters_form', function(event){  
           event.preventDefault();  
           var quarter_name = $('#quarter_name').val();  
           var quarter_description = $('#quarter_description').val();              
           
           if(quarter_name != '' && quarter_description != '' )  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'CatalogsQuarters/action'?>",  
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
                        $('#catalogsquarters_form')[0].reset(); // reset form fields 
                        $('#catalogsquartersModal').modal('hide');  // hide modal
                        dataTable_catalogsquarters.ajax.reload();  // reload datatable without page refresh
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

      $(document).on('click', '.updatecatalogsquarters', function(){  
           var catalogsquarters_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsQuarters/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsquarters_id:catalogsquarters_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#catalogsquartersModal').modal('show');  
                     $('#quarter_name').val(data.quarter_name);  
                     $('#quarter_description').val(data.quarter_description);  
                     $('.modal-title').text("Edit Quarter");  
                     $('#catalogsquarters_id').val(catalogsquarters_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      });         

      // $(document).on('click', '.deletecatalogsquarters', function(){  
      //      var catalogsquarters_id = $(this).attr("id"); //id from delete button 
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
      //               url:"<?php echo base_url(); ?>CatalogsQuarters/delete_one",  
      //               method:"POST",  
      //               data:{catalogsquarters_id:catalogsquarters_id}, 
      //               success:function(data)  
      //               {  
      //                  //alert(data);  
      //                  swal("Deleted!", "Selected Quarter has been deleted.", "success");
      //                  dataTable_catalogsquarters.ajax.reload();  // reload datatable without page refresh
      //               }  
      //          });                 
      //      });           
      // }); 

      //Soft Delete
      $(document).on('click', '.softdeletecatalogsquarters', function(){  
           var catalogsquarters_id = $(this).attr("id"); //id from Soft Delete button 
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
                    url:"<?php echo base_url().'CatalogsQuarters/action'; ?>",  
                    method:"POST",  
                    data:{catalogsquarters_id:catalogsquarters_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_catalogsquarters.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      $(document).on('click', '.viewcatalogsquarters', function(){  
           var catalogsquarters_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsQuarters/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsquarters_id:catalogsquarters_id},  
                dataType:"json",  
                success:function(data)  
                {     
                    
                   //disable all form inputs using form id
                   $("#catalogsquarters_form_viewonly :input").prop('disabled', true);

                   //add value to form input using input name attribute
                   $("#catalogsquarters_form_viewonly input[name='quarter_name']").val(data.quarter_name);
                   $("#catalogsquarters_form_viewonly textarea[name='quarter_description']").val(data.quarter_description);
                   $('.modal-title').text("Quarter");  
                   $('#catalogsquartersModal_L').modal('show');   
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
