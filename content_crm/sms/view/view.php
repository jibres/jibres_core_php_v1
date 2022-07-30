<?php
namespace content_crm\sms\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Show sms log detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/datalist');

		if(is_string(\dash\data::dataRow_meta()))
		{
			$meta = json_decode(\dash\data::dataRow_meta(), true);
			\dash\data::smsMeta($meta);
		}

	}
}
?>
