<?php
namespace content_a\factor\pay;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Pay factor');
		$this->data->page['desc']  = T_('You can search in list of pays, and select one of pay');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/factor';
		$this->data->page['badge']['text'] = T_('Back to last sales');

		$meta                    = [];
		$this->data->factor_detail = \lib\app\factor::get(['id' => \lib\utility::get('id')], $meta);
		$store_factor_setting    = \lib\store::detail('meta');

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

		$this->data->store_meta['factor'] = $store_factor_setting;

		// add to factor main
		$this->data->template['fishprint'] = 'content_a/factor/fishprint/fishprint.html';
		$this->data->pageSize = 'receipt8';
	}
}
?>
