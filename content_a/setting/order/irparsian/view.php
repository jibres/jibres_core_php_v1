<?php
namespace content_a\setting\order\irparsian;


class view extends \content_a\setting\order\onlinepayment\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('parsian payment'));

		\dash\data::back_text(T_('Online payment setting'));
		\dash\data::back_link(\dash\url::that(). '/onlinepayment');

	}
}
?>
