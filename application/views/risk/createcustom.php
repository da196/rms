<!-- Start Javascript here --->

<script text="javascript">
        $('#responsible_officer').select2({
           
        });

        $(document).ready(function(){   
            // Save Risk Emerging
            $('#saverisk').click(function(event){
                event.preventDefault();

                var name = $("#name").val();
                var information_source = $("#information_source").val();
                var remarks = $("#remarks").val();
                var responsible_officer = $("#responsible_officer").val();
                var reporter_id = $("#reporter_id").val();
                
                if(name.trim().length > 0 == ''){
                    swal(" ", "Risk Name is required!", "error");                                    
                    return false;                 
                }
                if(information_source.trim().length > 0  == ''){
                    swal(" ", "Source of the risk is required!", "error");                                    
                    return false;                   
                }
                if(remarks.trim().length > 0 == ''){
                    swal(" ", "Risk Detail is required!", "error");                                    
                    return false;                   
                }

                if(responsible_officer.trim().length > 0 == ''){
                    responsible_officer = '227';
                }else{
                    responsible_officer = responsible_officer;
                }
              
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_save",
                        data:{
                            name:name,
                            information_source:information_source,
                            remarks:remarks,
                            responsible_officer:responsible_officer,
                            reporter_id:reporter_id
                        },
                        success:function(msg){
                                swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location = "<?php echo base_url(); ?>risk/index"; 
                                });                                                                                                                                                            
                        },
                        error:function(){   
                                swal({title:"",text:"The risk was not saved properly!..", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                            
                        }
                    });
                 
             
            }); 
            // Submit Risk Emerging
            $('#submitrisk').click(function(event){
                event.preventDefault();

                var name = $("#name").val();
                var information_source = $("#information_source").val();
                var remarks = $("#remarks").val();
                var responsible_officer = $("#responsible_officer").val();
                var reporter_id = $("#reporter_id").val();

                if(name.trim().length > 0 == ''){
                    swal(" ", "Risk Name is required!", "error");                                     
                    return false;                   
                }
                if(information_source.trim().length > 0  == ''){
                    swal(" ", "Source of the risk is required!", "error");                                   
                    return false;                    
                }
                if(remarks.trim().length > 0 == ''){
                    swal(" ", "Risk Detail is required!", "error");                                   
                    return false;                    
                }

                if(responsible_officer.trim().length > 0 == ''){
                    responsible_officer = '227';
                }else{
                    responsible_officer = responsible_officer;
                }

                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_insert",
                        data:{
                            name:name,
                            information_source:information_source,
                            remarks:remarks,
                            responsible_officer:responsible_officer,
                            reporter_id:reporter_id
                        },
                        success:function(msg){                   
                                swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location = "<?php echo base_url(); ?>risk/index"; 
                                });                                                                       
                        },
                        error:function(){
                                swal({title:"",text:"The risk was not reported properly!..", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                                                                     
                        }
                    });
                 
             
            });           
                     
        });

     </script>
<!-- End Javascript here --->

<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>