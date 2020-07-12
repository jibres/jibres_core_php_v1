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

			'mobile'      => 'mobile',
			'gender'      => ['enum' => ['male', 'female']],
			'displayname' => 'displayname',

		];

		$require = ['title', 'total', 'type'];

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


		if($data['type'] === 'income')
		{
			// customer
			if(!$data['customer'] && ($data['mobile'] || $data['displayname']))
			{
				// customer
				$user_id = self::generate_user($data);
				if(!\dash\engine\process::status())
				{
					return false;
				}

				$data['customer'] = $user_id;
			}
		}
		elseif($data['type'] === 'cost')
		{
			if(!$data['seller'] && ($data['mobile'] || $data['displayname']))
			{
				// seller
				$user_id = self::generate_user($data);
				if(!\dash\engine\process::status())
				{
					return false;
				}

				$data['seller'] = $user_id;
			}
		}
		else
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
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

		unset($data['mobile']);
		unset($data['gender']);
		unset($data['displayname']);

		return $data;

	}


	private static function generate_user($data)
	{
		$user_id = null;
		if($data['mobile'])
		{
			$user_id = \dash\app\user::quick_add(['mobile' => $data['mobile'], 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
		}
		else
		{
			if($data['displayname'])
			{
				$check_exist_displayname = \dash\db\users::get_by_displayname($data['displayname']);
				if(isset($check_exist_displayname['id']))
				{
					\dash\notif::error(T_("This thirdparyt already added to your store. plase set her mobile or change the name"), 'displayname');
				}
				else
				{
					$user_id = \dash\app\user::quick_add(['mobile' => null, 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
				}
			}
		}

		return $user_id;
	}

}
?>