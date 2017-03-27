<?php
namespace Vbt;

class Error
{
	/**
	 * Call PHP error_reporting() function
	 * and this class setErrorHandler method
	 *
	 * @uses error_reporting()
	 */
	public function __construct()
	{
		error_reporting(E_ALL);
		$this->setErrorHandler(array($this, 'errorHandler'));
	}
	/**
	  * Set the error handler
	  *
	  * @param array $handler This class and error handler method
	  * @uses set_error_handler()
	  */
	private function setErrorHandler($handler)
	{
		ob_start(array($this, 'fatalError'));
		set_error_handler($handler);
	}
	/**
	  * Callback function. Receives the buffer content and search
	  * for a fatal error..
	  *
	  * @param string $buffer Buffer content
	  * @return mixed Buffer content or this class errorHandler method
	  */
	private function fatalError($buffer)
	{
		$temporal_buffer = $buffer;

		// Se eliminan las etiquetas HTML y PHP del string que esté en el buffer.
		$text = strip_tags($temporal_buffer);

		// e busca error fatal en el buffer por medio de expreciones regulares
		if(preg_match('/Fatal error: (.+) in (.+)? on line (\d+)/', $text, $match))
			return $this->errorHandler($errno = E_ERROR, $errstr = $match[1], $errfile = $match[2], $errline = $match[3], $context = '', true);

		return $buffer; 
	}
	/**
	  * Error handler function. Call Error class and passes it the recived
	  * params. Then return the error message.
	  *
	  * @param $params array Error params
	  * @param boolean $return True If hte message is on the buffer
	  */
	public function errorHandler($errno, $errstr, $errfile, $errline, $context, $return = false)
	{
		$params = array(
			'errno' => $errno,
			'errstr' => $errstr,
			'errfile' => $errfile,
			'errline' => $errline,
			'context' => $context
			);

		$context = new Context($params);

		if ($return) return $context->getMessage();

		echo $context->getMessage();
	}
}
?>