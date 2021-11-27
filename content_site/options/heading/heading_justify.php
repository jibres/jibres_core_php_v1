<?php
namespace content_site\options\heading;


trait heading_justify
{
	use \content_site\options\justify\justify;


	public static function db_key()
	{
		return 'heading_position';
	}

}
?>