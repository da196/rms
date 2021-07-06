<div id="page-wrapper" class="gray-bg dashbard-1">
        
        <div class="row border-bottom">
          <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="row">
                <div class="col-md-2">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i></a>
                    </div>  
                </div>

                <div class="col-md-5">
                    <!--   <img height="70px" style="padding-left:30px;" src="<?php echo base_url()?>public/img/risk_icon.png" alt=""/> -->
                    <div class="nav navbar-top-links" style="margin-top: 0; padding-top: 0;">
                        <div class="hidden-xs hidden-sm hidden-md minimalize-styl-2" style="margin-top: 0; padding-top: 0;"><h2>Enterprise Risk Management System</h2></div>
                        <div class="hidden-xs hidden-sm hidden-lg minimalize-styl-2"><h3>Enterprise Risk Management System</h3></div>
                        <div class="hidden-xs hidden-md hidden-lg minimalize-styl-2"><h3>Enterprise Risk Management System</h3></div>
                        <div class="hidden-sm hidden-md hidden-lg minimalize-styl-2"><h3>Enterprise Risk Management System</h3></div>
                    </div>
                </div>

                <div class="col-md-5">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">                                            
                               Welcome  <b>  <?php echo ucfirst($this->session->userdata('username')); ?> </b>
                            </span>
                        </li>
                        <li>
                            <a href="<?php echo base_url('login/logout')?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>                
          </nav>
        </div> 