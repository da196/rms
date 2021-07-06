
<style type="text/css">
  .asterisk {
    color:red;
  }  
</style>


 <!-- BREADCRUMP -->
 <div class="row wrapper border-bottom white-bg page-heading">     
     <div class="col-lg-10">
         <h2><?php echo $title; ?></h2>
         <ol class="breadcrumb">
             <li>
                 <a><?php echo $title; ?></a>
             </li>
             <li class="active">
                 <strong><?php echo $subtitle; ?></strong>
             </li>
         </ol>
     </div>
     <div class="col-lg-2">
     </div>
 </div>

<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>List of <?php echo $title.' '.$subtitle; ?></h5>    
                  <div class="ibox-tools">
                      <!-- CREATE BUTTON -->
                     <!--  <button type="button" class="btn btn-success" id="add_button_userroles" data-toggle="modal" data-target="#userrolesModal"><i class="fa fa-plus"></i>&nbsp;Create</button> -->
                  </div>
              </div>
              <div class="ibox-content">                
              <table class="table table-striped table-bordered table-hover" id="userroles_data" style="width:100%">
                  <thead>
                    <tr>
                        <th width="10%">S/N</th>    
                        <th width="40%">Email</th>  
                        <th width="30%">Role</th>                            
                        <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>                    
                  </tbody>
              </table>
              </div>
            </div>
          </div>
      </div>
</div>



  <!-- INSERT MODAL -->
  <div id="userrolesModal" class="modal fade">  
       <div class="modal-dialog">  
            <form method="post" id="userroles_form">  
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title"></h4>  
                      </div>  
                      <div class="modal-body">  
                           <label>Email</label><span class="asterisk">*</span> 
                         <!--   <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email ..." required=""/> -->                         
                           <!-- <select class="form-control" name="email" id="email" required>
                             <option value=""> -- Select -- </option>
                             <?php foreach($emails as $email):?>
                                <option value="<?php echo $email->id; ?>"><?php echo $email->email; ?></option>
                             <?php endforeach;?>
                           </select>  -->    
                           <input type="text" name="email" id="email" class="form-control" disabled value="" />                      
                           <br />
                           <label>Role</label><span class="asterisk">*</span>  
                           <select class="form-control" name="role_id" id="role_id" style="width: 100%" required>
                             <option value=""> -- Select -- </option>
                             <?php foreach($rolenames as $role):?>
                                <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                             <?php endforeach;?>
                           </select>
                           <br /> 
                           <label>Active</label><span class="asterisk">*</span>  
                           <select class="form-control" name="active" id="active" style="width: 100%" required>
                             <!-- <option value=""> -- Select -- </option> -->
                             <option value="1" selected>Yes</option>
                             <option value="0">No</option>
                           </select>
                           <br /> 
                           <p><span class="asterisk">*</span>Required field</p>
                      </div>  
                      <div class="modal-footer">  
                           <input type="hidden" name="userroles_id" id="userroles_id" />  
                           <input type="hidden" id="action" name="action" /> 
                           <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                           <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                      </div>  
                 </div>  
            </form>  
       </div>  
  </div> 


 <!-- VIEW MODAL -->
<div class="modal inmodal fade" id="userrolesModal_L" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"> 
              <form id="userroles_form_viewonly">
                <div class="row">                  
                        <div class="col-md-12">
                            <label>Email</label>  
                            <input type="text" id="email" name="email" class="form-control"/> 
                        </div>                                 
                </div> 
                <br/>
                <div class="row">                  
                       <div class="col-md-12">
                           <label>Role</label>  
                           <input type="text" id="role_id" name="role_id" class="form-control"/> 
                       </div>                                 
                </div> 
                <div class="row">                  
                     <div class="col-md-12">
                         <label>Role Description</label>  
                         <textarea class="form-control" name="role_description" id="role_description" rows="3"></textarea>
                     </div>                                 
                </div> 
              </form>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
            </div>
        </div>
    </div>
</div> 





