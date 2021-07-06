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
              <form method="post" action="<?php echo base_url(); ?>KeyRiskIndicator/ExcelReport">
                  <label>Filter:</label>
                  <!-- <select name="objective_id" id="objective_id">
                   <option value=""> -- All Objectives -- </option>
                    <?php foreach($organizationobjectives as $organizationobjective):?>
                       <option value="<?php echo $organizationobjective->id; ?>"><?php echo $organizationobjective->code; ?></option>
                    <?php endforeach;?>
                  </select> -->
                  <select name="risk_owner" id="risk_owner">
                    <option value=""> -- All Risk Owners -- </option>
                    <?php foreach($riskowners as $riskowner):?>
                       <option value="<?php echo $riskowner->id; ?>"><?php echo $riskowner->name; ?></option>
                    <?php endforeach;?>
                  </select> 
                  <!-- <label>Date Range:</label> -->
                  <!-- <input type="date"  id="startDate">
                  <input type="date"  id="endDate">  -->  

                  <label>Year:</label>
                  <select name="year_id" id="year_id" required="">
                    <option value=""> -- Year -- </option>
                    <?php foreach($years as $year):?>
                       <!-- <option value="<?php echo $year->id; ?>"><?php echo $year->year; ?></option> -->
                       <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                    <?php endforeach;?>
                  </select> 

                  <label>Quarter:</label>
                  <select name="quarter_id" id="quarter_id" required="">
                    <option value=""> -- Quarter -- </option>
                    <?php foreach($quarters as $quarter):?>
                       <option value="<?php echo $quarter->id; ?>"><?php echo $quarter->quarter_name; ?></option>
                    <?php endforeach;?>
                  </select>    
                   <label>Export:</label>                    
                   <input type="hidden" name="objective_id" id="objective_id">
                   <input type="hidden" name="risk_owner" id="risk_owner">
                   <!-- <input type="hidden" name="startDate" id="startDate">
                   <input type="hidden" name="endDate" id="endDate"> -->
                   <input type="hidden" name="quarter_idHIDDEN" id="quarter_idHIDDEN">
                   <input type="hidden" name="year_idHIDDEN" id="year_idHIDDEN">
                   <input type="submit" class="btn btn-success btn-xs" value="Excel Report"/>
              </form>
            </div>
            <div class="ibox-content"> 
              <table id='resultTable' class='display dataTable table table-bordered table-striped' style="width:100%">
                <thead>
                  <tr>
                    <th>Risk Owner</th>
                    <!-- <th>Organization Objective</th> -->
                    <th>Main Activity</th>
                    <th>Key Performance Indicator</th>
                    <th>Resources</th>
                    <th style="background: green; color:white;">Green</th>
                    <th style="background: #ffbf00; color:white;">Amber</th>
                    <th style="background: red; color:white;">Red</th>
                    <th>Year</th>
                    <th>Quarter</th>
                  </tr>
                </thead>
              </table>               
            </div>
        </div>
    </div>
</div>




