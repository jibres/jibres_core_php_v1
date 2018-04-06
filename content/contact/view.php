<?php
namespace content\contact;

class view
{
	public static function config()
	{
		\dash\data::page(T_('Contact Us'), 'title');
		\dash\data::page(T_('Knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way.'), 'desc');
	}
}
?>