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


<!-- CREATE BUTTON + DATATABLE -->
<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                   <h5>List of <?php echo $subtitle; ?></h5>
                  <div class="ibox-tools">
                      <button type="button" class="btn btn-success" id="add_button_catalogstrends" data-toggle="modal" data-target="#catalogstrendsModal"><i class="fa fa-plus"></i>&nbsp;Create</button>
                  </div>
              </div>
              <div class="ibox-content">
              <table class="table table-striped table-bordered table-hover" id="catalogstrends_data" style="width:100%">
                  <thead>
                    <tr>
                        <th width="10%">S/N</th>    
                        <th width="40%">Trend Name</th>  
                        <th width="30%">Color Code</th>                            
                        <th width="20%">Action</th>
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
 <div id="catalogstrendsModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="catalogstrends_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title"></h4>  
                     </div>  
                     <div class="modal-body"> 
                          <label>Trend Name</label><span class="asterisk">*</span>  
                          <input type="text" name="trend_name" id="trend_name" class="form-control" placeholder="Enter trend name ..." required/>  
                          <br /> 

                          <label>Color Code</label><span class="asterisk">*</span>    
                          <!-- <textarea class="form-control" name="color_code" id="color_code" rows="5" placeholder="Enter color code ..." required></textarea> -->
                          <select class="form-control" name="color_code" id="color_code" style="width: 100%">
                              <option value=""> -- Select -- </option>
                              <option value="Amber">Amber</option>
                              <option value="Green">Green</option>
                              <option value="Red">Red</option>
                          </select>

                          <p><span class="asterisk">*</span>Required field</p>
                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="catalogstrends_id" id="catalogstrends_id" />  

                          <input type="hidden" id="action" name="action" /> 
                          <input type="submit" id="submit" name="submit" class="btn btn-success" /> 
                          <!-- <button class="btn btn-success " type="button" id="submit" name="submit"><i class="fa fa-check"></i>&nbsp;Submit</button> -->
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 


 <!-- View Modal -->
 <div class="modal inmodal fade" id="catalogstrendsModal_L" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!-- <i class="fa fa-clock-o modal-icon"></i> -->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"> 
              <form id="catalogstrends_form_viewonly"> 
                <div class="row">
                    <div class="col-md-12">
                         <label>Trend Name</label>  
                         <input type="text" id="trend_name" name="trend_name" class="form-control"/> 
                    </div>                    
                </div>                
                <div class="row">
                     <div class="col-md-12">
                          <label>Color Code</label>  
                          <!-- <textarea class="form-control" name="color_code" id="color_code" rows="5"></textarea>  -->
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

s


