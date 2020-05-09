<?php
namespace content_a\website\header;


class controller
{
	public static function routing()
	{
		$active_header_detail = \lib\app\website\header\get::active_header_detail();
		if(!$active_header_detail)
		{
			\dash\redirect::to(\dash\url::that(). '/template');
		}

		\dash\data::activeHeaderDetail($active_header_detail);
	}
}
?>
