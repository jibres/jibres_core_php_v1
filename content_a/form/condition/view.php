<?php
namespace content_a\form\condition;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form condition'). ' | '. \dash\data::formDetail_title());

		$form_id = \dash\request::get('id');

		\content_a\form\edit\view::form_preview_link();

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?'. \dash\request::fix_get());

		$item = \lib\app\form\item\get::items_conditionable($form_id);

		\dash\data::itemsconditionable($item);

		$all_item = \lib\app\form\item\get::items($form_id, false, false, true);

		\dash\data::items($all_item);

		$operation_list =
		[
			'isequal'    => T_('Is Equal'),
			'isnotequal' => T_('Is not equal'),
		];

		\dash\data::operationList($operation_list);

		$currency_choice = [];

		$load_choice = \lib\app\form\condition\choice::get($form_id, \dash\request::get('if'));

		\dash\data::choiceList($load_choice);

		$conditionList = \lib\app\form\condition\get::list($form_id);
		\dash\data::conditionList($conditionList);

	}

}
