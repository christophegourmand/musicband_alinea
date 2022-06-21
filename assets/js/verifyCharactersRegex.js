console.log('verifyCharactersRegex LOADED');

// === SECTION : check login as user type it ===

let givenLogin_node = document.getElementById('given_login');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forUser_regex = /[^\w\_\-]/ig;

// --- : check login
givenLogin_node.addEventListener(
	'input',
	function(input){
		console.info('input'); console.log(input);// DEBUG

		// NOTE : `keypressEvent.key` contain the character
		if (givenLogin_node.value != '')
		{
			if (givenLogin_node.value.match(authorizedCharacters_forUser_regex)) {
				// --- actions for non-authorized characters
				// for test:
					console.info('caractere interdit!');
				
				// add class (for later, hwne everything will work) 
				givenLogin_node.classList.remove('form_input_text_valid');
				givenLogin_node.classList.add('form_input_text_invalid');
				
				// add style red, to test (just for now, plz later use the line above)
					// givenLogin_node.style.border = '3px solid red'; // TEST
					// givenLogin_node.style.backgroundColor = 'hsla(0, 100%, 50%, .5)'; // TEST
			} else {
				// --- actions for authorized characters
				// givenLogin_node.style.border = '3px solid green'; // TEST
				
				givenLogin_node.classList.remove('form_input_text_invalid');
				givenLogin_node.classList.add('form_input_text_valid');
			}
		} else //--- if field is empty
		{
			givenLogin_node.classList.remove('form_input_text_valid');
			givenLogin_node.classList.remove('form_input_text_invalid');
		}
	}
);


// === SECTION : check email as user type it ===

let givenEmail_node = document.getElementById('given_email');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forEmail_regex = /[^\w\_\-\.\@]/ig;


// --- : check email
givenEmail_node.addEventListener(
	'input',
	function(input){
		console.info('input'); console.log(input);// DEBUG

		// NOTE : `keypressEvent.key` contain the character
		if (givenEmail_node.value != '')
		{
			if (givenEmail_node.value.match(authorizedCharacters_forEmail_regex)) {
				// --- actions for non-authorized characters
				// for test:
					console.info('caractere interdit!');
				
				// add class (for later, hwne everything will work) 
				givenEmail_node.classList.remove('form_input_text_valid');
				givenEmail_node.classList.add('form_input_text_invalid');
				
				// add style red, to test (just for now, plz later use the line above)
					// givenEmail_node.style.border = '3px solid red'; // TEST
					// givenEmail_node.style.backgroundColor = 'hsla(0, 100%, 50%, .5)'; // TEST
			} else {
				// --- actions for authorized characters
				// givenEmail_node.style.border = '3px solid green'; // TEST
				
				givenEmail_node.classList.remove('form_input_text_invalid');
				givenEmail_node.classList.add('form_input_text_valid');
			}
		} else //--- if field is empty
		{
			givenEmail_node.classList.remove('form_input_text_valid');
			givenEmail_node.classList.remove('form_input_text_invalid');
		}
	
	}
);



// === SECTION : check password as user type it ===

let givenPassword_node = document.getElementById('given_password');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forPassword_regex = /[^\w\_\-\@\!\.\?\&\*\$\,\;\:\+\=]/ig;

// --- : check password
givenPassword_node.addEventListener(
	'input',
	function(input){
		console.info('input'); console.log(input);// DEBUG

		// NOTE : `keypressEvent.key` contain the character
		if (givenPassword_node.value != '')
		{
			if (givenPassword_node.value.match(authorizedCharacters_forPassword_regex)) 
			{
				// --- actions for non-authorized characters
				// for test:
					console.info('caractere interdit!');
				
				// add class (for later, hwne everything will work) 
				givenPassword_node.classList.remove('form_input_text_valid');
				givenPassword_node.classList.add('form_input_text_invalid');
				
				// add style red, to test (just for now, plz later use the line above)
					// givenPassword_node.style.border = '3px solid red'; // TEST
					// givenPassword_node.style.backgroundColor = 'hsla(0, 100%, 50%, .5)'; // TEST
			}
			else 
			{
				// --- actions for authorized characters
				// givenPassword_node.style.border = '3px solid green'; // TEST
				
				givenPassword_node.classList.remove('form_input_text_invalid');
				givenPassword_node.classList.add('form_input_text_valid');
			}
		} else //--- if field is empty
		{
			givenPassword_node.classList.remove('form_input_text_valid');
			givenPassword_node.classList.remove('form_input_text_invalid');
		}
	
	}
);
