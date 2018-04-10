<?php
namespace content_a\factor\opr;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Pay factor'));
		// \dash\data::page_desc(T_('You can search in list of pays, and select one of pay'));

		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::this());

		$pay_detail   = \lib\app\storetransaction::factor_pay_list(\dash\request::get('id'));
		$saved_amount = 0;
		if(is_array($pay_detail))
		{
			$temp         = array_column($pay_detail, 'plus');
			$temp         = array_sum($temp);
			$saved_amount = intval($temp);
		}
		\dash\data::payDetail($pay_detail);

		$meta          = [];
		$factor_detail = \lib\app\factor::get(['id' => \dash\request::get('id')], $meta);

		if(isset($factor_detail['factor']['sum']))
		{
			$factor_detail['factor']['sum_remain'] = intval($factor_detail['factor']['sum']) - $saved_amount;
		}
		\dash\data::factorDetail($factor_detail);

		$store_factor_setting = \lib\store::detail('meta');

		$default_meta =
		[
			'print_status'  => true,
			'print_size'    =>
			[
				'fishprint' => true,
				'a4'        => true,
				'a5'        => true,
			],
			'detault_print' => 'fishprint',

			'pay_status' => true,
			'pay'        =>
			[
				'cash'   => true,
				'pos'    => true,
				'cheque' => true,
			],

			'detault_pay' => 'cash',
			'pos_list'    =>  [],
			'default_pos' => null,
		];

		if(isset($store_factor_setting['factor']) && is_array($store_factor_setting['factor']))
		{
			$store_factor_setting = array_merge($default_meta, $store_factor_setting['factor']);
		}
		else
		{
			$store_factor_setting = $default_meta;
		}

		// $this->data->current_store['meta']['factor'] = $store_factor_setting;

		// add to factor main
		\dash\data::pageSize('receipt8');

	}
}
?>
