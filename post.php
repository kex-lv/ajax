<?php
$sid = 'fe49a009ff235bd636004e068b6a8bba';
$url = 'http://localhost/php/index.php';
$content = 'sid='.substr($sid, -15).'&form_refresh=1';

$header = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8'."\r\n".
		'Accept-Encoding:gzip, deflate'."\r\n".
		'Accept-Language:en-US,en;q=0.8'."\r\n".
		'Cache-Control:max-age=0'."\r\n".
		'Connection:keep-alive'."\r\n".
		'Content-type: application/x-www-form-urlencoded'."\r\n".
		'Cookie:PHPSESSID=clbf32n5n1lgjoii0kspmtdf27; tab=1; my_sessionid='.$sid."\r\n".
		'Host:localhost'."\r\n".
		'Origin:http://localhost'."\r\n".
		'Referer:http://localhost/php/index.php'."\r\n".
		'Upgrade-Insecure-Requests:1'."\r\n".
		'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/53.0.2785.143 Chrome/53.0.2785.143 Safari/537.36'."\r\n";

$step_content = $content.'&next%5B0%5D=Next+step';
$options = ['http' => [
	'method'  => 'POST',
	'header'  => $header.'Content-Length:'.mb_strlen($step_content)."\r\n\r\n",
	'content' => $step_content
]];
do_request($url, $options);

// step 1
$step_content = $content.'&next%5B1%5D=Next+step';
$options = ['http' => [
	'method'  => 'POST',
	'header'  => $header.'Content-Length:'.mb_strlen($step_content)."\r\n\r\n",
	'content' => $step_content
]];
do_request($url, $options);

// step 2
$step_content = $content.'&type=MYSQL&server=localhost&port=0&database=gdbk&user=root&password=1234'.
	'&next%5B2%5D=Next+step';
$options = ['http' => [
	'method'  => 'POST',
	'header'  => $header.'Content-Length:'.mb_strlen($step_content)."\r\n\r\n",
	'content' => $step_content
]];
do_request($url, $options);


function do_request($url, $options) {
	$stream_context = stream_context_create($options);

	$fp = fopen($url, 'rb', false, $stream_context);
	if (!$fp)
		throw new Exception('Could not connect to "'.$url.'"');

	$response = stream_get_contents($fp);

	if($response === FALSE)
		throw new Exception('Could not read data from "'.$url.'"');

	print_r($response);
}

?>
