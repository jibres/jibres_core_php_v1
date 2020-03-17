<?php
namespace content\bug;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Bug'));
		\dash\data::page_desc("Please report our bugs!");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>