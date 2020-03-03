<?php
namespace content_v2\business\about;


class view
{


	public static function config()
	{
		$detail = \content_v2\business\pages::by_slug('about');
		\content_v2\tools::say($detail);
	}

}
?>