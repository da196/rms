<!-- Script -->
<script type="text/javascript">    		
    $(document).ready(function(){  
       var resultDataTable = $('#resultTable').DataTable({
          dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
          pagingType: 'full_numbers',
         'responsive': true,
         'paging': true,
         'ordering': true,
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'searching': false, // Remove default Search Control
         'ajax': {
            "url":"<?php echo base_url().'KeyRiskIndicator/keyRiskIndicatorList'; ?>",  
            "data": function(data){    //custom search fields  
               //data.objective_id = $('#objective_id').val();
               data.risk_owner = $('#risk_owner').val();
               // data.startDate = $('#startDate').val();
               // data.endDate = $('#endDate').val();
               data.quarter_id = $('#quarter_id').val();
               data.year_id = $('#year_id').val();
            }
         },
         'columns': [ //specify the key names to be read on successful callback...display on form
            { data: 'risk_owner' },
            //{ data: 'objective_id' },
            { data: 'main_activity' },
            { data: 'key_performance_indicator' },
            { data: 'resources' },
            // { data: 'kri_green_definition' },
            // { data: 'kri_amber_definition' },
            // { data: 'kri_red_definition' },
            { data: 'kri_green_assessment' },
            { data: 'kri_amber_assessment' },
            { data: 'kri_red_assessment' },
            { data: 'year' },
            { data: 'quarter' }
         ]
       });

       //$('#objective_id,#risk_owner,#startDate,#endDate').change(function(){ //for dropdowns         
        $('#risk_owner,#year_id,#quarter_id').change(function(){ //for dropdowns       
          // var objective_id =$('#objective_id').val();
          // if(objective_id !== ''){ 
          //    $('input:hidden[name=objective_id]').val(objective_id); console.log(objective_id); 
          // }else{
          //    $('input:hidden[name=objective_id]').val('');
          // }

          var risk_owner =$('#risk_owner').val();
          if(risk_owner !== ''){ 
             $('input:hidden[name=risk_owner]').val(risk_owner); console.log(risk_owner); 
          }else{
             $('input:hidden[name=risk_owner]').val('');
          }

          // var startDate =$('#startDate').val();
          // if(startDate !== ''){ 
          //    $('input:hidden[name=startDate]').val(startDate); console.log(startDate); 
          // }else{
          //    $('input:hidden[name=startDate]').val('');
          // }

          // var endDate =$('#endDate').val();
          // if(endDate !== ''){ 
          //    $('input:hidden[name=endDate]').val(endDate); console.log(endDate); 
          // }else{
          //    $('input:hidden[name=endDate]').val('');
          // }

          var year_id =$('#year_id').val();
          if(year_id !== ''){ 
             $('input:hidden[name=year_id]').val(year_id); console.log(year_id); 
          }else{
             $('input:hidden[name=year_id]').val('');
          }

          var quarter_id =$('#quarter_id').val();
          if(quarter_id !== ''){ 
             $('input:hidden[name=quarter_id]').val(quarter_id); console.log(quarter_id); 
          }else{
             $('input:hidden[name=quarter_id]').val('');
          }

          resultDataTable.draw();
       });
    });
</script>