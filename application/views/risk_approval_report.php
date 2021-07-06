<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2> Risk Emerging Report </h2>
        <ol class="breadcrumb">
            <li>
                 <a>Risk</a>
            </li>
            <li>
                <a>  New/Emerging </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url();?>risk/report"> <strong> Report  </strong></a>
                           
            </li>
         </ol>
    </div>
</div>

<!--  End List of Report Risk -->
<div class="wrapper wrapper-content animated fadeInRight">            
      <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>List of Assessed Risk </h5>      
                  <div class="ibox-tools">                      
                                    
                  </div>
              </div>
 
                <div class="ibox-content">                     
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable_riskEmerge">
                        <thead>
                        <tr>
                            <th>Emerging Risk</th>
                            <th>Reported By </th>
                            <th>Date Reported </th>
                            <th>Responsible Officer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($list_approval_risk->num_rows() > 0) {
                            foreach($list_approval_risk->result() as $row){
                                $fullname =  $row->first_name.' '.$row->middle_name.' '.$row->last_name;
                        ?>
                                <tr class="gradeX">
                                <td><?php echo  $row->name; ?></td>
                                <!-- <td><?php echo  $row->information_source;?></td>  -->                                                       
                                <td><?php echo  ucfirst(str_replace("."," ",$row->email));?></td>
                                <td><?php echo date("d-m-Y", strtotime($row->date_reported));?></td> 
                                
                               
                                <td><?php echo $fullname;?></td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn-white btn btn-xs"><i class="fa fa-list"></i>
                                    <a href="<?php echo base_url();?>risk/risk_pdf_report_details/<?php echo $row->id;?>">Download Pdf </a>
                                    </button>
                                    </div>
                                </td>
                            </tr>
                            <?php  }
                        }else{ ?>
                            <tr class="gradeX">
                                <td colspan="5">No any risk has been reported</td>
                            </tr>                            
                            <?php  } ?>                                            
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Emerging Risk</th>
                            <!-- <th>Source of Information</th> -->
                            <th>Reported By </th>
                            <th>Date Reported </th>
                            <th>Responsible Officer</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  End List of Report Risk -->
</div>