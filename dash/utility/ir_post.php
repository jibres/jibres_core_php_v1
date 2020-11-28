<?php
namespace dash\utility;



class ir_post
{


	public static function calculate($_weight, $_meta = [])
	{

		$default_meta =
		[
			'type'     => null,
			'location' => null,
			'box_type' => null,
		];

		if(!is_array($_meta))
		{
			$_meta = [];
		}

		$_meta = array_merge($default_meta, $_meta);

		$rate = [];

		$_weight = \dash\validate::int($_weight);


		if(!$_weight || !is_numeric($_weight) || $_weight < 0)
		{
			return false;
		}



		if($_meta['location'])
		{
			if(isset($rate[$_meta['location']]))
			{
				$rate = $rate[$_meta['location']];
			}
			else
			{
				// error
				return false;
			}
		}

		return $rate;
	}


	private static function sefareshi($_weight)
	{
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
			/* errro */
			return false;
		}

	}

	private static function pishtaz($_weight)
	{

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
			/* errro */
			return false;
		}
	}

}
?>