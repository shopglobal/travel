 var date = moment().add(1, 'days').format('YYYY-MM-DD'); 
 var return_date = moment().add(3, 'days').format('YYYY-MM-DD'); 
    var apiKey = "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY";
    // var origin = (ui.item.value);
    // console.log(ui.item.value);
    console.log(date);
    console.log(apiKey);

$.ajax({
      url: "https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=mia&departure_date=" + date + "&apikey=" + apiKey,
      // https://api.sandbox.amadeus.com/v1.2/flights/low-fare-search?origin=MIA&destination=mco&departure_date=" + date + "&return_date=" + return_date + "&apikey=" + apiKey,
      // https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=mia&departure_date=" + date + "&apikey=" + apiKey,
      // working on a link which will pick up with Form results and insert at the right part of the API string ;)
      // url: "https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=" + FormAnswer + "&apikey=p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY",
      method: "GET"

      }).done(function(data) {

// creating an array with the data from the API
      Array['#origin'] = data['origin'];
      Array['#outbound'] = data['outbound'];
      Array['#flights'] = data['flights'];
      Array['#currency'] = data['currency'];
      Array['#results'] = data['results'];

      Array['#departure_date'] = data['departure_date'];
      Array['#return_date'] = data['return_date'];
      Array['#price'] = data['price'];
      Array['#airport'] = data['airport'];
      Array['#terminal'] = data['terminal'];
      Array['#destination'] = data['destination'];
      
    // array that needs to be sorted
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
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
      $('#origin').append("<br>" + data.origin);
       });

/* code to be executed after the ajax call */
function callback(data){
  data.origin = origin;
  console.log(data.origin);
  console.log(origin);
    // var data = (data);
    // data = data;
    // var Origin = (data.origin);

};

//     var date = moment().add(1, 'days').format('YYYY-MM-DD'); 
//     var apiKey = "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY";
//     // var origin = (ui.item.value);
//     // console.log(ui.item.value);

// $(function() {
// function log( message ) {
// $( "<div>" ).text( message ).prependTo( "#log" );
// $( "#log" ).scrollTop( 0 );
// }
// $( "#city" ).autocomplete({
// source: function( request, response ) {
// $.ajax({
// url: "https://api.sandbox.amadeus.com/v1.2/airports/autocomplete",
// dataType: "json",
// data: {
// apikey: "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY",
// term: request.term
// },
// success: function( data ) {
// response( data );
// console.log(data);
// console.log(log);
// console.log(city);
// }
// });
// },
// minLength: 3,
// select: function( event, ui ) {
// log( ui.item ?
// "Selected: " + ui.item.label :
// "Nothing selected, input was " + this.value);
// console.log(ui.item.label); // this is the Full Airport Name with Identifier and Title
// console.log(ui.item); // this is the Airport Object 
// console.log(ui.item.value); // this is the Airport Identifier

// var origin = (ui.item.value);

// $.ajax({
//       url: "https://api.sandbox.amadeus.com/v1.2/flights/low-fare-search?origin=" + origin + "&destination=mco&departure_date=" + date + "&apikey=" + apiKey,
//  // working on a link which will pick up with Form results and insert at the right part of the API string ;)
//       // url: "https://api.sandbox.amadeus.com/v1.2/flights/inspiration-search?origin=" + FormAnswer + "&apikey=p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY",
//       method: "GET"

//       }).done(function(data) {

// // creating an array with the data from the API
//       Array['#origin'] = data['origin'];
//       // Array['#outbound'] = data['outbound'];
//       // Array['#flights'] = data['flights'];
//       Array['#currency'] = data['currency'];
//       Array['#results'] = data['results'];

//       Array['#departure_date'] = data['departure_date'];
//       Array['#return_date'] = data['return_date'];
//       Array['#price'] = data['price'];
//       Array['#airport'] = data['airport'];
//       Array['#terminal'] = data['terminal'];
//       Array['#destination'] = data['destination'];
      
//     // array that needs to be sorted

//       // $('#table').dataTable(data.Year);
//       // // $('#Rating').dataTable(data.Ratings[0].Value);
//       // $('#data').dataTable(data.Actors);
//       // $('#table').dataTable(data.Title);
//       $('#departure_date').append("<br>" + data.results[0].departure_date);
//       $('#departure_date').append("<br>" + data.results[1].departure_date);
//       $('#departure_date').append("<br>" + data.results[2].departure_date);
//       $('#departure_date').append("<br>" + data.results[3].departure_date);
//       $('#departure_date').append("<br>" + data.results[4].departure_date);
//       $('#departure_date').append("<br>" + data.results[5].departure_date);
//       $('#departure_date').append("<br>" + data.results[6].departure_date);
//       $('#departure_date').append("<br>" + data.results[7].departure_date);
//       $('#departure_date').append("<br>" + data.results[8].departure_date);
//       $('#departure_date').append("<br>" + data.results[9].departure_date);
//       $('#departure_date').append("<br>" + data.results[10].departure_date);
//       $('#return_date').append("<br>" + data.results[0].return_date);
//       $('#return_date').append("<br>" + data.results[1].return_date);
//       $('#return_date').append("<br>" + data.results[2].return_date);
//       $('#return_date').append("<br>" + data.results[3].return_date);
//       $('#return_date').append("<br>" + data.results[4].return_date);
//       $('#return_date').append("<br>" + data.results[5].return_date);
//       $('#return_date').append("<br>" + data.results[6].return_date);
//       $('#return_date').append("<br>" + data.results[7].return_date);
//       $('#return_date').append("<br>" + data.results[8].return_date);
//       $('#return_date').append("<br>" + data.results[9].return_date);
//       $('#return_date').append("<br>" + data.results[10].return_date);
//       $('#price').append("<br> $" + data.results[0].price);
//       $('#price').append("<br> $" + data.results[1].price);
//       $('#price').append("<br> $" + data.results[2].price);
//       $('#price').append("<br> $" + data.results[3].price);
//       $('#price').append("<br> $" + data.results[4].price);
//       $('#price').append("<br> $" + data.results[5].price);
//       $('#price').append("<br> $" + data.results[6].price);
//       $('#price').append("<br> $" + data.results[7].price);
//       $('#price').append("<br> $" + data.results[8].price);
//       $('#price').append("<br> $" + data.results[9].price);
//       $('#price').append("<br> $" + data.results[10].price);
//       $('#destination').append("<br>" + data.results[0].destination);

//     $('#destination').append("<br>" + data.results[1].destination);
//     $('#destination').append("<br>" + data.results[2].destination);
//     $('#destination').append("<br>" + data.results[3].destination);
//     $('#destination').append("<br>" + data.results[4].destination);
//     $('#destination').append("<br>" + data.results[5].destination);
//     $('#destination').append("<br>" + data.results[6].destination);
//     $('#destination').append("<br>" + data.results[7].destination);
//     $('#destination').append("<br>" + data.results[8].destination);
//     $('#destination').append("<br>" + data.results[9].destination);
//     $('#destination').append("<br>" + data.results[10].destination);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//       $('#origin').append("<br>" + data.origin);
//        });

// /* code to be executed after the ajax call */
// function callback(data){
//   data.origin = origin;
//   console.log(data.origin);
//   console.log(origin);
//     // var data = (data);
//     // data = data;
//     // var Origin = (data.origin);

// };


// // console.log(this.city);
// },
// open: function() {
// $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
// },
// close: function() {
// $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
// }
// });
// });