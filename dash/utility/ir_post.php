<?php
namespace dash\utility;



class ir_post
{

	private static $error = [];

	public static function quick_view($_weight)
	{
		$result              = [];
		$result['sefareshi'] = self::calculate($_weight, ['type' => 'sefareshi']);
		$result['pishtaz']   = self::calculate($_weight, ['type' => 'pishtaz']);

		return $result;
	}


	public static function calculate($_weight, $_meta = [])
	{
		$condition =
		[
			'detail'        => 'bit',
			'send_type'     => ['enum' => ['inprovince', 'otherprovince']],
			'type'          => ['enum' => ['sefareshi', 'pishtaz']],
			'package_type'  => ['enum' => ['pocket', 'box']],
			'from_province' => 'province',
			'from_city'     => 'city',
			'to_province'   => 'province',
			'to_city'       => 'city',
			'location_mode' => 'bit',
		];


		$require = ['type'];

		$meta = [];

		$data = \dash\cleanse::input($_meta, $condition, $require, $meta);

		$rate = [];

		$detail_result = [];

		$get_detail = $data['detail'];

		$_weight = \dash\validate::int($_weight);

		if(!$_weight || !is_numeric($_weight) || $_weight < 0)
		{
			self::$error[] = T_("Please enter the package weight");
			$weight = 0;
		}

		if($_meta['type'] === 'sefareshi')
		{
			$rate = self::sefareshi($_weight);
		}
		elseif($_meta['type'] === 'pishtaz')
		{
			$rate = self::pishtaz($_weight);
		}

		if(!$get_detail)
		{
			// quick view
			foreach ($rate as $key => $value)
			{
				if($value)
				{
					$detail_result['vat'] = ((9 * $value) / 100);
					$value                = $value + $detail_result['vat'];

					$rate[$key] = $value;
				}
			}

			// foreach ($rate as $key => $value)
			// {
			// 	$rate[$key] = round($value / 10);
			// }

			$rate['currency'] = T_("Rial");

			return $rate;

		}


		$price = 0;

		$basic_rate = $rate;

		if($data['send_type'] === 'inprovince')
		{
			$price                  = $rate['province'];
			$detail_result['basic'] = $basic_rate['province'];
		}
		elseif($data['send_type'] === 'otherprovince' )
		{
			if($data['from_province'] && $data['to_province'])
			{
				$from_province = \dash\utility\location\provinces::$data[$data['from_province']];
				$to_province   = \dash\utility\location\provinces::$data[$data['to_province']];

				if(isset($from_province['neighbor']) && in_array($data['to_province'], $from_province['neighbor']))
				{
					$price                  = $rate['neighbor'];
					$detail_result['basic'] = $basic_rate['neighbor'];
				}
				else
				{
					$price                  = $rate['country'];
					$detail_result['basic'] = $basic_rate['country'];
				}
			}
			else
			{
				$price                  = $rate['country'];
				$detail_result['basic'] = $basic_rate['country'];
			}

			if($data['from_city'] && $data['to_city'])
			{
				$from_city   = \dash\utility\location\cites::$data[$data['from_city']];
				$to_city   = \dash\utility\location\cites::$data[$data['to_city']];
				if(isset($from_city['province_center']) && $from_city['province_center'] && isset($to_city['province_center']) && $to_city['province_center'])
				{
					$detail_result['province_center'] = ((10 * $price) / 100);
					$price                             = $price + $detail_result['province_center'];
				}
				// +10% for province center
			}
		}


		// if($data['package_type'] === 'box')
		{
			$detail_result['insurance']	= 8000;
			$price = floatval($price) + $detail_result['insurance'];

		}

		$detail_result['vat'] = ((9 * $price) / 100);
		$price                = $price + $detail_result['vat'];

		$detail_result['price'] = $price;

		// foreach ($detail_result as $key => $value)
		// {
		// 	$detail_result[$key] = round($value / 10);
		// }

		$detail_result['currency'] = T_("Rial");

		if(self::$error)
		{
			$detail_result = [];
			$detail_result['error']    = self::$error;
		}

		return $detail_result;

	}


	private static function sefareshi($_weight)
	{
		$rate = [];
		if($_weight <= 500)
		{
			$rate =
			[
				'province' => 36800,
				'neighbor' => 49000,
				'country'  => 53000,
			];
		}
		elseif($_weight <= 1000)
		{
			$rate =
			[
				'province' => 48300,
				'neighbor' => 67600,
				'country'  => 72800,
			];
		}
		elseif($_weight <= 2000)
		{
			$rate =
			[
				'province' => 69000,
				'neighbor' => 88000,
				'country'  => 95000,
			];
		}
		else
		{
			self::$error[] = T_("Can not send package more than 3 Kg By sefareshi post");
			$rate =
			[
				'province' => 0,
				'neighbor' => 0,
				'country'  => 0,
			];
		}

		return $rate;

	}

	private static function pishtaz($_weight)
	{
		$rate = [];

		if($_weight <= 500)
		{
			$rate =
			[
				'province' => 57500,
				'neighbor' => 78000,
				'country'  => 84000,
			];

		}
		elseif($_weight <= 1000)
		{
			$rate =
			[
				'province' => 74000,
				'neighbor' => 100000,
				'country'  => 112000,
			];
		}
		elseif($_weight <= 2000)
		{
			$rate =
			[
				'province' => 98000,
				'neighbor' => 127000,
				'country'  => 140000,
			];
		}
		elseif($_weight <= 25000)
		{
			$pishtaz_extra = ceil(($_weight - 2000) / 1000) * 25000;

			$rate =
			[
				'province' => 98000 + $pishtaz_extra,
				'neighbor' => 127000 + $pishtaz_extra,
				'country'  => 140000 + $pishtaz_extra,
			];

		}
		else
		{
			self::$error[] = T_("Can not send package more than 25 Kg By pishtaz post");
			$rate =
			[
				'province' => 0,
				'neighbor' => 0,
				'country'  => 0,
			];
		}

		return $rate;
	}

}
?>