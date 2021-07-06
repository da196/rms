    <!-- <div class="wrapper wrapper-content"> -->
        <!-- <div class="row">        
           <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right"></span>
                        <h5>Operational Risks </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?php //echo $operationalRiskCount; ?></h1>
                                <small>Total Count</small>
                            </div>
                            <div class="col-md-6">
                                <div class="row text-center">
                                    <canvas id="operationalriskschart" width="78" height="78"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right"></span>
                        <h5>Strategic Risks </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?php //echo $strategicRiskCount; ?></h1>
                                <small>Total Count</small>
                            </div>
                            <div class="col-md-6">
                                <div class="row text-center">
                                    <canvas id="strategicriskschart" width="78" height="78"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right"></span>
                        <h5>Project Risks </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?php //echo $projectRiskCount; ?></h1>
                                <small>Total Count</small>
                            </div>
                            <div class="col-md-6">
                                <div class="row text-center">
                                    <canvas id="projectriskschart" width="78" height="78"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                            <div>
                                <span class="pull-right text-right">
                                <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                    <br/>
                                    All sales: 162,862
                                </span>
                                <h1 class="m-b-xs">Risk Trends</h1>
                                <h3 class="font-bold no-margins">
                                    Half-year revenue margin
                                </h3>
                                <small>Sales marketing.</small>
                            </div>

                        <div>
                            <canvas id="lineChart" height="70"></canvas>
                        </div>

                        <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                                Update on 16.07.2015
                            </small>
                           <small>
                               <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                           </small>
                        </div>

                    </div>
                </div>
            </div>
        </div> -->
<!-- </div> -->




    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Un-assessed Risks</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $unassessedrisks;?></h1>
                        <small>Total Count</small>
                    </div>
                </div>
            </div>    
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Accepted Risks</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $acceptedrisks;?></h1>
                        <small>Total Count</small>
                    </div>
                </div>
            </div>   
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Submitted Risks</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $submittedrisks;?></h1>
                        <small>Total Count</small>
                    </div>
                </div>
            </div>  
            <!-- <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Reported Incident Risks</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $incidentrisks;?></h1>
                        <small>Total Count</small>
                    </div>
                </div>
            </div> 
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Assessed Key Risk Indicators</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $assessedkris;?></h1>
                        <small>Total Count</small>
                    </div>
                </div>
            </div>  -->
        </div> 
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!-- Search Filters -->
                <div class="ibox-title">
                 <form>
                      <label>View:</label> 
                      <select name="objective_category_id" id="objective_category_id" style="width: 50%;">
                        <option value=""> -- All Risk Category -- </option>
                        <?php foreach($riskcategorys as $riskcategory):?>
                           <option value="<?php echo $riskcategory->id; ?>"><?php echo $riskcategory->objective_category; ?></option>
                        <?php endforeach;?>
                      </select>       
                  </form>
                </div>
                <div class="ibox-content"> 
                  <div class="table-responsive">
                      <table id='resultTable' class='display dataTable table table-bordered table-striped' style="width:100%">
                        <thead>
                          <tr>
                            <th>Activity/Risk Name</th>
                            <th class="no-sort">Magnitude</th>
                            <th class="no-sort">Residual Risk Score</th>
                            <th class="no-sort">Trends</th>
                            <th class="no-sort">Risk Category</th>
                            <th class="no-sort">Year</th>
                            <th class="no-sort">Quarter</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Activity/Risk Name</th>
                            <th class="no-sort">Magnitude</th>
                            <th class="no-sort">Residual Risk Score</th>
                            <th class="no-sort">Trends</th>
                            <th class="no-sort">Risk Category</th>
                            <th class="no-sort">Year</th>
                            <th class="no-sort">Quarter</th>
                          </tr>
                        </tfoot>
                      </table> 
                  </div>                            
                </div>
            </div>
        </div>    
    </div>    
