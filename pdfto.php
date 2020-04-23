<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json2=$_GET['v'];

echo '<iframe src="'.base64_decode($json2).'"stream-url="chrome-extension://mhjfbmdgcfjbbpaeojofohoefgiehjai/9998104a-f5f8-43cf-b25c-0a193ae75822" headers="Content-Length: 11570 Content-Type: application/pdf" background-color="0xFF525659" top-toolbar-height="36" javascript="allow" full-frame="" width=100% height=100%></iframe>';

?>