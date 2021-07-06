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



<!-- KRI Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">        
            <div class="ibox-content">
                <div class="table-responsive">   
                     <table id="keyriskindicators_data" class="table table-bordered table-striped" style="width:100%">  
                        <thead>  
                           <tr>  
                              <!-- <th width="">S/N</th>  -->   
                             <!--  <th width="10%">Directorate</th>   -->
                              <th width="10%">Risk Owner</th>                               
                              <!-- <th width="5%">Objective</th> -->
                              <th width="">Main Activity</th>  
                              <th width="20%">Key Performance Indicator</th> 
                              <th width="">Resources</th>                              
                             <!--  <th width="10%">Risk Measurement</th>     -->
                             <th width="" style="background: green; color:white;">Green</th>    
                             <th width="" style="background: #ffbf00; color:white;">Amber</th>    
                             <th width="" style="background: red; color:white;">Red</th>    
                              <th width="10%">Action</th>
                           </tr>  
                        </thead>  
                     </table>  
                </div>  
            </div>
        </div>
    </div>
</div>



 <!-- Insert KRI Modal -->
 <div id="keyriskindicatorsModal" class="modal inmodal fade">  
      <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn table-responsive">
           <form method="post" id="keyriskindicators_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close closebtn" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body">  
                          <!-- <label>Directorate/Unit</label><span class="asterisk">*</span> 
                          <select class="form-control" name="directorate" id="directorate" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($alldirectorates as $alldirectorate):?>
                               <option value="<?php echo $alldirectorate->id; ?>"><?php echo $alldirectorate->directorate_name; ?></option>
                            <?php endforeach;?>
                          </select>

                          <br />  --> 
                          <label>Risk Owner..</label><span class="asterisk">*</span> 
                          <select class="form-control" name="risk_owner" id="risk_owner" style="width: 100%" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($riskowners as $riskowner):?>
                               <option value="<?php echo $riskowner->id; ?>" onfocus="this.blur()" readonly="readonly"><?php echo $riskowner->name; ?></option>
                            <?php endforeach;?>
                          </select>
                          <br />  
                          <!-- <label>Strategic Objective</label><span class="asterisk">*</span> 
                          <select class="form-control" name="objective_id" id="objective_id" required>
                            <option value=""> -- Select -- </option>
                            <?php foreach($organizationobjectives as $organizationobjective):?>
                               <option value="<?php echo $organizationobjective->id; ?>"><?php echo $organizationobjective->code; ?></option>
                            <?php endforeach;?>
                          </select> -->
                          <label>Strategic Objective</label><span class="asterisk">*</span><br/>
                          <?php foreach($organizationobjectives as $organizationobjective) { ?>
                            <input type="checkbox" name="objective_id[]" id="objective_id" value="<?php echo $organizationobjective->id; ?>"> <?php echo $organizationobjective->name; ?> </br>
                          <?php } ?>      
                          <br />  

                          <label>Main Activity</label><span class="asterisk">*</span>   
                          <textarea class="form-control" name="main_activity" id="main_activity" placeholder="Enter main activity ..." required rows="5"></textarea>
                          <br /> 
                          <label>Key Performance Indicator</label><span class="asterisk">*</span>  
                          <textarea class="form-control" name="key_performance_indicator" id="key_performance_indicator" placeholder="Enter a key performance Indicator ..." required rows="5"></textarea>
                          <br /> 
                          <label>Key Risk Indicator Resources</label><span class="asterisk">*</span>  
                          <textarea class="form-control" name="resources" id="resources" placeholder="Enter Resources ..." required rows="5"></textarea>
                          <br /> 


                         <label>Key Risk Indicator</label><span class="asterisk">*</span><br/>
                         <!--  <textarea class="form-control" name="risk_measurement" id="risk_measurement" placeholder="Enter Risk Measurement ..." required rows="5"></textarea>  -->
                         <div class="row" id="kri_definition">
                           <div class="col-md-12">
                             <div class="col-md-4" >
                                <label style="color:green;">Acceptable Level</label>
                                <textarea class="form-control" name="kri_green_definition" id="kri_green_definition" placeholder="Enter Green Key Risk Indicator ..." required rows="2" style="background:green; color: white;"></textarea>
                             </div>
                             <div class="col-md-4">
                                <label style="color:#ffbf00;">Beyond Acceptable Level</label>
                                <textarea class="form-control" name="kri_amber_definition" id="kri_amber_definition" placeholder="Enter Amber Key Risk Indicator  ..." required rows="2" style="background:#ffbf00; color: white;"></textarea>
                             </div>
                             <div class="col-md-4">                                   
                                <label style="color:red;">Unacceptable Level</label>
                                <textarea class="form-control" name="kri_red_definition" id="kri_red_definition" placeholder="Enter Red Key Risk Indicator  ..." required rows="2" style="background:red; color: white;"></textarea>
                             </div>
                           </div>
                         </div>  
                         <br /> 

                         <label>Risk Measurement</label><span class="asterisk">*</span>

                         <!-- START PREVIOUS RISK ASSESSMENT -->
                         <div class="previousassessment">
                            <div class="outer-accordion">                              
                            </div>
                         </div>                        
                         <!-- END PREVIOUS RISK ASSESSMENT -->


                         <div class="row" id="kri_value">
                             <div class="col-md-12">
                                <label>Year</label>
                                <select class="form-control" name="year" id="year" style="width: 100%" required>
                                  <option value=""> -- Select Year -- </option>
                                  <?php foreach($years as $year):?>
                                     <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                  <?php endforeach;?>
                                </select>
                             </div>
                             <div class="col-md-12">
                                <label>Quarter</label>
                                <select class="form-control" name="quarter" id="quarter" style="width: 100%" required>
                                  <option value=""> -- Select Quarter -- </option>
                                  <?php foreach($quarters as $quarter):?>
                                     <option value="<?php echo $quarter->id; ?>"><?php echo $quarter->quarter_name; ?></option>
                                  <?php endforeach;?>
                                </select>
                             </div>                        
                             <div class="col-md-12">
                               <div class="col-md-4" >
                                 <label style="color:green;">Acceptable Level</label>
                                 <textarea class="form-control" name="kri_green_assessment" id="kri_green_assessment" placeholder="Assess Green Key Risk Indicator ..."  rows="2" style="background:green; color: white;"></textarea>
                               </div>
                               <div class="col-md-4">
                                 <label style="color:#ffbf00;">Beyond Acceptable Level</label>
                                 <textarea class="form-control" name="kri_amber_assessment" id="kri_amber_assessment" placeholder="Assess Amber Key Risk Indicator  ..."  rows="2" style="background:#ffbf00; color: white;"></textarea>
                               </div>
                               <div class="col-md-4">                                   
                                 <label style="color:red;">Unacceptable Level</label>
                                 <textarea class="form-control" name="kri_red_assessment" id="kri_red_assessment" placeholder="Assess Red Key Risk Indicator  ..."  rows="2" style="background:red; color: white;"></textarea>
                               </div>
                             </div>
                         </div> 
                         <br /> 
                         <p><span class="asterisk">*</span>Required field</p>
                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="keyriskindicators_id" id="keyriskindicators_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" value="Submit" /> 
                          <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->
                          <button type="button" class="btn btn-default closebtn" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                     </div>  
                </div>  
           </form>
        </div>
      </div>  
 </div> 







