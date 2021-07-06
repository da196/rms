
<script text="javascript">

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
                                    window.location.reload(); 
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
                                    window.location.reload(); 
                                });                                                                      
                        },
                        error:function(){
                            swal({title:"",text:"The risk was not reported properly", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                    
                        }
                    });
                 
             
            });           
            // Update Risk Emerging
            $('#updaterisk').click(function(event){
                event.preventDefault();
                var u_name = $("#update_name").val();
                var u_information_source = $("#update_information_source").val();
                var u_remarks = $("#update_remarks").val();
                var u_responsible_officer = $("#update_responsible_officer").val();
                var u_risk_id = $("#update_risk_id").val();

                if(u_name.trim().length > 0 == ''){
                    swal(" ", "Name of the risk is required!", "error");                                    
                    return false;                
                }
                if(u_information_source.trim().length > 0  == ''){
                    swal(" ", "Source of information is required!", "error");                                    
                    return false;                     
                }
                if(u_remarks.trim().length > 0 == ''){
                    swal(" ", "Remarks is required!", "error");                                    
                    return false;                      
                }
                if(u_responsible_officer.trim().length > 0 == ''){
                    u_responsible_officer = '227';
                }else{
                    u_responsible_officer = u_responsible_officer;
                }
          
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_update",
                        data:{
                            u_risk_id:u_risk_id,
                            u_name:u_name,
                            u_information_source:u_information_source,
                            u_remarks:u_remarks,
                            u_responsible_officer:u_responsible_officer
                        },
                        success:function(msg){                              
                                swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                      
                        },
                        error:function(){
                                swal({title:"",text:"No risk was updated", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                 
                        }
                    });           
            });
            // Complete Risk Emerging
            $('#completerisk').click(function(event){
                event.preventDefault();
                var c_name = $("#complete_name").val();
                var c_information_source = $("#complete_information_source").val();
                var c_remarks = $("#complete_remarks").val();
                var c_responsible_officer = $("#complete_responsible_officer").val();
                var c_risk_id = $("#complete_risk_id").val();

                if(c_name.trim().length > 0 == ''){
                    swal(" ", "Risk Name is required!", "error");                                    
                    return false;                
                }
                if(c_information_source.trim().length > 0  == ''){
                    swal(" ", "Source of the risk is required!", "error");                                    
                    return false;                    
                }
                if(c_remarks.trim().length > 0 == ''){
                    swal(" ", "Risk Detail is required!", "error");                                    
                    return false;                   
                }
               if(c_responsible_officer.trim().length > 0 == '' ){
                    swal(" ", "Responsible officer/office is required!", "error");                                    
                    return false; 
                }
         
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_complete",
                        data:{
                            c_risk_id:c_risk_id,
                            c_name:c_name,
                            c_information_source:c_information_source,
                            c_remarks:c_remarks,
                            c_responsible_officer:c_responsible_officer
                        },
                        success:function(msg){       
                                swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                      
                        },
                        error:function(){
                            swal({title:"",text:"No risk was completed", type: "success"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                    
                        }
                    });           
            });
            /* Delete Risk Emerging
            $('.delete_risk').click(function(event){
                event.preventDefault();
                var id = $(this).attr("id");
                if(confirm(" Do you want to delete this Emerging Risk ? ")){
                    window.location = "<?php echo base_url(); ?>risk/delete_risk/"+id;
                }else{
                    window.location.reload(); 
                }
            });
            */
            // Approve Risk Emerging
            $('#arisk').click(function(event){
                event.preventDefault();
                var approve_risk_id = $("#approve_risk_id").val();
                //alert(approve_risk_id);
                var approved_by= $("#approved_by").val();
                var risk_comment = $("#risk_comment").val();
                var reporter = $("#reported_by").val();
                

                if(risk_comment.trim().length > 0 == '' ){
                    swal(" ", "Comment is required!", "error");                   
                    return false;
                }
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_approve",
                        data:{
                            approve_risk_id:approve_risk_id,
                            approved_by:approved_by,
                            risk_comment:risk_comment,
                            reporter:reporter
                        },
                        success:function(msg){
                                var test = JSON.parse(msg);
                                if(test.Status_code == 404){ 
                                    swal({title:"",text:test.Message, type: "error"},
                                    function(){ 
                                        window.location.reload(); 
                                    }); 
                                }else{
                                    swal({title:"",text:test.Message, type: "success"},
                                    function(){ 
                                        window.location.reload(); 
                                    }); 

                                }                                                                                                                                 
                        },
                        error:function(){
                                swal({title:"",text:"No Comment was inserted", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                 
                        }
                    });                
            });


            // Reject Risk Emerging
            $('#rrisk').click(function(event){
                event.preventDefault();
                var approve_risk_id = $("#approve_risk_id").val();
                var approved_by= $("#approved_by").val();
                var risk_comment = $("#risk_comment").val();
                var reporter = $("#reported_by").val();

                if(risk_comment.trim().length > 0 == '' ){
                    swal(" ", "Comment is required!", "error");                   
                    return false;
                }
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>risk/risk_reject",
                        data:{
                            approve_risk_id:approve_risk_id,
                            approved_by:approved_by,
                            risk_comment:risk_comment,
                            reporter:reporter
                        },
                        success:function(msg){
                            var test = JSON.parse(msg);
                                if(test.Status_code == 404){ 
                                    swal({title:"",text:test.Message, type: "error"},
                                    function(){ 
                                        window.location.reload(); 
                                    }); 
                                }else{
                                    swal({title:"",text:test.Message, type: "success"},
                                    function(){ 
                                        window.location.reload(); 
                                    }); 

                                }                                                                                                       
                        },
                        error:function(){
                                swal({title:"",text:"No Comment was inserted", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                      
                        }
                    });                
            });
            
        });

     </script>

<script text="javascript">
    function viewFunction(risk_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>risk/view_risk",
			data:{
				risk_id:risk_id, 
				}, 
			success:function(msg){	
                var fullname = msg.first_name+ ' ' + msg.last_name;
				document.getElementById('view_name').value = msg.name;
				document.getElementById('view_information_source').value = msg.information_source;
				document.getElementById('view_remarks').value = msg.remarks;
                document.getElementById('view_responsible_officer').value = fullname;
				document.getElementById('view_email').value = msg.email;
                var date_create = msg.date_created;
                var new_date_create = date_create.replace("00:00:00+03", "");
                document.getElementById('view_date_reported').value = new_date_create;													          
				}
		});
	}

    function editFunction(risk_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>risk/view_risk",
			data:{
				risk_id:risk_id, 
				}, 
			success:function(msg){	
                //var fullname = msg.first_name+ ' ' + msg.last_name;
				document.getElementById('update_name').value = msg.name;
				document.getElementById('update_information_source').value = msg.information_source;
				document.getElementById('update_remarks').value = msg.remarks;
                //document.getElementById('update_responsible_officer').value = fullname;
                document.getElementById('update_risk_id').value = risk_id;
                var date_create = msg.date_created;
                var new_date_create = date_create.replace("00:00:00+03", "");
                document.getElementById('update_date_reported').value = new_date_create;														          
												          
				}
		});
	}

    function completeFunction(risk_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>risk/view_risk",
			data:{
				risk_id:risk_id 
				}, 
			success:function(msg){	
				document.getElementById('complete_name').value = msg.name;
				document.getElementById('complete_information_source').value = msg.information_source;
				document.getElementById('complete_remarks').value = msg.remarks;
                document.getElementById('complete_responsible_officer').value = msg.responsible_officer;	
                document.getElementById('complete_risk_id').value = risk_id;												          
				}
		});
    }

    function approvalFunction(risk_id){
        document.getElementById('approve_risk_id').value = risk_id;	
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>risk/view_risk",
			data:{
				risk_id:risk_id 
				}, 
			success:function(msg){          
                var fullname = msg.first_name+ ' ' + msg.last_name;
				document.getElementById('review_name').value = msg.name;
				document.getElementById('review_information_source').value = msg.information_source;
                document.getElementById('review_remarks').value = msg.remarks;
                document.getElementById('review_responsible_officer').value = fullname;
				document.getElementById('review_email').value = msg.email;       
                var date_create = msg.date_created;
                var new_date_create = date_create.replace("00:00:00+03", "");
                document.getElementById('review_date_reported').value = new_date_create;
                document.getElementById('reported_by').value = msg.reporter_id;;
				}
		});
    }

    

</script>

<script text="javascript">

    $(document).on('click', '.delete_risk', function(){  
           var risk_id = $(this).attr("id");

           swal({
               title:"Are you sure?",
               text: "Once deleted, you will not be able to recover this data!",
               type: "warning",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }, function () {
               $.ajax({  
                    url:"<?php echo base_url().'risk/delete_risk'; ?>",  
                    method:"POST",  
                    data:{risk_id:risk_id}, 
                    success:function(msg){
                            swal({title:"",text:"Risk has been deleted successfully", type: "success"},
                                function(){ 
                                    window.location.reload();
                                });
                        },
                        error:function(){
                            swal({title:"",text:"Sorry, Risk was not deleted successfully", type: "error"},
                                function(){ 
                                    window.location.reload();
                                });                                                                       
                        }  
               });                 
           });   

      });

    $(document).ready(function () {

        $('#dataTable_riskEmerge').DataTable({
            "ordering": false
        });


    });

</script>



<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
