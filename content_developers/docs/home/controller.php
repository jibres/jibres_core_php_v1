<?php
namespace content_developers\docs\home;


class controller
{
	public static function routing()
	{
		if(\dash\url::child() === 'api-doc')
		{
			\dash\redirect::to_external('https://documenter.getpostman.com/view/1511811/TVt2e4vB');
		}

		if(\dash\url::child() === 'domain-api')
		{
			\dash\redirect::to_external('https://documenter.getpostman.com/view/1511811/TWDRsKf3');
		}

	}
}
?>