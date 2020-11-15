<?php
namespace content_a\order\comment;


class view
{
	public static function config()
	{
		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

		\content_a\order\view::master_order_view();

	}
}
?>
