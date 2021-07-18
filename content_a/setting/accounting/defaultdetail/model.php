<?php
namespace content_a\setting\accounting\defaultdetail;


class model
{
	public static function post()
	{
		$post                                   = [];

		$post['assistant_close_harmful_profit'] = \dash\request::post('assistant_close_harmful_profit');
		$post['assistant_close_accumulated']    = \dash\request::post('assistant_close_accumulated');
		$post['assistant_closing']              = \dash\request::post('assistant_closing');

		$post['default_cost_tax']               = \dash\request::post('default_cost_tax');
		$post['default_cost_vat']               = \dash\request::post('default_cost_vat');
		$post['default_income_tax']             = \dash\request::post('default_income_tax');
		$post['default_income_vat']             = \dash\request::post('default_income_vat');

		\lib\app\setting\set::accounting_setting($post);

		\dash\redirect::pwd();
	}
}
?>