<?php
namespace content_a\setting\cats;

class view
{
	public static function config()
	{
		// \dash\data::currentPlan(\lib\db\storeplans::current(\lib\store::id()));

		\dash\data::page_title(T_('Setting | '). T_('Change Plan of :name', ['name'=>\dash\data::store_name()]));
		\dash\data::page_desc(T_('By choose new plan, we generate your invoice until now and next invoice is created one month later exactly at this time and you can pay it from billing.'));
	}
}
?>