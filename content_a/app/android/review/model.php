<?php
namespace content_a\app\android\review;

class model
{
	public static function post()
	{
		if(\dash\request::post('build') === 'now')
		{
			\lib\app\application\queue::add_new_queue();
			\dash\redirect::pwd();
		}
		// \lib\app\application\queue::rebuild();
	}
}
?>
