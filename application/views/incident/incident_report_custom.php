<!-- Start Javascript here.... -->
<!-- <script text="javascript">

    $(document).ready(function () {

        $('#dataTable_riskEmerge').DataTable();

    });

</script> -->

<script type="text/javascript">         
    $(document).ready(function(){  
       var resultDataTable = $('#resultTable').DataTable({
          dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
          pagingType: 'full_numbers',
         'responsive': true,
         'paging': true,
         'ordering': true,
         'columnDefs': [ //disable ordering on ACTION columns
            { orderable: false, targets: [4] }  
          ],
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'searching': false, // Remove default Search Control
         'ajax': {
            "url":"<?php echo base_url().'Incident/incidentList'; ?>",  
            "data": function(data){    //custom search fields  
                data.reporter_id = $('#reporter_id').val(); 
                data.startDate = $('#startDate').val();
                data.endDate = $('#endDate').val();
            }
         },
         'columns': [ //specify the key names to be read on successful callback...display on form
            { data: 'date_reported' },
            { data: 'reporter_id' },
            { data: 'description' },
            { data: 'directorate_id' },
            { data: 'section_id' },
            { data: 'esc_user_id' },
            { data: 'button' }
         ]
       });

       
       $('#reporter_id,#startDate,#endDate').change(function(){ //for dropdowns    
          var reporter_id =$('#reporter_id').val();
          if(reporter_id !== ''){ 
             $('input:hidden[name=reporter_idHIDDEN]').val(reporter_id); console.log(reporter_id); 
          }else{
             $('input:hidden[name=reporter_idHIDDEN]').val('');
          }

          var startDate =$('#startDate').val();
          if(startDate !== ''){ 
             $('input:hidden[name=startDate]').val(startDate); console.log(startDate); 
          }else{
             $('input:hidden[name=startDate]').val('');
          }

          var endDate =$('#endDate').val();
          if(endDate !== ''){ 
             $('input:hidden[name=endDate]').val(endDate); console.log(endDate); 
          }else{
             $('input:hidden[name=endDate]').val('');
          }

          resultDataTable.draw();
       });

    });
</script>
<!-- End Javascript here.... -->
<!-- CLOSE PAGE -->
</div>
</div>
</body>
</html>