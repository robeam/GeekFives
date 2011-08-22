<?php # Script 14.1 - mysql_connect.php
$env = 'laptop';
// This file contains the database access information for the database. 
// This file also establishes a connection to MySQL and selects the database.

// Set the database access information as constants.
if($env === 'nixon'){
	define ('DB_USER', 'root');
	define ('DB_PASSWORD', 'root');
	define ('DB_HOST', 'localhost');
	define ('DB_NAME', 'geekfives');
} else if($env === 'laptop'){
	define ('DB_USER', 'root');
	define ('DB_PASSWORD', 'root');
	define ('DB_HOST', 'localhost');
	define ('DB_NAME', 'fives');
} else {
	define ('DB_USER', 'db131208');
	define ('DB_PASSWORD', 'rob3am74');
	define ('DB_HOST', 'internal-db.s131208.gridserver.com');
	define ('DB_NAME', 'db131208_fives');
}
// Make the connnection and then select the database.

$dbc = mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
mysql_select_db (DB_NAME) OR die ('Could not select the database: ' . mysql_error() );


// Create a function for escaping the data.
function escape_data ($data) {
	
	// Address Magic Quotes.
	if (ini_get('magic_quotes_gpc')) {
		$data = stripslashes($data);
	}
	
	// Check for mysql_real_escape_string() support.
	if (function_exists('mysql_real_escape_string')) {
		global $dbc; // Need the connection.
		$data = mysql_real_escape_string (trim($data), $dbc);
	} else {
		$data = mysql_escape_string (trim($data));
	} 

	// Return the escaped value.	
	return $data;

} // End of function.
?>