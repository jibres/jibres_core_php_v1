<?php
namespace content_b1\company\remove;


class controller
{
	public static function routing()
	{
		\content_b1\tools::appkey_required();
		\content_b1\tools::apikey_required();

	}
}
?>