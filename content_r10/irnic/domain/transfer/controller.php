<?php
namespace content_r10\irnic\domain\transfer;


class controller
{
	public static function routing()
	{
		\content_r10\tools::appkey_required();
		\content_r10\tools::apikey_required();
	}
}
?>