<?php
namespace content_business\profile\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My profile"));
		\dash\data::dataRow(\dash\user::detail());


		if(\dash\language::current() === 'fa' && \dash\data::dataRow_birthday())
		{
			\dash\data::dataRow_birthday(\dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_birthday())));
		}

	}
}
?>
