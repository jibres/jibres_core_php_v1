<?php
namespace content_su\shorturl;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		$val = \dash\request::get('val');
		if($val)
		{
			\dash\data::valEncode(\dash\coding::decode($val));
			\dash\data::valDecode(\dash\coding::encode($val));
		}

	}
}
?>