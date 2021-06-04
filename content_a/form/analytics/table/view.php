<?php
namespace content_a\form\analytics\table;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));


		$table_name = \lib\app\form\view\get::is_created_table(\dash\request::get('id'));

		if(!$table_name)
		{
			\dash\header::status(404, T_("Table not created"));
		}

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);
		$args               = [];
		$args['sort']       = 'id';
		$args['order']      = 'desc';
		$args['table_name'] = $table_name;
		$args['filter_id']  = \dash\request::get('fid');
		$args['form_id']    = \dash\request::get('id');
		$q                  = \dash\validate::search_string();

		$form_id = \dash\request::get('id');

		$hot_query = [];

		if(\dash\request::get('province'))
		{

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


		$dataTable = \lib\app\form\view\search_table::list($q, $args, $hot_query);



		$filterBox     = \lib\app\form\view\search::filter_message();
		$isFiltered    = \lib\app\form\view\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
