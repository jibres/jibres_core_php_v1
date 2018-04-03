<?php
namespace content\contact;

class view
{
	public static function config()
	{
		\lib\data::page(T_('Contact Us'), 'title');
		\lib\data::page(T_('Knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way.'), 'desc');
	}
}
?>