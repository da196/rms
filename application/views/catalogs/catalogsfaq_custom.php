
<script type="text/javascript">
  $(document).ready(function() {
        // ************************************
        // CATALOGS - FAQ
        // *************************************        
        $('#add_button_catalogsfaq').click(function(){  
             $('#catalogsfaq_form')[0].reset();  //reset form
             $('.modal-title').text("Add FAQ");  //modal title
             //$('#submit').val("Add");  //assign value to input with submit ID, Button value
             $('#action').val("Add"); //assign value to input with action ID
        })  

        var dataTable_catalogsfaq = $('#catalogsfaq_data').DataTable({  //Initialize datatable
             "processing":true,  
             "serverSide":true,  
             "order":[],  //removes initially enabled "order" on a table
             "ajax":{  
                  url:"<?php echo base_url().'CatalogsFaq/fetch'; ?>",  
                  type:"POST"  
             },  
             "columnDefs":[  
                {  
                     "targets":[0, 1, 2, 3], //
                     "orderable":false,  
                },  
             ],  
        });  
        
        $(document).on('submit', '#catalogsfaq_form', function(event){  
             event.preventDefault();  
             var faq_question = $('#faq_question').val();  
             var faq_answer = $('#faq_answer').val();  
             var status_code = $('#active').val();              
             
             if(faq_question != '' && faq_answer != ''  && status_code != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url().'CatalogsFaq/action'?>",  
                       method:'POST',  
                       data:new FormData(this), //sends data from form inform of key-> value pairs 
                       contentType:false,  
                       processData:false,  
                       success:function(data)  
                       {  
                          //alert(data);  
                          swal({title: "",text: data,type: "success"});
                          $('#catalogsfaq_form')[0].reset(); // reset form fields 
                          $('#catalogsfaqModal').modal('hide');  // hide modal
                          dataTable_catalogsfaq.ajax.reload();  // reload datatable without page refresh

                       }  
                  });  
             }  
             else  
             {  
                  //alert("All Fields are Required");  
                  swal({
                      title: "",
                      text: "All Fields are Required!",
                      type: "error"
                  });
             }  
        });  

        $(document).on('click', '.updatecatalogsfaq', function(){  
             var catalogsfaq_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsFaq/fetch_one'; ?>",  
                  method:"POST",  
                  data:{catalogsfaq_id:catalogsfaq_id},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                       
                       $('#catalogsfaqModal').modal('show');  
                       $('#faq_question').val(data.faq_question);  
                       $('#faq_answer').val(data.faq_answer);  
                       //$('#active').val(data.active);  
                       $('#active').val(data.active);  
                       $('.modal-title').text("Edit FAQ");  
                       $('#catalogsfaq_id').val(catalogsfaq_id);   
                       //$('#submit').val("Edit"); //assign value to input with submit ID, Button value
                       $('#action').val("Edit"); //assign value to input with action ID
                  }  
             })  
        });     


        //Soft Delete
        $(document).on('click', '.softdeletecatalogsfaq', function(){  
             var catalogsfaq_id = $(this).attr("id"); //id from Soft Delete button 
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
                      url:"<?php echo base_url().'CatalogsFaq/action'; ?>",  
                      method:"POST",  
                      data:{catalogsfaq_id:catalogsfaq_id,action:action}, 
                      success:function(data)  
                      {  
                         //alert(data);  
                         swal("", data, "success");
                         dataTable_catalogsfaq.ajax.reload();  // reload datatable without page refresh
                      }  
                 });                 
             });   

        }); 

        $(document).on('click', '.viewcatalogsfaq', function(){  
             var catalogsfaq_id = $(this).attr("id"); //id from update button 
             $.ajax({  
                  url:"<?php echo base_url().'CatalogsFaq/fetch_one_view'; ?>",  
                  method:"POST",  
                  data:{catalogsfaq_id:catalogsfaq_id},  
                  dataType:"json",  
                  success:function(data)  
                  {                           
                     //disable all form inputs using form id
                     $("#catalogsfaq_form_viewonly :input").prop('disabled', true);

                     //add value to form input using input name attribute
                     $("#catalogsfaq_form_viewonly input[name='faq_question']").val(data.faq_question);
                     $("#catalogsfaq_form_viewonly input[name='faq_answer']").val(data.faq_answer);
                     $("#catalogsfaq_form_viewonly input[name='active']").val(data.active);
                     
                     $('.modal-title').text("FAQ");  
                     $('#catalogsfaqModal_L').modal('show');   
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
