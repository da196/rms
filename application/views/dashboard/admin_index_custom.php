<script>
$(document).ready(function(){  

	$('#objective_category_id').select2({});

   //  var resultDataTable = $('#resultTable').DataTable({
	  // 'responsive': true,
	  // 'paging': true,
	  // 'ordering': true,
	  // 'processing': true,
	  // 'serverSide': true,
	  // 'serverMethod': 'post',
	  // 'searching': true,
	  // 'ajax': {
	  //    "url":"<?php echo base_url().'Registry/riskRegisterList'; ?>",
	  //    "data": function(data){    //custom search fields ... passed on page reload
	  //         data.trends_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
	  //         data.objective_category_id = $('#objective_category_id').val();
	  //         data.quarter_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
	  //         data.year_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
	  //    }
	  // },	
	  // 'columns': [ //specify the key names to be read on successful callback...display on form
	  //      { data: 'activity' },
	  //      //{ data: 'impact_scale_id' },
	  //      //{ data: 'like_hood_scale_id' },
	  //      { data: 'magnitude' },
	  //      //{ data: 'controls_effectiveness_scale_id' },
	  //      { data: 'residualriskscore' },
	  //      { data: 'trends_id' },
	  //      { data: 'objective_category_id' },
	  //      { data: 'year_id' },
	  //      { data: 'quarter_id' }
	  //  ]
   //  });


	 var resultDataTable = $('#resultTable').DataTable({
	   dom: 'lpftrip', //PAGINATION AT THE TOP AND BOTTON
	   pagingType: 'full_numbers',
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'searching': false,
      'ajax': {
         // "url":"<?=base_url()?>index.php/Registry/dashboardRiskRegisterList",
         "url":"<?php echo base_url().'Registry/dashboardRiskRegisterList'; ?>",
         "data": function(data){    //custom search fields ... passed on page reload
             data.trends_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
             data.objective_category_id = $('#objective_category_id').val();
             data.quarter_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
             data.year_id = ""; //pass these as empty..bcoz they are not used on dashboard-admin
         }
      },
      'columns': [
         { data: 'activity' },
         { data: 'magnitude' },
         { data: 'residualriskscore' },
         { data: 'trends_id' },
         { data: 'objective_category_id' },
         { data: 'year_id' },
         { data: 'quarter_id' },
      ], //DISABLE SORTING ON SPECIFIC COLUMNS
      // 'columnDefs': [
      //    //{ orderable: false, targets: [1,2,3] }, // 1,2,3 indicates the second, third, fourth column you define in <thead>
      //    { orderable: false, targets: [0,1,2,3,4,5,6] },
      // ]
      "ordering": true,
      columnDefs: [{
        orderable: false,
        targets: "no-sort"
      }]
    });


    $('#objective_category_id').change(function(){ //for dropdowns  
         var objective_category_id =$('#objective_category_id').val();
         if(objective_category_id !== ''){ 
            $('input:hidden[name=objective_category_idHIDDEN]').val(objective_category_id); console.log(objective_category_id); 
         }else{
            $('input:hidden[name=objective_category_idHIDDEN]').val('');
         }
         resultDataTable.draw();
    });
	
	// var lineData = {
	//     labels: ["January", "February", "March", "April", "May", "June", "July"],
	//     datasets: [
	//         {
	//             label: "Example dataset",
	//             fillColor: "rgba(220,220,220,0.5)",
	//             strokeColor: "rgba(220,220,220,1)",
	//             pointColor: "rgba(220,220,220,1)",
	//             pointStrokeColor: "#fff",
	//             pointHighlightFill: "#fff",
	//             pointHighlightStroke: "rgba(220,220,220,1)",
	//             data: [65, 59, 80, 81, 56, 55, 40]
	//         },
	//         {
	//             label: "Example dataset",
	//             fillColor: "rgba(26,179,148,0.5)",
	//             strokeColor: "rgba(26,179,148,0.7)",
	//             pointColor: "rgba(26,179,148,1)",
	//             pointStrokeColor: "#fff",
	//             pointHighlightFill: "#fff",
	//             pointHighlightStroke: "rgba(26,179,148,1)",
	//             data: [28, 48, 40, 19, 86, 27, 90]
	//         }
	//     ]
	// };

	// var lineOptions = {
	//     scaleShowGridLines: true,
	//     scaleGridLineColor: "rgba(0,0,0,.05)",
	//     scaleGridLineWidth: 1,
	//     bezierCurve: true,
	//     bezierCurveTension: 0.4,
	//     pointDot: true,
	//     pointDotRadius: 4,
	//     pointDotStrokeWidth: 1,
	//     pointHitDetectionRadius: 20,
	//     datasetStroke: true,
	//     datasetStrokeWidth: 2,
	//     datasetFill: true,
	//     responsive: true,
	// };


	// var ctx = document.getElementById("lineChart").getContext("2d");
	// var myNewChart = new Chart(ctx).Line(lineData, lineOptions);


	// var projectrisksdata = [
 //        {	//Red
 //            value: <?php echo $projectRiskCountRed; ?>,
 //            color: "#FF0000",
 //            highlight: "#1ab394",
 //            label: "Red"
 //        },
 //        {  //Amber
 //            value: <?php echo $projectRiskCountAmber; ?>,
 //            color: "#ffbf00",
 //            highlight: "#1ab394",
 //            label: "Amber"
 //        },
 //        {   //Green
 //            value: <?php echo $projectRiskCountGreen; ?>,
 //            color: "#008000",
 //            highlight: "#1ab394",
 //            label: "Green"
 //        }
 //    ];

	// var strategicrisksdata = [
 //        {	//Red
 //            value: <?php echo $strategicRiskCountRed; ?>,
 //            color: "#FF0000",
 //            highlight: "#1ab394",
 //            label: "Red"
 //        },
 //        {  //Amber strategicRiskCountAmber
 //            value: <?php echo $strategicRiskCountAmber; ?>,
 //            color: "#ffbf00",
 //            highlight: "#1ab394",
 //            label: "Amber"
 //        },
 //        {   
 //            value: <?php echo $strategicRiskCountGreen; ?>,
 //            color: "#008000",
 //            highlight: "#1ab394",
 //            label: "Green"
 //        }
 //    ];

 //    var operationalrisksdata = [
 //       {	//Red
 //           value: <?php echo $operationalRiskCountRed; ?>,
 //           color: "#FF0000",
 //           highlight: "#1ab394",
 //           label: "Red"
 //       },
 //       {  //Amber
 //           value: <?php echo $operationalRiskCountAmber; ?>,
 //           color: "#ffbf00",
 //           highlight: "#1ab394",
 //           label: "Amber"
 //       },
 //       {   //Green
 //           value: <?php echo $operationalRiskCountGreen; ?>,
 //           color: "#008000",
 //           highlight: "#1ab394",
 //           label: "Green"
 //       }
 //    ];

 //    var doughnutOptions = {
 //        segmentShowStroke: true,
 //        segmentStrokeColor: "#fff",
 //        segmentStrokeWidth: 2,
 //        percentageInnerCutout: 45, // This is 0 for Pie charts
 //        animationSteps: 100,
 //        animationEasing: "easeOutBounce",
 //        animateRotate: true,
 //        animateScale: false
 //    };

 //    var ctx = document.getElementById("projectriskschart").getContext("2d");
 //    var DoughnutChart = new Chart(ctx).Doughnut(projectrisksdata, doughnutOptions);


 //    var ctx2 = document.getElementById("strategicriskschart").getContext("2d");
 //    var DoughnutChart2 = new Chart(ctx2).Doughnut(strategicrisksdata, doughnutOptions);

 //    var ctx3 = document.getElementById("operationalriskschart").getContext("2d");
 //    var DoughnutChart3 = new Chart(ctx3).Doughnut(operationalrisksdata, doughnutOptions);

	            
});
</script>