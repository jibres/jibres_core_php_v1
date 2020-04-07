<?php
namespace content_r10\irnic\contact\fetch;


class controller
{
	public static function routing()
	{
		\content_r10\tools::appkey_required();
		\content_r10\tools::apikey_required();
	}
}
?>