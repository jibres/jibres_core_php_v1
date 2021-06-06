<?php
namespace content_site\section\blog;


class model
{
	public static function post()
	{
		$option_list = controller::options();

		return \content_site\model::public_model($option_list);

	}
}
?>