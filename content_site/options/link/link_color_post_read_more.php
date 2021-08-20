<?php
namespace content_site\options\link;


class link_color_post_read_more
{
	use link_color;

	public static function checked()
	{
		return \content_site\section\view::get_current_index_detail('post_show_read_more');
	}


	public static function option_key()
	{
		return 'link_color_post_read_more';
	}


}
?>