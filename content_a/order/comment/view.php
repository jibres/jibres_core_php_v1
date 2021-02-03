<?php
namespace content_a\order\comment;


class view
{
	public static function config()
	{
		\dash\upload\size::maxUploadSize('order');

		\content_a\order\view::master_order_view();

	}
}
?>
