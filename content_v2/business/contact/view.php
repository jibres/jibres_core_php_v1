<?php
namespace content_v2\business\contact;


class view
{


	public static function config()
	{
		$detail = \content_v2\business\pages::by_slug('contact');
		\content_v2\tools::say($detail);
	}

}
?>