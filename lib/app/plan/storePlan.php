<?php

namespace lib\app\plan;


class storePlan
{

	public static function activate($_business_id, array $_args)
	{
		$data = self::cleanArgs($_args);

		$plan    = $data['plan'];
		$newPlan = planLoader::load($plan);
		$newPlan->setPeriod($data['period']);
		$newPlan->prepare();

		$currentPlan = self::currentPlan($_business_id);


		if (!planChoose::allowChoosePlan($currentPlan, $newPlan))
		{
			\dash\notif::error_once(T_("Can not choose this plan"));
			return false;
		}


		$planPrice = new planPrice($newPlan);
		$readyPlan = new planPay($newPlan, $planPrice);
		$readyPlan->setStoreId($_business_id);
		$readyPlan->readyToPay($data);

		if ($readyPlan->needPay())
		{
			$result =
				[
					'needPay'       => $readyPlan->needPay(),
					'payLink'       => $readyPlan->payLink(),
					'planActiveate' => false,
				];
		}
		else
		{
			$readyToSetPlan =
				[
					'plan'           => $plan,
					'period'         => $data['period'],
					'transaction_id' => null,
					'store_id'       => $_business_id,
					'planName'       => $newPlan->title(),
					'user_id'        => \dash\user::id(),
					'price'          => $newPlan->price(),
				];
			$activate       = self::afterPay($readyToSetPlan);
			$result         =
				[
					'needPay'       => $readyPlan->needPay(),
					'payLink'       => $readyPlan->payLink(),
					'planActiveate' => $activate,
				];
		}

		return $result;
	}


	private static function cleanArgs(array $_args)
	{
		$condition =
			[
				'plan'        => ['enum' => planList::list()],
				'period'      => ['enum' => ['monthly', 'yearly']],
				'action_type' => ['enum' => ['register', 'renew']],
				'use_budget'  => 'bit',
				'turn_back'   => 'string_2000',
			];

		$require = ['plan'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	public static function currentPlan($_business_id) : array
	{
		$loadBusinessData      = \lib\db\store\get::data($_business_id);
		$lastPlanHistoryRecord = self::lastPlanHistoryRecord($_business_id);
		$currentPlan           = self::checkPlanRecord($_business_id, $loadBusinessData, $lastPlanHistoryRecord);

		if ($currentPlan)
		{
			$planDetail = $lastPlanHistoryRecord;
		}
		else
		{
			$planDetail = [];
		}
		return $planDetail;
	}


	private static function lastPlanHistoryRecord($_business_id)
	{
		$lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);

		if (!$lastPlanHistoryRecord)
		{
			planSet::setFirstPlan($_business_id, 'free');
			$lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);
		}
		return $lastPlanHistoryRecord;
	}


	private static function checkPlanRecord($_business_id, $_loadBusinessData, $_lastPlanRecord)
	{
		$result = [];


		if (!$_lastPlanRecord)
		{
			// @BUG All business must have plan record
			return $result;
		}

		$currentPlan = null;

		if (isset($_lastPlanRecord['plan']) && $_lastPlanRecord['plan'])
		{
			$currentPlan = $_lastPlanRecord['plan'];
		}


		if (isset($_lastPlanRecord['status']) && $_lastPlanRecord['status'] === 'active')
		{
			// ok. Nothing.
		}

		$expDate = a($_lastPlanRecord, 'expirydate');

		if ($expDate)
		{
			if (strtotime($_lastPlanRecord['expirydate']) < time())
			{
				\lib\db\store_plan_history\update::record([
					'status' => 'deactive', 'reason' => 'expired',
				], $_lastPlanRecord['id']);
				planSet::setFirstPlan($_business_id, 'free', null, $_lastPlanRecord);
				$currentPlan = 'free';
				$expDate     = null;
			}
		}

		$updateStoreData = [];

		if (!\dash\validate::is_equal($currentPlan, a($_loadBusinessData, 'plan')))
		{
			$updateStoreData['plan'] = $currentPlan;
		}

		if (!\dash\validate::is_equal($expDate, a($_loadBusinessData, 'planexp')))
		{
			$updateStoreData['planexp'] = $expDate;
		}

		if ($updateStoreData)
		{
			\lib\db\store\update::record_data($updateStoreData, $_business_id);
		}


		return $currentPlan;


	}


	public static function afterPay($_args = [])
	{
		$args = self::cleanArgsAfterPay($_args);

		$store_id = a($args, 'store_id');
		$plan     = a($args, 'plan');
		$period   = a($args, 'period');


		if (!$plan)
		{
			\dash\notif::error(T_("Plan not found"));
			return false;
		}

		$currentPlan = self::currentPlan($store_id);

		$newPlan = planLoader::load($plan);
		$newPlan->setPeriod($period);
		$newPlan->prepare();


		if (planChoose::allowChoosePlan($currentPlan, $newPlan))
		{
			\lib\db\store_plan_history\update::record([
				'status' => 'deactive', 'reason' => 'buy new plan',
			], $currentPlan['id']);
			planSet::set($store_id, $newPlan, $currentPlan);
			self::minusTransaction($args, $newPlan);
			return true;
		}
		else
		{
			\dash\notif::error_once(T_("Can not choose this plan"));
			return false;
		}
	}


	private static function cleanArgsAfterPay(array $_args)
	{
		$condition =
			[
				'plan'           => ['enum' => planList::list()],
				'period'         => ['enum' => ['monthly', 'yearly']],
				'transaction_id' => 'id',
				'store_id'       => 'id',
				'planName'       => 'string',
				'user_id'        => 'id',
				'price'          => 'price',
			];

		$require = ['plan'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	private static function minusTransaction(array $_args, $newPlan)
	{
		// for free plan needless to minus transaction
		if (!floatval($_args['price']))
		{
			return;
		}

		$title = T_("Activate plan :plan ( :period ) ", ['plan' => $newPlan->title(), 'period' => $newPlan->period()]);

		$insert_transaction =
			[
				'user_id' => $_args['user_id'],
				'title'   => $title,
				'amount'  => floatval($_args['price']),

			];

		\dash\app\transaction\budget::minus($insert_transaction);

	}


	public static function activePlanHistory($_business_id)
	{
		$activePlanHistoryRecord = \lib\db\store_plan_history\get::activePlanHistoryRecord($_business_id);
		return $activePlanHistoryRecord;

	}


	public static function doCancel($_business_id)
	{
		$store_id = $_business_id;

		$currentPlan = self::currentPlan($store_id);

		$meta =
			[
				'action_type' => 'cancel',
				'plan'        => 'free',
			];

		$cancelDetail = planFactor::calculate($store_id, $meta);

		if (isset($cancelDetail['access']['ok']) && $cancelDetail['access']['ok'])
		{
			// ok
			if (isset($cancelDetail['total']['price']) && $cancelDetail['total']['price'])
			{
				self::plusTransaction($cancelDetail, $cancelDetail['total']['price'], $store_id);

				if (isset($cancelDetail['meta']['guarantee']) && $cancelDetail['meta']['guarantee'])
				{
					\lib\db\store_plan_history\update::record([
						'status' => 'deactive', 'reason' => 'refund+guarantee',
					], $currentPlan['id']);
				}
				else
				{

					\lib\db\store_plan_history\update::record([
						'status' => 'deactive', 'reason' => 'refund',
					], $currentPlan['id']);
				}
			}
			else
			{
				\lib\db\store_plan_history\update::record([
					'status' => 'deactive', 'reason' => 'cancel',
				], $currentPlan['id']);
			}

			planSet::setFirstPlan($store_id, 'free', null, $currentPlan);

		}
		else
		{
			\dash\notif::error(T_("Can not cancel this plan"));
			return false;
		}

	}


	private static function plusTransaction($detail, $_price, $_business_id)
	{

		$title = T_("Refund plan :plan ", ['plan' => a($detail, 'meta', 'plan_title')]);

		$insert_transaction =
			[
				'user_id' => \lib\app\store\get::owner($_business_id),
				'title'   => $title,
				'amount'  => floatval($_price),

			];

		\dash\app\transaction\budget::plus($insert_transaction);
	}


}