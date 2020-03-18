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
			$post                 = [];
			$post['pos']          = \dash\request::post('pos');
			$post['title']        = \dash\request::post('title');
			$post['irankish']     = \dash\request::post('irankish');
			$post['serial']       = \dash\request::post('serial');
			$post['terminal']     = \dash\request::post('terminal');
			$post['receiver']     = \dash\request::post('receiver');
			$post['asanpardakht'] = \dash\request::post('asanpardakht');
			$post['ip']           = \dash\request::post('ip');
			$post['port']         = \dash\request::post('port');

			$result = \lib\app\pos\add::new_pos($post);

			if($result)
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>