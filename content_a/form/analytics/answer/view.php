<?php
namespace content_a\form\analytics\answer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answer Detail'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '?id='. \dash\request::get('id'));


		$table_name = \lib\app\form\view\get::is_created_table(\dash\request::get('id'));

		if(!$table_name)
		{
			\dash\header::status(404, T_("Table not created"));
		}

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());
		$new_field = [];

		foreach ($fields as $key => $value)
		{
			if(isset($value['item_id']))
			{
				if(!isset($new_field[$value['item_id']]))
				{
					$new_field[$value['item_id']] = $value;
				}
			}
		}

		\dash\data::fields($new_field);

		$args              = [];

		$args['answer_id'] = \dash\request::get('aid');
		$args['form_id']   = \dash\request::get('id');
		$args['export'] = true;

		$q = \dash\request::get('q');

		$dataTable = \lib\app\form\answerdetail\search::list($q, $args);

		$filterBox     = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered    = \lib\app\form\answerdetail\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		$load_items = \lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'));

		\dash\data::formItems($load_items);


	}

}
?>
