    <!-- Script -->
    <script type="text/javascript">
    		
    $(document).ready(function(){

    	// $('.datepicker').datepicker({
    	//    dateFormat: 'yy-mm-dd'
    	//  });        


       var resultDataTable = $('#resultTable').DataTable({
          'responsive': true,
          //'dom': 'Bfrtip',
          // 'buttons': [
          //    'excel', 'pdf'
          // ],
          // 'buttons': [
          //   { extend: 'excelHtml5',

          //     text : '<i class="fa fa-file-excel-o"> Excel</i>'
          //   },
          //   {
          //       extend : 'pdfHtml5',
          //       customize: function (doc) {
          //           doc.content[1].table.widths = 
          //               Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  

          //           doc.styles = {
          //                 subheader: {
          //                     fontSize: 10,
          //                     bold: true,
          //                     color: 'black'
          //                 },
          //                 tableHeader: {
          //                     bold: true,
          //                     fontSize: 10.5,
          //                      background: 'grey',
          //                     //alignment: 'center'
          //                     color: 'black'
          //                 },
          //                 lastLine: {
          //                     bold: true,
          //                     fontSize: 11,
          //                     color: 'blue'
          //                 },
          //                 defaultStyle: {
          //                     fontSize: 10,
          //                     color: 'black'
          //                 }
          //           }
          //         },
                
          //       orientation : 'landscape',
          //       pageSize : 'legal',
          //       text : '<i class="fa fa-file-pdf-o"> PDF</i>',
          //       titleAttr : 'PDF',
          //       exportOptions: {
          //                           columns: ':visible'
          //                       }
          //   }
          // ],

         'paging': true,
         'ordering': true,
         'processing': true,
         'order': [[ 2, "desc" ]], //columns 2 will de the de-facto column to be order desc by default
         'serverSide': true,
         'serverMethod': 'post',
         'searching': false, // Remove default Search Control
         'ajax': {
            "url":"<?php echo base_url().'Risk/emergingRiskList'; ?>",  
            "data": function(data){    //custom search fields  
               data.reporter_id = $('#reporter_id').val();
               data.status_id = $('#status_id').val();
               data.startDate = $('#startDate').val();
               data.endDate = $('#endDate').val();
            }
         },
         'columns': [ //specify the key names to be read on successful callback...display on form
            { data: 'name' },
            { data: 'reporter_id' },
            { data: 'date_reported' },
            { data: 'status_id' },
         ]
       });

       // $('#sel_city,#sel_gender').change(function(){
       //    resultDataTable.draw();
       // });
       //$('#reporter_id,#status_id').keyup(function(){ //for normal text inputs
         //resultDataTable.draw();
       //});

       $('#reporter_id,#status_id,#startDate,#endDate').change(function(){ //for dropdowns         
          var reporter_id =$('#reporter_id').val();
          if(reporter_id !== ''){ 
             $('input:hidden[name=reporter_id]').val(reporter_id); console.log(reporter_id); 
          }else{
             $('input:hidden[name=reporter_id]').val('');
          }

          var status_id =$('#status_id').val();
          if(status_id !== ''){ 
             $('input:hidden[name=status_id]').val(status_id); console.log(status_id); 
          }else{
             $('input:hidden[name=status_id]').val('');
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