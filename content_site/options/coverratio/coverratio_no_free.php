<?php
namespace content_site\options\coverratio;


class coverratio_no_free
{

	use coverratio;

	public static function have_free_ratio()
	{
		return false;
	}

}
?>