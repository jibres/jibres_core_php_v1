<?php
namespace content_a\form\condition;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form condition'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?'. \dash\request::fix_get());

		$item = \lib\app\form\item\get::items_conditionable(\dash\request::get('id'));

		\dash\data::itemsconditionable($item);

		$all_item = \lib\app\form\item\get::items(\dash\request::get('id'), false, false, true);

		\dash\data::items($all_item);

		$operation_list =
		[
			'isequal'    => T_('Is Equal'),
			'isnotequal' => T_('Is not equal'),
		];

		\dash\data::operationList($operation_list);

		$currency_choice = [];

		if(($if = \dash\request::get('if')) && is_array($item))
		{
			$load_choice = [];

			foreach ($item as $key => $value)
			{
				if($value['id'] == $if)
				{

					switch ($value['type'])
					{
						case 'yes_no':
							$load_choice = [['id' => 'yes', 'title' => T_("Yes")],['id' => 'no', 'title' => T_("No")]];
							break;

						case 'single_choice':
							$load_choice = $value['choice'];
							break;

						case 'dropdown':
							$load_choice = $value['choice'];
							break;

						case 'country':
							\dash\utility\location\countres::html_data();
							\dash\data::choiceMode('country');
							break;

						case 'province':
							\dash\utility\location\countres::html_data();
							\dash\data::choiceMode('city');
							break;

						case 'gender':
							$load_choice = [['id' => 'male', 'title' => T_("Male")],['id' => 'female', 'title' => T_("Female")]];
							break;

						case 'list_amount':
							$load_choice = $value['choice'];
							break;

						default:
							// code...
							break;
					}
				}
			}
		}

		\dash\data::choiceList($load_choice);


	}

}
?>
