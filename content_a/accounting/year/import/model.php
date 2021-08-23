<?php
namespace content_a\accounting\year\import;

class model
{
	public static function post()
	{

		if(!\dash\request::files('import'))
		{
			\dash\notif::error(T_("Please Upload a file"));
			return false;
		}

		$data = \dash\upload\quick::read_csv('import');

		if(!$data)
		{
			\dash\notif::error(T_("No data was received!"));
			return false;
		}


		$year_id = \dash\request::get('id');
		$i = 0;

		foreach ($data as $key => $value)
		{
			$i++;
			$post =
			[
				'template'        => a($value, 'template'),

				'year_id'         => $year_id,

				'pay_from'        => a($value, 'pay_from') ? $value['pay_from'] : null,
				'put_on'          => a($value, 'put_on') ? $value['put_on'] : null,
				'bank'            => a($value, 'bank') ? $value['bank'] : null,
				'partner'         => a($value, 'partner') ? $value['partner'] : null,
				'petty_cash'      => a($value, 'petty_cash') ? $value['petty_cash'] : null,
				'bank_profit'      => a($value, 'bank_profit') ? $value['bank_profit'] : null,

				'thirdparty'      => a($value, 'thirdparty') ? $value['thirdparty'] : null,

				'date'            => a($value, 'date'),

				'total'           => a($value, 'total'),
				'totaldiscount'   => a($value, 'totaldiscount'),
				'totalvat'        => a($value, 'totalvat'),
				'quarterlyreport' => a($value, 'quarterlyreport'),
			];


			$add = \lib\app\tax\doc\template::add($post);

			if(isset($add['id']))
			{
				$result = \lib\app\tax\doc\edit::edit_status(['status' => 'lock'], $add['id']);
			}

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}


		\lib\app\tax\doc\edit::reset_number(['year_id' => $year_id]);

		\dash\notif::clean();

		\dash\notif::ok(T_(":val Factor imported", ['val' => \dash\fit::number($i)]));



	}
}
?>
