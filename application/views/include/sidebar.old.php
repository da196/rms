 <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">  <!-- class="dropdown profile-element" -->
                        <span>
                             <img alt="image" class="img-circle rounded mx-auto d-block" src="<?=base_url()?>public/img/profile.png" />
                         </span> 
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo ucfirst($this->session->userdata('username')); ?></strong> </span></span>
                    </div>
                    <div class="logo-element">
                        ERMS
                    </div>
                </li> 

                <?php 
                               // SET THE ROLES FOR ACCESS 
                 // 2=>Anonymous, 3=>Default, 4=>Administrator, 7=>RMU Officer,
                // 8=>Risk Owner,  9=>Management and 10=> Risk Champion
                $dash_user = array(3,8,10);
                $user = array(2,3,4,7,8,9,10);
                $dash_RMU = array(4,7,9);
                $create_emerge_risk = array(3,4,7,8,9,10);
                $admin_rmu = array(3,4,7);
                $rmu_only = array(4,7);
                $admin_only = array(4);
                
                //$report_emerge_risk = array(4,5);

                //$create_incident_risk = array(4,5);
                //$view_incident_risk = array(4,5);
                //$report_incident_risk = array(4,5);

                //$create_risk_registry = array(4,5);
                //$view_risk_registry = array(4,5);
                //$report_risk_registry = array(4,5);

                
                //if(in_array($this->session->userdata('role'), $dash_user)) {
                    
                // }
                ?>
              
                <!-- Dashboard -->
                <?php if(in_array($this->session->userdata('role'), $dash_user)) { ?>
                    <li>
                        <a href="<?=site_url('login/index')?>"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
                    </li>
                <?php } ?>
              
                <?php if(in_array($this->session->userdata('role'), $dash_RMU)) { ?>
                    <li>
                        <!-- <a href="<?=site_url('risk/dashboard')?>"><i class="fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a> -->
                        <a href="<?=site_url('dashboard/admin')?>"><i class="fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
                    </li>
                <?php } ?>
                
                <?php if(in_array($this->session->userdata('role'), $admin_only)) { ?>
                <li>
                    <a href="<?=site_url('dashboard/admin')?>"><i class="fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
                </li>
                <?php } ?>

                          
                <!-- Risk Register -->
                <?php if(in_array($this->session->userdata('role'), $admin_rmu)) { ?>
                    <li>
                        <a href="#"><i class="fa fa-bullhorn"></i> <span class="nav-label">Risk Register</span><span class="fa arrow"></span></a>                    
                            <ul class="nav nav-second-level collapse">
                                <?php if(in_array($this->session->userdata('role'), $rmu_only)) { ?>
                                <li>
                                    <a href="<?=site_url('registry/index')?>">Assess</a>
                                </li>
                                <?php } ?> 

                                <li>
                                    <a href="<?=site_url('registry/view')?>">Review & Assess</a>
                                </li>

                                <?php if(in_array($this->session->userdata('role'), $rmu_only)) { ?>
                                <li>
                                    <a href="<?=site_url('registry/generatereports')?>">Reports</a>
                                </li>
                                <?php } ?> 

                            </ul>
                    </li>
                <?php } ?> 

                <!-- New Emerging Risk  -->
                <li>
                    <a href="#"><i class="fa fa-times-circle-o"></i> <span class="nav-label">New/Emerging Risk </span><span class="fa arrow"></span></a>                    
                    <ul class="nav nav-second-level collapse">
                        <?php if(in_array($this->session->userdata('role'), $user)) { ?>
                        <li>
                            <a href="<?=site_url('risk/create')?>">Create</a>
                        </li>
                        <li>
                            <a href="<?=site_url('risk/index')?>">View</a>
                        </li>
                        <?php } ?>

                        <?php if(in_array($this->session->userdata('role'), $dash_RMU)) { ?>
                        <li>
                            <a href="<?=site_url('risk/generatereports')?>">Reports</a>
                        </li> 
                        <?php } ?>
                    </ul>                               
                </li>    


                 <!-- Key Risk Indicator  -->
                <?php if(in_array($this->session->userdata('role'), $admin_rmu)) { ?>
                <li>
                    <a href="#"><i class="fa fa-circle-o-notch"></i> <span class="nav-label">Key Risk Indicator </span><span class="fa arrow"></span></a>                    
                    <ul class="nav nav-second-level collapse">
                        <?php if(in_array($this->session->userdata('role'), $rmu_only)) { ?>
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/index')?>">Create</a>
                        </li>
                        <?php } ?>

                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/view')?>">View</a>
                        </li>

                        <?php if(in_array($this->session->userdata('role'), $rmu_only)) { ?>
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/assess')?>">Assess</a>
                        </li>
                        
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/generatereports')?>">Reports</a>
                        </li>
                        <?php } ?> 
                        
                    </ul>                               
                </li>
                <?php } ?>  


                <!-- Incident  -->
                <li>
                    <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Incident </span><span class="fa arrow"></span></a>                    
                    <ul class="nav nav-second-level collapse">
                        <?php if(in_array($this->session->userdata('role'), $user)) { ?>
                        <li>
                            <a href="<?=site_url('incident/index')?>">Create</a>
                        </li>
                        <li>
                            <a href="<?=site_url('incident/view')?>">View</a>
                        </li>
                        <?php } ?>

                        <?php if(in_array($this->session->userdata('role'), $rmu_only)) { ?>
                        <li>
                            <a href="<?=site_url('incident/generatereports')?>">Reports</a>
                        </li> 
                        <?php } ?>
                    </ul>                               
                </li>
                
                <!-- Reports and Analytics
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports &amp; Analytics</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">Risks - This month</a></li>
                        <li><a href="">Risks - This quarter</a></li>
                        <li><a href="">Risks - This year</a></li>                      
                        <li><a href="">Risks - This vs last month</a></li>
                        <li><a href="">Risks - This vs last quarter</a></li>
                        <li><a href="">Risks - This vs last year</a></li>
                    </ul>
                </li> 
                -->
                           
                <!-- Settings -->
                <?php if(in_array($this->session->userdata('role'), $admin_only)) { ?>
                <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
					 <ul class="nav nav-second-level collapse"> 
                        <li><a href="<?=site_url('CatalogsEffectivenessScale/index')?>">Effectiveness Scale</a></li>
                        <li><a href="<?=site_url('CatalogsImpactScale/index')?>">Impact Scale</a></li>
                        <li><a href="<?=site_url('CatalogsLikelihoodScale/index')?>">Likelihood Scale</a></li>
                        <li><a href="<?=site_url('CatalogsObjectives/index')?>">Objectives</a></li>
                        <li><a href="<?=site_url('CatalogsFaq/index')?>">FAQ</a></li>
                        <!-- <li><a href="<?=site_url('Settings_Permissions/index')?>">Permissions</a></li> -->
                       <!--  <li><a href="<?=site_url('CatalogsQuarters/index')?>">Quarters</a></li> -->
                        <!-- <li><a href="<?=site_url('CatalogsRoles/index')?>">Roles</a></li>  -->
                      <!--   <li><a href="<?=site_url('CatalogsTrends/index')?>">Trends</a></li> -->
                    </ul>
                </li>
                <!-- Users -->
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?=site_url('UserRoles/index')?>">Roles</a></li>
                    </ul>
                </li>
                <?php } ?>

                <!--  
                <li>
                    <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">Tools</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">SMTP settings</a></li>
                        <li><a href="#">Auth settings</a></li>
                        <li><a href="#">File server settings</a></li>
                        <li><a href="#">Theme settings</a></li>
                    </ul>
                </li> 
                -->               
            </ul>
        </div>
    </nav>
