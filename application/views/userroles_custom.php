<script type="text/javascript">
  $(document).ready(function() { 
    // ************************************
    // USER ROLES MODEL
    // *************************************    
    $('#add_button_userroles').click(function(){  
         $('#userroles_form')[0].reset();  //reset form
         $('.modal-title').text("Assign Role to User");  //modal title
         //$('#submit').val("Add");  //assign value to input with submit ID, Button value
         $('#action').val("Add"); //assign value to input with action ID
    })  

    var dataTable_userroles = $('#userroles_data').DataTable({  //Initialize datatable
         "processing":true,  
         "serverSide":true,  
         "order":[],  //removes initially enabled "order" on a table
         "ajax":{  
              url:"<?php echo base_url().'UserRoles/fetch'; ?>",  
              type:"POST"  
         },  
         "columnDefs":[  
            {  
                 "targets":[1], // columns shown on datatable view
                 "orderable":true,  
            },  
         ],  
    });  
    
    $(document).on('submit', '#userroles_form', function(event){  
         event.preventDefault();  
        // var email = $('#email').val();  
         var role_id = $('#role_id').val(); 
         var active = $('#active').val(); 
        // email != '' &&
         if( role_id != ''  && active != '')  
         {  
              $.ajax({  
                   url:"<?php echo base_url().'UserRoles/action'?>",  
                   method:'POST',  
                   data:new FormData(this), //sends data from form inform of key-> value pairs 
                   contentType:false,  
                   processData:false,  
                   success:function(data)  
                   {  
                      //alert(data);  
                      swal({title: "",text: data,type: "success"});
                      $('#userroles_form')[0].reset(); // reset form fields 
                      $('#userrolesModal').modal('hide');  // hide modal
                      dataTable_userroles.ajax.reload();  // reload datatable without page refresh
                   }  
              });  
         }  
         else  
         {  
              //alert("All Fields are Required");  
              swal({title: "",text: "All Fields are Required!",type: "error"});
         }  
    });  

    
    $(document).on('click', '.updateuserroles', function(){ 
         var userroles_id = $(this).attr("id"); //id from update button 
         $.ajax({  
              url:"<?php echo base_url().'UserRoles/fetch_one'; ?>",  
              method:"POST",  
              data:{userroles_id:userroles_id},  
              dataType:"json",  
              success:function(data)  
              {  
                   $('#userrolesModal').modal('show');  
                   $('#email').val(data.email);  
                   $('#role_id').val(data.role_id); 
                   $('.modal-title').text("Change User Role");  
                   $('#userroles_id').val(userroles_id);   
                   //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                   $('#action').val("Edit"); //assign value to input with action ID
              }  
         })  
    }); 

    $(document).on('click', '.viewuserroles', function(){  
         var userroles_id = $(this).attr("id"); //id from update button 
         $.ajax({  
              url:"<?php echo base_url().'UserRoles/fetch_one'; ?>",  
              method:"POST",  
              data:{userroles_id:userroles_id},  
              dataType:"json",  
              success:function(data)  
              {     
               //disable all form inputs using form id
               $("#userroles_form_viewonly :input").prop('disabled', true);
               //add value to form input using input name attribute
               $("#userroles_form_viewonly input[name='email']").val(data.email);
               $("#userroles_form_viewonly input[name='role_id']").val(data.role_idNAME);
               $("#userroles_form_viewonly textarea[name='role_description']").val(data.role_description);
               $('.modal-title').text("View User Role");  
               $('#userrolesModal_L').modal('show');  
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
