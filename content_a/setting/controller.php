<?php
namespace content_a\setting;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$new_url = \lib\url::here(). '/setting/general';

		$this->redirector($new_url)->redirect();

	}
}
?>