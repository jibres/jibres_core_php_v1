<?php

namespace lib\app\plan;

class planEdit
{

	public static function edit(array $_args, $_id)
	{
		$data         = self::cleanArgs($_args);
		$dataCleanded = \dash\cleanse::patch_mode($_args, $data);
		if ($dataCleanded)
		{
			$loadPlan = planGet::get($_id);
			if ($loadPlan)
			{
				\lib\db\store_plan_history\update::record($dataCleanded, $loadPlan['id']);
				\dash\notif::ok(T_("Saved"));
				return true;
			}
		}
		return false;
	}


	private static function cleanArgs(array $_args)
	{
		$condition =
			[
				'status' => ['enum' => ['active', 'deactive']],
				'reason' => 'string_1000',
			];

		$require = [];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}

}