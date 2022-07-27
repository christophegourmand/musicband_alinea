<?php
	// --- paste this in your file to use this function :
	# require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');

	/**
	* Visualize a variable in console.log or in html page.
	* Import using `require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');`
	* 
	* @param	string 		$title	title of what you visualize
	* @param	mixed 		$val	what you want to visualize
	* @param	string 		$method	where to visualize and how: 'console_type','console_json', 'console_class', 'console_proprietes', 'console_methods', 'html_dump', 'html_printr', 'html_propriete'
	* @return	void
	*/
	function dbug(string $title , $val, string $method = 'console_json') {
		$methodsForConsole = ['console_type','console_json', 'console_class', 'console_proprietes', 'console_methods'];
		$methodsForHtml = ['html_dump','html_printr','html_propriete'];

		$fileOrigin = basename(__FILE__);
		$line = __LINE__;

		if ( in_array($method ,$methodsForConsole) ) 
		{
			switch ($method) {
				case 'console_type':
					$wantToSee = gettype($val);
					break;
				case 'console_json':
					$wantToSee = json_encode($val);
					break;
				case 'console_class':
					$wantToSee = json_encode(get_class($val));
					break;
				case 'console_proprietes':
					$nomClass = get_class($val);
					$wantToSee = json_encode( get_class_vars($nomClass) );
					break;
				case 'console_methods':
					$nomClass = get_class($val);
					$wantToSee = json_encode( get_class_methods($nomClass) );
					break;
				default:
					$wantToSee = 'valeurs utilisables en 3e param: ';
					$wantToSee .= json_encode($methodsForConsole);
					break;
			}
			// dans tous les cas :
			$out = <<<SCRIPT
			<script>
				console.info('${fileOrigin}::${line} - ${title}');
				console.debug(${wantToSee});
			</script>
			SCRIPT;

			print $out;
		}

		if ( in_array($method ,$methodsForHtml) ) 
		{
			echo '<h3 style="color:red;">'.$title.'</h3>';
			switch ($method) {
				case 'html_dump':
					echo '<pre>'.var_dump($val).'</pre>';
					break;
				case 'html_printr':
					echo '<pre>'.print_r($val).'</pre>';
					break;
				case 'html_propriete':
					$nomClass = get_class($val);
					$wantToSee = get_class_vars($nomClass);
					echo '<pre>'.var_dump($wantToSee).'</pre>';	
					break;
			}
		}
	}

?>
