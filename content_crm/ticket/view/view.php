<?php
namespace content_crm\ticket\view;


class view
{
	public static function config()
	{
		if(\dash\data::dataRow_subtype() === 'bug')
		{
			\dash\face::title(T_("Bug report"). ' '. \dash\fit::text(\dash\data::dataRow_id()));
		}
		else
		{
			\dash\face::title(T_("Ticket"). ' '. \dash\fit::text(\dash\data::dataRow_id()));
		}

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/datalist');


		// \dash\face::btnSetting(\dash\url::this(). '/setting?id='. \dash\request::get('id'));


		$ticket_id = \dash\data::dataRow_id();

		$conversation = \dash\app\ticket\get::conversation($ticket_id, null, \dash\request::get('lastid'));

		\dash\data::conversation($conversation);

	}
}
?>
