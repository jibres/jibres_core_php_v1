<?php
namespace content_a\setting\thirdparty\irasanpardakht;


class view extends \content_a\setting\thirdparty\onlinepayment\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Asanpardakht Payment'));



	}
}
?>
