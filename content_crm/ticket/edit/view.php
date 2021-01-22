<?php
namespace content_crm\ticket\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit ticket"));

		$master_id = \dash\data::dataRow_id();
		if(\dash\data::dataRow_parent())
		{
			$master_id = \dash\data::dataRow_parent();
		}

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(self::back_link());
	}


	public static function back_link()
	{
		$master_id = \dash\data::dataRow_id();
		if(\dash\data::dataRow_parent())
		{
			$master_id = \dash\data::dataRow_parent();
		}

		return \dash\url::this(). '/view?id='. $master_id;

	}
}
?>
