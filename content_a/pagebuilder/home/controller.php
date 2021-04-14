<?php
namespace content_a\pagebuilder\home;


class controller
{
	public static function routing()
	{

		$child    = \dash\url::child();
		$subchild = \dash\url::subchild();

		if($child)
		{
			$id   = \dash\request::get('id');

			$args = [];

			$data = \lib\app\pagebuilder\line\get::load_element($child, $subchild, $id, $args);

			if($data)
			{
				\dash\data::lineSetting($data);
				\dash\open::get();
				\dash\open::post();
			}
		}
	}
}
?>
