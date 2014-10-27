<?php //This is what i got from client !

$ApiUrl		= 'http://api.url';

$ch			= curl_init($ApiUrl);
$nb			= rand(1,6000); // in caz ca folosim bycode = NB trebuie inlocuit cu codul
$client		= 'ClientId';
$method		= 'bycode';  // sau metoda "all-price"
$code		= 'L100962008_5'; //bycode = trebuie declarat codul produsului sau mai multe coduri prin , = "L12345,L12346"

$str_bycode		= strlen($client).$client.strlen($method).$method.strlen($code).$code;
$str_allprice	= strlen($client).$client.strlen($method).$method.strlen($nb).$nb;
$Key			= '*SecretKey*';
$hash_bycode	= hash_hmac('md5', $str_bycode,$Key);
$hash_allprice	= hash_hmac('md5', $str_allprice,$Key);

$fields = array(
    'client-id' => $client,
    'method' => $method, // trebuie schimbat la metoda "all-price" daca se doreste all-price
	'code' => $code, //se schimba cu 'nb' => $nb in caz ca se foloseste metoda "all-price"
    'key' => $hash_bycode // se schimba cu in caz ca se foloseste metoda "all-price"
);


$query= http_build_query($fields) . "\n";

echo "<h1>string folosit</h1>";
echo $str_bycode;
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
