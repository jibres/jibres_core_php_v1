<?php
namespace content_a\setting\factor;


class model
{
	public static function post()
	{
		\dash\permission::access('aSettingEdit');
		$old_meta = \lib\store::detail('meta');

		if(isset($old_meta['factor']))
		{
			$old_meta = $old_meta['factor'];
		}
		else
		{
			$old_meta = [];
		}

		$meta = self::getPost($old_meta);

		\lib\app\store::edit_meta(['factor' => $meta]);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Factor setting saved"));
			\dash\redirect::pwd();
		}
	}


	public static function getPost($_old_meta = [])
	{
		// @important!
		// if you want to change this array
		// must be change the array in view of factor/pay/view.php
		$default_meta =
		[
			'print_status'  => false,
			'print_size'    =>
			[
				'fishprint' => false,
				'a4'        => false,
				'a5'        => false,
			],
			'default_print' => 'fishprint',

			'pay_status' => false,
			'pay'        =>
			[
				'cash'   => false,
				'pos'    => false,
				'cheque' => false,
			],

			'default_pay' => 'cash',
			'pos_list'    =>  [],
			'default_pos' => null,
		];


		$meta                  = $default_meta;
		$meta['print_status']  = \dash\request::post('printStatus') ? true : false;
		$meta['default_pos']   = \dash\request::post('defaultPos');
		$meta['default_print'] = \dash\request::post('defaultPrint');
		$meta['default_pay']   = \dash\request::post('defaultPay');

		if(\dash\request::post('print_size') && is_array(\dash\request::post('print_size')))
		{
			$meta['print_size']['fishprint'] = in_array('fishprint', \dash\request::post('print_size')) ? true : false;
			$meta['print_size']['a4']        = in_array('a4', \dash\request::post('print_size')) ? true : false;
			$meta['print_size']['a5']        = in_array('a5', \dash\request::post('print_size')) ? true : false;
		}

		if(\dash\request::post('pay') && is_array(\dash\request::post('pay')))
		{
			$meta['pay']['cash']   = in_array('cash', \dash\request::post('pay')) ? true : false;
			$meta['pay']['pos']    = in_array('pos', \dash\request::post('pay')) ? true : false;
			$meta['pay']['cheque'] = in_array('cheque', \dash\request::post('pay')) ? true : false;
		}


		$pos_active = \dash\request::post('pos_active');

		$support_pos_active =
		[
			'saderat',		'mellat',		'tejarat',		'melli',
			'sepah',		'keshavarzi',	'parsian',		'maskan',
			'refah',		'novin',		'ansar',		'pasargad',
			'saman',		'sina',			'post',			'ghavamin',
			'taavon',		'shahr',		'ayande',		'sarmayeh',
			'day',			'hekmat',		'iranzamin',	'karafarin',
			'gardeshgari',	'madan',		'tsaderat',		'khavarmiyane',
			'ivbb',			'irkish',		'asanpardakht',	'zarinpal',
			'payir',
		];

		$meta['pos_list'] = [];

		if($pos_active && is_array($pos_active))
		{
			foreach ($pos_active as $key => $value)
			{
				if(in_array($value, $support_pos_active))
				{
					$temp =
					[
						'status' => true,
						'class'  => $value,
						'name'   => T_(ucfirst($value)),
					];
					$meta['pos_list'][$value] = $temp;
				}
			}
		}

		return $meta;
	}
}
?>