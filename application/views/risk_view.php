<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>New/Emerging Risk </h2>
        <ol class="breadcrumb">
            <li>
                 <a>New/Emerging Risk</a>
            </li>

            <li class="active">
                <a href="<?php echo base_url();?>risk/index"> <strong>View</strong></a>
                           
            </li>
         </ol>
    </div>
</div>


<!--  Start List of Report Risk -->          
<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>List of New/Emerging Risk </h5>      
                  <div class="ibox-tools">  
                  
                   </div>
              </div>

                <div class="ibox-content">                     
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable_riskEmerge">
                        <thead>
                        <tr>
                            
                            <th>Date Reported </th>
                            <th>Reported By </th>
                            <th>Emerging Risk</th>
                            <th>Responsible Officer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 


                        if($list_risk->num_rows() > 0) {
                            foreach($list_risk->result() as $row){
                                $fullname = $row->first_name .' '. $row->middle_name .'  '.$row->last_name; 
                        ?>
                                <tr class="gradeX">
                                <td><?php echo date("d-m-Y", strtotime($row->date_reported));?></td>   
                                <td><?php echo $row->email;?></td>
                                <td><?php echo  $row->name; ?></td>                               
                                <td><?php echo $fullname;?></td>                          

                                    <?php if($row->status == 'Submitted'){
                                            $label = 'info';
                                    }elseif($row->status == 'Incomplete'){
                                            $label = 'default';
                                    }elseif($row->status == 'Deleted'){
                                            $label = 'danger';
                                    }elseif($row->status == 'Rejected'){
                                        $label = 'warning';
                                    }elseif($row->status == 'Accepted'){
                                        $label = 'primary';
                                    }else{
                                            $label = '';
                                    }
                                    ?>

                                <td> <span class="label label-<?php echo $label;?>"><?php echo  $row->status;?> </span></td>
                                <td>
                                    <div class="btn-group">
                                    <?php 
                                        $normal_user = array(3,4,7,8,9,10,23);
                                        $rmu = array(4,7);
                                        $admin = array(4);
                                    ?>

                                    <?php  if(in_array($this->session->userdata('role'), $normal_user) ){ 

                                    if(($row->status == 'Submitted') || ($row->status == 'Accepted') || ($row->status == 'Rejected')){
                                    ?>
                                        <button class="btn-white btn btn-xs"><i class="fa fa-list"></i><a onClick="viewFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#viewExampleModal"> View </a></button>

                                    <?php } if($row->status == 'Incomplete')  {?>
                                               
                                        <button class="btn-white btn btn-xs"><i class="fa fa-save"></i><a onClick="completeFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#completeExampleModal"> Complete </a></button>

                                    <?php }}?>

                                    <?php if(in_array($this->session->userdata('role'), $rmu) ){ ?>
                                        
                                        <?php if($row->status == 'Submitted')  {?>

                                        <button class="btn-white btn btn-xs"><i class="fa fa-check"></i><a onClick="approvalFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#approveExampleModal"> Review </a></button>

                                    <?php  }}?>

                                    <?php  if(in_array($this->session->userdata('role'), $admin) ){ ?>
                                      <!--
                                        <button class="btn-white btn btn-xs"><i class="fa fa-edit"></i><a onClick="editFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#editExampleModal"> Edit </a></button>
                                       -->     
                                        <?php if($row->status != 'Deleted'){ ?>
                                        <button id="<?php echo $row->id; ?>" class="btn-white btn btn-xs delete_risk"><i class="fa fa-trash"></i><a>  Delete </a></button>

                                    <?php }}?>

                                    </div>
                                </td>
                            </tr>
                            <?php  }
                        }else{ ?>
                            <tr class="gradeX">
                                <td colspan="5">No any risk has been reported</td>
                            </tr>                            
                            <?php  } ?>                                            
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Date Reported </th>
                            <th>Reported By </th>
                            <th>Emerging Risk</th>
                            <th>Responsible Officer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  End List of Report Risk -->
</div>

<!-- View Report Risk Modal -->
<div class="modal fade" id="viewExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">View New / Emerging Risk</h4> 
                      </div> 

      <div class="modal-body">
 
                <form id="viewRisk">
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <div class="form-group">

                        <label><strong>  Risk Name <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="view_name" id="view_name" class="form-control">   </textarea>                       

                        <label><strong>  Source of the risk <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly  name="view_information_source"  id="view_information_source" class="form-control">    </textarea>
                        
                        <label><strong> Risk Detail <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="view_remarks"  id="view_remarks"  class="form-control">   </textarea>
                        
                        <label><strong> Responsible Officer <span class="text-danger">*</span></label> </strong></label>
                        <textarea  readonly name="view_responsible_officer" id="view_responsible_officer"  class="form-control">     </textarea>

                        <label><strong> Reported By <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_email" id="view_email" class="form-control" readonly/>   

                        <label><strong> Date Reported <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_date_reported" id="view_date_reported" class="form-control" readonly/>                                                                
                    </div>
                </form>                           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- View Report Risk Modal -->


<!-- Edit Report Risk Modal -->
<div class="modal fade" id="editExampleModal" tabindex="-1" role="dialog" aria-labelledby="editExampleModal" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">Edit New / Emerging Risk</h4> 
                      </div>

      <div class="modal-body">
                <form method="post" id="viewRisk">

                    <input type="hidden" name="update_risk_id" id="update_risk_id" class="form-control"/>
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">

                    <input type="hidden" name="update_responsible_officer" id="update_responsible_officer" class="form-control" value=" ">

                    <div class="form-group">

                        <label><strong>  Risk Name <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="update_name" id="update_name" class="form-control">   </textarea>                       

                        <label><strong> Source of the risk <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="update_information_source"  id="update_information_source" class="form-control">    </textarea>
                        
                        <label><strong> Risk Detail <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="update_remarks"  id="update_remarks"  class="form-control">   </textarea>
                                               
                        <label><strong> Responsible Officer <span class="text-danger">*</span></label> </strong></label>
                        <select class="form-control"  name="update_responsible_officer" id="update_responsible_officer">
                                <option value=" "> -- Select -- </option>
                            <?php 
                            foreach($list_responsible_officers->result() as $row){
                                $fullname = $row->first_name .' '. $row->middle_name .'  '.$row->last_name. ' - '.$row->designation; 
                                ?>                         
                            <option class="form-control" value="<?php echo $row->id; ?>"> <?php echo $fullname; ?> </option>
                            <?php } ?>
                        </select></br>

                        <button type="submit" id="updaterisk" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-check"></i>  <b>Update</b></button>
                                    
                    </div>
                </form>                           
      </div>
      <div class="modal-footer">
        <button type="button" id="updaterisk" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Edit Report Risk Modal -->


<!-- Complete Report Risk Modal -->
<div class="modal fade" id="completeExampleModal" tabindex="-1" role="dialog" aria-labelledby="completeExampleModal" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">Complete New / Emerging Risk</h4> 
                      </div>

      <div class="modal-body">
 
                <form method="post" id="completeRisk">

                    <input type="hidden" name="complete_risk_id" id="complete_risk_id" class="form-control"/>
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">


                    <div class="form-group">

                        <label><strong>  Risk Name <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="complete_name" id="complete_name" class="form-control">   </textarea>                       

                        <label><strong> Source of the risk  <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="complete_information_source"  id="complete_information_source" class="form-control">    </textarea>
                        
                        <label><strong> Risk Detail <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="complete_remarks"  id="complete_remarks"  class="form-control">   </textarea>
                                               
                        <label><strong> Responsible Officer <span class="text-danger">*</span></label> </strong></label>
                        <select class="form-control"  name="complete_responsible_officer" id="complete_responsible_officer" style="width: 100%">
                            <option value=" "> -- Select -- </option>
                            <?php 
                            foreach($list_responsible_officers->result() as $row){
                                $fullname = $row->first_name .' '. $row->middle_name .'  '.$row->last_name. ' - '.$row->designation; 
                                ?>                         
                            <option class="form-control" value="<?php echo $row->id; ?>"> <?php echo $fullname; ?> </option>
                            <?php } ?>
                        </select></br>

                        <button type="submit" id="completerisk" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-check"></i>  <b>Submit</b></button>
                                    
                    </div>
                </form>                           
      </div>
      <div class="modal-footer">
        <button type="button" id="completerisk" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Complete Report Risk Modal -->


<!-- Review Report Risk Modal -->
<div class="modal fade" id="approveExampleModal" tabindex="-1" role="dialog" aria-labelledby="approveExampleModal" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">Review New Emerging Risk</h4> 
                      </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="approve_risk_id" id="approve_risk_id" class="form-control"/>
                    <input type="hidden" name="approved_by" id="approved_by" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <input type="hidden" name="reported_by" id="reported_by" class="form-control"/>
                    
                    <div class="form-group">

                        <label><strong>  Risk Name <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="review_name" id="review_name" class="form-control">   </textarea>                       

                        <label><strong> Source of risk <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly  name="review_information_source"  id="review_information_source" class="form-control">    </textarea>
                        
                        <label><strong> Risk Detail <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="review_remarks"  id="review_remarks"  class="form-control">   </textarea>
                        
                        <label><strong> Responsible Officer <span class="text-danger">*</span></label> </strong></label>
                        <textarea  readonly name="review_responsible_officer" id="review_responsible_officer"  class="form-control">     </textarea>

                        <label><strong> Reported By <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="review_email" id="review_email" class="form-control" readonly/>   

                        <label><strong> Date Reported <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="review_date_reported" id="review_date_reported" class="form-control" readonly/> 

                        <!-- Start Comment Part  -->
                        <label><strong> Comment <span class="text-danger">*</span></label> </strong></label>
                        <textarea  name="risk_comment" id="risk_comment" class="form-control">   </textarea>
                         <!-- End Comment Part  -->                       
                        </br>
                        <button type="submit" id="arisk" class="btn btn-sm btn-success" style="float:right; margin-right: 5px;"><i class="fa fa-check"></i>  <b>Accept</b></button> 
                        <button type="submit" id="rrisk" class="btn btn-sm btn-danger" style="float:right; margin-right: 5px;"><i class="fa fa-close"></i>  <b>Reject</b></button>
                                    
                    </div>
                </form>                           
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>    
      </div>
    </div>
  </div>
</div>
<!-- Review Report Risk Modal -->



   
