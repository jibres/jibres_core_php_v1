<?php

namespace lib\app\plan;

class dashboard
{

	public static function detail()
	{
		$result                    = [];
		$groupByPlan               = \lib\db\store_plan_history\get::groupByPlan();
		$result['groupByStatus']   = $groupByPlan;
		$result['totalRows']       = \lib\db\store_plan_history\get::totalRows();
		$result['refundGuarantee'] = \lib\db\store_plan_history\get::totalRowsRefundGuarantee();
		$result['refund']          = \lib\db\store_plan_history\get::totalRowsRefund();
		$result['active']          = \lib\db\store_plan_history\get::totalRowsStatus('active');
		$result['yearlyCount']     = \lib\db\store_plan_history\get::totalRowsPeriodType('yearly');
		$result['monthlyCount']    = \lib\db\store_plan_history\get::totalRowsPeriodType('monthly');

		return $result;
	}

}