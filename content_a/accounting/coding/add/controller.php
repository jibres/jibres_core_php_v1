<?php
namespace content_a\accounting\coding\add;


class controller
{
	public static function routing()
	{

		\dash\permission::access('_group_setting');
		$type = \dash\request::get('type');
		if($type)
		{
			$type = \dash\validate::enum($type, false, ['enum' => ['group', 'total', 'assistant','details']]);
			if($type)
			{
				\dash\data::myType($type);
			}
		}
	}
}
?>
