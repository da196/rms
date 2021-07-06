<script type="text/javascript">
   $(document).ready(function() {

      // ************************************
      // CATALOGS - OBJECTIVES
      // *************************************
      
      $('#add_button_catalogsobjectives').click(function(){  
           $('#catalogsobjectives_form')[0].reset();  //reset form
           $('.modal-title').text("Add Organization Objective");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_catalogsobjectives = $('#catalogsobjectives_data').DataTable({  //Initialize datatable
           "processing":true,  
           "serverSide":true,  
           "order":[],  //removes initially enabled "order" on a table
           "ajax":{  
                url:"<?php echo base_url().'CatalogsObjectives/fetch'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
              {  
                   "targets":[0, 1, 2, 3], //
                   "orderable":false,  
              },  
           ],  
      });  
      
      $(document).on('submit', '#catalogsobjectives_form', function(event){  
           event.preventDefault();  
           var code = $('#code').val();  
           var name = $('#name').val();  
           var description = $('#description').val(); 
           
           if(code != '' && name != '' && description != '' )  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'CatalogsObjectives/action'?>",  
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
                        $('#catalogsobjectives_form')[0].reset(); // reset form fields 
                        $('#catalogsobjectivesModal').modal('hide');  // hide modal
                        dataTable_catalogsobjectives.ajax.reload();  // reload datatable without page refresh
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

      $(document).on('click', '.updatecatalogsobjectives', function(){  
           var catalogsobjectives_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsObjectives/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsobjectives_id:catalogsobjectives_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#catalogsobjectivesModal').modal('show');  
                     $('#code').val(data.code);  
                     $('#name').val(data.name); 
                     $('#description').val(data.description);   
                     $('.modal-title').text("Edit Organization Objective");  
                     $('#catalogsobjectives_id').val(catalogsobjectives_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      }); 

      // $(document).on('click', '.deletecatalogsobjectives', function(){  
      //      var catalogsobjectives_id = $(this).attr("id"); //id from delete button 
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
      //               url:"<?php echo base_url(); ?>CatalogsObjectives/delete_one",  
      //               method:"POST",  
      //               data:{catalogsobjectives_id:catalogsobjectives_id}, 
      //               success:function(data)  
      //               {  
      //                  //alert(data);  
      //                  swal("Deleted!", "Selected Objective has been deleted.", "success");
      //                  dataTable_catalogsobjectives.ajax.reload();  // reload datatable without page refresh
      //               }  
      //          });                 
      //      });           
      // }); 

      //Soft Delete
      $(document).on('click', '.softdeletecatalogsobjectives', function(){  
           var catalogsobjectives_id = $(this).attr("id"); //id from Soft Delete button 
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
                    url:"<?php echo base_url().'CatalogsObjectives/action'; ?>",  
                    method:"POST",  
                    data:{catalogsobjectives_id:catalogsobjectives_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_catalogsobjectives.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      $(document).on('click', '.viewcatalogsobjectives', function(){  
           var catalogsobjectives_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsObjectives/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogsobjectives_id:catalogsobjectives_id},  
                dataType:"json",  
                success:function(data)  
                {     
                    
                     //disable all form inputs using form id
                     $("#catalogsobjectives_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     $("#catalogsobjectives_form_viewonly input[name='code']").val(data.code);
                     $("#catalogsobjectives_form_viewonly input[name='name']").val(data.name);
                     $("#catalogsobjectives_form_viewonly textarea[name='description']").val(data.description);
                     $('.modal-title').text("Organization Objective");  
                     $('#catalogsobjectivesModal_L').modal('show');  
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
