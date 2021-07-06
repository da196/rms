
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



<!--  Start List of Report Incident  -->
<div class="wrapper wrapper-content animated fadeInRight">            
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <!-- Search Filters -->
          <form method="post" action="<?php echo base_url(); ?>Incident/ExcelReport">                      
                <label>Filter:</label>
                <!--  <input type="text" id="reporter_id" placeholder="reporter_id"> -->
                <select name="reporter_id" id="reporter_id">
                 <option value=""> -- All Reporters -- </option>
                  <?php foreach($users as $user):?>
                     <option value="<?php echo $user->id; ?>"><?php echo $user->email; ?></option>
                  <?php endforeach;?>
                </select>
                <label>Date Range:</label>
                <input type="date"  id="startDate">
                <input type="date"  id="endDate">
                <label>Export:</label>                    
                <input type="hidden" name="reporter_idHIDDEN" id="reporter_idHIDDEN">
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="endDate" id="endDate">
                <input type="submit" class="btn btn-success btn-xs" value="Excel Report"/>
          </form>
        </div>
        <div class="ibox-content"> 
          <div class="table-responsive">
              <table id='resultTable' class='display dataTable table table-bordered table-striped' style="width:100%">
                <thead>
                  <tr>
                    <th>Date Reported </th>   
                    <th>Reported By</th>   
                    <th>Incident Description</th>
                    <th>Directorate</th>
                    <th>Section</th> 
                    <th>Escalated To</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table> 
          </div>                            
        </div>
      </div>
    </div>
</div>
<!--  End List of Report Incident -->
</div>