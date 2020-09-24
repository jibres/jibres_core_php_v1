<?php
namespace content_a\form\analytics\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);

		\dash\face::btnSave('form1');

		if(\dash\request::get('export') === 'export')
		{

			$table_name = \lib\app\form\view\get::is_created_table(\dash\request::get('id'));

			if(!$table_name)
			{
				\dash\header::status(404, T_("Table not created"));
			}

			$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());
			$fields = array_combine(array_column($fields, 'field'), $fields);
			$args                = [];
			$args['sort']        = 'id';
			$args['order']       = 'desc';
			$args['table_name']  = $table_name;
			$args['filter_id']   = \dash\request::get('fid');
			$args['form_id']     = \dash\request::get('id');
			$q                   = \dash\request::get('q');
			$args['start_limit'] = 10;
			$args['limit']       = 50;

			$result = \lib\app\form\view\search_table::list($q, $args);

			$result = self::ready_field($result, $fields);
			$first_record = true;

			$file_name = 'Export_Form_filter_'. date("Y_m_d"). '_'. rand(11111, 99999);

			$addr = \lib\app\export\directory::form_answer($file_name);

			while ($result)
			{

				\dash\utility\export::csv_file(['name' => $file_name, 'data' => $result], $addr, $first_record);

				$first_record = false;

				$args['start_limit'] = $args['start_limit'] + 50;

				$result = \lib\app\form\view\search_table::list($q, $args);

				$result = self::ready_field($result, $fields);

			}

			\dash\file::download($addr);

		}



	}

	private static function ready_field($_data, $_field)
	{
		$new_result = [];
		foreach ($_data as $key => $value)
		{
			foreach ($value as $k => $v)
			{
				if((isset($_field[$k]['visible']) && $_field[$k]['visible']) || $k === 'f_answer_id')
				{
					if(isset($_field[$k]['title']))
					{
						$new_result[$key][$_field[$k]['title']] = $v;
					}
				}
			}
		}

		return $new_result;

	}

}
?>
