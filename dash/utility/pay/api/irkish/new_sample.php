<?php
$terminalID = '';
$password = '';
$acceptorId = "";
$pub_key = '';

$amount = 1000;


function generateAuthenticationEnvelope($pub_key, $terminalID, $password, $amount)
{
	$data = $terminalID . $password . str_pad($amount, 12, '0', STR_PAD_LEFT) . '00';
	$data = hex2bin($data);
	$AESSecretKey = openssl_random_pseudo_bytes(16);
	$ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
	$iv = openssl_random_pseudo_bytes($ivlen);
	$ciphertext_raw = openssl_encrypt($data, $cipher, $AESSecretKey, $options = OPENSSL_RAW_DATA, $iv);
	$hmac = hash('sha256', $ciphertext_raw, true);
	$crypttext = '';

	openssl_public_encrypt($AESSecretKey . $hmac, $crypttext, $pub_key);

	return array(
		"data" => bin2hex($crypttext),
		"iv" => bin2hex($iv),
	);
}


if (isset($_POST['token']) && $_POST['token'] != "") {
	if ($_POST['responseCode'] != "00") {
		echo "failed: code " . $_POST['responseCode'];
		exit;
	}
	$data = array(
		"terminalId" => $terminalID,
		"retrievalReferenceNumber" => $_POST['retrievalReferenceNumber'],
		"systemTraceAuditNumber" => $_POST['systemTraceAuditNumber'],
		"tokenIdentity" => $_POST['token'],
	);

	$data_string = json_encode($data);


	$ch = curl_init('https://ikc.shaparak.ir/api/v3/confirmation/purchase');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string)
	));



	$result = curl_exec($ch);
	if ($result === false) {
		echo curl_error($ch);
		exit;
	}
	curl_close($ch);

	$response = json_decode($result, JSON_OBJECT_AS_ARRAY);
	print_r($response);
	exit;
}



$token = generateAuthenticationEnvelope($pub_key, $terminalID, $password, $amount);

$data = [];
$data["request"] = [
	"acceptorId" => $acceptorId,
	"amount" => $amount,
	"billInfo" => null,
	"paymentId" => null,
	"requestId" => uniqid(),
	"requestTimestamp" => time(),
	"revertUri" => "http://wwww.irankish.com/...",
	"terminalId" => $terminalID,
	"transactionType" => "Purchase"
];
$data['authenticationEnvelope'] = $token;
$data_string = json_encode($data);
$ch = curl_init('https://ikc.shaparak.ir/api/v3/tokenization/make');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string)
));



$result = curl_exec($ch);

curl_close($ch);

$response = json_decode($result, JSON_OBJECT_AS_ARRAY);
if ($response["responseCode"] != "00") {
	echo $response["description"];
	exit;
}

?>

<form method="post" action="https://ikc.shaparak.ir/iuiv3/IPG/Index/" enctype="‫‪multipart/form-data‬‬">
	<input type="hidden" name="tokenIdentity" value="<?php echo  $response['result']['token'] ?>">
	<input type="submit" value="DoPayment">
</form>