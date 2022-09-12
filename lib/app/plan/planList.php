<?php
namespace lib\app\plan;


class planList
{

	public static function list() : array
	{
		return
			[
				'free',
				'gold',
				'diamond',
				'rafiei',
			];
	}


	public static function cancelAble() : array
	{
		return
			[
				'gold',
				'diamond',
			];
	}


	public static function listByDetail($_args = [])
	{
		$planDetail = [];

		$currentPlanDetail = new businessPlanDetail(\lib\store::id());
		$currentPlan       = $currentPlanDetail->currentPlan();
		$period            = 'yearly';

		if(isset($_args['period']) && in_array($_args['period'], ['monthly', 'yearly']))
		{
			$period = $_args['period'];
		}

		foreach (self::list() as $plan)
		{
			$myPlan = planLoader::load($plan);

			if(self::allowToShow($myPlan))
			{
				$planDetail[] = self::getPlanDetail($myPlan, $currentPlan, $period);
			}
		}


		return $planDetail;
	}


	private static function allowToShow(plan $myPlan)
	{
		if($myPlan->type() === 'public')
		{
			return true;
		}

		if($myPlan->type() === 'enterprise')
		{
			if(\lib\store::enterprise() === $myPlan->enterprise())
			{
				return true;
			}
		}
		return false;
	}


	private static function getPlanDetail(plan $_myPlan, $_currentPlan, $_period) : array
	{
		$currency     = $_myPlan->currency();
		$currencyName = \lib\currency::name($currency);

		$isActive = false;
		if(isset($_currentPlan['plan']) && $_currentPlan['plan'] === $_myPlan->name())
		{
			$isActive = true;
		}

		$planDetail =
			[
				'name'                => $_myPlan->name(),
				'title'               => $_myPlan->title(),
				'description'         => $_myPlan->description(),
				'outstandingFeatures' => $_myPlan->outstandingFeatures(),
				'featureList'         => $_myPlan->featureList(),
				'price'               => $_myPlan->calculatePrice($_period),
				'currency'            => $currency,
				'currencyName'        => $currencyName,
				'isActive'            => $isActive,
			];
		return $planDetail;
	}


	public static function preparePlanFeacureList(array $_planDetail)
	{
		$allPlan = array_column($_planDetail, 'name');
		$allPlan = array_flip($allPlan);
		$allPlan = array_map(function ()
		{
			return null;
		}, $allPlan);

		$allFeature = [];
		foreach ($_planDetail as $planDetail)
		{
			foreach ($planDetail['featureList'] as $group => $list)
			{
				if(!isset($allFeature[$group]))
				{
					$allFeature[$group] = [];
				}

				foreach ($list as $item_key => $item_value)
				{
					if(!array_key_exists($item_key, $allFeature[$group]))
					{
						$allFeature[$group][$item_key] = $allPlan;
					}
				}

			}
		}

		foreach ($_planDetail as $plan)
		{
			foreach ($plan['featureList'] as $group => $list)
			{
				foreach ($list as $item => $value)
				{
					$allFeature[$group][$item][$plan['name']] = $value;
				}
			}

		}

		return $allFeature;

	}


}