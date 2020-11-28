<?php
namespace dash\utility;



class ir_post
{

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

		$_weight = \dash\validate::int($_weight);

		if(!$_weight || !is_numeric($_weight) || $_weight < 0)
		{
			return false;
		}

		if($_meta['type'] === 'sefareshi')
		{
			$rate = self::sefareshi($_weight);
		}
		elseif($_meta['type'] === 'pishtaz')
		{
			$rate = self::pishtaz($_weight);
		}

		foreach ($rate as $key => $value)
		{
			if($value)
			{
				if($data['package_type'] === 'box')
				{
					$value = floatval($value) + 8000;
				}
				$value = $value + ((9 * $value) / 100);
				$rate[$key] = $value;
			}
		}


		// must be show by province near
		if($data['location_mode'])
		{
			$rate = $rate['country'];
		}

		return $rate;
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
			/*nothing*/
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
			/*nothing*/
		}

		return $rate;
	}

}
?>