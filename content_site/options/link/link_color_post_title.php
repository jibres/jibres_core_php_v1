<?php
namespace content_site\options\link;


class link_color_post_title
{
	use link_color;

	public static function checked()
	{
		return \content_site\section\view::get_current_index_detail('post_title_position') === 'out';
	}

}
?>