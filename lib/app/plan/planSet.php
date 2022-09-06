<?php

namespace lib\app\plan;

class planSet
{

	public static function setFirstPlan($_business_id, string $_plan, $_period = null, $_currentPlan = null)
	{
		$myPlan = planLoader::load($_plan);
		$myPlan->prepare();

		if ($_period)
		{
			$myPlan->setPeriod($_period);
		}

		if(isset($_currentPlan['expirydate']))
		{
			unset($_currentPlan['expirydate']);
		}


		self::set($_business_id, $myPlan, $_currentPlan);
	}


	public static function set($_business_id, plan $_newPlan, $_currentPlan = null)
	{
		$myPlan      = $_newPlan;
		$currentPlan = $_currentPlan;
		$startdate   = date("Y-m-d H:i:s");

		if (isset($_currentPlan['plan']) && $_currentPlan['plan'] === $_newPlan->name())
		{
			if (isset($currentPlan['expirydate']) && $currentPlan['expirydate'])
			{
				$startdate = date("Y-m-d H:i:s", strtotime($currentPlan['expirydate']) + 1);
			}
		}

		$expirydate = null;
		if ($days = $myPlan->calculateDays())
		{
			$expirydate = date("Y-m-d H:i:s", strtotime($startdate) + ($days * 60 * 60 * 24));
		}

		$previous_plan_id = null;
		if (isset($_currentPlan['id']))
		{
			$previous_plan_id = $_currentPlan['id'];
		}

		$action = self::detectPlanAction(a($_currentPlan, 'plan'), $_newPlan->name());

		\lib\db\store_plan_history\update::allOldActivePlanOnDeactive($_business_id);
		$insert =
			[
				'store_id'         => $_business_id,
				'user_id'          => \dash\user::id(),
				'plan'             => $myPlan->name(),
				'startdate'        => $startdate,
				'expirydate'       => $expirydate,
				'type'             => $myPlan->type(),
				'action'           => $action,
				'status'           => 'active',
				'reason'           => null,
				'periodtype'       => $myPlan->period(),
				'setby'            => $myPlan->setBy(),
				'days'             => $myPlan->calculateDays(),
				'price'            => $myPlan->price(),
				'discount'         => null,
				'vat'              => null,
				'finalprice'       => $myPlan->price(),
				'currency'         => $myPlan->currency(),
				'giftusage_id'     => null,
				'previous_plan_id' => $previous_plan_id,
				'datecreated'      => date("Y-m-d H:i:s"),
				'datemodified'     => null,
			];

		$planHistoryId = \lib\db\store_plan_history\insert::new_record($insert);
		return $planHistoryId;

	}


	public static function setManual(array $_args)
	{
		$data = self::cleanArgs($_args);


		$currentPlan = storePlan::currentPlan($data['store_id']);

		$newPlan = planLoader::load($data['plan']);
		$newPlan->setPeriod($data['period']);
		$newPlan->setDays($data['days']);
		$newPlan->prepare();


		if (planChoose::allowChoosePlanAdmin($currentPlan, $newPlan))
		{
			self::set($data['store_id'], $newPlan, $currentPlan);
			return true;
		}
		else
		{
			\dash\notif::error_once(T_("Can not choose this plan"));
			return false;
		}


	}


	private static function cleanArgs(array $_args)
	{
		$condition =
			[
				'plan'     => ['enum' => planList::list()],
				'period'   => ['enum' => ['monthly', 'yearly', 'custom']],
				'days'     => 'id',
				'store_id' => 'id',
			];

		$require = ['plan', 'store_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	private static function detectPlanAction($_current_plan, $_new_plan)
	{
		if (!$_current_plan)
		{
			$action = 'set';
		}
		elseif ($_new_plan === $_current_plan)
		{
			$action = 'extends';
		}
		else
		{
			if ($_new_plan === 'free')
			{
				$action = 'downgrade';
			}
			elseif ($_current_plan === 'free')
			{
				$action = 'upgrade';
			}
			else
			{
				if (in_array($_current_plan, ['gold']) && in_array($_new_plan, ['diamond']))
				{
					$action = 'upgrade';
				}
				elseif (in_array($_current_plan, ['diamond']) && in_array($_new_plan, ['gold']))
				{
					$action = 'downgrade';
				}
				else
				{
					$action = 'set';
				}
			}
		}

		return $action;
	}


}