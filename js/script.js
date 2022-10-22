// Localize scope of functions for performance
let print = console.log

// Format buttons
let buttons = document.querySelectorAll('button')
for (let i = buttons.length; i--;) buttons[i].innerHTML = buttons[i].id

// Format inputs
let inputs = document.querySelectorAll('input')
for (let i = inputs.length; i--;) inputs[i].placeholder = inputs[i].id

let handleSearch = query => location.replace('./results.htm#' + query)

let Search = document.querySelector('#Search')
Search.onkeydown = info => { if (info.keyCode == 13) handleSearch(Search.value) }


onhashchange = info => { print('Begin search query on: ' + Search.value) }

/*function toggleDisplay() {
    var signin = document.getElementById("err");
    signin.classList.toggle("hide");
};*/

/*var keys = document.getElementsByClassName("movie");

for(var i=0; i<keys.length; i++) {
    keys[i].addEventListener("click", keyClick);
}

function keyClick(e) {
  console.log("this.id = " + this.id);
  console.log("e.currentTarget.id = " + e.currentTarget.id);
  console.log("e.target.id = " + e.target.id);
}*/




