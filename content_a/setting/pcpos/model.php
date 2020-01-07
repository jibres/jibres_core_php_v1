<?php
namespace content_a\setting\pcpos;


class model
{
	public static function post()
	{
		if(\dash\request::post('type') === 'default')
		{
			$result = \lib\app\pos\tools::default(\dash\request::post('id'));

			if($result)
			{
				\dash\redirect::pwd();
			}
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			$result = \lib\app\pos\remove::remove(\dash\request::post('id'));

			if($result)
			{
				\dash\redirect::pwd();
			}
		}
		else
		{
			$post = \dash\request::post();

			$result = \lib\app\pos\add::new_pos($post);

			if($result)
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>