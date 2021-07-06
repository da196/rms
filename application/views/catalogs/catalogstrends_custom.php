
<script type="text/javascript">
  $(document).ready(function() {
        // ************************************
        // CATALOGS - TRENDS
        // *************************************
        
        $('#add_button_catalogstrends').click(function(){  
             $('#catalogstrends_form')[0].reset();  //reset form
             $('.modal-title').text("Add Trend");  //modal title
             //$('#submit').val("Add");  //assign value to input with submit ID, Button value
             $('#action').val("Add"); //assign value to input with action ID
        })  

        var dataTable_catalogstrends = $('#catalogstrends_data').DataTable({  //Initialize datatable
             "processing":true,  
             "serverSide":true,  
             "order":[],  //removes initially enabled "order" on a table
             "ajax":{  
                  url:"<?php echo base_url().'CatalogsTrends/fetch'; ?>",  
                  type:"POST"  
             },  
             "columnDefs":[  
                {  
                     "targets":[0, 1, 2, 3], //
                     "orderable":false,  
                },  
             ],  
        });  
        
        $(document).on('submit', '#catalogstrends_form', function(event){  
             event.preventDefault();  
             var trend_name = $('#trend_name').val();  
             var color_code = $('#color_code').val();              
             
             if(trend_name != '' && color_code != '' )  
             {  
                  $.ajax({  
                       url:"<?php echo base_url().'CatalogsTrends/action'?>",  
                       method:'POST',  
                       data:new FormData(this), //sends data from form inform of key-> value pairs 
                       contentType:false,  
                       processData:false,  
                       success:function(data)  
                       {  
                          //alert(data);  
                          swal({
                              title: "",
                              text: data,
                              type: "success"
                          });
                          $('#catalogstrends_form')[0].reset(); // reset form fields 
                          $('#catalogstrendsModal').modal('hide');  // hide modal
                          dataTable_catalogstrends.ajax.reload();  // reload datatable without page refresh
                       }  
                  });  
             }  
             else  
             {  
                  //alert("All Fields are Required");  
                  swal({
                      title: "",
                      text: "All Fields are Required",
                      type: "error"
                  });
             }  
        });  

        $(document).on('click', '.updatecatalogstrends', function(){  
             var catalogstrends_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsTrends/fetch_one'; ?>",  
                  method:"POST",  
                  data:{catalogstrends_id:catalogstrends_id},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                       $('#catalogstrendsModal').modal('show');  
                       $('#trend_name').val(data.trend_name);  
                       $('#color_code').val(data.color_code);  
                       $('.modal-title').text("Edit Trend");  
                       $('#catalogstrends_id').val(catalogstrends_id);   
                       //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                       $('#action').val("Edit"); //assign value to input with action ID
                  }  
             })  
        });         

        // $(document).on('click', '.deletecatalogstrends', function(){  
        //      var catalogstrends_id = $(this).attr("id"); //id from delete button 
        //      swal({
        //          title: "Are you sure?",
        //          text: "Once deleted, you will not be able to recover this data!",
        //          type: "warning",
        //          icon: "warning",
        //          showCancelButton: true,
        //          confirmButtonColor: "#DD6B55",
        //          confirmButtonText: "Yes, delete it!",
        //          closeOnConfirm: false
        //      }, function () {
        //          $.ajax({  
        //               url:"<?php echo base_url(); ?>CatalogsTrends/delete_one",  
        //               method:"POST",  
        //               data:{catalogstrends_id:catalogstrends_id}, 
        //               success:function(data)  
        //               {  
        //                  //alert(data);  
        //                  swal("Deleted!", "Selected Trend has been deleted.", "success");
        //                  dataTable_catalogstrends.ajax.reload();  // reload datatable without page refresh
        //               }  
        //          });                 
        //      });           
        // }); 

        //Soft Delete
        $(document).on('click', '.softdeletecatalogstrends', function(){  
             var catalogstrends_id = $(this).attr("id"); //id from Soft Delete button 
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
                      url:"<?php echo base_url().'CatalogsTrends/action'; ?>",  
                      method:"POST",  
                      data:{catalogstrends_id:catalogstrends_id,action:action}, 
                      success:function(data)  
                      {  
                         //alert(data);  
                         swal("", data, "success");
                         dataTable_catalogstrends.ajax.reload();  // reload datatable without page refresh
                      }  
                 });                 
             });   

        }); 

        $(document).on('click', '.viewcatalogstrends', function(){  
             var catalogstrends_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsTrends/fetch_one'; ?>",  
                  method:"POST",  
                  data:{catalogstrends_id:catalogstrends_id},  
                  dataType:"json",  
                  success:function(data)  
                  {     
                      
                     //disable all form inputs using form id
                     $("#catalogstrends_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     $("#catalogstrends_form_viewonly input[name='trend_name']").val(data.trend_name);
                     //$("#catalogstrends_form_viewonly textarea[name='color_code']").val(data.color_code);
                     $("#catalogstrends_form_viewonly input[name='color_code']").val(data.color_code);
                     $('.modal-title').text("Trends");  
                     $('#catalogstrendsModal_L').modal('show');   
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
