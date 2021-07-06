<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/natural.js"></script>
<!-- Script -->
<script type="text/javascript">         
    $(document).ready(function(){  
       var resultDataTable = $('#resultTable').DataTable({
         dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
         pagingType: 'full_numbers',
         'responsive': true,
         //'paging': true,
         //'ordering': true,
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'searching': false, // Remove default Search Control
         'ajax': {
            "url":"<?php echo base_url().'Registry/riskRegisterList'; ?>",  
            "data": function(data){    //custom search fields ... passed on page reload
                data.trends_id = $('#trends_id').val(); 
                data.activity = $('#activity').val();
                data.objective_category_id = $('#objective_category_id').val();
                data.quarter_id = $('#quarter_id').val();
                data.year_id = $('#year_id').val();
            }
         },
         'columns': [ //specify the key names to be read on successful callback...display on form
            { data: 'activity' },
            { data: 'risk_owner' },
            //{ data: 'impact_scale_id' },
            //{ data: 'like_hood_scale_id' },
            { data: 'magnitude' },
            //{ data: 'controls_effectiveness_scale_id' },
            { data: 'residualriskscore' },
            { data: 'trends_id' },
            { data: 'year_id' },
            { data: 'quarter_id' }
         ],
         columnDefs: [{
           //orderable: false,
           //targets: "no-sort",
           type: 'natural', targets: 0,
         },
         {
             "targets": [1,2,3,4,5,6],
             "orderable": false
         }], 
         // columnDefs: [ //Sort alphanumeric string using natural.js
         //   { type: 'natural', targets: 0 }
         // ],
         order: [[ 0, 'desc' ]]
       });  

       
       $('#trends_id,#activity,#objective_category_id,#quarter_id,#year_id').change(function(){ //for dropdowns   
          //$('#trends_id,#objective_category_id,#startDate,#endDate').change(function(){ //for dropdowns   
          //$('#trends_id,#objective_category_id').change(function(){       
          var trends_id =$('#trends_id').val();
          if(trends_id !== ''){ 
             $('input:hidden[name=trends_idHIDDEN]').val(trends_id);   //alert(trends_id); //console.log(trends_id); 
          }else{
             $('input:hidden[name=trends_idHIDDEN]').val('');
          }

          var activity =$('#activity').val();
          if(activity !== ''){ 
             $('input:hidden[name=activityHIDDEN]').val(activity);   //alert(activity); //console.log(activity); 
          }else{
             $('input:hidden[name=activityHIDDEN]').val('');
          }

          var objective_category_id =$('#objective_category_id').val();
          if(objective_category_id !== ''){ 
             $('input:hidden[name=objective_category_idHIDDEN]').val(objective_category_id); console.log(objective_category_id);  //alert(objective_category_id); 
          }else{
             $('input:hidden[name=objective_category_idHIDDEN]').val('');
          }

          var quarter_id =$('#quarter_id').val();
          if(quarter_id !== ''){ 
             $('input:hidden[name=quarter_idHIDDEN]').val(quarter_id); console.log(quarter_id);  //alert(quarter_id);
          }else{
             $('input:hidden[name=quarter_idHIDDEN]').val('');
          }

          var year_id =$('#year_id').val();
          if(year_id !== ''){ 
             $('input:hidden[name=year_idHIDDEN]').val(year_id); console.log(year_id);  //alert(year_id);
          }else{
             $('input:hidden[name=year_idHIDDEN]').val('');
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

          resultDataTable.draw();
       });

    });
</script>