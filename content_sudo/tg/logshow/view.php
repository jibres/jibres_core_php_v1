<?php
namespace content_sudo\tg\logshow;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::title(T_("Telegram log"));
		// add back level to summary link
		\dash\data::action_text(T_('Back to log list'));
		\dash\data::action_link(\dash\url::this() .'/log');


		$load = \dash\db\telegrams::get(\dash\request::get('id'));
		// if(is_array($load))
		// {
		// 	$new = [];
		// 	foreach ($load as $key => $value)
		// 	{
		// 		var_dump($key);
		// 		var_dump($value);

		// 		if(is_string($value))
		// 		{
		// 			var_dump(111);
		// 			if(substr($value, 0, 1) === '{' || substr($value, 0, 1) === '[')
		// 			{
		// 				$tmp = json_decode($value, true);
		// 				$load[$key] = \dash\social\telegram::json($tmp);
		// 			}
		// 		}
		// 	}
		// }
		\dash\data::dataRow($load);

		// \dash\db\telegrams::insert(['key' => 'value', 'key2' => 'value2']);
		// \dash\db\telegrams::update(['key' => 'value', 'key2' => 'value2'], 10); // where id = 10 update
	}
}
?>