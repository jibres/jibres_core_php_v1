<?php
namespace content_a\setting;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$new_url = \dash\url::here(). '/setting/general';

		\dash\redirect::to($new_url);

	}
}
?>