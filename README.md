deus-services
=============
ClientID = Key sensitive
Key      = Key sensitive

METHOD allowed = POST


==== API V2 USAGE ====
	
	/* Arguments: */
	/* Username @string */
	/* Password @string */	
	/* Method @string by default is set 'all' */
	/* Codes @string separated by comma */
	
	/* By Code method */
	require 'api_v2.php';
	$deus = new DeusApi();
	$username = 'username';
	$password = 'password';
	$method = 'bycode';
	$codes = '12345,12346,12347';

	$deus->retrieveData($username, $password, $method, $codes);
	//Retrun file name
	
	
		/* All method */
	require 'api_v2.php';
	$deus = new DeusApi();
	$username = 'username';
	$password = 'password';

	$deus->retrieveData($username, $password);
	//Retrun file name
