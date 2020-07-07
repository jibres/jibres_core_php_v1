<?php
namespace lib\app\irvat;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[

			'title'             => 'string_200',
			'code'              => 'string_200',
			'serialnumber'      => 'string_200',
			'factordate'        => 'datetime',
			'type'              => ['enum' => ['income', 'cost']],
			'customer'          => 'code',
			'seller'            => 'code',
			'total'             => 'bigint',
			'subtotalitembyvat' => 'bigint',
			'sumvat'            => 'bigint',
			'items'             => 'smallint',
			'itemsvat'          => 'smallint',
			'official'          => 'bit',
			'vat'               => 'bit',
			'desc'              => 'desc',

		];

		$require = ['title', 'total'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['customer'])
		{
			$data['customer'] = \dash\coding::decode($data['customer']);
		}

		if($data['seller'])
		{
			$data['seller'] = \dash\coding::decode($data['seller']);
		}

		if($data['factordate'])
		{
			$factor_date = $data['factordate'];

			$jalali = \dash\utility\jdate::date("Y-m-d", $factor_date, false);
			$jdate_explode = explode('-', $jalali);

			if(isset($jdate_explode[0]))
			{
				$data['year'] = $jdate_explode[0];
			}

			if(isset($jdate_explode[1]))
			{
				$data['month'] = intval($jdate_explode[1]);
				switch ($data['month'])
				{
					case 1:
					case 2:
					case 3:
						$data['season'] = 1;
						break;

					case 4:
					case 5:
					case 6:
						$data['season'] = 2;
						break;

					case 7:
					case 8:
					case 9:
						$data['season'] = 3;
						break;

					case 10:
					case 11:
					case 12:
						$data['season'] = 4;
						break;

				}
			}

			if(isset($jdate_explode[2]))
			{
				$data['day'] = intval($jdate_explode[2]);
			}
		}


		return $data;

	}

}
?>