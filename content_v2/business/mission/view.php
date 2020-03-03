<?php
namespace content_v2\business\mission;


class view
{


	public static function config()
	{
		$detail = \content_v2\business\pages::by_slug('mission');
		\content_v2\tools::say($detail);
	}

}
?>