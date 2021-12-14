<?php
namespace content_a\setting2\general;


class model
{
	public static function post()
	{
		if(\dash\request::post('set_title') === 'set_title')
		{
			$post =
			[
				'title'      => \dash\request::post('title'),
			];

			\lib\app\store\edit::selfedit($post);

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::complete();
				\lib\store::refresh();
			}
		}

		if(\dash\request::post('set_industry') === 'set_industry')
		{
			$post =
			[
				'industry'      => \dash\request::post('industry'),
			];

			\lib\app\store\edit::selfedit($post);

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::complete();
				\lib\store::refresh();
			}
		}
	}


}
?>