<?php
namespace content_site\options\link;


class link_color_magicbox_button
{
	use link_color;

	public static function checked()
	{
		$magicbox_title_position = \content_site\section\view::get_current_index_detail('magicbox_title_position');
		if($magicbox_title_position != 'hide')
		{
			return true;
		}

		return false;
	}


	public static function db_key()
	{
		return 'btn_color';
	}


	public static function title()
	{
		return T_("Button color");
	}





}
?>