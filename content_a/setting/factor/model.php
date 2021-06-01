<?php
namespace content_a\setting\factor;


class model
{
	public static function post()
	{
		$post = [];


		if(\dash\request::post('set_show_vat_column'))
		{
			$post['show_vat_column'] = \dash\request::post('show_vat_column');
		}

		if(\dash\request::post('set_show_discount_column'))
		{
			$post['show_discount_column'] = \dash\request::post('show_discount_column');
		}

		if(\dash\request::post('set_tax_status'))
		{
			$post['tax_status'] = \dash\request::post('tax_status');
		}

		if(\dash\request::post('set_tax_calc'))
		{
			$post['tax_calc'] = \dash\request::post('tax_calc');
		}

		\lib\app\setting\set::save_vat($post);

		\dash\notif::ok(T_("Saved"));

	}
}
?>
