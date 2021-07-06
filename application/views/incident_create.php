<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Incident </h2>
        <ol class="breadcrumb">
            <li>
                <a>Incident </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url();?>incident/index"> <strong>Create</strong></a>
                           
            </li>
         </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeIn">

<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Incident </a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2"> Possible Consequences </a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3"> Possible Mitigation Proposals </a></li>

            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">

                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label><strong> Directorate <span class="text-danger">*</span></label> </strong></label>
                          <select class="form-control"  name="directorate" id="directorate" style="width: 100%">
                            <option value=" "> -- Select -- </option>
                            <?php
                             foreach($list_directorate->result() as $row)
                              { ?>
                                <option value="<?php echo $row->id; ?>"> <?php echo $row->directorate_name; ?></option>
                            <?php } ?>
                          </select>
                          </div>

                        <div class="col-sm-6">
                        <label><strong> Section <span class="text-danger">*</span></label> </strong></label>
                            <select class="form-control" name="section" id="section" style="width: 100%">
                                <option value=" "> -- Select -- </option>
                            </select>  
                        </div>

                        <div class="col-sm-12">
                        <label><strong> Incident Description <span class="text-danger">*</span></label> </strong></label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="col-sm-6">
                        <label><strong> Escalated to <span class="text-danger">*</span></label> </strong></label>
                        <select class="form-control" name="esc_to" id="esc_to" style="width: 100%">
                            <option value=" "> -- Select -- </option>
                            <option value="RMU">RMU</option>
                            <option value="Risk Champion">Risk Champion</option>
                            <option value="Supervisor">Supervisor</option>
                        </select> 
                        </div>

                       
                        <div class="col-sm-6">
                            <label><strong> Officer's name  <span class="text-danger">*</span></label> </strong></label>
                            <select class="form-control" name="esc_to_success" id="esc_to_success" style="width: 100%">
                                <option value=" "> -- Select -- </option>
                            </select> 
                        </div>
                                              
                    </div>
              
                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <strong>Possible Consequences <span class="text-danger">*</span></label> </strong>
                      
                        <button type="submit" id="addConsequences" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                            <div id="toAddConsequences">
                                <!-- <textarea  name="consequences"  id="consequences"  class="form-control">   </textarea> -->
                            </div>
                      
                    </div>
                </div>

                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <strong> Possible Mitigation Proposals <span class="text-danger">*</span></label> </strong>
                       
                        <button type="submit" id="addMitigation" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-plus"></i>  <b>ADD</b></button></br></br></br>
                            <div id="toAddMitigation">
                                <!-- <textarea  name="mitigations"  id="mitigations"  class="form-control">   </textarea> -->
                            </div>                       
                </div>
            </div>

        </div>
      </div>

    <!-- START SUBMIT BUTTON -->
    </br>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" id="submitIncidence" class="btn btn-xs btn-success" style="float:right;"><i class="fa fa-check"></i>  <b> SUBMIT </b></button>                  
        </div>
    </div>
    <!-- END SUBMIT BUTTON -->

    </div>

    
