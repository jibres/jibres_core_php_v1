<?php
namespace content_a\form\analytics\answer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answer Detail'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '/table?'. \dash\request::fix_get(['aid' => null]));


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


		$hot_query = [];

		if(\dash\request::get('province'))
		{

			$form_id = \dash\request::get('id');
			$item_province = [];

			$items = \lib\app\form\item\get::items($form_id);


			if(!is_array($items))
			{
				$items = [];
			}

			foreach ($items as $key => $value)
			{
				if(isset($value['type']) && $value['type'] && in_array($value['type'], ['province_city', 'province']))
				{
					$item_province[] = "`$table_name`.`f_$value[id]`";
				}
			}


			$province = \dash\utility\location\provinces::$data;


			foreach ($province as $key => $value)
			{
				if($value['country'] === 'IR')
				{
					if($key === \dash\request::get('province'))
					{

						if($item_province)
						{


							$args =
							[
								'form_id'    => $form_id,
								'filter_id'  => \dash\request::get('fid'),
								'table_name' => $table_name,
								// 'get_count'  => true,
							];

							$hot_query = [];
							foreach ($item_province as $V)
							{
								$hot_query[] = "$V LIKE '$key%' ";
							}

							$hot_query = implode(" OR ", $hot_query);
							$hot_query = "$hot_query";
							$hot_query = [$hot_query];

						}

					}

				}
			}

		}



		$args               = [];

		$args['answer_id']  = \dash\request::get('aid');
		$args['filter_id']  = \dash\request::get('fid');
		$args['table_name'] = $table_name;
		$args['form_id']    = \dash\request::get('id');
		$args['export']     = true; // set 100 limit

		$q = \dash\request::get('q');

		$dataTable = \lib\app\form\answerdetail\search::list($q, $args, $hot_query);

		$filterBox     = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered    = \lib\app\form\answerdetail\search::is_filtered();


		$new_result = [];
		foreach ($dataTable as $key => $value)
		{
			if(!isset($new_result[$value['answer_id']]))
			{
				$new_result[$value['answer_id']]  = [];
			}

			$new_result[$value['answer_id']][] = $value;
		}

		\dash\data::resultAnswer($new_result);

		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		$all_tag = \lib\app\form\tag\get::all_tag();
		\dash\data::allTagList($all_tag);


		$tag_list = \lib\app\form\tag\get::answer_tag(\dash\request::get('aid'));
		if(!is_array($tag_list))
		{
			$tag_list = [];
		}
		\dash\data::tagsSavedTitle(array_column($tag_list, 'title'));


		$comment_list = \lib\app\form\comment\get::get(\dash\request::get('aid'));

		\dash\data::commentList($comment_list);
		// $load_items = \lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'));

		// \dash\data::formItems($load_items);


	}

}
?>
