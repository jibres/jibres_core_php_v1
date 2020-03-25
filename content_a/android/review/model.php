<?php
namespace content_a\android\review;

class model
{
	public static function post()
	{
		if(\dash\request::post('build') === 'now')
		{
			if(\dash\request::post('rebuild'))
			{
				\lib\app\application\queue::rebuild();
			}
			else
			{
				\lib\app\application\queue::add_new_queue();
			}

			\dash\redirect::pwd();
		}
	}
}
?>
