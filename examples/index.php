<?php
require_once 'Vendor/autoload.php';

use Vbt\Autoload,
	Vbt\Error;

try {
	new Autoload('Vbt', dirname(__DIR__) . '/src');

	$error = new Error();

	trigger_error('Error', E_USER_ERROR);

} catch (Exception $e) {
	echo $e->getMessage();
}
?>