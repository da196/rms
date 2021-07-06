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
   
<!-- CREATE FORM -->
<div class="row">
   <div class="col-lg-12">
     <div class="ibox float-e-margins">
       <div class="ibox-content">
          <form method="post" id="keyriskindicators_form" class="form-horizontal">  
            <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title"><?php echo $subtitle.' '.$title ?></h4>  
               </div>  
               <div class="modal-body"> 
                   <!-- RISK OWNER -->
                    <label>Risk Owner</label><span class="asterisk">*</span> 
                    <select class="form-control" name="risk_owner" id="risk_owner" style="width: 100%">
                      <option value=""> -- Select -- </option>
                      <?php foreach($riskowners as $riskowner):?>
                         <option value="<?php echo $riskowner->id; ?>"><?php echo $riskowner->name; ?></option>
                      <?php endforeach;?>
                    </select>
                    <br /> <br /> 
                    <!-- STRATEGIC OBJECTIVES -->
                    <label>Strategic Objective</label><span class="asterisk">*</span><br/>
                    <?php foreach($organizationobjectives as $organizationobjective) { ?>
                      <input type="checkbox" name="objective_id[]" id="objective_id" value="<?php echo $organizationobjective->id; ?>"> <?php echo $organizationobjective->name; ?> </br>
                    <?php } ?> 
                    <br />  
                    <!-- MAIN ACTIVITY -->
                    <label>Main Activity</label><span class="asterisk">*</span>   
                    <textarea class="form-control" name="main_activity" id="main_activity" placeholder="Enter main activity ..."  rows="5"></textarea>                    
                    <br /> 
                    <!-- KEY PERFOMANCE INIDICATOR -->
                    <label>Key Performance Indicator</label><span class="asterisk">*</span>  
                    <textarea class="form-control" name="key_performance_indicator" id="key_performance_indicator" placeholder="Enter a key performance Indicator ..."  rows="5"></textarea>
                    <br /> 
                    <!-- RESOURCES -->
                    <label>Resources</label><span class="asterisk">*</span>  
                    <textarea class="form-control" name="resources" id="resources" placeholder="Enter Resources ..."  rows="5"></textarea>
                    <br /> 
                    <!-- KEY RISK INDICATOR DEFINITIONS -->
                   <label>Key Risk Indicator</label><span class="asterisk">*</span><br/>
                   <div class="row">
                     <div class="col-md-12">
                      <!-- GREEN DEFINITION -->
                       <div class="col-md-4" >
                         <label style="color:green;">Acceptable Level</label>
                         <textarea class="form-control" name="kri_green_definition" id="kri_green_definition" placeholder="Enter Green Key Risk Indicator ..."  rows="2" style="background:green; color: white;"></textarea>
                       </div>
                       <!-- AMBER DEFINITION -->
                       <div class="col-md-4">
                         <label style="color:#ffbf00;">Beyond Acceptable Level</label>
                         <textarea class="form-control" name="kri_amber_definition" id="kri_amber_definition" placeholder="Enter Amber Key Risk Indicator  ..."  rows="2" style="background:#ffbf00; color: white;"></textarea>
                       </div>
                       <!-- RED DEFINITION -->
                       <div class="col-md-4">                                   
                         <label style="color:red;">Unacceptable Level</label>
                         <textarea class="form-control" name="kri_red_definition" id="kri_red_definition" placeholder="Enter Red Key Risk Indicator  ..."  rows="2" style="background:red; color: white;"></textarea>
                       </div>
                     </div>
                   </div>  
                   <br /> 

                   <!-- Year -->
                   <!--  <label>Year</label><span class="asterisk">*</span>  
                    <select class="form-control" name="year" id="year">
                      <?php foreach($list_year->result() as $row) { ?>
                      <?php
                          //grab first four string
                          $year = substr($row->year, 0, 4);
                          //get current year
                          $currentyear = date("Y");
                          //make current year a default selection
                          if($year ==  $currentyear ){ 
                      ?>
                          <option selected="selected" value="<?php echo $row->id; ?>"> <?php echo $row->year; ?> </option>
                      <?php
                          }else{
                       ?>
                          <option value="<?php echo $row->id; ?>"> <?php echo $row->year; ?> </option>
                       <?php
                          }
                      ?>                          
                      <?php } ?>                         
                    </select>
                    <br />  -->
                   
                   <!-- Quarter -->
                   <!--  <label>Quarter</label><span class="asterisk">*</span>  
                    <select class="form-control" name="quarter" id="quarter">
                    <?php
                    //display only quarter one, not any other quarter
                    //control to see other quarters will be on assessment 
                    foreach($list_quarter->result() as $row)
                    { 
                      if($row->quarter_name == 'One'){ ?>
                        <option value="<?php echo $row->id; ?>"> <?php echo $row->quarter_name; ?> </option>
                    <?php
                      }
                    ?>                      
                    <?php } ?>                     
                    </select>
                    <br />  -->

                    <p><span class="asterisk">*</span>Required field</p>
               </div>  
               <div class="modal-footer">  
                  <input type="hidden" name="keyriskindicators_id" id="keyriskindicators_id" />
                 <!--  <input type="hidden" id="action" name="action" value="Add" />  -->
                  <input type="hidden" id="action" name="action"/>


                  <button type="submit" id="saveasdraft" name="saveasdraft" class="btn btn-warning btn-sm"><i class="fa fa-save"></i>&nbsp;Save as Draft</button>&nbsp; 

                  <button type="submit" id="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i>&nbsp;Submit</button>
                 <!--  <input type="submit" id="submit" name="submit" class="btn btn-success" />  -->
                  <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->
               </div>  
            </div>  
          </form>
       </div>
     </div>
   </div>
</div>





