function update_location(){
  $.ajax({
    url:  'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&key=YOUR_API_KEY',
    method: "Get",
    processData : false,
    dataType : 'json',
    

success: function(response) {

     json = JSON.stringify(response);
     data = JSON.parse(json);
     var address = data.results[2].formatted_address;
     $('#location').text(address);
   
}
  });

}
update_location();
   
   var linechart = new Chart(document.querySelector('#lineChart'), {
        type: 'line',
        
        label : 'Energy Generated for the day',
        data: {
          labels: [],
          datasets: [{
            label: 'Energy Generated (Kw)',
            data: [],
            fill: false,
            borderColor: '#E8E8E8',
            tension: 0.0,  
            pointBackgroundColor: "#55bae7",
            pointBorderColor: "#55bae7",
            backgroundColor: "#e755ba",
            pointBackgroundColor: "#55bae7",
            pointBorderColor: "#55bae7",
            pointHoverBackgroundColor: "#55bae7",
            pointHoverBorderColor: "#55bae7",
            borderColor: "#E8E8E8",
   
          }]
        },
        
        options: {
          responsive : true,
          scales: {
            y: {
              beginAtZero: false,
              title: {
                display: true,
                text: 'Energy Generated'
              },
              
            
            } ,
            x: {
              
              title: {
                display: true,
                text: 'Time in Hours (hrs)'
              },
        
            
            } 
          },
          plugins: {
            legend: {
              position: 'top',
              display: false
            },
            title: {
              display: false,
              text: ''
            }
          }
        }
      });
     
          
         
    lineintervalReference = setInterval(updateChart,3000);
    boardintervalreference = setInterval(updateBoard,3000);
         
function updateBoard(){
  var route= "/updateBoard";
  $.ajax({
    url:route,
    type:'GET',
    
   
   
    success:
    function(result){
      $('#dev-id').text(result['DeviceId']);
      $('#cumm-ener').text(result['TotalEnergy'] );
      $('#total-ener').html(result['TotalEnergy']+'<sub>kWh</sub>');
      $('#last-seen').text(result['LastSeen']);
      $('#car-cre').text(result['CarbonCredit']);
      $('#total-car-cre').html(result['CarbonCredit'] + '<sub>(c)</sub>');
      $('#box-stat').text(result['BoxStatus']);
      $('#energy-incr').text(result['EnergyIncrease']+ '%');
      $('#energy-incr-stat').text(result['EnergyIncreaseStatus']);
      $('#carbon-incr').text(result['EnergyIncrease'] + '%');
      $('#carbon-incr-stat').text(result['EnergyIncreaseStatus']+'%');
      
      }
      
    })
  
}

function loadchart(chart,newData){

  newData['label'] = newData['label'].reverse();
  newData['data'] = newData['data'].reverse();
  chart.data.labels= (newData['label'])
  chart.data.datasets[0].data = newData['data'];
chart.update();

}

/*
Helper function for loading and updating chart every 5 seconds,

this function is called
*/
function updateChart()  {
  var route= "/LoadLineChart";
  $.ajax({
    url:route,
    type:'GET',
    auth: , 
  
    success:
    function(result){
      if(result !== null && result['label'] !== null){
      loadchart(linechart,result);
      }
 
      
    }
    
});
}


/***
 * 
 * 
 */
