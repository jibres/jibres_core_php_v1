<?php

namespace lib\app\plan;

class planCheck
{

	public static function access($_feature_key, $_args = null) : bool
	{
		return self::get($_feature_key, 'access', $_args);
	}


	public static function get(string $_feature_key, string $_function_name, $_args = [])
	{
		$load = self::load($_feature_key);
		if(!$load)
		{
			return false;
		}

		if(!method_exists($load, $_function_name))
		{
			return false;
		}

		return call_user_func([$load, $_function_name], $_args);
	}


	public static function load(string $_feature_key)
	{
		$loadCurrentPlan = businessPlanDetail::getMyPlanDetail();

		if($loadCurrentPlan)
		{
			$contain = businessPlanDetail::contain();

			if(isset($contain[$_feature_key]))
			{
				$loadFeature = \lib\app\plan\feature\generate::loadFeature($_feature_key, $contain[$_feature_key]);
				return $loadFeature;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


}