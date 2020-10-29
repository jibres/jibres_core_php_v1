<?php
namespace dash;

class plan extends \dash\plan_list
{

	public static function check($_caller)
	{
		if(!\dash\engine\store::inStore())
		{
			// in jibres we have not plan
			return null;
		}

		// @todo @reza @check reald store paln
		$plan = \lib\store::plan();

		if(!$plan || !is_string($plan))
		{
			return false;
		}

		$plan_contain = [];

		switch ($plan)
		{
			case 'trial':
			case 'free':
			case 'simple':
			case 'standard':
				$plan_contain = call_user_func(['self', 'plan_'. $plan]);
				break;

			default:
				// invalid plan!
				return false;

				break;
		}

		// the caller was exist in this plan
		if(isset($plan_contain['contain']) && is_array($plan_contain['contain']) && in_array($_caller, $plan_contain['contain']))
		{
			return true;
		}

		return false;

	}



	private static function plan_trial()
	{

		$trial_contain   = self::_master_contain();

		$trial =
		[
		  'title'      => 'trial',
		  'public'     => true,
		  'monthly'    => 0,
		  'yearly'     => 0,
		  'first_year' => 0,
		  'contain'    => $trial_contain,
		];

		return $trial;
	}



	private static function plan_free()
	{
		$free_contain   = self::_master_contain();

		$free =
		[
		  'title'      => 'free',
		  'public'     => true,
		  'monthly'    => 0,
		  'yearly'     => 0,
		  'first_year' => 0,
		  'contain'    => $free_contain,
		];

		return $free;
	}



	public static function plan_simple()
	{

		$simple_contain   = self::_master_contain();

		$simple =
		[
			'title'      => 'simple',
			'monthly'    => 14000,
			'yearly'     => 140000,
			'first_year' => 50000,
			'contain'    => $simple_contain,
		];

		return $simple;
	}



	public static function plan_standard()
	{

		$standard_contain   = self::_master_contain();

		$standard =
		[
			'title'      => 'standard',
			'monthly'    => 14000,
			'yearly'     => 140000,
			'first_year' => 50000,
			'contain'    => $standard_contain,
		];

		return $standard;
	}



	public static function plan()
	{
		$plan             = [];
		$plan['free']     = self::plan_free();
		$plan['trial']    = self::plan_trial();
		$plan['simple']   = self::plan_simple();
		$plan['free']     = self::plan_free();
		$plan['standard'] = self::plan_standard();

		return $plan;
	}

}
?>
