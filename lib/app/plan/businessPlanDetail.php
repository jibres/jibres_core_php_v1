<?php

namespace lib\app\plan;

class businessPlanDetail
{

	private static $currnentPlanRecordDetail = null;
	private static $currentPlan;


	public static function getMyPlanDetail()
	{
		if(!\lib\store::id())
		{
			return false;
		}

		self::loadDetailOnce();

		if(self::$currnentPlanRecordDetail)
		{
			planReady::calculateDays(self::$currnentPlanRecordDetail);
		}

		if(self::name())
		{
			self::$currentPlan = planLoader::load(self::name());
		}

		return self::$currnentPlanRecordDetail;

	}


	public static function getMyCurrentPlanDetail()
	{
		$currentPlanDetail = self::getMyPlanDetail();
		if($currentPlanDetail)
		{
			return planReady::ready(self::$currnentPlanRecordDetail);
		}
		return false;
	}


	public static function calculateFactor(array $_args)
	{
		$planFactorOnJibres = \lib\api\jibres\api::plan_factor($_args);

		if(isset($planFactorOnJibres['result']))
		{
			$result = $planFactorOnJibres['result'];
		}
		else
		{
			$result = [];
		}

		return $result;
	}


	public static function doCancel()
	{
		$doCancelPlan = \lib\api\jibres\api::plan_cancel();

		if(isset($doCancelPlan['result']))
		{
			$result = $doCancelPlan['result'];
		}
		else
		{
			$result = [];
		}
		return $result;
	}


	public static function name()
	{
		if(isset(self::$currnentPlanRecordDetail['plan']))
		{
			return self::$currnentPlanRecordDetail['plan'];
		}
		return null;
	}


	private static function loadDetailOnce()
	{
		// load once!
		if(!is_array(self::$currnentPlanRecordDetail))
		{
			self::$currnentPlanRecordDetail = self::settingRecord();

			if(self::syncRequired() || !self::$currnentPlanRecordDetail)
			{
				self::$currnentPlanRecordDetail = self::syncPlanSetting();
			}
		}

		return self::$currnentPlanRecordDetail;

	}




	public static function currentPlan()
	{
		return self::$currnentPlanRecordDetail;
	}


	public static function contain() : array
	{
		if(self::$currentPlan)
		{
			return self::$currentPlan->contain();
		}
		return [];
	}


	private static function settingRecord()
	{
		$planSettingRecord = \lib\db\setting\get::by_cat_key('plan', 'last');

		if(!is_array($planSettingRecord))
		{
			$planSettingRecord = [];
		}

		if(isset($planSettingRecord['value']))
		{
			$planSettingRecord = json_decode($planSettingRecord['value'], true);
			if(!is_array($planSettingRecord))
			{
				$planSettingRecord = [];
			}
		}
		else
		{
			$planSettingRecord = [];
		}


		return $planSettingRecord;
	}


	private static function syncRequired()
	{
		$planSyncSetting = \lib\db\setting\get::by_cat_key('plan', 'synced');

		if(isset($planSyncSetting['value']))
		{
			if($planSyncSetting['value'] === 'no')
			{
				$syncRequired = true;
			}
			elseif($syncTime = strtotime($planSyncSetting['value']))
			{
				if($syncTime < (time() - (60 * 30)))
				{
					$syncRequired = true;
				}
				else
				{
					$syncRequired = false;
				}
			}
			else
			{
				$syncRequired = true;
			}
		}
		else
		{
			$syncRequired = true;
		}

		return $syncRequired;

	}


	private static function syncPlanSetting()
	{
		$planDetailOnJibres = \lib\api\jibres\api::plan_detail();

		if(isset($planDetailOnJibres['result']))
		{
			$result = $planDetailOnJibres['result'];
		}
		else
		{
			$result = [];
		}

		self::setSynced();

		self::savePlanInSetting($result);


		return $result;

	}


	private static function setSynced()
	{
		\lib\db\setting\update::overwirte_cat_key(date("Y-m-d H:i:s"), 'plan', 'synced');
	}


	private static function savePlanInSetting($_planDetail)
	{
		\lib\db\setting\update::overwirte_cat_key(json_encode($_planDetail), 'plan', 'last');

	}


	public static function sync_required()
	{
		\lib\db\setting\update::overwirte_cat_key('no', 'plan', 'synced');
	}


}