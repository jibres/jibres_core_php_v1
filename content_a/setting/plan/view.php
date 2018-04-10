<?php
namespace content_a\setting\plan;

class view
{
	public static function config()
	{
		$currentPlan = \lib\db\storeplans::current(\lib\store::id());
		\dash\data::currentPlan($currentPlan);

		$myTeam = 'myTeam';

		if(isset($currentPlan['team_id']))
		{
			$team_code = \dash\coding::encode($currentPlan['team_id']);
			$current_team = $this->model()->getTeamDetail($team_code);

			if(isset($current_team['name']))
			{
				$myTeam = $current_team['name'];
			}
		}

		\dash\data::page_title(T_('Setting | '). T_('Change Plan of :name', ['name'=>$myTeam]));
		\dash\data::page_desc(T_('By choose new plan, we generate your invoice until now and next invoice is created one month later exactly at this time and you can pay it from billing.'));
	}
}
?>