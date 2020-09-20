<?php
namespace lib\app\form\view;


class create
{

	public static function new_view($_form_id)
	{
		$laod_form = \lib\app\form\form\get::get($_form_id);

		if(!$laod_form || !isset($laod_form['id']))
		{
			return false;
		}

		$count_answer = \lib\db\form_answer\get::count_by_form_id($laod_form['id']);

		if(!$count_answer)
		{
			\dash\notif::error(T_("This form have not any answer! Can not create view from this form"));
			return false;
		}

		if(isset($laod_form['analyze']) && $laod_form['analyze'])
		{
			\dash\notif::error(T_("The analyze of this form is created before"));
			return false;
		}


		$table_name = 'form_view_table_'. $_form_id;



		ini_set('max_execution_time', 10000); //10000 seconds = 5 minutes
		set_time_limit(10000);

		$form_id = $laod_form['id'];

		$step         = 20;
		$start_limit  = 0;
		$end_limit    = $step;
		$first_record = true;
		$file_name    = $table_name. '_' . date("Y_m_d"). '_'. rand(11111, 99999);

		$addr         = \lib\app\export\directory::form_answer($file_name);

		$addr = str_replace('.csv', '.sql', $addr);


		if (ob_get_level() == 0) ob_start();

		$result       = \lib\db\form_answer\get::export_list($form_id, $start_limit, $end_limit);

		$result       = \lib\app\form\answer\export::ready_for_export_sql($result, $table_name);

		$table_columns = \lib\app\form\answer\export::$sql_column_list;

		while ($result)
		{

			\dash\file::append($addr, implode("; \n", $result));

			\dash\file::append($addr, ";\n");

			unset($result);

			$limit        = $start_limit + $step;
			$start_limit  = $limit;

			$first_record = false;
			$end_limit    = $end_limit + $step;

			$result       = \lib\db\form_answer\get::export_list($form_id, $start_limit, $step);
			$result       = \lib\app\form\answer\export::ready_for_export_sql($result, $table_name);

	        ob_flush();
	        flush();
		}

		ob_end_flush();

		$insert_form_fields = [];
		foreach ($table_columns as $key => $value)
		{
			$insert_form_fields[] = $key;
		}


		if(!empty($insert_form_fields))
		{
			\lib\db\form\update::update(['analyzefield' => json_encode($insert_form_fields, JSON_UNESCAPED_UNICODE)], $form_id);
		}

		\lib\db\form\update::update(['analyze' => date("Y-m-d H:i:s")], $form_id);

		\lib\db\form_view\insert::create_table($table_name, $table_columns);


		$fuel          = \lib\store::my_fuel();
		$database_name = \lib\store::my_db_name();
		$db_charset = 'utf8mb4';

		$cmd  = "mysql ";
		$cmd .= " --host='$fuel[host]' --default-character-set='$db_charset'";
		$cmd .= " --user='$fuel[user]'";
		$cmd .= " --password='$fuel[pass]' '$database_name'";
		$cmd .= " < $addr ";

		$result = exec($cmd, $c, $v);



	}



}
?>