<?php
namespace content_a\setting\accounting;


class model
{
	public static function post()
	{
		$post           = [];

		if(\dash\request::post('set_currency'))
		{
			$post['currency'] = \dash\request::post('currency');
		}


		if(\dash\request::post('set_assistant_close_harmful_profit'))
		{
			$post['assistant_close_harmful_profit'] = \dash\request::post('assistant_close_harmful_profit');
		}

		if(\dash\request::post('set_assistant_close_accumulated'))
		{
			$post['assistant_close_accumulated']    = \dash\request::post('assistant_close_accumulated');
		}

		if(\dash\request::post('set_assistant_closing'))
		{
			$post['assistant_closing']              = \dash\request::post('assistant_closing');
		}


		if(\dash\request::post('set_default_cost_tax'))
		{
			$post['default_cost_tax']               = \dash\request::post('default_cost_tax') ? \dash\request::post('default_cost_tax') : null;
		}

		if(\dash\request::post('set_default_cost_vat'))
		{
			$post['default_cost_vat']               = \dash\request::post('default_cost_vat') ? \dash\request::post('default_cost_vat') : null;
		}

		if(\dash\request::post('set_default_income_tax'))
		{
			$post['default_income_tax']             = \dash\request::post('default_income_tax') ? \dash\request::post('default_income_tax') : null;
		}

		if(\dash\request::post('set_default_income_vat'))
		{
			$post['default_income_vat']             = \dash\request::post('default_income_vat') ? \dash\request::post('default_income_vat') : null;
		}

		if(\dash\request::post('set_default_cost_payer'))
		{
			$post['default_cost_payer']             = \dash\request::post('default_cost_payer') ? \dash\request::post('default_cost_payer') : null;
		}

		if(\dash\request::post('set_default_cost_bank'))
		{
			$post['default_cost_bank']              = \dash\request::post('default_cost_bank') ? \dash\request::post('default_cost_bank') : null;
		}

		if(\dash\request::post('set_default_partner'))
		{
			$post['default_partner']              = \dash\request::post('default_partner') ? \dash\request::post('default_partner') : null;
		}

		\lib\app\setting\set::accounting_setting($post);

		\dash\redirect::pwd();
	}
}
?>