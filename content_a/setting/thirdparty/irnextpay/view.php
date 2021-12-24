<?php
namespace content_a\setting\thirdparty\irnextpay;


class view extends \content_a\setting\thirdparty\onlinepayment\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Nextpay Payment'));

	}
}
?>
