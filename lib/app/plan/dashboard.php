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
		$result['chart']           = self::chart();

		return $result;
	}


	private static function chart()
	{
		$data = \lib\db\store_plan_history\get::adminChart();

		$categories = [];
		$plan       = array_column($data, 'plan');
		$plan       = array_filter($plan);
		$plan       = array_unique($plan);

		$clone = [];
		foreach ($plan as $onePlan)
		{
			$clone[$onePlan] = 0;
		}

		$series = [];

		foreach ($data as $value)
		{
			if(!in_array($value['categories'], $categories))
			{
				$categories[]                 = $value['categories'];
				$series[$value['categories']] = $clone;
			}

			$series[$value['categories']][$value['plan']] = $value['count'];

		}

		$newSeries = [];

		foreach ($plan as $onePlan)
		{
			$newSeries[] =
				[
					'name' => T_(ucfirst($onePlan)),
					'data' => array_column($series, $onePlan),
				];
		}

		$chart               = [];
		$chart['categories'] = json_encode(array_map(['\\dash\\fit', 'date'], $categories));
		$chart['series']     = json_encode($newSeries);
		return $chart;

	}

}