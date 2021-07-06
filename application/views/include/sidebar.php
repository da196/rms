 <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <?php 
                        $username = $this->session->userdata('username');
                        $firstname = ucfirst(strtok($username, '.'));
                        $lastname = ucfirst(substr($username, strpos($username, ".") + 1));                        
                        $username = $firstname."  ". $lastname;     

                        $rolename = $this->session->userdata('rolename');                                       
                    ?>
                    <div class="dropdown profile-element">
                        <img alt="image" class="img-circle rounded-circle mx-auto d-block" src="<?=base_url()?>public/img/profile.png"/>
                        <a>
                            <span class="block m-t-xs font-bold"><?php echo $username; ?></span>
                            <span class="text-muted text-xs block"><?php echo $rolename; ?></span>
                        </a>
                    </div>
                    <div class="logo-element">
                        <?php echo APPLICATION_NAME_ABBREVIATION; ?>
                    </div>
                </li> 

                <?php 
                               // SET THE ROLES FOR ACCESS 
                 // 2=>Anonymous, 3=>Default, 4=>Administrator, 7=>RMU Officer,
                // 8=>Risk Owner,  9=>Management and 10=> Supervisor 23=>Risk Champion
                $dash_user = array(3,8,10);
                $user = array(2,3,4,7,8,9,10,23);
                $dash_RMU = array(4,7,8,9,23);
                $admin_rmu = array(4,7);
                $rmu_only = array(4,7);
                $admin_only = array(4);
                // 
                // NEW ROLES-IDs MAPPING
                // 
                $anonymous_only=array(2);
                $default_only=array(3);
                $administrator_only=array(4);
                $rmuofficer_only=array(7);
                $riskowner_only=array(8);
                $management_only=array(9);
                $supervisor_only=array(10);
                $riskchampion_only=array(23);

                //RISK CHAMPION, RMU OFFICE $ ADMIN
                $riskchampion_rmu_admin=array(4,7,23);
                //RMU OFFICE $ ADMIN
                $rmu_admin=array(4,7);

                //Administrator+RMU Officer+Risk Owner+Management+Risk Champion
                $administrator_rmu_riskowner_management_riskchampion=array(4,7,8,9,23);

                //Anonymous+Default+Risk Owner+Management+Supervisor+Risk Champion
                $anonymous_default_riskowner_management_supervisor_riskchampion=array(2,3,8,9,10,23);

                
                //$all_users=array(2,3,4,7,8,9,10,23); //ALL USERS ACCESS
                $allUsers = array(2,3,4,7,8,23); //ALL USERS ACCESS
                $allExceptDefaultAndAnonymous = array(4,7,8,23); 
                $adminRMUOfficerOnly = array(4,7); //RMU OFFICE $ ADMIN ONLY
                $adminRMUOfficerRiskChampionOnly = array(4,7,23); //Risk Champion, RMU OFFICE $ ADMIN ONLY
                $adminOnly = array(4);


                // $isAnonymous = array(2);
                // $isDefault = array(3);
                // $isRiskOwner = array(3,8);
                // $isRiskChampion = array(3,8,23);
                // $isRMUOfficer = array(3,8,23,7);
                // $isAdmin = array(3,8,23,7,4);                

                ?>
              
                <!-- Dashboard -->
                <!-- <?php //if(in_array($this->session->userdata('role'), $dash_user)) { ?> -->
                <?php if(in_array($this->session->userdata('role'), $anonymous_default_riskowner_management_supervisor_riskchampion)) { ?>
                    <li>
                        <a href="<?=site_url('login/index')?>"><i class="fa fa-home"></i>&nbsp;<span class="nav-label">Home</span></a>
                    </li>
                <?php } ?>
              
                <!-- <?php //if(in_array($this->session->userdata('role'), $admin_rmu)) { ?> -->
                <?php if(in_array($this->session->userdata('role'), $rmu_admin)) { ?>
                    <li>
                        <!-- <a href="<?=site_url('risk/dashboard')?>"><i class="fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a> -->
                        <a href="<?=site_url('dashboard/admin')?>"><i class="fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
                    </li>
                <?php } ?>
                
              

                          
                <!-- Risk Register -->
                <!-- <?php //if(in_array($this->session->userdata('role'), $admin_rmu)) { ?> -->
                <?php //if(in_array($this->session->userdata('role'), $riskchampion_rmu_admin)) { ?>   
                <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>                     
                    <li>
                        <a href="#"><i class="fa fa-bullhorn"></i>&nbsp;<span class="nav-label">Risk Register</span><span class="fa arrow"></span></a>                  
                            <ul class="nav nav-second-level collapse">
                                <?php //if(in_array($this->session->userdata('role'), array_merge($administrator_only,$rmuofficer_only))) { ?>
                                <?php if(in_array($this->session->userdata('role'), $adminRMUOfficerRiskChampionOnly)) { ?>                                    
                                <li>
                                    <a href="<?=site_url('registry/index')?>">Assess</a>
                                </li>
                                <?php } ?> 
                                <!-- <?php //if(in_array($this->session->userdata('role'), array_merge($riskchampion_only,$administrator_only,$rmuofficer_only))) { ?> -->
                                <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>
                                <li>
                                    <a href="<?=site_url('registry/view')?>">Review & Assess</a>
                                </li>
                                <?php } ?> 
                                <!-- <?php //if(in_array($this->session->userdata('role'), array_merge($administrator_only,$rmuofficer_only,$riskchampion_only))) { ?> -->
                                <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>
                                <li>
                                    <a href="<?=site_url('registry/generatereports')?>">Reports</a>
                                </li>
                                <?php } ?> 
                            </ul>
                    </li>
                <?php } ?> 

                <!-- New Emerging Risk  -->
                <li>
                    <a href="#"><i class="fa fa-times-circle-o"></i>&nbsp;<span class="nav-label">New/Emerging Risk</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(in_array($this->session->userdata('role'), $allUsers)) { ?>
                        <li>
                            <a href="<?=site_url('risk/create')?>">Create</a>
                        </li>
                        <?php } ?>
                        <!-- <?php //if(in_array($this->session->userdata('role'), $rmu_admin)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>                            
                        <li>
                            <a href="<?=site_url('risk/index')?>">View</a>
                        </li>                        
                        <?php } ?>
                        <!--  <?php //if(in_array($this->session->userdata('role'), $administrator_rmu_riskowner_management_riskchampion)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>
                         <li>
                            <a href="<?=site_url('risk/generatereports')?>">Reports</a>
                         </li> 
                        <?php } ?>
                    </ul>                               
                </li>    


                 <!-- Key Risk Indicator  -->
                <?php //if(in_array($this->session->userdata('role'), $riskchampion_rmu_admin)) { ?>
                <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>
                <li>
                    <a href="#"><i class="fa fa-circle-o-notch"></i>&nbsp;<span class="nav-label">Key Risk Indicator</span><span class="fa arrow"></span></a>                    
                    <ul class="nav nav-second-level collapse">
                        <!-- <?php //if(in_array($this->session->userdata('role'), $rmu_admin)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $adminRMUOfficerOnly)) { ?>                            
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/index')?>">Create</a>
                        </li>
                        <?php } ?>
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?> 
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/view')?>">View</a>
                        </li>
                        <?php } ?>
                        <!-- <?php //if(in_array($this->session->userdata('role'), $rmu_admin)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $adminRMUOfficerOnly)) { ?>
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/assess')?>">Assess</a>
                        </li>
                        <?php } ?>
                        <!-- <?php //if(in_array($this->session->userdata('role'), $riskchampion_rmu_admin)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>
                        <li>
                            <a href="<?=site_url('KeyRiskIndicator/generatereports')?>">Reports</a>
                        </li>
                        <?php } ?>                         
                    </ul>                               
                </li>
                <?php } ?>  


                <!-- Incident  -->
                <li>
                    <a href="#"><i class="fa fa-info"></i>&nbsp;<span class="nav-label">Incident</span><span class="fa arrow"></span></a>                    
                    <ul class="nav nav-second-level collapse">
                        <?php if(in_array($this->session->userdata('role'), $allUsers)) { ?>
                        <li>
                            <a href="<?=site_url('incident/index')?>">Create</a>
                        </li>
                        <?php } ?>
                        <!-- <?php //if(in_array($this->session->userdata('role'), $rmu_admin)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>  
                        <li>
                            <a href="<?=site_url('incident/view')?>">View</a>
                        </li>
                        <?php } ?>

                        <!-- <?php //if(in_array($this->session->userdata('role'), $administrator_rmu_riskowner_management_riskchampion)) { ?> -->
                        <?php if(in_array($this->session->userdata('role'), $allExceptDefaultAndAnonymous)) { ?>  
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
                <!-- <?php //if(in_array($this->session->userdata('role'), $admin_only)) { ?> -->
                <?php if(in_array($this->session->userdata('role'), $adminOnly)) { ?>                    
                <li>
                    <a href="#"><i class="fa fa-cog"></i>&nbsp;<span class="nav-label">Settings</span><span class="fa arrow"></span></a>
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
                    <a href="#"><i class="fa fa-users"></i>&nbsp;<span class="nav-label">Users</span><span class="fa arrow"></span></a>
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
