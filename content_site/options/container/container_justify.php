<?php
namespace content_site\options\container;


trait container_justify
{
	use \content_site\options\justify\justify;

	public static function db_key()
	{
		return 'container_justify';
	}




}
?>