<?php
namespace content_v2\business\vision;


class view
{


	public static function config()
	{
		$detail = \content_v2\business\pages::by_slug('vision');
		\content_v2\tools::say($detail);
	}

}
?>