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


<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>List of <?php echo $subtitle; ?></h5>
                  <div class="ibox-tools">
                      <button type="button" class="btn btn-success" id="add_button_catalogseffectivenessscale" data-toggle="modal" data-target="#catalogseffectivenessscaleModal"><i class="fa fa-plus"></i>&nbsp;Create</button>
				  </div>
              </div>
              <div class="ibox-content">
              <table class="table table-striped table-bordered table-hover" id="catalogseffectivenessscale_data" style="width:100%">
                  <thead>
                    <tr>
                        <th width="10%">S/N</th>    
                        <th width="20%">Effectiveness Scale</th>  
                        <th width="20%">Effectiveness Scale Score</th>   
                        <th width="20%">Color Code</th>                             
                        <th width="30%">Action</th>
                    </tr>
                  </thead>
                  <tbody>                    
                  </tbody>
              </table>
              </div>
            </div>
          </div>
      </div>
</div>



 <!-- Insert Modal -->
 <div id="catalogseffectivenessscaleModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="catalogseffectivenessscale_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body"> 
                          <label>Control Effectiveness Scale</label><span class="asterisk">*</span> 
                          <select class="form-control" name="controls_effectiveness_scale" id="controls_effectiveness_scale" >
                              <option value=""> -- Select -- </option>
                              <option value="No Control">No Control</option>
                              <option value="Very Poor">Very Poor</option>
                              <option value="Poor">Poor</option>
                              <option value="Effective">Effective</option>
                              <option value="Highly Effective">Highly Effective</option>
                          </select>
                          <br /> 

                          <label>Control Effectiveness Scale Score</label><span class="asterisk">*</span>    
                          <input type="number" min="1" max="5" class="form-control" name="controls_effectiveness_scale_score" id="controls_effectiveness_scale_score" placeholder="Enter Control Effectiveness scale Score ..." required/>
                          <br /> 

                          <label>Color Code</label><span class="asterisk">*</span>
                          <select class="form-control" name="color_code" id="color_code" style="width: 100%">
                              <option value=""> -- Select -- </option>
                              <option value="Amber">Amber</option>
                              <option value="Green">Green</option>
                              <option value="Red">Red</option>
                          </select>
                          <br /> 
                          <p><span class="asterisk">*</span>Required field</p>
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



 <!-- View Modal -->
 <div class="modal inmodal fade" id="catalogseffectivenessscaleModal_L" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!--<i class="fa fa-clock-o modal-icon"></i>-->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"> 
              <form id="catalogseffectivenessscale_form_viewonly"> 
                <div class="row">
                    <div class="col-md-12">
                         <label>Control Effectiveness Scale</label>  
                         <input type="text" id="controls_effectiveness_scale" name="controls_effectiveness_scale" class="form-control"/> 
                    </div>  
                    <div class="col-md-12">
                         <label>Control Effectiveness Scale Score</label>  
                         <input type="text" id="controls_effectiveness_scale_score" name="controls_effectiveness_scale_score" class="form-control"/> 
                    </div> 
                    <div class="col-md-12">
                         <label>Color Code</label>  
                         <input type="text" id="color_code" name="color_code" class="form-control"/> 
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





