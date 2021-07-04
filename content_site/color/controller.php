<?php
namespace content_site\color;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('json'))
		{
			$list = color::list();

			$new_list = [];

			foreach ($list as $key => $value)
			{
				$new_list[] =
				[
					'html' => "<div class='h-10 w-full rounded ring-1 bg-$value[color]'>$value[color]</div>",
					'id'   => $value['color'],
				];
			}

			$result = ['results' => $new_list];
			\dash\code::jsonBoom($result);
		}
	}
}
?>