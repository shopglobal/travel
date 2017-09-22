        // var date = moment().add(1, 'days').format('YYYY-MM-DD'); 
    var apiKey = "p8YSKZZKV403qdiG3zvO2jbw3pnEdPZY";
    // var origin = (ui.item.value);
    // console.log(ui.item.value);

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
// console.log(log);
// console.log(city);
}
});
},
minLength: 3,
select: function( event, ui ) {
log( ui.item ?
"Selected: " + ui.item.label :
"Nothing selected, input was " + this.value);
console.log(ui.item.label); // this is the Full Airport Name with Identifier and Title
console.log(ui.item); // this is the Airport Object 
console.log(ui.item.value); // this is the Airport Identifier
console.log(arr[0]);
console.log(arr[1]);

// var arr = jQuery.makeArray( ui.item.value );
// var origin = (ui.item.value);
// var origin = $('#origin').val().trim();
var originInput = $("#origin").val().trim();  //To agree with the database, city input from the 'where' search box has the form 'New York City, United States' -- wenfang
        var arr = originInput.split(",");
        origin2 = arr[0];
        console.log("originInput var trim/split is: " + origin2);
        origin = origin2;
console.log("This is dans origin " + origin);

// var destination = $('#destination').val().trim();
// console.log("This is dans destination " + destination);
var destinationInput = $("#destination").val().trim();  //To agree with the database, city input from the 'where' search box has the form 'New York City, United States' -- wenfang
        var arr = destinationInput.split(",");
        destination2 = arr[0];
        console.log("destinationInput var trim/split is: " + destination2);
        destination = destination2;
console.log("This is the var destination: " + destination);

                });
        });
});
