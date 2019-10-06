<?php
namespace content_pardakhtyar\customer\dashboard;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Dashboard"));
		\dash\data::page_desc('Check request detail');
		\dash\data::page_pictogram('question');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_("Customers"));
		$id     = \dash\request::get('id');
		$result = \lib\pardakhtyar\app\customer::get($id);

		if(!$result)
		{
			\dash\header::status(403, T_("Invalid customer id"));
		}

		\dash\data::dataRowCustomer($result);

		if(isset($result['id']))
		{
			$shopDetail = \lib\pardakhtyar\db\shop::get(['customer_id' => $result['id'], 'limit' => 1]);
			\dash\data::dataRowShop($shopDetail);

			$merchantIbans = \lib\pardakhtyar\db\merchantIbans::get(['customer_id' => $result['id']]);
			\dash\data::dataRowIban($merchantIbans);

			$acceptor = \lib\pardakhtyar\db\acceptor::get(['customer_id' => $result['id'], 'limit' => 1]);
			\dash\data::dataRowAcceptor($acceptor);

			$terminal = \lib\pardakhtyar\db\terminal::get(['customer_id' => $result['id'], 'limit' => 1]);
			\dash\data::dataRowTerminal($terminal);
		}

	}
}
?>