//     $(".date-picker").datepicker();
 
//     $(".date-picker").on("change", function () {
//     var id = $(this).attr("id");
//     var val = $("label[for='" + id + "']").text();
//     console.log(val);
//     console.log(id);
//     console.log(this.date);
//     $("#msg").text(val + " changed");
// });
 
// MomentJS if wanted to automate departureDate
    // var date = (date); 
    // var date = moment().format('YYYY-MM-DD');  // Today, in MomentJS - however to note, Amadeus doesn't allow promt searches with Inspiration. Must add +1 day to proceed. -- Mark
    // var date = (date);  
 
//     var options = {
//     minDate: new Date(2017, 0, 1, 12),
//     maxDate: new Date(2070, 11, 31),
//     dateFormat: "yy/mm/dd",
//     changeMonth: true,
//     changeYear: true,
//     gotoCurrent:false,
//     // dateFormat: "m/d/yy"
//     // dateFormat: "yyyy/mm/dd",
//     beforeShow: function (inputEl, datepickerInst) {
//         console.log("before show");
//         //datepickerInst.input[0].value =  datepickerInst.selectedMonth + "/" + datepickerInst.selectedDay + "/" + datepickerInst.selectedYear;
 
//         console.log("selected Year/Month/Day", datepickerInst.selectedYear,
//             "/", datepickerInst.selectedMonth,
//             "/", datepickerInst.selectedDay);
//         console.log("current Year/Month/Day", datepickerInst.currentYear,
//             "/", datepickerInst.currentMonth,
//             "/", datepickerInst.currentDay);
//         console.log("draw Year/Month/Day", datepickerInst.drawYear,
//             "/", datepickerInst.drawMonth,
//             "/", datepickerInst.drawDay);
 
//         console.log(datepickerInst);
//         //datepickerInst.input[0].hidden = true;
 
//     },
//     onClose: function(date, inst){
//         console.log(date);
//         var date = (departureDate.value);
//         console.log(date);
//         console.log(departureDate.value);
//         // var date = (date);
//         console.log(inst);




//         // var date = (date);
//         // inst.input[0].value=inst.selectedMonth + "/" + inst.selectedYear;
//     }
 
// };
 
// $(".datepicker").datepicker(options);
 
    
 
    
    // $("#departureDate").on("click" , function(event)) {
    // var date = (departureDate);
    //     console.log(date);
    // }
    // var date = (date);
    // callback (checkIn);checkOut //
    var apiKey = "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY";
    // var origin = (ui.item.value);
    // console.log(ui.item.value);
    // console.log(dates);
    console.log(apiKey);
 
$(function() {
   function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
}
$( ".autocomplete" ).autocomplete({
source: function( request, response ) {
$.ajax({
url: "https://api.sandbox.amadeus.com/v1.2/airports/autocomplete",
dataType: "json",
data: {
apikey: "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY",
term: request.term
},
success: function( data ) {
response( data );
console.log(data);
console.log(data[0]);
console.log(data[0].label);
console.log(data[1]);
console.log(log);

// console.log(where);
// console.log(where.value);
 
}
});
},
minLength: 3,
select: function( event, ui ) {
log( ui.item ?
"Selected: " + ui.item.label :
"Nothing selected, input was " + this.value);
 
console.log("This prints the ui.item.label: " + ui.item.label); // this is the Full Airport Name with Identifier and Title
// $("#where").value(ui.item.label);
console.log("This prints the ui.item: " + ui.item); // this is the Airport Object 
console.log("This prints the ui.item.value: " + ui.item.value); // this is the Airport Identifier
// console.log("This is the var cityName: " + cityName);
// console.log(date);
var origin = (ui.item.value);
console.log("This is the var origin: " + origin);

   // take value from input name
        var originInput = $(".whereOrigin").val().trim();  //To agree with the database, city input from the 'where' search box has the form 'New York City, United States' -- wenfang
        var arr = originInput.split(",");
        origin2 = arr[0];
        console.log("originInput var trim/split is: " + origin2);
        origin = origin2;

// var de = (ui.item.value);
// var destination = document.getElementById("destination").value;
// var destination = (ui.item.value);
// take value from input name
        var destinationInput = $(".where").val().trim();  //To agree with the database, city input from the 'where' search box has the form 'New York City, United States' -- wenfang
        var arr = destinationInput.split(",");
        destination2 = arr[0];
        console.log("destinationInput var trim/split is: " + destination2);
        destination = destination2;
console.log("This is the var destination: " + destination);

var departureDate = (departure_date);
console.log("This is the departureDate: " + departureDate);

var returnDate = (return_date);
console.log("This is the returnDate: " + returnDate);

// }
// }),
// console.log(origin[0]);
// console.log(origin[1]);
// var where = ("This is the var where: " + where);


 
 
$(".submit").on("click" , function(event) {
$.ajax({
      url: "https://api.sandbox.amadeus.com/v1.2/flights/low-fare-search?origin=" + origin + "&destination=" + cityName + "&departure_date=" + departureDate + "&apikey=" + apiKey,

      // https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=" + origin + "&departure_date=" + date + "&apikey=" + apiKey, // Working Inspiration Search 
 
      // Low Fare Search, in progress. TODO: Date, and Departure City -- Mark 
      // https://api.sandbox.amadeus.com/v1.2/flights/low-fare-search?origin=" + origin + "&destination=" + destination + "&departure_date=" + date + "&apikey=" + apiKey, // 
 
      // Inspiration search, // 
      // https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=" + origin + "&destination=" + cityName + "&departure_date=" + date + "&apikey=" + apiKey, //
 
      // working on a link which will pick up with Form results and insert at the right part of the API string ;)
      // url: "https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=" + FormAnswer + "&apikey=p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY",
 
      // // low fare query
// http://api.sandbox.amadeus.com/v1.2/flights/low-fare-search?origin=" + origin + "&destination=" + destination + "&departure_date=" + departureDate + "&return_by=" + returnDate + "&apikey=" + apiKey, //
 
      method: "GET"
 
      }).done(function(data) {
 
// creating an array with the data from the API
      Array['#results'] = data['results'];
      Array['#origin'] = data['origin'];
      // console.log(data.origin);
      $('#origin').append("<br>" + origin);
      $('#origin').append("<br>" + origin);
      $('#origin').append("<br>" + origin);
      $('#origin').append("<br>" + origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      console.log(origin);
      console.log(results);
      // console.log(results);
      // Array['#outbound'] = data['outbound'];
      // Array['#flights'] = data['flights'];
      Array['#currency'] = data['currency'];
      
 
      Array['#departure_date'] = data['departure_date'];
      Array['#return_date'] = data['return_date'];
      Array['#price'] = data['price'];
      Array['#airport'] = data['airport'];
      Array['#terminal'] = data['terminal'];
      Array['#destination'] = data['destination'];
      
    // array that needs to be sorted
 
      // $('#table').dataTable(data.Year);
      // // $('#Rating').dataTable(data.Ratings[0].Value);
      // $('#data').dataTable(data.Actors);
      // $('#table').dataTable(data.Title);
 
      $('#departure_date').append("<br>" + data.results[0].departure_date);
      $('#departure_date').append("<br>" + data.results[1].departure_date);
      $('#departure_date').append("<br>" + data.results[2].departure_date);
      $('#departure_date').append("<br>" + data.results[3].departure_date);
      $('#departure_date').append("<br>" + data.results[4].departure_date);
      $('#departure_date').append("<br>" + data.results[5].departure_date);
      $('#departure_date').append("<br>" + data.results[6].departure_date);
      $('#departure_date').append("<br>" + data.results[7].departure_date);
      $('#departure_date').append("<br>" + data.results[8].departure_date);
      $('#departure_date').append("<br>" + data.results[9].departure_date);
      $('#departure_date').append("<br>" + data.results[10].departure_date);
      $('#return_date').append("<br>" + data.results[0].return_date);
      $('#return_date').append("<br>" + data.results[1].return_date);
      $('#return_date').append("<br>" + data.results[2].return_date);
      $('#return_date').append("<br>" + data.results[3].return_date);
      $('#return_date').append("<br>" + data.results[4].return_date);
      $('#return_date').append("<br>" + data.results[5].return_date);
      $('#return_date').append("<br>" + data.results[6].return_date);
      $('#return_date').append("<br>" + data.results[7].return_date);
      $('#return_date').append("<br>" + data.results[8].return_date);
      $('#return_date').append("<br>" + data.results[9].return_date);
      $('#return_date').append("<br>" + data.results[10].return_date);
      $('#price').append("<br> $" + data.results[0].price);
      $('#price').append("<br> $" + data.results[1].price);
      $('#price').append("<br> $" + data.results[2].price);
      $('#price').append("<br> $" + data.results[3].price);
      $('#price').append("<br> $" + data.results[4].price);
      $('#price').append("<br> $" + data.results[5].price);
      $('#price').append("<br> $" + data.results[6].price);
      $('#price').append("<br> $" + data.results[7].price);
      $('#price').append("<br> $" + data.results[8].price);
      $('#price').append("<br> $" + data.results[9].price);
      $('#price').append("<br> $" + data.results[10].price);
      $('#destination').append("<br>" + data.results[0].destination);
 
    $('#destination').append("<br>" + data.results[1].destination);
    $('#destination').append("<br>" + data.results[2].destination);
    $('#destination').append("<br>" + data.results[3].destination);
    $('#destination').append("<br>" + data.results[4].destination);
    $('#destination').append("<br>" + data.results[5].destination);
    $('#destination').append("<br>" + data.results[6].destination);
    $('#destination').append("<br>" + data.results[7].destination);
    $('#destination').append("<br>" + data.results[8].destination);
    $('#destination').append("<br>" + data.results[9].destination);
    $('#destination').append("<br>" + data.results[10].destination);

      }); });
 
/* code to be executed after the ajax call */
function callback(data){
  data.origin = origin;
  console.log(data.origin);
  console.log(origin);
    // var data = (data);
    // data = data;
    // var Origin = (data.origin);
 
};
 
 
// console.log(this.city);
},
open: function() {
$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
},
close: function() {
$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
}
});
});