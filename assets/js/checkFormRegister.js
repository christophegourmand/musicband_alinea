console.log('checkFormRegister LOADED');

let registerLogin_node = document.getElementById('register_login');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forUser_regex = /^[A-Za-z0-9_.]+$/g;
let authorizedCharacters_forEmail_regex = /^[A-Za-z0-9_.]+$/g;
// for password, all is authorized !

// --- : check login
registerLogin_node.addEventListener(
	'focusout',
	function(focusout){
		console.info('focusout'); console.log(focusout);// DEBUG

		// NOTE : `keypressEvent.key` contain the character
		if (! registerLogin_node.value.match(authorizedCharacters_forUser_regex)) {
			// --- actions for non-authorized characters
			// for test:
				// console.info('caractere interdit!');
			
			// add class (for later, hwne everything will work) 
				registerLogin_node.classList.add('form_input_text_invalid');
			
			// add style red, to test (just for now, plz later use the line above)
				registerLogin_node.style.border = '3px solid red'; // temporaire
		} else {
			// --- actions for authorized characters
			registerLogin_node.style.border = '3px solid green'; // temporaire
			
			registerLogin_node.classList.remove('form_input_text_invalid');
			registerLogin_node.classList.add('form_input_text_valid');
		}
	
	}
);