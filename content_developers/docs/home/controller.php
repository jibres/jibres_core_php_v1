<?php
namespace content_developers\docs\home;


class controller
{
	public static function routing()
	{
		if(\dash\url::child() === 'api-doc')
		{
			\dash\redirect::to_external('https://documenter.getpostman.com/view/11715391/UVREj4JF');
		}

		if(\dash\url::child() === 'domain-api')
		{
			\dash\redirect::to_external('https://documenter.getpostman.com/view/11715391/UVREj4JE');
		}

	}
}
?>