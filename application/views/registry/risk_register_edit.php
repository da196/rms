<?php
    require APPPATH.'views/include/header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Risk Register</h2>
        <ol class="breadcrumb">
            <li><a>Risk Register</a></li>
            <li class="active"><a><b>Edit</b></a></li>
         </ol>
    </div>
</div>
<br/>
<div class="row">     
    <div class="col-lg-12">
        <div class="ibox "><!-- collapsed -->
            <div class="ibox-title">
                <h5> General Information </h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>             
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-4">

                        <input type="text" name="createdAtFromDB" id="createdAtFromDB" value="<?php echo $createdAtFromDB; ?>">
                        <input type="text" name="createdByFromDB" id="createdByFromDB" value="<?php echo $createdByFromDB; ?>">

                        <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">

                        <input type="text" name="registry_id" id="registry_id" class="form-control" value="<?php echo $registry_id; ?>">
                        <label><strong>Activity&nbsp;<span class="text-danger">*</span></label></strong></label>
                        <textarea name="activity" id="activity" class="form-control" readonly><?php echo $activity; ?></textarea>
                    </div>
                    <div class="col-sm-4">
                        <label><strong>Objectives Category&nbsp;<span class="text-danger">*</span></label></strong></label>
                        <select class="form-control" name="objective_category" id="objective_category" style="width: 100%" disabled="">
                            <option> -- Select -- </option>
                            <?php
                                foreach($list_objective_category->result() as $row) {
                                    $selected = ($row->id == $objective_category) ? 'selected' : '';
                                    echo '<option value="' . $row->id . '" ' . $selected . '>';
                                    echo $row->objective_category;
                                    echo '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label><strong>Risk Owner&nbsp;<span class="text-danger">*</span></label></strong></label>
                        <select class="form-control"  name="directorate_id" id="directorate_id" style="width: 100%" disabled="">
                            <option> -- Select -- </option>
                            <?php
                                foreach($list_riskOwner->result() as $row){
                                    $selected = ($row->id == $riskowner) ? 'selected' : '';
                                    echo '<option value="' . $row->id . '" ' . $selected . '>';
                                    echo $row->name;
                                    echo '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>              
    </div>  
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Events Assessment&nbsp;<span class="text-danger">*</span></h5>
                <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <button type="submit" id="addEventsReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 25px;"><i class="fa fa-plus"></i>&nbsp;<b>REASON</b></button>
                            <button type="submit" id="addEvents" class="btn btn-xs btn-success" style="float:right; margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button>                                          
                        </div><br/>
                        <?php foreach($list_events->result() as $row){ ?>
                            <div class="col-sm-11">
                                <textarea name="events_edit"  id="<?php echo $row->id; ?>" class="form-control"><?php echo $row->events; ?></textarea></div>
                            <div class="col-sm-1"><button id="<?php echo $row->event_id; ?>" data-id="<?php echo $registry_id; ?>" name="remove" class="btn btn-xs delete_event btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button></div>
                        <?php } ?>                        
                        <div id="toAddEvents"></div>
                        <div id="toAddEventsReason"></div>
                    </div>
                </div>           
            </div>
        </div>
    </div>           
</div>
   
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Causes Assessment&nbsp;<span class="text-danger">*</span></h5>
                <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">                    
                        <div class="row">
                            <button type="submit" id="addCausesReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 25px;"><i class="fa fa-plus"></i>&nbsp;<b>REASON</b></button>
                            <button type="submit" id="addCauses" class="btn btn-xs btn-success" style="float:right; margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button>                                          
                        </div><br/>                    
                            <?php foreach($list_causes->result() as $row){ ?>
                                    <div class="col-sm-11"><textarea name="causes_edit" id="<?php echo $row->cause_id; ?>"  class="form-control" > <?php echo $row->causes; ?></textarea></div> 
                                    <div class="col-sm-1"><button id="<?php echo $row->cause_id; ?>" data-id="<?php echo $registry_id; ?>" name="remove" class="btn btn-xs delete_cause btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button></div>
                            <?php } ?>
                            <div id="toAddCauses"></div>
                            <div id="toAddCausesReason"></div>                        
                    </div>
                </div>           
            </div>
        </div>
    </div>           
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Consequences Assessment&nbsp;<span class="text-danger">*</span></h5>
                <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <button type="submit" id="addConsequencesReason" class="btn btn-xs btn-primary" style="float:right; margin-right: 25px;"><i class="fa fa-plus"></i>&nbsp;<b>REASON</b></button>
                            <button type="submit" id="addConsequences" class="btn btn-xs btn-success" style="float:right; margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button>                                          
                        </div><br/>
                        <?php foreach($list_consequences->result() as $row){ ?>
                            <div class="col-sm-11"><textarea  name="consequences_edit"  id="<?php echo $row->id; ?>"  class="form-control" > <?php echo $row->consequences; ?></textarea></div>
                            <div class="col-sm-1"><button id="<?php echo $row->cons_id; ?>" data-id="<?php echo $registry_id; ?>" name="remove" class="btn btn-xs delete_consequence btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button></div>
                        <?php } ?>                        
                        <div id="toAddConsequences"></div>
                        <div id="toAddConsequencesReason"></div>
                    </div>
                </div>           
            </div>
        </div>
    </div>           
</div>
   
<div class="row">     
    <div class="col-lg-12">
        <div class="ibox "><!-- collapsed -->
            <div class="ibox-title">
                <h5>Inherent Analysis</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>             
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-4">
                        <label><strong>Impact Score&nbsp;<span class="text-danger">*</span></strong></label>
                        <input type="hidden" class="form-control" name="temp_impact_score" id="temp_impact_score"/> 
                        <select class="form-control"  name="impact_score" id="impact_score" style="width: 100%" disabled="">
                            <option> -- Select -- </option>                       
                                <?php
                                    foreach($list_impact_scale->result() as $row) {
                                        $selected = ($row->id == $impact_scale_id) ? 'selected' : '';
                                        echo '<option value="' . $row->id . '" ' . $selected . '>';
                                        echo $row->impact_scale;
                                        echo '</option>';
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label><strong>Likelihood&nbsp;<span class="text-danger">*</span></strong></label>
                        <input type="hidden" class="form-control" name="temp_likehood" id="temp_likehood"/>                        
                        <select class="form-control"  name="likehood" id="likehood" style="width: 100%" disabled="">
                            <?php
                            foreach($list_likehood_scale->result() as $row) {
                                $selected = ($row->id == $like_hood_scale_id) ? 'selected' : '';
                                echo '<option value="' . $row->id . '" ' . $selected . '>';
                                echo $row->like_hood_scale;
                                echo '</option>';
                            }
                            ?>
                        </select>                
                    </div> 
                    <div class="col-sm-4">
                        <label><strong>Risk Magnitude&nbsp;<span class="text-danger">*</span></strong></label>                   
                        <input type="hidden" class="form-control" name="hidden_magnitude" id="hidden_magnitude" readonly/> 
                        <input type="text" class="form-control" name="magnitude" id="magnitude"  value="<?php echo $magnitude; ?>"readonly/> 
                    </div> 
                </div>  
            </div>
        </div>           
    </div> 
</div>
    
<div class="row">
    <div class="col-lg-12">
     <div class="ibox ">
        <div class="ibox-title">
            <h5> Existing Controls Assessment&nbsp;<span class="text-danger">*</span></h5>
            <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addExControls" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button></br></br></br>                                      
                    <?php foreach($list_excontrols->result() as $row){ ?>
                    <div class="col-sm-11"><textarea  name="excontrols_edit"  id="<?php echo $row->id; ?>"  class="form-control" > <?php echo $row->excontrols; ?></textarea></div> 
                    <div class="col-sm-1"><button id="<?php echo $row->excontr_id; ?>" data-id="<?php echo $registry_id; ?>" name="remove" class="btn btn-xs delete_excontrol btn-danger" ><i class="fa fa-trash"></i>&nbsp;Remove</button></div>    
                    <?php } ?>
                    <div id="toAddExControls">
                    </div>
                </div>
            </div>           
        </div>  
    </div>
 </div>           
</div>


<div class="row">
    <div class="col-lg-12">
     <div class="ibox ">
        <div class="ibox-title">
            <h5>Controls Analysis Assessment</strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
        <div class="row">
                <div class="col-sm-6">
                    <label><strong>Effective of Existing Controls&nbsp;<span class="text-danger">*</span></strong></label> 
                    <input type="hidden" class="form-control" name="temp_eff_excontrols" id="temp_eff_excontrols"/>                  
                    <select class="form-control"  name="eff_excontrols" id="eff_excontrols" style="width: 100%" disabled="">
                        <option> -- Select -- </option>            
                        <?php
                            foreach($list_eff_controls->result() as $row) {
                                $selected = ($row->id == $controls_effectiveness_scale_id) ? 'selected' : '';
                                echo '<option value="' . $row->id . '" ' . $selected . '>';
                                echo $row->controls_effectiveness_scale;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>   
                 <div class="col-sm-6">
                    <label><strong>Residual Risk Score&nbsp;<span class="text-danger">*</span></strong></label>                   
                    <input type="hidden" class="form-control" name="hidden_residual_score" id="hidden_residual_score" /> 
                    <input type="text" class="form-control" name="residual_score" id="residual_score" value="<?php echo $residual_risk_score;?>" readonly/> 
                </div>           
            </div>            
        </div>  
    </div>
 </div>           
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
            <h5>Additional Controls Assessment&nbsp;<span class="text-danger">*</span></h5>
            <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addADControls" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>&nbsp;<b>ADD</b></button></br></br></br>
                    <?php foreach($list_adcontrols->result() as $row){ ?>
                        <div class="col-sm-11"><textarea  name="excontrols_edit"  id="<?php echo $row->id; ?>"  class="form-control" > <?php echo $row->adcontrols; ?> </textarea></div> 
                        <div class="col-sm-1"><button id="<?php echo $row->adcontr_id; ?>" data-id="<?php echo $registry_id; ?>" name="remove" class="btn btn-xs delete_adcontrol btn-danger" ><i class="fa fa-trash"></i>&nbsp;Remove</button></div>                                                 
                    <?php } ?>
                    <div id="toAddADControls"></div>
                </div>
            </div>           
        </div>
    </div>
  </div>           
</div>

<div class="row">        
    <div class="col-lg-12">
      <div class="ibox "><!-- collapsed -->
        <div class="ibox-title">
            <h5>Previous Quarter Assessment</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>            
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-6">
                    <label><strong>Status&nbsp;<span class="text-danger">*</span></strong></label>
                    <textarea name="status" id="status" class="form-control"><?php echo $status; ?></textarea>
                </div>
                <div class="col-sm-6">
                    <label><strong>Remarks&nbsp;<span class="text-danger">*</span></strong></label>
                    <textarea name="remarks" id="remarks" class="form-control"><?php echo $remarks; ?></textarea>
                </div>                
            </div><br/>
            <div class="row">
                <div class="col-sm-4">
                    <label><strong>Trends&nbsp;<span class="text-danger">*</span></strong></label>                 
                    <select class="form-control" name="trends" id="trends" style="width: 100%">
                    <option> -- Select -- </option>
                        <?php
                            foreach($list_trends->result() as $row) {
                                $selected = ($row->id == $trends) ? 'selected' : '';
                                echo '<option value="' . $row->id . '" ' . $selected . '>';
                                echo $row->trend_name;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong>Quarter&nbsp;<span class="text-danger">*</span></strong></label>
                    <select class="form-control" name="quarter" id="quarter" style="width: 100%" disabled="">
                            <option> -- Select -- </option>
                            <?php
                                foreach($list_quarter->result() as $row) {
                                    $selected = ($row->id == $quarter) ? 'selected' : '';
                                    echo '<option value="' . $row->id . '" ' . $selected . '>';
                                    echo $row->quarter_name;
                                    echo '</option>';
                                }
                            ?>                         
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong>Year&nbsp;<span class="text-danger">*</span></strong></label>
                    <select class="form-control" name="year" id="year" style="width: 100%" disabled="">
                            <option> -- Select -- </option>
                            <?php
                                foreach($list_year->result() as $row) {
                                    $selected = ($row->id == $year_id) ? 'selected' : '';
                                    echo '<option value="' . $row->id . '" ' . $selected . '>';
                                    echo $row->year;
                                    echo '</option>';
                                }
                            ?>
                            >                         
                    </select>
                </div>
            </div>                      
        </div>
       </div>  
    </div>
</div>

<div class="row">                
    <div class="col-sm-12">     
        <button type="submit" id="edit_risk_register_btn" class="btn btn-success btn-block" style="float:right;"><i class="fa fa-pencil-square-o"></i><b>&nbsp;Update</b></button>
        
    </div>
</div>
<br/>
<br/>
<br/>



<?php
  require APPPATH.'views/include/footer.php';
?>


