<?php
namespace content_site\options\description;

class description_copyright
{

	use description;

	public static function db_key()
	{
		return 'copyright';
	}

	public static function title()
	{
		return T_('Copyright');
	}


}
?>