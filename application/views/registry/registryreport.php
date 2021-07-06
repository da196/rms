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
              <form method="post" action="<?php echo base_url(); ?>Registry/ExcelReport">
                  <label>Filter:</label> 
                  <!-- THIS STYLE style="font-family: 'FontAwesome';" HELPS RENDERING FONTAWESOME ICONS ON OPTION TAGS-->
                  <select name="trends_id" id="trends_id" style="font-family: 'FontAwesome';"> 
                   <option value=""> -- All Risk Trends -- </option>
                    <?php foreach($trends as $trend):?>
                        <?php if($trend->trend_name == 'Constant - Amber'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #FFBF00;color: white;">&#xf0ec;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Constant - Green'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #008000;color: white;">&#xf0ec;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Constant - Red'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #FF0000;color: white;">&#xf0ec;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Upward - Amber'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #FFBF00;color: white;">&#xf062;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Upward - Green'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #008000;color: white;">&#xf062;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Downward - Amber'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #FFBF00;color: white;">&#xf063;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                        <?php if($trend->trend_name == 'Downward - Red'){ ?>
                          <option  value="<?php echo $trend->id; ?>" style="background: #FF0000;color: white;">&#xf063;&nbsp;<?php echo $trend->trend_name; ?></option>
                        <?php } ?>
                    <?php endforeach;?>
                  </select>
                  <select name="activity" id="activity" style="font-family: 'FontAwesome';"> 
                   <option value=""> -- All Activity/Risk -- </option>
                    <?php foreach($activity as $activity):?>
                          <option  value="<?php echo $activity->activity; ?>">&nbsp;<?php echo $activity->activity; ?></option>
                    <?php endforeach;?>
                  </select>
                  <select name="objective_category_id" id="objective_category_id" style="font-family: 'FontAwesome';" required="">
                    <option value=""> -- All Risk Category -- </option>
                    <?php foreach($riskcategorys as $riskcategory):?>
                       <option value="<?php echo $riskcategory->id; ?>"><?php echo $riskcategory->objective_category; ?></option>
                    <?php endforeach;?>
                  </select> 
                 <!--<label>Date Range:</label>
                  <input type="date"  id="startDate">
                  <input type="date"  id="endDate">-->
                  <label>Year:</label>
                  <select name="year_id" id="year_id" style="font-family: 'FontAwesome';" required="">
                    <option value=""> -- Year -- </option>
                    <?php foreach($years as $year):?>
                       <option value="<?php echo $year->id; ?>"><?php echo $year->year; ?></option>
                    <?php endforeach;?>
                  </select> 
                  <label>Quarter:</label>
                  <select name="quarter_id" id="quarter_id" style="font-family: 'FontAwesome';" required="">
                    <option value=""> -- Quarter -- </option>
                    <?php foreach($quarters as $quarter):?>
                       <option value="<?php echo $quarter->id; ?>"><?php echo $quarter->quarter_name; ?></option>
                    <?php endforeach;?>
                  </select> 
                  <label>Export:</label>                
                  <input type="hidden" name="trends_idHIDDEN" id="trends_idHIDDEN">
                  <input type="hidden" name="activityHIDDEN" id="activityHIDDEN">
                  <input type="hidden" name="objective_category_idHIDDEN" id="objective_category_idHIDDEN">
                  <!--<input type="hidden" name="startDate" id="startDate">
                  <input type="hidden" name="endDate" id="endDate"> -->
                  <input type="hidden" name="quarter_idHIDDEN" id="quarter_idHIDDEN">
                  <input type="hidden" name="year_idHIDDEN" id="year_idHIDDEN">              
                  <input type="submit" class="btn btn-success btn-xs" value="Excel Report"/>          
              </form>
            </div>
            <div class="ibox-content"> 
              <div class="table-responsive">
                  <table id='resultTable' class='display dataTable table table-bordered table-striped' style="width:100%">
                    <thead>
                      <tr>
                        <th>Activity/Risk Name</th>
                        <th class="no-sort">Risk Owner</th>
                        <!-- <th>Impact</th>
                        <th>Likelihood</th> -->
                        <th class="no-sort">Magnitude</th>
                      <!--   <th>Control Effectiveness</th> -->
                        <th class="no-sort">Residual Risk Score</th>
                        <th class="no-sort">Trends</th>
                        <th class="no-sort">Year</th>
                        <th class="no-sort">Quarter</th>
                      </tr>
                    </thead>
                  </table> 
              </div>                            
            </div>
        </div>
    </div>
</div>




