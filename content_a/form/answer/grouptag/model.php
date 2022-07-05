<?php
namespace content_a\form\answer\export;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\form\answer\export::remove(\dash\request::post('id'));
		}
		else
		{
			$post =
			[
				'startdate' => \dash\request::post('startdate'),
				'enddate'   => \dash\request::post('enddate'),
				'starttime' => \dash\request::post('starttime'),
				'endtime'   => \dash\request::post('endtime'),
				'tag_id'    => \dash\request::post('tag'),
			];

			\lib\app\form\answer\export::queue(\dash\request::get('id'), $post);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
