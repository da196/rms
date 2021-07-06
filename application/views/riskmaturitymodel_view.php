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
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Risk</a>
            </li>
            <li class="active">
                <strong><?php echo $title; ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>


<!-- RMM Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
        	
        	<div class="ibox-title"> 
              <h5><?php echo $title; ?> - List</h5>         		
                <div class="ibox-tools">
                    <!-- RMM CREATE BUTTON -->
                    <button type="button" class="btn btn-success" id="add_button_riskmaturitymodel" data-toggle="modal" data-target="#riskmaturitymodelModal"><i class="fa fa-plus"></i>&nbsp;Create</button>                    
                </div>                 
            </div>
            <div class="ibox-content">
                <div class="table-responsive">   
                     <table id="riskmaturitymodel_data" class="table table-bordered table-striped" style="width:100%">  
                        <thead>  
                           <tr>  
                              <th width="10%">S/N</th>    
                              <th width="20%">Reporting Unit</th>  
                              <th width="30%">Process</th>  
                              <th width="20%">Risk Level</th> 
                              <th width="20%">Action</th>
                           </tr>  
                        </thead>  
                     </table>  
                </div>  
            </div>
        </div>
    </div>
</div>



 <!-- Insert RMM Modal -->
 <div id="riskmaturitymodelModal" class="modal fade">  
      <div class="modal-dialog modal-lg">  
           <form method="post" id="riskmaturitymodel_form">  
                <div class="modal-content animated fadeIn">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body"> 
                          <label>Reporting Unit</label><span class="asterisk">*</span> 
                          <select class="form-control" name="reporting_unit" id="reporting_unit" style="width: 100%" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($alldirectorates as $alldirectorate):?>
                               <option value="<?php echo $alldirectorate->id; ?>"><?php echo $alldirectorate->directorate_name; ?></option>
                            <?php endforeach;?>
                          </select>
                         
                          <br />

                          <label>Process/Activity</label><span class="asterisk">*</span>
                          <select class="form-control" name="process_id" id="process_id" style="width: 100%" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($rmm_processes as $rmm_process):?>
                               <option value="<?php echo $rmm_process->id; ?>"><?php echo $rmm_process->name; ?></option>
                            <?php endforeach;?>
                          </select> 
                          <br />  
                          <label>Risk Level</label><span class="asterisk">*</span> 
                          <select class="form-control" name="risk_level_id" id="risk_level_id" style="width: 100%" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($risklevels as $risklevel):?>
                               <option value="<?php echo $risklevel->id; ?>"><?php echo $risklevel->name; ?></option>
                            <?php endforeach;?>
                          </select> 
                          <br />  

                          <label>Risk Level Description</label><span class="asterisk">*</span> 
                          <textarea class="form-control" name="risk_level_description" id="risk_level_description" placeholder="Enter Risk Level Description ..." required rows="5"></textarea>
                          <br /> 
                          <p><span class="asterisk">*</span>Required field</p>
                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="riskmaturitymodel_id" id="riskmaturitymodel_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                          <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>
                     </div>  
                </div> 
           </form>  
      </div>  
 </div> 


 <!-- View RMM Modal -->
 <div class="modal inmodal fade" id="riskmaturitymodelModal_L" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"> 
              <form id="riskmaturitymodel_form_viewonly">
                <div class="row">
                    <div class="col-md-12">
                        <label>Reporting Unit</label>  
                        <input type="text"  id="reporting_unit" name="reporting_unit" class="form-control"/>  
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <label>Process/activity</label>  
                         <input type="text" id="process_id" name="process_id" class="form-control"/>  
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <label>Risk Level</label>  
                         <input type="text" id="risk_level_id" name="risk_level_id" class="form-control"/>  
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <label>Risk Level Description</label>  
                         <textarea class="form-control" rows="5" name="risk_level_description" id="risk_level_description"></textarea>
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


