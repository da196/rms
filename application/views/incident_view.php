<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
    <h2> View  Incident  </h2>
        <ol class="breadcrumb">
            <li>
                <a>  Incident </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url();?>incident/view"> <strong> View  </strong></a>
                           
            </li>
         </ol>
    </div>
</div>

<!--  Start List of View Incident -->
<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>List of Reported Incident </h5>      
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
                            <th>Incident Description </th>
                            <th>Directorate </th>
                            <th>Section</th>                                               
                            <th>Escalated To</th>                   
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($list_incident->num_rows() > 0) {
                            foreach($list_incident->result() as $row){
                        ?>
                                <tr class="gradeX">
                                <td><?php echo date("d-m-Y", strtotime($row->date_reported));?></td> 
                                <td><?php echo  ucfirst(str_replace("."," ",$row->email));?></td>  
                                <td><?php echo  $row->description; ?></td>
                                <td><?php echo  $row->directorate_name; ?></td>
                                <td><?php echo  $row->section_name; ?></td>
                                <td><?php echo  $row->escalated_to;?></td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn-white btn btn-xs"><i class="fa fa-list"></i><a onClick="viewFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#viewAllModal"> View </a></button>
                                    </br>
                                    <button class="btn-white btn btn-xs softdeleteIncident" id="<?php echo $row->id; ?>"><i class="fa fa-trash"></i><a> Delete </a></button>
                                    </div>
                                </td>
                            </tr>
                            <?php  }
                        }else{ ?>
                            <tr class="gradeX">
                                <td colspan="7">No any Incident has been reported</td>
                            </tr>                            
                            <?php  } ?>                                            
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Date Reported </th>
                            <th>Reported By </th>
                            <th>Incident Description </th>
                            <th>Directorate </th>
                            <th>Section</th>                                              
                            <th>Escalated To</th>                   
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  End List of View Incident -->


<!-- Start View viewAllModal -->
<div class="modal fade" id="viewAllModal" tabindex="-1" role="dialog" aria-labelledby="viewAllModal" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">View New Incident </h4> 
                      </div>

      <div class="modal-body">
 
                <form method="post">
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <div class="form-group">


                        <label><strong> Description Incident <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="view_description_incident" id="view_description_incident" class="form-control">   </textarea>                       

                        <label><strong> Directorate <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_directorate" id="view_directorate" class="form-control" readonly/> 

                        <label><strong> Section <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_section" id="view_section" class="form-control" readonly/> 

                        <label><strong> Reported By <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_reported_by" id="view_reported_by" class="form-control" readonly/> 

                        <label><strong> Date Reported <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_date_reported" id="view_date_reported" class="form-control" readonly/>                                                                

                        <label><strong> Escalated To <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_esc_to" id="view_esc_to" class="form-control" readonly/>                                                                

                        <!--
                        <label><strong> Escalated Officer <span class="text-danger">*</span></label> </strong></label>
                        <textarea  readonly name="view_esc_user" id="view_esc_user"  class="form-control">     </textarea>
                        -->
                        <label><strong> List of Possible Incident Consequences  </strong></label>

                            <div id="list_consequences">

                            </div>

                        <label><strong> List of Possible Incident Mitigations  </strong></label>

                            <div id="list_mitigations">

                            </div>
                                              
                    </div>
                </form>                            
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- End View viewAllModal -->
</div>

