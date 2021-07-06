
  <div>  
       <div class="table-responsive">  
            <br />  
            <button type="button" id="add_button_roles" data-toggle="modal" data-target="#rolesModal" class="btn btn-info btn-lg">Add Role</button>  
            <br /><br />  
            <table id="roles_data" class="table table-bordered table-striped" style="width:100%">  
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

 <!-- Insert Roles Modal -->
 <div id="rolesModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="roles_form">  
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
                          <input type="hidden" name="roles_id" id="roles_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" /> 

                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>  



