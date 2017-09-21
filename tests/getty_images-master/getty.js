/*jshint esversion: 6*/

//const key = require('./key');

//
let button = document.querySelector('#searchButton');
let searchBar = document.querySelector('#searchText');
let display = document.querySelector('#content');
button.addEventListener('click', function(){
  console.log(searchBar.value);
  getImage(searchBar.value);
}
);


function getImage(keyword){
  oReq = new XMLHttpRequest();
  oReq.addEventListener('load', displayImage);
  oReq.open('GET', `https://api.gettyimages.com/v3/search/images?phrase=${keyword}`);
  oReq.setRequestHeader('Api-Key', 'sngkdsdagt8mg6ec5czdsvye');
  //oReq.setRequestHeader('keyword_ids', 'dog');

  oReq.send();
}

function displayImage(){
  const requestData = JSON.parse(this.responseText);
  console.log(requestData);
  const image = document.createElement('img');
   const uri = image.innerHTML = requestData.images[0].display_sizes[0].uri;
   console.log(uri);
   image.setAttribute('src', uri);
   image.setAttribute('width', '300');
   image.setAttribute('height', '300');
content.appendChild(image);
}

//getImage('cat');