<?php
namespace content_su\passwd;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>