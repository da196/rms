
<script type="text/javascript">
   $(document).ready(function() { 
       // ************************************
       // CATALOGS - ROLES
       // *************************************
       
       $('#add_button_roles').click(function(){  
            $('#roles_form')[0].reset();  //reset form
            $('.modal-title').text("Add Role///");  //modal title
            $('#submit').val("Add");  //assign value to input with submit ID, Button value
            $('#action').val("Add"); //assign value to input with action ID
       })  

       var dataTable_roles = $('#roles_data').DataTable({  //Initialize datatable
            "processing":true,  
            "serverSide":true,  
            "order":[],  //removes initially enabled "order" on a table
            "ajax":{  
                 url:"<?php echo base_url().'CatalogsRoles/fetch'; ?>",  
                 type:"POST"  
            },  
            "columnDefs":[  
               {  
                    "targets":[0, 4, 5, 6], //
                    "orderable":false,  
               },  
            ],  
       });  

       $(document).on('submit', '#roles_form', function(event){  
            event.preventDefault();  
            var code = $('#code').val();  
            var name = $('#name').val();  
            var description = $('#description').val(); 
            var active = $('#active').val(); 

            if(code != '' && name != '' && description != '' && active != '')  
            {  
                 $.ajax({  
                      url:"<?php echo base_url().'CatalogsRoles/action'?>",  
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
                         $('#roles_form')[0].reset(); // reset form fields 
                         $('#rolesModal').modal('hide');  // hide modal
                         dataTable_roles.ajax.reload();  // reload datatable without page refresh
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

       $(document).on('click', '.updateroles', function(){  
            var roles_id = $(this).attr("id"); //id from update button 
            $.ajax({  
                 url:"<?php echo base_url().'CatalogsRoles/fetch_one'; ?>",  
                 method:"POST",  
                 data:{roles_id:roles_id},  
                 dataType:"json",  
                 success:function(data)  
                 {  
                      $('#rolesModal').modal('show');  
                      $('#code').val(data.code);  
                      $('#name').val(data.name); 
                      $('#description').val(data.description); 
                      $('#active').val(data.active);    
                      $('.modal-title').text("Edit Role");  
                      $('#roles_id').val(roles_id);   
                      $('#submit').val("Edit"); //assign value to input with submit ID, Button value
                      $('#action').val("Edit"); //assign value to input with action ID
                 }  
            })  
       }); 

       $(document).on('click', '.deleteroles', function(){  
            var roles_id = $(this).attr("id"); //id from delete button 
            if(confirm("Are you sure you want to delete this?")){
               $.ajax({  
                    url:"<?php echo base_url(); ?>CatalogsRoles/delete_one",  
                    method:"POST",  
                    data:{roles_id:roles_id}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_roles.ajax.reload();  // reload datatable without page refresh
                    }  
               }); 
            }else{
               return false;
            }             
       }); 
   });
</script>



<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
