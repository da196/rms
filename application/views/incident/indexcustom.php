<!-- START INCIDENT -->
<script text="javascript">
        $(document).ready(function(){  

        
        $('#directorate,#section,#esc_to,#esc_to_success').select2({});


        // Get Risk Champion and Supervisor
        $('#esc_to').on('change', function(e){
            var getSection = $('#section').val();
            var getDirectorate = $('#directorate').val();
                        var optionSelected = $(this).find("option:selected");
                        var esc_to_val = optionSelected.val();
                        
                        if(esc_to_val == 'Supervisor'){
                            esc_to_val = '10';
                        }
                        else if(esc_to_val == 'Risk Champion'){
                            esc_to_val = '23';
                        }else{
                            // Clear the selection under RMU Officer..
                            esc_to_val = '7';    
                        }
                            $.ajax({
                                type:"POST",
                                url:"<?php echo base_url();?>incident/incident_get_escTo",
                                data:{
                                    esc_to_val:esc_to_val,
                                    getSection:getSection,
                                    getDirectorate:getDirectorate
                                },
                                success:function(msg){                           
                                        var obj = JSON.parse(msg);
                                        $('#esc_to_success').html('');
                                        var content  = ' ';
                                        $.each(obj, function(key, value) {
                                           
                                            content +='<option value="'+value.id+'">'+value.email.toUpperCase()+'</option>';
                                        });
                                        $('#esc_to_success').append(content);    
                                },
                                error:function(){                                  
                                        swal({title:"",text:"Sorry, Supervisors/Champions  were not found!", type: "error"},
                                        function(){ 
                                        window.location.reload(); 
                                        });                                                                     
                                }
                            });                       
                    });
            // Get Section in a choosen Directorate
            $('#directorate').on('change', function(e){
                var optionSelected = $(this).find("option:selected");
                var directorate_id = optionSelected.val();
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>incident/incident_section_get",
                        data:{
                            directorate_id:directorate_id
                        },
                        success:function(msg){                           
                                var obj = JSON.parse(msg);
                                $('#section').html('');
                                var content  = ' ';
                                $.each(obj, function(key, value) {
                                    content +='<option value="'+value.id+'">'+value.section_name+'</option>';
                                });
                                $('#section').append(content);    
                        },
                        error:function(){
                                swal({title:"",text:"The section was not found!", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                     
                        }
                    });
            });
            // ADD BUTTON IN CONSEQUENCES
                    var counter = 1;
                    $("#addConsequences").click(function(e){
                    var newTextBoxDiv = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv' + counter);
                            newTextBoxDiv.after().html('<div class="col-sm-11"> <textarea class="form-control" name="Cons_textBoxs" '+	                                           
                                                    '" id="textbox' +counter+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="textbox' +counter+ '" class="btn-xs btn-danger btn-remove"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDiv.appendTo("#toAddConsequences");
                	counter++;
                });
                // REMOVE BUTTON IN CONSEQUENCES
                $(document).on('click', '.btn-remove',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });

                // ADD BUTTON IN MITIGATION
                   var counter = 1;
                    $("#addMitigation").click(function(e){
                    var newTextBoxDiv = $(document.createElement('div'))
                                        .attr("id", 'TextBoxDiv2' + counter);
                            newTextBoxDiv.after().html('<div class="col-sm-11"><textarea class="form-control" name="Mtg_textBoxs" '+	                                           
                                                    '" id="Mit_textbox' +counter+'_"></textarea></div>'+
                                                    '<div class="col-sm-1"><button name="remove" id="Mit_textbox' +counter+ '" class="btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i>  Remove </button></div></br>');                                              
	                newTextBoxDiv.appendTo("#toAddMitigation");
                	counter++;
                });
               // REMOVE BUTTON IN MITIGATION
                $(document).on('click', '.btn-delete',function(){
                    var btn = $(this).attr('id');
                    $('#'+btn+'').remove();
                    $('#'+btn+'_').remove();
                });
    

               
                // Insert Incidence Data in the  Database
                $('#submitIncidence').click(function(){
                    var directorate = $('#directorate').val();
                    var section = $('#section').val();
                    var description = $('#description').val();
                    var esc_to = $('#esc_to').val();
                    var esc_user  = $('#esc_to_success').val();
                    var reporter_id = $('#reporter_id').val();
                    var consequences = [];
                    var mitigation = [];

                    // Initializing array with list of consequences
                    $("textarea[name='Cons_textBoxs']").each(function(){
                        consequences.push(this.value);
                    });

                      // Initializing array with list of mitigation
                      $("textarea[name='Mtg_textBoxs']").each(function(){
                        mitigation.push(this.value);
                    });


                    // Start check if empty                
                    if(directorate.trim().length > 0  == ''){
                        swal(" ", "Directorate is required!.. ", "error");  
                        return false;  
                    }

                    if(section.trim().length > 0  == ''){
                        swal(" ", "Section is required!.. ", "error");  
                        return false;
                    }

                    if(description.trim().length > 0  == ''){
                        swal(" ", "Incident Description  is required!.. ", "error");  
                        return false;
                    }

                    if(esc_to.trim().length > 0  == ''){
                        swal(" ", "Escalation To  is required!.. ", "error");  
                        return false;
                    }


                    if(esc_user.trim().length > 0  == ''){
                        swal(" ", "Officer's name is required!.. ", "error");  
                        return false;
                    }

                    if(consequences.length > 0  == ''){
                        swal(" ", "Consequence is required!.. ", "error");  
                        return false;
                    }
                 
                    if(mitigation.length > 0  == ''){
                        swal(" ", "Mitigation is required!.. ", "error");  
                        return false;
                    }
                    // End check if empty

                    if(reporter_id.trim().length > 0 == ''){
                        reporter_id = '6';
                    }else{
                        reporter_id = reporter_id;
                    } 


                   $.ajax({
                        url:"<?php echo base_url();?>incident/incident_insert",
                        method:"POST",
                        data:{
                            reporter_id:reporter_id,
                            directorate:directorate,
                            section:section,
                            esc_user:esc_user,
                            description:description,
                            esc_to:esc_to,
                            consequences:consequences,
                            mitigation:mitigation},
                        success:function(msg){
                            swal({title:"",text:msg, type: "success"},
                                function(){ 
                                    window.location = "<?php echo base_url(); ?>incident/view"; 
                                });                            
                        },
                        error:function(){
                            swal({title:"",text:"New Incident was not inserted properly!", type: "error"},
                                function(){ 
                                    window.location.reload(); 
                                });                                                                                                   
                        }
                   });
                });
          });
    </script>
<!-- END INCIDENT -->

<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>