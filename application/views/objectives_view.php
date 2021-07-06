
  <div>  
       <div class="table-responsive">  
            <br />
            <button type="button" class="btn btn-primary" id="add_button_objectives" data-toggle="modal" data-target="#objectivesModal"><i class="fa fa-plus"></i>&nbsp;Add Objective</button>
            <br /><br />  
            <table id="objectives_data" class="table table-bordered table-striped">  
               <thead>  
                  <tr>  
                     <th width="10%">ID</th>    
                     <th width="25%">Code</th>  
                     <th width="25%">Name</th>  
                     <th width="20%">Description</th> 
                     <th width="10%">Edit</th>  
                     <th width="10%">Delete</th>
                  </tr>  
               </thead>  
            </table>  
       </div>  
  </div>  

 <!-- Insert Objective Modal -->
 <div id="objectivesModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="objectives_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body">  
                          <label>Code</label>  
                          <input type="number" name="code" id="code" class="form-control" placeholder="Enter a code ..." required/>  
                          <br />  
                          <label>Name</label>  
                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter a name ..." required/>  
                          <br />  
                          <label>Description</label>  
                          <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter description ..." required></textarea>
                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="objective_id" id="objective_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                          <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->

                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>  

