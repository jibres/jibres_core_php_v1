<?php
namespace content_site\section\blog;


class model
{
	public static function post()
	{
		$option_list = chante::options();

		return \content_site\model::public_model($option_list);

	}
}
?>