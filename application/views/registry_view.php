<?php 

// START CALL ALL THE MODELS HERE...
$this->load->model('registry_causes_model');
$this->load->model('registry_events_model');
$this->load->model('registry_consequences_model');
// END CALL ALL THE MODELS HERE...

?>

<style type="text/css">
  .asterisk {
    color:red;
  }  
</style>

<!-- START -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
    <h2>Risk Register</h2>
        <ol class="breadcrumb">
            <li>
                <a>Risk Register</a>
            </li>
            <li class="active">
                <a href="<?php echo base_url();?>registry/view"><strong>Review & Assess</strong></a>
            </li>
         </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeIn">
<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Strategic - Risk Category </a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Operational - Risk Category </a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Project - Risk Category </a></li>
            </ul>
            <div class="tab-content">
                <!-- All the Strategic Risk Category -->
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                    <!-- START  BODY -->
                    <div class="row">
                        <div class="col-lg-12">                   
                                    <h4>List of Risk Register (Strategic Category) </h4>                                                       
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover display" id="dataTable_riskEmerge" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            if($list_strategic_registry->num_rows() > 0) {
                                                foreach($list_strategic_registry->result() as $row){
                                            ?>
                                                    <tr class="gradeX">
                                                    <td><?php echo  $row->activity; ?></td>
                                                    <!-- CAUSES -->
                                                    <td>
                                                        <ol>
                                                            <?php
                                                            $list_causes  = $this->registry_model->getRegistry_causes($row->id);
                                                            foreach($list_causes->result() as $cause){?>                                       
                                                                <li><?php echo  $cause->causes; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- EVENTS -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_events  = $this->registry_model->getRegistry_events($row->id);
                                                            foreach($list_events->result() as $event){?>                                       
                                                                <li><?php echo  $event->events; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- CONSEQUENCES -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_consequences  = $this->registry_model->getRegistry_consequences($row->id);
                                                            foreach($list_consequences->result() as $consequence){?>                                       
                                                                <li><?php echo  $consequence->consequences; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>


                                                    <?php 
                                                    if($row->trend_name == 'Upward - Amber')
                                                    {
                                                        $label = 'warning';
                                                        $font_label = 'arrow-up';
                                                    }elseif($row->trend_name == 'Downward - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'arrow-down';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Red')
                                                    {
                                                       $label = 'danger';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Green')
                                                    {
                                                       $label = 'primary';
                                                       $font_label = 'exchange';  
                                                    }
                                                     elseif($row->trend_name == 'Constant - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Downward - Red')  
                                                    {
                                                        $label = 'danger';
                                                        $font_label = 'arrow-down';
                                                    }
                                                    else
                                                    {
                                                        $label = 'primary';
                                                        $font_label = 'arrow-up';
                                                    }
                                                    ?>
                                                    <td> 
                                                        <i class="fa fa-<?php echo $font_label;?> fa-lg"></i>
                                                        <span class="label label-<?php echo $label;?>"><?php echo  $row->trend_name;?> </span>  
                                                    </td>
                                                   
                                                    <td>
                                                        <?php
                                                         $allExceptDefaultAndAnonymous = array(4,7,8,23); 
                                                         $adminRMUOfficerOnly = array(4,7); //RMU OFFICE $ ADMIN ONLY
                                                         $adminRMUOfficerRiskChampionOnly = array(4,7,23); //Risk Champion, RMU OFFICE $ ADMIN ONLY
                                                         if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>

                                                            <button class="btn-white btn btn-xs"><i class="fa fa-list"></i><a onClick="viewRegistryFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#viewRegistryModal">&nbsp;Review</a></button><br/> 
                                                            <?php if(in_array($this->session->userdata('role'), $adminRMUOfficerRiskChampionOnly)) { ?>
                                                                <button class="btn-white btn btn-xs"><i class="fa fa-cogs"></i><a href="<?php echo base_url();?>registry/registry_edit/<?php echo $row->id;?>">&nbsp;Assess</a></button>
                                                            <?php } ?>
                                                            <?php if(in_array($this->session->userdata('role'), $adminRMUOfficerOnly)) { ?>
                                                                <button class="btn-white btn btn-xs"><i class="fa fa-pencil"></i> <a href="<?php echo base_url();?>registry/risk_register_edit_page/<?php echo $row->id;?>">&nbsp;Edit</a></button><br>

                                                                <button id="<?php echo $row->id;?>" 
                                                                        data-userid="<?php echo $this->session->userdata('user_id'); ?>"
                                                                        class="btn-white btn btn-xs delete_risk_register">
                                                                        <i class="fa fa-trash"></i>
                                                                        <a>&nbsp;Delete</a>
                                                                </button>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </td>
                                                </tr>
                                                <?php  }
                                            }else{ ?>
                                                <tr class="gradeX">
                                                    <td colspan="5">Risk Register has no data to assess</td>
                                                </tr>                            
                                                <?php  } ?>                    
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                            </table>                                   
                                        </div>
                            </div>
                        </div>
                    <!-- END BODY -->
                    </div>
                </div>


                <!-- All the Operational Risk Category -->
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                    <!-- START  BODY -->
                    <div class="row">
                        <div class="col-lg-12">                   
                                    <h4>List of Risk Register (Operational Category) </h4>                                                       
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover display" id="dataTable2_riskEmerge" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            if($list_operational_registry->num_rows() > 0) {
                                                foreach($list_operational_registry->result() as $row){
                                            ?>
                                                    <tr class="gradeX">
                                                    <td><?php echo  $row->activity; ?></td>
                                                    <!-- CAUSES -->
                                                    <td>
                                                        <ol>
                                                            <?php
                                                            $list_causes  = $this->registry_model->getRegistry_causes($row->id);
                                                            foreach($list_causes->result() as $cause){?>                                       
                                                                <li><?php echo  $cause->causes; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- EVENTS -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_events  = $this->registry_model->getRegistry_events($row->id);
                                                            foreach($list_events->result() as $event){?>                                       
                                                                <li><?php echo  $event->events; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- CONSEQUENCES -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_consequences  = $this->registry_model->getRegistry_consequences($row->id);
                                                            foreach($list_consequences->result() as $consequence){?>                                       
                                                                <li><?php echo  $consequence->consequences; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <?php                                                

                                                    if($row->trend_name == 'Upward - Amber')
                                                    {
                                                        $label = 'warning';
                                                        $font_label = 'arrow-up';
                                                    }elseif($row->trend_name == 'Downward - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'arrow-down';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Red')
                                                    {
                                                       $label = 'danger';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Green')
                                                    {
                                                       $label = 'primary';
                                                       $font_label = 'exchange';  
                                                    }
                                                     elseif($row->trend_name == 'Constant - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Downward - Red')  
                                                    {
                                                        $label = 'danger';
                                                        $font_label = 'arrow-down';
                                                    }
                                                    else
                                                    {
                                                        $label = 'primary';
                                                        $font_label = 'arrow-up';
                                                    }
                                                    ?>
                                                    
                                                        <td> 
                                                        <i class="fa fa-<?php echo $font_label;?> fa-lg"></i>
                                                        <span class="label label-<?php echo $label;?>"><?php echo  $row->trend_name;?> </span>  
                                                        </td>
                                                        <td>
                                                        <button class="btn-white btn btn-xs"><i class="fa fa-list"></i><a onClick="viewRegistryFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#viewRegistryModal">&nbsp;Review</a></button>
                                                        </br> 

                                                        <?php
                                                            $riskchampion_only=array(23);
                                                            if(in_array($this->session->userdata('role'), $riskchampion_only)) { ?>
                                                                <button class="btn-white btn btn-xs"><i class="fa fa-cogs"></i><a href="<?php echo base_url();?>registry/registry_edit/<?php echo $row->id;?>">&nbsp;Assess</a></button>
                                                        <?php } ?>


                                                        <?php
                                                        $rmu_only = array(4,7);
                                                        if(in_array($this->session->userdata('role'), $rmu_only)) { ?>

                                                        <button class="btn-white btn btn-xs"><i class="fa fa-pencil"></i> <a href="<?php echo base_url();?>registry/risk_register_edit_page/<?php echo $row->id;?>">&nbsp;Edit</a></button>
                                                        <br/>

                                                        <button class="btn-white btn btn-xs"><i class="fa fa-cogs"></i> <a href="<?php echo base_url();?>registry/registry_edit/<?php echo $row->id;?>">&nbsp;Assess</a></button>
                                                        <br/>
                                                        <button id="<?php echo $row->id;?>" class="btn-white btn btn-xs delete_risk_register"><i class="fa fa-trash"></i><a>&nbsp;Delete</a></button>

                                                        <?php } ?>

                                                    </td>
                                                </tr>
                                                <?php  }
                                            }else{ ?>
                                                <tr class="gradeX">
                                                    <td colspan="5">Risk Register has no data to assess</td>
                                                </tr>                            
                                                <?php  } ?>                    
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                            </table>                                   
                                        </div>
                            </div>
                        </div>
                    <!-- END BODY -->           
                    </div>
                </div>

                <!-- All the Project Risk Category -->
                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                    <!-- START  BODY -->
                    <div class="row">
                        <div class="col-lg-12">                   
                                    <h4>List of Risk Register (Project Category) </h4>                                                       
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover display" id="dataTable3_riskEmerge" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            if($list_project_registry->num_rows() > 0) {
                                                foreach($list_project_registry->result() as $row){
                                            ?>
                                                    <tr class="gradeX">
                                                    <td><?php echo  $row->activity; ?></td>
                                                    <!-- CAUSES -->
                                                    <td>
                                                        <ol>
                                                            <?php
                                                            $list_causes  = $this->registry_model->getRegistry_causes($row->id);
                                                            foreach($list_causes->result() as $cause){?>                                       
                                                                <li><?php echo  $cause->causes; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- EVENTS -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_events  = $this->registry_model->getRegistry_events($row->id);
                                                            foreach($list_events->result() as $event){?>                                       
                                                                <li><?php echo  $event->events; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <!-- CONSEQUENCES -->
                                                    <td>
                                                        <ol>
                                                            <?php 
                                                            $list_consequences  = $this->registry_model->getRegistry_consequences($row->id);
                                                            foreach($list_consequences->result() as $consequence){?>                                       
                                                                <li><?php echo  $consequence->consequences; ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </td>

                                                    <?php
                                                
                                                     
                                                    if($row->trend_name == 'Upward - Amber')
                                                    {
                                                        $label = 'warning';
                                                        $font_label = 'arrow-up';
                                                    }elseif($row->trend_name == 'Downward - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'arrow-down';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Red')
                                                    {
                                                       $label = 'danger';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Constant - Green')
                                                    {
                                                       $label = 'primary';
                                                       $font_label = 'exchange';  
                                                    }
                                                     elseif($row->trend_name == 'Constant - Amber')
                                                    {
                                                       $label = 'warning';
                                                       $font_label = 'exchange';  
                                                    }
                                                    elseif($row->trend_name == 'Downward - Red')  
                                                    {
                                                        $label = 'danger';
                                                        $font_label = 'arrow-down';
                                                    }
                                                    else
                                                    {
                                                        $label = 'primary';
                                                        $font_label = 'arrow-up';
                                                    }
                                                    ?>
                                                    
                                                    <td> 
                                                        <i class="fa fa-<?php echo $font_label;?> fa-lg"></i>
                                                        <span class="label label-<?php echo $label;?>"><?php echo  $row->trend_name;?> </span>  
                                                    </td>
                                                    <td>
                                                        <button class="btn-white btn btn-xs"><i class="fa fa-list"></i><a onClick="viewRegistryFunction(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#viewRegistryModal">&nbsp;Review</a></button>
                                                        </br> 

                                                        <?php
                                                            $riskchampion_only=array(23);
                                                            if(in_array($this->session->userdata('role'), $riskchampion_only)) { ?>
                                                                <button class="btn-white btn btn-xs"><i class="fa fa-cogs"></i><a href="<?php echo base_url();?>registry/registry_edit/<?php echo $row->id;?>">&nbsp;Assess</a></button>
                                                        <?php } ?>


                                                        <?php
                                                        $rmu_only = array(4,7);
                                                        if(in_array($this->session->userdata('role'), $rmu_only)) { ?>

                                                        <button class="btn-white btn btn-xs"><i class="fa fa-pencil"></i> <a href="<?php echo base_url();?>registry/risk_register_edit_page/<?php echo $row->id;?>">&nbsp;Edit</a></button>
                                                        <br/>

                                                        <button class="btn-white btn btn-xs"><i class="fa fa-cogs"></i> <a href="<?php echo base_url();?>registry/registry_edit/<?php echo $row->id;?>">&nbsp;Assess</a></button>
                                                        <br/>
                                                        <button id="<?php echo $row->id;?>" class="btn-white btn btn-xs delete_risk_register"><i class="fa fa-trash"></i><a>&nbsp;Delete</a></button>

                                                        <?php } ?>
                                                        
                                                    </td>
                                                </tr>
                                                <?php  }
                                            }else{ ?>
                                                <tr class="gradeX">
                                                    <td colspan="5">Risk Register has no data to assess</td>
                                                </tr>                            
                                                <?php  } ?>                    
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Causes </th>
                                                <th>Events </th>                                                   
                                                <th>Consequences</th>                   
                                                <th>Trend</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                            </table>                                   
                                        </div>
                            </div>
                        </div>
                    <!-- END BODY -->  
                    </div>
                </div>
        </div>
      </div>
    </div>
<!-- END -->








<!-- Start View Risk Registry -->
<div class="modal fade" id="viewRegistryModal" tabindex="-1" role="dialog" aria-labelledby="viewRegistryModal" aria-hidden="true">
       <div class="modal-dialog">    
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title" id="exampleModalLabel">View Risk Registry </h4> 
                      </div>

      <div class="modal-body">
 
                <form method="post">
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <div class="form-group">

                        <label><strong> Activity <span class="text-danger">*</span></label> </strong></label>
                        <textarea readonly name="view_activity" id="view_activity" class="form-control">   </textarea>                       

                        <label><strong> Risk Category <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_risk_category" id="view_risk_category" class="form-control" readonly/> 

                        <label><strong> Risk Owner <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_risk_owner" id="view_risk_owner" class="form-control" readonly/>

                        <label><strong> Affected Institutional objective(s) <span class="text-danger">*</span></label> </strong></label>
                            <div id="list_objectives">

                            </div>

                        <label><strong> List of Possible Event(s)  </strong></label>
                        <div id="list_events">

                        </div>

                        <label><strong> List of Possible Cause(s) </strong></label>
                            <div id="list_causes">

                            </div>   
                            
                         
                            
                        <label><strong> List of Possible  Consequence(s)  </strong></label>
                                <div id="list_consequences">

                                </div> 

                        <!-- START INHERIT ANALYSIS -->    
                        <div class="row">
                            <div class="col-sm-4">
                                <label><strong> Impact Score </strong></label>
                                <input type="text" name="view_impact_score" id="view_impact_score" class="form-control" readonly/> 
                            </div> 
                            <div class="col-sm-4">
                                <label><strong> LikeHood Score </strong></label>
                                <input type="text" name="view_like_hood_score" id="view_like_hood_score" class="form-control" readonly/>                            
                            </div> 
                            <div class="col-sm-4">
                                <label><strong> Risk Magnitude <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_risk_magnitude" id="view_risk_magnitude" class="form-control" readonly/>                        
                            </div> 
                        </div>                                        
                        <!-- END INHERIT ANALYSIS -->
                        
                        <label><strong> List of Existing Control(s)  </strong></label>
                                <div id="list_excontrols">

                                </div>  

                        <!-- START  EFFECTIVE CONTROLS ANALYSIS -->
                        <div class="row">
                            <div class="col-sm-6">
                                <label><strong> Effective of Existing Controls <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_eff_controls" id="view_eff_controls" class="form-control" readonly/> 
                            </div> 
                            <div class="col-sm-6">
                                <label><strong> Residual Risk Score  <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_residual_risk_score" id="view_residual_risk_score" class="form-control" readonly/> 
                            </div>  
                        </div>        
                         <!-- END   EFFECTIVE CONTROLS ANALYSIS -->   
                              
                        <label><strong> List of Additional Control(s)  </strong></label>
                                <div id="list_adcontrols">

                                </div>         

                        <label><strong> Remarks <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_remarks" id="view_remarks" class="form-control" readonly/> 

                        <label><strong> Status <span class="text-danger">*</span></label> </strong></label>
                        <input type="text" name="view_status" id="view_status" class="form-control" readonly/> 

                        <div class="row">
                            <div class="col-sm-4">
                                <label><strong> Trends <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_trends" id="view_trends" class="form-control" readonly/>  
                            </div> 
                            <div class="col-sm-4">
                                <label><strong> Quarter <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_quarter" id="view_quarter" class="form-control" readonly/> 
                            </div> 
                            <div class="col-sm-4">
                                <label><strong> Year  <span class="text-danger">*</span></label> </strong></label>
                                <input type="text" name="view_year" id="view_year" class="form-control" readonly/> 
                            </div>  
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

<!-- End View Risk Registry -->


<!-- Start EDIT Risk Register -->
<div id="editRiskRegisterModal" class="modal inmodal fade" role="dialog" aria-hidden="true" data-focus="false" data-backdrop="static" data-keyboard="false">  
     <div class="modal-dialog modal-lg animated fadeIn">  
          <form method="post" id="catalogseffectivenessscale_form">  
               <div class="modal-content">  
                    <div class="modal-header">  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>  
                         <h4 class="modal-title"></h4>  
                    </div>  
                    <div class="modal-body"> 
                        <div class="row">     
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5>General Information</h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                                                <input type="hidden" name="edit_registry_id" id="edit_registry_id" class="form-control">
                                                <label><strong>Activity<span class="text-danger">*</span></label></strong></label>
                                                <textarea name="edit_activity" id="edit_activity" class="form-control" readonly></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><strong>Objectives Category<span class="text-danger">*</span></label></strong></label>
                                                <input class="form-control" type="text" name="edit_objective_category" id="edit_objective_category" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><strong>Risk Owner<span class="text-danger">*</span></label></strong></label>
                                                <input class="form-control" type="text" name="edit_directorate_id" id="edit_directorate_id" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                        </div>

                      

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5>Events Assessment<span class="text-danger">*</span></label></strong></h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <!-- <button type="submit" id="addEventsReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i><b>Reason</b></button> -->
                                                    <button class="btn-default btn btn-xs" id="addEvents" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i> <a href="#">Add</a></button>
                                                </div><br/>                                               
                                            </div>
                                        </div> 
                                        <input type="text" id="eventscount">
                                        <div class="row" id="toAddEvents">
                                            <!-- <textarea  name="consequences"  id="consequences"  class="form-control"></textarea> -->
                                            <!-- <div class="col-md-12" id="toAddEventsReason">
                                                <textarea  name="consequences"  id="consequences"  class="form-control"></textarea>
                                            </div> -->                                           
                                        </div>          
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5>Causes  Assessment<span class="text-danger">*</span></label> </strong></h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-12">                                            
                                                <div class="row">
                                                    <button type="submit" id="addCausesReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i>  <b>REASON</b></button>
                                                    <button type="submit" id="addCauses" class="btn btn-xs btn-success" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i>  <b>ADD</b></button>
                                                </div><br/>                                             


                                                <div id="toAddCauses">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control"></textarea> -->
                                                </div>
                                                <div id="toAddCausesReason">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control"></textarea> -->
                                                </div>                                                
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5> Consequences Assessment <span class="text-danger">*</span></label> </strong></h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <button type="submit" id="addConsequencesReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i>  <b>REASON</b></button>
                                                    <button type="submit" id="addConsequences" class="btn btn-xs btn-success" style="float:right; margin-right: 5px;"><i class="fa fa-plus"></i>  <b>ADD</b></button>
                                                </div><br/>                                                
                                                <div id="toAddConsequences">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control">   </textarea> -->
                                                </div>
                                                <div id="toAddConsequencesReason">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control">   </textarea> -->
                                                </div>
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                        </div>           
                     
                           
                        <div class="row">     
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5> Inherent Analysis </h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label><strong>Impact Score<span class="text-danger">*</span></strong></label>
                                                <input type="text" class="form-control" name="edit_impact_score" id="edit_impact_score" readonly/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><strong>Likehood<span class="text-danger">*</span></strong></label>
                                                <input type="text" class="form-control" name="edit_likehood" id="edit_likehood" readonly/>               
                                            </div> 
                                            <div class="col-sm-4">
                                                <label><strong> Risk Magnitude</strong></label>                   
                                                <input type="text" class="form-control" name="edit_magnitude" id="edit_magnitude" readonly/> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>           
                         </div> 
                 
                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5> Existing Controls Assessment <span class="text-danger">*</span> </strong></h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>             
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" id="addExControls" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                                                <div id="toAddExControls">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control">   </textarea> -->
                                                </div>
                                            </div>
                                        </div>           
                                    </div>  
                                </div>
                            </div>           
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5> Controls Analysis Assessment <span class="text-danger">*</span> </strong></h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label><strong>Effective of Existing Controls<span class="text-danger">*</span></strong></label> 
                                                <input type="text" class="form-control" name="edit_eff_excontrols" id="edit_eff_excontrols" readonly/>
                                            </div>  
                                            <div class="col-sm-6">
                                                <label><strong>Residual Risk Score<span class="text-danger">*</span></strong></label>
                                                <input type="text" class="form-control" name="edit_residual_score" id="edit_residual_score" readonly/>
                                            </div>           
                                        </div>            
                                    </div>  
                                </div>
                             </div>           
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                              <div class="ibox collapsed">
                                <div class="ibox-title">
                                    <h5> Additional Controls Assessment<span class="text-danger">*</span> </strong></h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>             
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" id="addADControls" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                                                <div id="toAddADControls">
                                                        <!-- <textarea  name="consequences"  id="consequences"  class="form-control">   </textarea> -->
                                                </div>
                                        </div>
                                    </div>           
                                </div>
                            </div>
                          </div>           
                        </div>

                        <div class="row">        
                            <div class="col-lg-12">
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5>Previous Quarter Assessment </h5>
                                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                                    </div>                                    
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label><strong> Status<span class="text-danger">*</span></strong></label>
                                                <textarea name="previous_status" id="previous_status" class="form-control" readonly></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label><strong>Remarks<span class="text-danger">*</span></strong></label>
                                                <textarea name="previous_remarks" id="previous_remarks" class="form-control" readonly></textarea>
                                            </div>                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label><strong>Trends<span class="text-danger">*</span></strong></label>
                                                <input class="form-control" type="text" name="previous_trends" id="previous_trends" style="width: 100%" readonly/> 
                                            </div>
                                            <div class="col-sm-4">
                                                <label><strong>Quarter<span class="text-danger">*</span></strong></label>
                                                <input class="form-control" type="text" name="previous_quarter" id="previous_quarter" style="width: 100%" readonly/> 
                                            </div>
                                            <div class="col-sm-4">
                                                <label><strong>Year<span class="text-danger">*</span></strong></label>
                                                <input class="form-control" type="text" name="previous_year" id="previous_year" style="width: 100%" readonly/> 
                                            </div>
                                        </div>                      
                                    </div>
                                </div>  
                            </div>
                        </div>
                         <p><span class="asterisk">*</span>&nbsp;Required field</p>
                    </div>  
                    <div class="modal-footer">  
                         <input type="hidden" name="catalogseffectivenessscale_id" id="catalogseffectivenessscale_id" />  
                         <input type="hidden" id="action" name="action" />                          
                         <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                    </div>  
               </div>  
          </form>  
     </div>  
</div>
<!-- End EDIT Risk Register -->






</div>



