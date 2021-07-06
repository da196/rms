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
                             <!--  <th width="5%">S/N</th>     -->
                             <!--  <th width="10%">Directorate</th>   -->
                              <th width="10%">Risk Owner</th>                               
                             <!--  <th width="5%">Objective</th> -->
                              <th width="10%">Main Activity</th>  
                              <th width="20%">Key Performance Indicator</th> 
                              <th width="">Resources</th>                              
                             <!--  <th width="10%">Risk Measurement</th>     -->
                             <th width="" style="background: green; color:white;">Green</th>    
                             <th width="" style="background: #ffbf00; color:white;">Amber</th>    
                             <th width="" style="background: red; color:white;">Red</th> 
                              <th width="20%">Action</th>
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
       <div class="modal-content animated fadeIn">
          <form method="post" id="keyriskindicators_form">  
               <div class="modal-content">  
                    <div class="modal-header">  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>  
                         <h4 class="modal-title"></h4>  
                    </div>  
                    <div class="modal-body">  
                         <!-- <label>Directorate/Unit</label><span class="asterisk">*</span> 
                         <select class="form-control" name="directorate" id="directorate" required>
                           <option value=""> -- Select -- </option>
                           <?php foreach($alldirectorates as $alldirectorate):?>
                              <option value="<?php echo $alldirectorate->id; ?>"><?php echo $alldirectorate->directorate_name; ?></option>
                           <?php endforeach;?>
                         </select> -->

                         <br />  
                         <label>Risk Owner</label><span class="asterisk">*</span> 
                         <select class="form-control" name="risk_owner" id="risk_owner" style="width: 100%" required>
                           <option value=""> -- Select -- </option>
                           <?php foreach($riskowners as $riskowner):?>
                              <option value="<?php echo $riskowner->id; ?>"><?php echo $riskowner->name; ?></option>
                           <?php endforeach;?>
                         </select>
                         <br />  
                         <!-- <label>Strategic Objective</label><span class="asterisk">*</span> 
                         <select class="form-control" name="objective_id" id="objective_id" required>
                           <option value=""> -- Select -- </option>
                           <?php foreach($organizationobjectives as $organizationobjective):?>
                              <option value="<?php echo $organizationobjective->id; ?>"><?php echo $organizationobjective->code; ?></option>
                           <?php endforeach;?>
                         </select>
                         <br />  --> 
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
                         <label>Resources</label><span class="asterisk">*</span>  
                         <textarea class="form-control" name="resources" id="resources" placeholder="Enter Resources ..." required rows="5"></textarea>
                         <br /> 


                        <label>Key Risk Indicator</label><span class="asterisk">*</span><br/>
                        <!--  <textarea class="form-control" name="risk_measurement" id="risk_measurement" placeholder="Enter Risk Measurement ..." required rows="5"></textarea>  -->
                        <div class="row">
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
                         <p><span class="asterisk">*</span>Required field</p>
                    </div>  
                    <div class="modal-footer">  
                         <input type="hidden" name="keyriskindicators_id" id="keyriskindicators_id" />  

                         <input type="hidden" id="action" name="action" /> 
                         <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                         <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->

                         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                    </div>  
               </div>  
          </form>
       </div>
     </div>  
</div> 


 <!-- View KRI Modal -->
 <div class="modal inmodal fade" id="keyriskindicatorsModal_L" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body table-responsive"> 
              <form id="keyriskindicators_form_viewonly">
                <!-- <div class="row">                  
                    <div class="col-md-12">
                        <label>Directorate/Unit</label>  
                        <input type="text" id="directorate" name="directorate" class="form-control"/> 
                    </div>                                                          
                </div> <br/> -->
                <div class="row">
                  <div class="col-md-12">
                      <label>Risk Owner</label>  
                      <input type="text" id="risk_owner" name="risk_owner" class="form-control"/>  
                  </div> 
                </div><br/>
                <div class="row">
                    <div class="col-md-12">
                        <label>Strategic Objective</label>   
                        <textarea class="form-control" name="objective_id" id="objective_id" rows="5"></textarea>
                    </div>                    
                </div><br/>
                <div class="row">
                    <div class="col-md-12">
                         <label>Main Activity</label>  
                         <textarea class="form-control" name="main_activity" id="main_activity" rows="5"></textarea>
                    </div>                    
                </div><br/>
                <div class="row">
                    <div class="col-md-12">
                         <label>Key Performance Indicator</label> 
                         <textarea class="form-control" name="key_performance_indicator" id="key_performance_indicator" rows="5"></textarea>
                    </div>                    
                </div>   <br/>              
                <div class="row">
                     <div class="col-md-12">
                          <label>Resources</label>  
                          <textarea class="form-control" name="resources" id="resources" rows="5"></textarea> 
                     </div>                    
                </div><br/>

                <label>Key Risk Indicator</label><br/>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4" >
                      <label style="color:green;">Acceptable Level</label>
                      <textarea class="form-control" name="kri_green_definition" id="kri_green_definition" rows="2" style="background:green; color: white;"></textarea>
                    </div>
                    <div class="col-md-4">
                      <label style="color:#ffbf00;">Beyond Acceptable Level</label>
                      <textarea class="form-control" name="kri_amber_definition" id="kri_amber_definition" rows="2" style="background:#ffbf00; color: white;"></textarea>
                    </div>
                    <div class="col-md-4">                                   
                      <label style="color:red;">Unacceptable Level</label>
                      <textarea class="form-control" name="kri_red_definition" id="kri_red_definition" rows="2" style="background:red; color: white;"></textarea>
                    </div>
                  </div>
                </div><br/> 


               <!--  <div id="kri_assessment_div">
                    <label>Risk Measurement</label><br/>                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4" >
                          <label style="color:green;">Acceptable Level</label>
                          <textarea class="form-control" name="kri_green_value" id="kri_green_value" rows="2" style="background:green; color: white;"></textarea>
                        </div>
                        <div class="col-md-4">
                          <label style="color:#ffbf00;">Beyond Acceptable Level</label>
                          <textarea class="form-control" name="kri_amber_value" id="kri_amber_value" rows="2" style="background:#ffbf00; color: white;"></textarea>
                        </div>
                        <div class="col-md-4">                                   
                          <label style="color:red;">Unacceptable Level</label>
                          <textarea class="form-control" name="kri_red_value" id="kri_red_value" rows="2" style="background:red; color: white;"></textarea>
                        </div>
                      </div>
                    </div>
                </div> --> 
                

                <!-- START PREVIOUS RISK ASSESSMENT -->
                <div class="previousassessment">
                   <label>Risk Measurement</label><span class="asterisk">*</span>
                   <div class="outer-accordion">                              
                   </div>
                </div>                        
                <!-- END PREVIOUS RISK ASSESSMENT -->


              </form>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
            </div>
        </div>
    </div>
</div>





