console.log('verifyCharactersRegex LOADED');

// =================================================================================
// SECTION : EVENT LISTENERS TO CHECK BAD CHARACTERS IN FORMS : TRAITMENT BY FONCTION
// =================================================================================

function checkCharactersOnFormInput(arg_eventTypeName_str, arg_fieldToCheck_node , arg_authorizedCharacters_regex , arg_cssClassIfValid_str , arg_cssClassIfInvalid_str)
{
	//--- create node displaying the wrong characters
	let errorsDisplayerId_str = "errorsDisplayer_" + arg_fieldToCheck_node;

	//document.getElementById(errorsDisplayerId_str).remove;
	//let errorsBadCharacters_node = document.createTextNode("Caractères interdits: " + badCharactersFound_str); // REVIEW : old version, DEPCRACATED

	let errorsBadCharacters_node = document.createElement('div');
	errorsBadCharacters_node.id = "errorsDisplayer_" + arg_fieldToCheck_node;
	errorsBadCharacters_node.classList.add("errorDisplayer");

	// let fieldToCheck_node = document.getElementById('given_login'); // NOTE : already given in argument

	// --- prepare `regex` for authorized character|symbols:
	// let authorizedCharacters_forUser_regex = /[^\w\_\-]/ig; // NOTE : already given in argument

	// --- : check login
	if (arg_fieldToCheck_node !== null)
	{
		arg_fieldToCheck_node.addEventListener(
			arg_eventTypeName_str,
			function(inputEvent){
				if (ENV === 'dev')
				{
					console.info(arg_eventTypeName_str); console.log(inputEvent);// DEBUG
				}

				// NOTE : `keypressEvent.key` contain the character
				if (arg_fieldToCheck_node.value != '')
				{
					var badCharactersFound_arrOrNull = arg_fieldToCheck_node.value.match(arg_authorizedCharacters_regex);
					var badCharactersFound_str = badCharactersFound_arrOrNull.join('');
					if (badCharactersFound_arrOrNull !== null) {
						// --- actions for non-authorized characters
						// for test:
						if (ENV === 'dev')
						{
							console.info('caractères interdit!'); // DEBUG
							console.log(badCharactersFound_arrOrNull); // DEBUG
						}

						// add class (for later, hwne everything will work) 
						arg_fieldToCheck_node.classList.remove(arg_cssClassIfValid_str);
						arg_fieldToCheck_node.classList.add(arg_cssClassIfInvalid_str);

						//--- fill the error message
						errorsBadCharacters_node.innerHTML = `<p class='errorsDisplayer-message'>Caractères interdits: ${badCharactersFound_str}</p>`;

						//--- push that node after the field having bad characters:
						// arg_fieldToCheck_node.parentNode.appendChild(errorsBadCharacters_node);
						//--- simpler version:
						arg_fieldToCheck_node.after(errorsBadCharacters_node);
						
					} else {
						// --- actions for authorized characters
						// arg_fieldToCheck_node.style.border = '3px solid green'; // TEST

						arg_fieldToCheck_node.classList.remove(arg_cssClassIfInvalid_str);
						arg_fieldToCheck_node.classList.add(arg_cssClassIfValid_str);
					}
				} else //--- if field is empty , we remove both css-classes
				{
					arg_fieldToCheck_node.classList.remove(arg_cssClassIfValid_str);
					arg_fieldToCheck_node.classList.remove(arg_cssClassIfInvalid_str);
				}
			}
		)
	}
}

//--- prepare css class:
let cssClassIfValid_str = 'form_input_text_valid';
let cssClassIfInvalid_str = 'form_input_text_invalid';

// SECTION : CHECK IF BAD CHARACTERS IN FIELD `given_login` ===
//--- get node :
let loginFieldToCheck_node = document.getElementById('given_login');
//--- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forLogin_regex = /[^\w\_\-]/ig;
//--- use function to detect bad characters and display it if found
checkCharactersOnFormInput('input' , loginFieldToCheck_node , authorizedCharacters_forLogin_regex , cssClassIfValid_str , cssClassIfInvalid_str);

// SECTION : CHECK IF BAD CHARACTERS IN FIELD `given_email` ===
//--- get node :
let emailFieldToCheck_node = document.getElementById('given_email');
//--- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forEmail_regex = /[^\w\_\-\.\@]/ig;
//--- use function to detect bad characters and display it if found
checkCharactersOnFormInput('input' , emailFieldToCheck_node , authorizedCharacters_forEmail_regex , cssClassIfValid_str , cssClassIfInvalid_str);

// SECTION : CHECK IF BAD CHARACTERS IN FIELD `given_password` ===
//--- get node :
let passwordFieldToCheck_node = document.getElementById('given_password');
//--- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forPassword_regex = /[^\w\_\-]/ig;
//--- use function to detect bad characters and display it if found
checkCharactersOnFormInput('input' , passwordFieldToCheck_node , authorizedCharacters_forPassword_regex , cssClassIfValid_str , cssClassIfInvalid_str);


// =================================================================================
// SECTION : EVENT LISTENERS TO CHECK BAD CHARACTERS IN FORMS : TRAITMENT ONE BY ONE
// =================================================================================

/*
// === SECTION : check login as user type it ===

let givenLogin_node = document.getElementById('given_login');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forUser_regex = /[^\w\_\-]/ig;


// --- : check login
if (givenLogin_node !== null)
{
	givenLogin_node.addEventListener(
		'input',
		function(inputEvent){
			if (ENV === 'dev')
			{
				console.info('input'); console.log(inputEvent);// DEBUG
			}

			// NOTE : `keypressEvent.key` contain the character
			if (givenLogin_node.value != '')
			{
				let badCharactersFound_arrOrNull = givenLogin_node.value.match(authorizedCharacters_forUser_regex);
				if (badCharactersFound_arrOrNull !== null) {
					// --- actions for non-authorized characters
					// for test:
					if (ENV === 'dev')
					{
						console.info('caractères interdit!'); // DEBUG
						console.log(badCharactersFound_arrOrNull); // DEBUG
					}

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
}
*/

// === SECTION : check email as user type it ===
/* 
let givenEmail_node = document.getElementById('given_email');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forEmail_regex = /[^\w\_\-\.\@]/ig;

// --- : check email
if (givenEmail_node !== null)
{
	givenEmail_node.addEventListener(
		'input',
		function(inputEvent){
			console.info('input'); console.log(inputEvent);// DEBUG

			// NOTE : `keypressEvent.key` contain the character
			if (givenEmail_node.value != '')
			{
				if (givenEmail_node.value.match(authorizedCharacters_forEmail_regex)) {
					// --- actions for non-authorized characters
					// for test:
						console.info('caractères interdit!');
					
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
}
 */


// === SECTION : check password as user type it ===
/* 
let givenPassword_node = document.getElementById('given_password');

// --- prepare `regex` for authorized character|symbols:
let authorizedCharacters_forPassword_regex = /[^\w\_\-\@\!\.\?\&\*\$\,\;\:\+\=]/ig;

// --- : check password
if (givenPassword_node !== null)
{
	givenPassword_node.addEventListener(
		'input',
		function(inputEvent){
			console.info('input'); console.log(inputEvent);// DEBUG

			// NOTE : `keypressEvent.key` contain the character
			if (givenPassword_node.value != '')
			{
				if (givenPassword_node.value.match(authorizedCharacters_forPassword_regex)) 
				{
					// --- actions for non-authorized characters
					// for test:
						console.info('caractères interdit!');
					
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
}
 */