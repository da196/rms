<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
    <h2> Risk Assessment  </h2>
        <ol class="breadcrumb">
            <li>
                 <a>Risk Register</a>
            </li>
            
            <li class="active">
                <a href="<?php echo base_url();?>registry/index"> <strong> Assess  </strong></a>                         
            </li>
         </ol>
    </div>
</div>


<div class="row">     
    <div class="col-lg-12">
        <div class="ibox">
        <div class="ibox-title">
            <h5>General Information </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-4">
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">

                    <label><strong> Activity/Risk Name <span class="text-danger">*</span></label></strong></label>
                    <textarea name="activity"  id="activity"  class="form-control"></textarea>
                </div>
                <div class="col-sm-4">
                    <label><strong> Risk Category <span class="text-danger">*</span></label></strong></label>
                    <select class="form-control"  name="risk_category" id="risk_category" style="width: 100%">
                        <option> -- Select -- </option>
                        <?php
                        foreach($list_objective_category->result() as $row)
                        { ?>
                        <option value="<?php echo $row->id; ?>"> <?php echo $row->objective_category; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong> Risk Owner <span class="text-danger">*</span></label> </strong></label>
                    <select class="form-control"  name="riskOwner_id" id="riskOwner_id" style="width: 100%">
                        <option> -- Select -- </option>
                        <?php
                             foreach($list_riskOwner->result() as $row)
                              { ?>
                                <option value="<?php echo $row->id; ?>"> <?php echo $row->name; ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <label><strong> Affected Institutional objective(s)  <span class="text-danger">*</span></label> </strong></label></br>                             
                    <?php
                        foreach($list_objectives->result() as $row)
                        { ?>
                        <input class="i-checks" type="checkbox" name="objectives" id="objectives" value="<?php echo $row->id; ?>"> <?php echo $row->name; ?>" </br>
                   <?php } ?>                                 
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
            <h5>Causes <span class="text-danger">*</span></label> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addCauses" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                        <div id="toAddCauses">
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
            <h5>Events <span class="text-danger">*</span></label> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addEvents" class="btn  btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                        <div id="toAddEvents">
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
            <h5>Consequences <span class="text-danger">*</span></label> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addConsequences" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                        <div id="toAddConsequences">
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
            <h5>Inherent Analysis <span class="text-danger">*</span> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-4">
                    <label><strong> Impact Score <span class="text-danger">*</span> </strong></label>
                    <input type="hidden" class="form-control" name="temp_impact_score" id="temp_impact_score"/> 
                    <select class="form-control"  name="impact_score" id="impact_score" style="width: 100%">
                        <option> -- Select -- </option>
                        <?php
                        foreach($list_impact_scale->result() as $row)
                        { ?>
                        <option value="<?php echo $row->impact_scale_score; ?>"> <?php echo $row->impact_scale; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong> Likehood  <span class="text-danger">*</span> </strong></label>
                    <input type="hidden" class="form-control" name="temp_likehood" id="temp_likehood"/>  
                    <select class="form-control"  name="likehood" id="likehood" style="width: 100%">
                        <option> -- Select -- </option>
                        <?php
                        foreach($list_likehood_scale->result() as $row)
                        { ?>
                        <option value="<?php echo $row->like_hood_scale_score; ?>"> <?php echo $row->like_hood_scale; ?> </option>
                        <?php } ?>
                    </select>                
                </div> 

                <div class="col-sm-4">
                    <label><strong> Risk Magnitude  </strong></label>                   
                    <input type="hidden" class="form-control" name="hidden_magnitude" id="hidden_magnitude" readonly/> 
                    <input type="text" class="form-control" name="magnitude" id="magnitude" readonly/> 
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
            <h5>Existing Controls <span class="text-danger">*</span> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="addExControls" class="btn  btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
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
            <h5>Existing Controls Analysis <span class="text-danger">*</span> </strong></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-6">
                    <label><strong> Effective of Existing Controls  <span class="text-danger">*</span> </strong></label> 
                    <input type="hidden" class="form-control" name="temp_eff_excontrols" id="temp_eff_excontrols"/>                  
                    <select class="form-control"  name="eff_excontrols" id="eff_excontrols" style="width: 100%">
                        <option> -- Select -- </option>
                        <?php
                        foreach($list_eff_controls->result() as $row)
                        { ?>
                        <option value="<?php echo $row->controls_effectiveness_scale_score; ?>"> <?php echo $row->controls_effectiveness_scale; ?> </option>
                        <?php } ?>
                    </select>
                </div>   

                 <div class="col-sm-6">
                    <label><strong> Residual Risk Score  </strong></label>                   
                    <input type="hidden" class="form-control" name="hidden_residual_score" id="hidden_residual_score" /> 
                    <input type="text" class="form-control" name="residual_score" id="residual_score" readonly/> 
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
            <h5>Additional Controls <span class="text-danger">*</span> </strong></h5>
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
      <div class="ibox">
        <div class="ibox-title">
            <h5> Remarks </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>             
            </div>
        </div>
            
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-6">
                    <label><strong>Status<span class="text-danger">*</span></strong></label>
                    <textarea name="status" id="status" class="form-control"></textarea>
                </div>
                <div class="col-sm-6">
                    <label><strong>Remarks<span class="text-danger">*</span></strong></label>
                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label><strong>Trends<span class="text-danger">*</span></strong></label>
                 
                    <select class="form-control" name="trends" id="trends" style="width: 100%">
                            <option> -- Select -- </option>
                            <?php
                             foreach($list_trends->result() as $row)
                              { ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->trend_name; ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong>Quarter<span class="text-danger">*</span></strong></label>
                    <select class="form-control" name="quarter" id="quarter" style="width: 100%">
                            <option> -- Select -- </option>
                              <?php
                             foreach($list_quarter->result() as $row)
                              { ?>
                                <option value="<?php echo $row->id; ?>"> <?php echo $row->quarter_name; ?> </option>
                            <?php } ?>                        
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong>Year<span class="text-danger">*</span></strong></label>
                    <select class="form-control" name="year" id="year" style="width: 100%">
                            <option> -- Select -- </option>
                            <?php
                             foreach($list_year->result() as $row)
                              { ?>
                                <option value="<?php echo $row->id; ?>"> <?php echo $row->year; ?> </option>
                            <?php } ?>                         
                    </select>
                </div>
            </div>
            </br>
            <div class="row">                
                 <div class="col-sm-12">     
                    <button type="submit" id="submit_Registry" class="btn btn-success" style="float:right;"><i class="fa fa-check"></i>&nbsp;Submit</button>
                </div>
            </div>   
            <br><br>        
        </div>
       </div>  
    </div>         
</div>





