<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>New/Emerging Risk </h2>
        <ol class="breadcrumb">
            <li>
                <a>New/Emerging Risk</a>
            </li>
            <li class="active">
                <a href="<?php echo base_url();?>risk/create"> <strong> Create  </strong></a>
                           
            </li>
         </ol>
    </div>
</div>


<!--  Start Form Creation of Risk -->          
<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>Create New/Emerging Risk </h5>      
                  <div class="ibox-tools">  
                  </div>
              </div>

                <div class="ibox-content"> 
                    <input type="hidden" name="reporter_id" id="reporter_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                      
                    <div class="row">
                        <div class="col-sm-6">
                        <label><strong>Risk Name<span class="text-danger">*</span></label></strong></label>
                        <textarea name="name" id="name" class="form-control"></textarea>                       
                        </div>
                        <div class="col-sm-6">
                        <label><strong>Source of the risk<span class="text-danger">*</span></label></strong></label>
                        <textarea name="information_source" id="information_source" class="form-control"></textarea>
                        </div>
                    </div>  

                    <div class="row"> 
                      <div class="col-sm-6">
                        <label><strong>Risk Detail<span class="text-danger">*</span></label> </strong></label>
                        <textarea name="remarks" id="remarks" class="form-control"></textarea>
                       </div> 
                       <div class="col-sm-6">
                        <label><strong> Responsible Officer </strong></label>
                        <select class="form-control"  name="responsible_officer" id="responsible_officer" style="width: 100%">
                            <option value=" "> -- Select -- </option>
                            <?php 
                            foreach($list_responsible_officers->result() as $row){
                                $fullname = $row->first_name .' '. $row->middle_name .'  '.$row->last_name. ' - '.$row->designation; 
                                ?>                         
                            <option class="form-control" value="<?php echo $row->id; ?>"> <?php echo $fullname; ?> </option>
                            <?php } ?>
                        </select></br>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" id="submitrisk" class="btn btn-xs btn-success" style="float:right;  margin-right: 5px;"><i class="fa fa-check"></i>  <b>Submit</b></button>
                        <button type="submit" id="saverisk" class="btn btn-xs btn-warning" style="float:right;  margin-right: 5px;"><i class="fa fa-save"></i>  <b>Save as Draft</b></button>                                           
                    </div>
                                    
                </div>
                <!-- END IBOX-CONTENT -->
            </div>
        </div>
    </div>
<!--  End Form Creation of Risk -->  
</div>








   
