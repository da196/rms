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


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <!-- Search Filters -->
            <div class="ibox-title"> 
              <form method="post" action="<?php echo base_url(); ?>Risk/ExcelReport">
                  <!--  <input type="text" id="reporter_id" placeholder="reporter_id"> -->
                  <label>Filter:</label>
                  <select name="reporter_id" id="reporter_id">
                   <option value=""> -- Reported By -- </option>
                    <?php foreach($users as $user):?>
                       <option value="<?php echo $user->id; ?>"><?php echo $user->email; ?></option>
                    <?php endforeach;?>
                  </select>
                  <!--  <input type="text" id="status_id" placeholder="status_id">     -->
                  <select name="status_id" id="status_id">
                    <option value=""> -- Status -- </option>
                    <?php foreach($statuses as $status):?>
                       <option value="<?php echo $status->id; ?>"><?php echo $status->status; ?></option>
                    <?php endforeach;?>
                  </select> 
                  <label>Date Range:</label>
                  <input type="date"  id="startDate">
                  <input type="date"  id="endDate">   
                   <label>Export:</label>  
                   <!--   <a href="#" class="btn btn-default btn-xs" id="excelbutton" name="excelbutton"><i class="fa fa-file-excel-o "></i>&nbsp;Excel</a>-->                  
                   <!--   <a href="<?= base_url() ?>Risk/PDFReport" class="btn btn-default btn-xs"><i class="fa fa-file-pdf-o"></i>&nbsp;PDF</a> -->
                   <input type="hidden" name="reporter_id" id="reporter_id">
                   <input type="hidden" name="status_id" id="status_id">
                   <input type="hidden" name="startDate" id="startDate">
                   <input type="hidden" name="endDate" id="endDate">
                   <input type="submit" class="btn btn-success btn-xs" value="Excel Report"/>
              </form>
            </div>
            <div class="ibox-content"> 
              <table id='resultTable' class='display dataTable table table-bordered table-striped' style="width:100%">
                <thead>
                  <tr>
                    <th>Emerging Risk</th>
                    <th>Reported By</th>
                    <th>Date Reported</th>
                    <th>Status</th>
                  </tr>
                </thead>
              </table>               
            </div>
        </div>
    </div>
</div>




