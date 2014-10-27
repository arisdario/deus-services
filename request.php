<?php //This is what i got from client !

$ApiUrl	=	"http://api.url";

$ch		=	curl_init($ApiUrl);
$nb		=	rand(1,6000);
$client	=	"ClientID";
$method	=	"bycode";

$str	=	strlen($client).$client.strlen($method).$method.strlen($nb).$nb;
$Key	=	'*StrongKeyProvided*';
$hash	=	hash_hmac('md5', $str,$Key);

$fields = array(
    'client_id' => $client,
    'nb' => $nb,
    'method' => $method,
    'key' => $hash
);



$query	=	http_build_query($fields) . "\n";

echo "<h1>string folosit</h1>";
echo $str;
echo "<h1>Cheie folosita</h1>";
echo $Key;

echo "<h1>Request</h1>";
echo $query;

echo "<h1>Response</h1>";
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
$output = curl_exec($ch);
echo htmlentities($output);
curl_close($ch);

