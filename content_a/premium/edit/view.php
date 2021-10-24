<?php
namespace content_a\discount\edit;


class view extends \content_a\discount\add\view
{
	public static function config()
	{

		parent::config();

		\dash\face::title(T_("Edit discount code"));


		\dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. \dash\request::get('id'));

		\dash\data::discountSummary(\lib\app\discount\get::summary(\dash\request::get('id'), \dash\data::dataRow()));

	}
}
?>