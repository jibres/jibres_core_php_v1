<?php
namespace content\bug;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Bug'));
		\dash\face::desc("Please report our bugs!");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>