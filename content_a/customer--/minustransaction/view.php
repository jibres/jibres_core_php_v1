<?php
namespace content_a\customer\minustransaction;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Transactions'));
		\dash\data::page_desc(T_('Check all transactions include sales, purchases and money send and recieve.'));
		\dash\data::page_pictogram('balance-scale');

		\content_a\customer\load::fixTitle();

	}
}
?>
