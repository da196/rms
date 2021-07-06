<script text="javascript">
    function viewFunction(inc_id){
        viewConsequences_Function(inc_id);
        viewMitigations_Function(inc_id);
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>incident/view_incident",
			data:{
				inc_id:inc_id, 
				}, 
			success:function(msg){	
				document.getElementById('view_description_incident').value = msg.description;
				document.getElementById('view_directorate').value = msg.directorate_name;
				document.getElementById('view_section').value = msg.section_name;
                document.getElementById('view_reported_by').value = msg.email;
                document.getElementById('view_esc_to').value = msg.escalated_to;
                //document.getElementById('view_esc_user').value = msg.email;	
                var date_create = msg.date_created;
                var new_date_create = date_create.replace("00:00:00+03", "");
                document.getElementById('view_date_reported').value = new_date_create;													          
			}
		});
	}
</script>



<script text="javascript">
    function viewConsequences_Function(incident_id){
        //alert(incident_id);
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>incident/incident_view_consequences",
			data:{
				incident_id:incident_id, 
				}, 
			success:function(msg){
                //alert(msg);	
                var cons = '';
                    cons += '<ol>';
                    // Start loop here
                    for(var i = 0; i < msg.length; i++) {                       
                    cons += '<li>'+ msg[i].description +'</li>';
                    }
                    // End Loop here
                    cons += '</ol>';
                $('#list_consequences').html(cons);

				//document.getElementById('view_name').value = msg.name;
																	          
			}
		});
	}


    function viewMitigations_Function(incident_id){
        $.ajax({
			type:"POST",
            dataType:"json",
			url: "<?php echo base_url();?>incident/incident_view_mitigations",
			data:{
				incident_id:incident_id, 
				}, 
			success:function(msg){
                // Start Mitigation here...	
                var mit = '';
                    mit += '<ol>';
                    // Start loop here 
                    for(var i = 0; i < msg.length; i++) {                       
                        mit += '<li>'+ msg[i].description +'</li>';
                    }               
                    // End Loop here
                    mit += '</ol>';
                $('#list_mitigations').html(mit);
                 // End Mitigation here...
			}
		});
	}
</script>


<script text="javascript">

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