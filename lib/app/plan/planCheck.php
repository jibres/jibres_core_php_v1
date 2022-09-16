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


	private static function load(string $_feature_key, $_business_id = null)
	{
		if(!$_business_id)
		{
			$loadCurrentPlan = businessPlanDetail::getMyPlanDetail();
		}
		else
		{
			$loadCurrentPlan = storePlan::currentPlan($_business_id);
		}


		if($loadCurrentPlan)
		{
			$myPlan   = $loadCurrentPlan['plan'];
			$loadPlan = planLoader::load($myPlan);
			$contain  = $loadPlan->contain();

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


	public static function jibresCheck($_business_id, $_feature_key, $_function_name, $_args = [])
	{
		$load = self::load($_feature_key, $_business_id);

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


}