<?php
namespace content_a\setting\branding;


class model
{
	public static function post()
	{
		if(\dash\request::post('set') === 'set')
		{
			\lib\app\plan\branding::set(\dash\request::post('removebranding'));
		}
		else
		{
			$post =
			[
				'plan'  => \dash\request::post('key'),
			];

			\lib\app\plan\branding::remove($post);
		}

		\dash\redirect::pwd();

	}
}
?>