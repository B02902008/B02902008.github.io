<?php
	mb_internal_encoding('utf-8');
	session_start();

	require 'vendor/autoload.php';

	$directory = realpath(dirname(__FILE__));
	$document_root = realpath($_SERVER['DOCUMENT_ROOT']);
	$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .
		$_SERVER['HTTP_HOST'];
	if(strpos($directory, $document_root)===0) {
		$base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
	}

	define("BASE_URL", $base_url);
	define("DOCUMENT_ROOT", $document_root);
	if (strpos(BASE_URL, 'localhost') !== false)
		define("LIVE", false);
	else
		define("LIVE", true);
	$app = new \Slim\Slim();
	$app->get("/", function() {
		echo "Welcome\n";
	});
	$app->hook("slim.before.router",function() use ($app) {
			echo "Not Available API ...\n";
		}
	});
	$app->run();
?>
