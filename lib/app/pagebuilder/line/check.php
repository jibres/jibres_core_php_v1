<?php
namespace lib\app\pagebuilder\line;


class check
{
	public static function input($_element, $_contain, $_id, $_args = [])
	{
		$args = \lib\app\pagebuilder\line\tools::global_clean_input($_args);

		$global_input_condition = \lib\app\pagebuilder\line\tools::global_input_condition();

		$input_condition = \lib\app\pagebuilder\line\tools::call_fn_args($_element, 'input_condition', $global_input_condition);

		// the module have not function check input
		if($input_condition === false)
		{
			$input_condition = $global_input_condition;
		}

		$require = [];

		$input_required = \lib\app\pagebuilder\line\tools::call_fn($_element, 'input_required');

		if(is_array($input_required))
		{
			$require = $input_required;
		}


		$meta = [];

		$input_meta = \lib\app\pagebuilder\line\tools::call_fn($_element, 'input_meta');

		if(is_array($input_meta))
		{
			$meta = $input_meta;
		}

		$data = \dash\cleanse::input($args, $input_condition, $require, $meta);

		if(!$data)
		{
			return false;
		}

		$data = \lib\app\pagebuilder\line\tools::global_ready_for_save_db($data);

		$ready_for_db = \lib\app\pagebuilder\line\tools::call_fn_args($_element, 'ready_for_db', $data);

		if($ready_for_db)
		{
			return $ready_for_db;
		}
		else
		{
			return $data;
		}

	}

}
?>