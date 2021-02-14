<?php
namespace lib\app\export;

class form_answer
{

	public static function run($_detail = [])
	{
		$form_id = null;
		if(isset($_detail['related_id']))
		{
			$form_id = $_detail['related_id'];
		}

		if(!$form_id)
		{
			\dash\log::oops('formExportFormIdNotSet');
			return false;
		}


		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		set_time_limit(300);

		$step         = 500;
		$start_limit  = 0;
		$end_limit    = $step;
		$first_record = true;
		$file_name    = 'export-form-'. $form_id. '-'. date("Y-m-d"). '-'. date("His"). '-'. rand(11111,99999);

		$addr         = \lib\app\export\directory::temp_dir('form');

		if (ob_get_level() == 0) ob_start();

		$result       = \lib\db\form_answer\get::export_list($form_id, $start_limit, $end_limit);
		$result       = \lib\app\form\answer\export::ready_for_export($result);

		while ($result)
		{
			\dash\utility\export::csv_file(['name' => $file_name, 'data' => $result], $addr, $first_record);

			unset($result);

			$limit        = $start_limit + $step;
			$start_limit  = $limit;

			$first_record = false;
			$end_limit    = $end_limit + $step;

			$result       = \lib\db\form_answer\get::export_list($form_id, $start_limit, $step);
			$result       = \lib\app\form\answer\export::ready_for_export($result);

	        ob_flush();
	        flush();
		}

		ob_end_flush();


		$file_detail         = \dash\upload\importexport::push_export_file($addr, $file_name, 'form');

		$path = null;
		if(isset($file_detail['path']))
		{
			$path = $file_detail['path'];
		}

		\dash\file::delete($addr);

		$msg     = T_("Create export form answer completed");
		$msg     .= '<br>'. T_("This file will be automatically deleted tomorrow");

		$myname  = T_("Form builder");
		$user_id = (isset($_detail['creator']) && $_detail['creator']) ? \dash\validate::id($_detail['creator']): null;

		if($user_id)
		{
			\dash\log::set('export_ExportProduct', ['fileaddr' => $path, 'myname' => $myname, 'to' => $user_id]);
		}

		return $path;

	}
}
?>