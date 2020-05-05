<?php
namespace content_a\website\footer\customize;


class controller
{
	public static function routing()
	{
		$active_footer_detail = \lib\app\website\footer\get::active_footer_detail();
		if(!$active_footer_detail)
		{
			\dash\redirect::to(\dash\url::that());
		}

		\dash\data::activeFooterDetail($active_footer_detail);



	}
}
?>
