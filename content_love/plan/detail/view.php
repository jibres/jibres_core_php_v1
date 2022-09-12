<?php
namespace content_love\plan\detail;


class view
{

	public static function config()
	{
		\dash\face::title(T_("Plan detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this() . '/datalist');

		$business_id         = \dash\data::dataRow_store_id();
		$args                = [];
		$args['plan']        = \dash\data::dataRow_plan();
		$args['action_type'] = 'cancel';
		$cancelFactor              = \lib\app\plan\planFactor::calculate($business_id, $args);
		\dash\data::cancelFactor($cancelFactor);


		$args['action_type'] = 'renew';
		$renewFactor              = \lib\app\plan\planFactor::calculate($business_id, $args);
		\dash\data::renewFactor($renewFactor);


	}

}

?>
