'use strict'

///Localize scope of functions for performance
let print = console.log
let JSONe = JSON.parse
let JSONd = JSON.stringify

let textEncoder = new TextEncoder()
let textDecoder = new TextDecoder()


let null256 = 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'//IDK




//sha256 stuff
{
	let toHex = bytes => bytes.reduce((string, byte) => string + byte.toString(16).padStart(2, '0'), '')
	var onSum = (promise, call) => promise.then(buffer => call(toHex(new Uint8Array(buffer))))
	var sha256sum = string => { return crypto.subtle.digest('SHA-256', textEncoder.encode(string)) }
}





onload = () => {







let session, footer
let saveSession
let loadSession
{
	saveSession = () => document.cookie = JSONd(session) + footer

	loadSession = () => {
		footer = ''
		let sessid = document.cookie.indexOf('PHPSESSID=')
		if (sessid) footer = '; ' + document.cookie.substr(sessid)
		try {
			session = JSONe(document.cookie.substr(0, sessid - 2))
		}
		catch {
			print('Sorry, something completely fucked up your session...')
			session = {}
			saveSession()//Reset the cookies
		}
	}

}

loadSession()
print(document.cookie)










//Format buttons
let buttons = document.querySelectorAll('button')
for (let i = buttons.length; i--;) buttons[i].innerHTML = buttons[i].id

//Format inputs
let input_id_type = {}
input_id_type.username = 'text'
input_id_type.email = 'text'
input_id_type.password = 'password'
input_id_type.register = 'submit'
input_id_type.login = 'submit'

let inputs = document.querySelectorAll('input')
for (let i = inputs.length; i--;) {
	let input = inputs[i]

	let display = input.id.charAt(0).toUpperCase() + input.id.slice(1)

	input.placeholder = display
	input.type = input_id_type[input.id]

	if (input.type == 'submit') input.value = display
}



{
	let handleSearch = query => location.replace('./results.php#' + query)
	let Search = document.querySelector('#Search')
	if (Search) Search.onkeydown = info => { if (info.keyCode == 13) handleSearch(Search.value) }
	onhashchange = info => { print('Begin search query on: ' + Search.value) }
}



{
	let username = document.querySelector('#username')
	let password = document.querySelector('#password')
	let email = document.querySelector('#email')

	let register = document.querySelector('#register')
	if (register) {
		register.onclick = () => {
			onSum(sha256sum(username.value + password.value), sumstring => {
				session.usersum = sumstring
				saveSession()
				//SEND SIGN UP REQUEST TO SERVER
			})
		}
	}

	let login = document.querySelector('#login')
	if (login) {
		login.onclick = () => {
			onSum(sha256sum(username.value + password.value), sumstring => {
				session.usersum = sumstring
				saveSession()
				//SEND LOGIN REQUEST TO SERVER
			})
		}
	}
}




}