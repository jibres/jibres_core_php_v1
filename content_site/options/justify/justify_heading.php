<?php
namespace content_site\options\justify;


trait justify_heading
{
	use justify;


	public static function db_key()
	{
		return 'heading_position';
	}

}
?>