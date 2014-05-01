<?php
 
if (isset($_SERVER['SCRIPT_FILENAME'])) {
	    return false;
} else {
	    $_SERVER['SCRIPT_FILENAME'] = $_SERVER['DOCUMENT_ROOT']
		            . DIRECTORY_SEPARATOR
			            . 'app.php'
				        ;
	     
	        require 'app.php';
}
