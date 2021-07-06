
  <div>  
       <div class="table-responsive">  
            <br />  
            <button type="button" id="add_button_permissions" data-toggle="modal" data-target="#permissionsModal" class="btn btn-info btn-lg">Add Permission</button>  
            <br /><br />  
            <table id="permissions_data" class="table table-bordered table-striped">  
               <thead>  
                  <tr>  
                     <th width="10%">ID</th>    
                     <th width="20%">Code</th>  
                     <th width="20%">Name</th>  
                     <th width="20%">Description</th> 
                     <th width="10%">Active</th> 
                     <th width="10%">Edit</th>  
                     <th width="10%">Delete</th>
                  </tr>  
               </thead>  
            </table>  
       </div>  
  </div>  

 <!-- Insert Permissions Modal -->
 <div id="permissionsModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="permissions_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body">  
                          <label>Code</label>  
                          <input type="number" name="code" id="code" class="form-control" />  
                          <br />  
                          <label>Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Description</label>  
                          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                          <br />   
                           <label>Active</label>  
                          <input type="number" name="active" id="active" class="form-control" />                

                          <!-- <input type="hidden" name="action" id="action" value="Add"/>  -->
                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="permissions_id" id="permissions_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" /> 

                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>  

<script>
  $(document).ready(function() {
        // ************************************
        // SETTINGS - PERMISSIONS
        // *************************************
        
        $('#add_button_permissions').click(function(){  
             $('#permissions_form')[0].reset();  //reset form
             $('.modal-title').text("Add Permission///");  //modal title
             $('#submit').val("Add");  //assign value to input with submit ID, Button value
             $('#action').val("Add"); //assign value to input with action ID
        })  

        var dataTable_permissions = $('#permissions_data').DataTable({  //Initialize datatable
             "processing":true,  
             "serverSide":true,  
             "order":[],  //removes initially enabled "order" on a table
             "ajax":{  
                  url:"<?php echo base_url().'Settings_Permissions/fetch'; ?>",  
                  type:"POST"  
             },  
             "columnDefs":[  
                {  
                     "targets":[0, 4, 5, 6], //
                     "orderable":false,  
                },  
             ],  
        });  

        $(document).on('submit', '#permissions_form', function(event){  
             event.preventDefault();  
             var code = $('#code').val();  
             var name = $('#name').val();  
             var description = $('#description').val(); 
             var active = $('#active').val(); 

             if(code != '' && name != '' && description != '' && active != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url().'Settings_Permissions/action'?>",  
                       method:'POST',  
                       data:new FormData(this), //sends data from form inform of key-> value pairs 
                       contentType:false,  
                       processData:false,  
                       success:function(data)  
                       {  
                          alert(data);  
                          $('#permissions_form')[0].reset(); // reset form fields 
                          $('#permissionsModal').modal('hide');  // hide modal
                          dataTable_permissions.ajax.reload();  // reload datatable without page refresh
                       }  
                  });  
             }  
             else  
             {  
                  alert("All Fields are Required");  
             }  
        });  

        $(document).on('click', '.updatepermissions', function(){  
             var permissions_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'Settings_Permissions/fetch_one'; ?>",  
                  method:"POST",  
                  data:{permissions_id:permissions_id},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                       $('#permissionsModal').modal('show');  
                       $('#code').val(data.code);  
                       $('#name').val(data.name); 
                       $('#description').val(data.description); 
                       $('#active').val(data.active);    
                       $('.modal-title').text("Edit Permission");  
                       $('#permissions_id').val(permissions_id);   
                       $('#submit').val("Edit"); //assign value to input with submit ID, Button value
                       $('#action').val("Edit"); //assign value to input with action ID
                  }  
             })  
        }); 

        $(document).on('click', '.deletepermissions', function(){  
             var permissions_id = $(this).attr("id"); //id from delete button 
             if(confirm("Are you sure you want to delete this?")){
                $.ajax({  
                     url:"<?php echo base_url(); ?>Settings_Permissions/delete_one",  
                     method:"POST",  
                     data:{permissions_id:permissions_id}, 
                     success:function(data)  
                     {  
                        alert(data);  
                        dataTable_permissions.ajax.reload();  // reload datatable without page refresh
                     }  
                }); 
             }else{
                return false;
             }             
        });
  }); 


</script>
