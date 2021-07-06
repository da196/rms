<script type="text/javascript">
  $(document).ready(function() {
      // ************************************
      // CATALOGS - EFFECTIVENESS
      // *************************************



      
      $('#add_button_catalogseffectivenessscale').click(function(){  
           $('#catalogseffectivenessscale_form')[0].reset();  //reset form
           $('.modal-title').text("Add Control Effectiveness Rating Scale");  //modal title
           //$('#submit').val("Add");  //assign value to input with submit ID, Button value
           $('#action').val("Add"); //assign value to input with action ID
      })  

      var dataTable_catalogseffectivenessscale = $('#catalogseffectivenessscale_data').DataTable({  //Initialize datatable
           "processing":true,  
           "serverSide":true,  
           "order":[],  //removes initially enabled "order" on a table
           "ajax":{  
                url:"<?php echo base_url().'CatalogsEffectivenessScale/fetch'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
              {  
                   "targets":[ 1, 2, 3], // order on colimns 1,2 and 3 only
                   "orderable":true,  
              },  
           ],  
      });  
      
      $(document).on('submit', '#catalogseffectivenessscale_form', function(event){  
           event.preventDefault();  
           var controls_effectiveness_scale = $('#controls_effectiveness_scale').val();  
           var controls_effectiveness_scale_score = $('#controls_effectiveness_scale_score').val();  
           var color_code = $('#color_code').val();              
           console.log(color_code);
           if(controls_effectiveness_scale != '' && controls_effectiveness_scale_score != ''  && color_code != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url().'CatalogsEffectivenessScale/action'?>",  
                     method:'POST',  
                     data:new FormData(this), //sends data from form inform of key-> value pairs 
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                        //alert(data);  
                        swal({title: "",text: data,type: "success"});
                        $('#catalogseffectivenessscale_form')[0].reset(); // reset form fields 
                        $('#catalogseffectivenessscaleModal').modal('hide');  // hide modal
                        dataTable_catalogseffectivenessscale.ajax.reload();  // reload datatable without page refresh
                     }  
                });  
           }  
           else  
           {  
                //("All Fields are Required");  
                swal({title: "",text: "All Fields are Required!",type: "error"});
           }  
      });  

      $(document).on('click', '.updatecatalogseffectivenessscale', function(){  
           var catalogseffectivenessscale_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsEffectivenessScale/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogseffectivenessscale_id:catalogseffectivenessscale_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#catalogseffectivenessscaleModal').modal('show');  
                     $('#controls_effectiveness_scale').val(data.controls_effectiveness_scale);  
                     $('#controls_effectiveness_scale_score').val(data.controls_effectiveness_scale_score);  
                     $('#color_code').val(data.color_code);  
                     $('.modal-title').text("Edit Control Effectiveness Rating Scale");  
                     $('#catalogseffectivenessscale_id').val(catalogseffectivenessscale_id);   
                     //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                     $('#action').val("Edit"); //assign value to input with action ID
                }  
           })  
      });     


      //Soft Delete
      $(document).on('click', '.softdeletecatalogseffectivenessscale', function(){  
           var catalogseffectivenessscale_id = $(this).attr("id"); //id from Soft Delete button 
           var action = "SoftDelete";

           swal({
               title: "Are you sure?",
               text: "Once deleted, you will not be able to recover this data!",
               type: "warning",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }, function () {
               $.ajax({  
                    url:"<?php echo base_url().'CatalogsEffectivenessScale/action'; ?>",  
                    method:"POST",  
                    data:{catalogseffectivenessscale_id:catalogseffectivenessscale_id,action:action}, 
                    success:function(data)  
                    {  
                       //alert(data);  
                       swal("", data, "success");
                       dataTable_catalogseffectivenessscale.ajax.reload();  // reload datatable without page refresh
                    }  
               });                 
           });   

      }); 

      $(document).on('click', '.viewcatalogseffectivenessscale', function(){  
           var catalogseffectivenessscale_id = $(this).attr("id"); //id from update button 
           $.ajax({  
                url:"<?php echo base_url().'CatalogsEffectivenessScale/fetch_one'; ?>",  
                method:"POST",  
                data:{catalogseffectivenessscale_id:catalogseffectivenessscale_id},  
                dataType:"json",  
                success:function(data)  
                {                           
                   //disable all form inputs using form id
                   $("#catalogseffectivenessscale_form_viewonly :input").prop('disabled', true);

                   //add value to form input using input name attribute
                   $("#catalogseffectivenessscale_form_viewonly input[name='controls_effectiveness_scale']").val(data.controls_effectiveness_scale);
                   $("#catalogseffectivenessscale_form_viewonly input[name='controls_effectiveness_scale_score']").val(data.controls_effectiveness_scale_score);
                   $("#catalogseffectivenessscale_form_viewonly input[name='color_code']").val(data.color_code);

                   $('.modal-title').text("Control Effectiveness Rating Scale");  
                   $('#catalogseffectivenessscaleModal_L').modal('show');   
                }  
           })  
      }); 
  });
</script>


<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>
