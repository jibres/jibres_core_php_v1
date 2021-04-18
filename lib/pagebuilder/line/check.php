<?php
namespace lib\pagebuilder\line;


class check
{
	public static function input($_element, $_id, $_args = [], $_saved_detail = [])
	{
		$args = \lib\pagebuilder\line\tools::global_clean_input($_args);

		$input_condition = \lib\pagebuilder\line\tools::call_fn($_element, 'input_condition');

		if($input_condition === false)
		{
			return false;
		}

		$contain = \lib\pagebuilder\line\tools::get_contain($_element);

		foreach ($contain as $one_contain)
		{
			$fn = ['\\lib\\app\\pagebuilder\\config\\'. $one_contain, 'input_condition'];

			if(is_callable($fn))
			{
				$input_condition = call_user_func_array($fn, [$input_condition]);
			}
		}

		$require = [];

		$input_required = \lib\pagebuilder\line\tools::call_fn($_element, 'input_required');

		if(is_array($input_required))
		{
			$require = $input_required;
		}

		$meta = [];

		$input_meta = \lib\pagebuilder\line\tools::call_fn($_element, 'input_meta');

		if(is_array($input_meta))
		{
			$meta = $input_meta;
		}

		$data = \dash\cleanse::input($args, $input_condition, $require, $meta);

		if(!$data)
		{
			return false;
		}

		foreach ($contain as $one_contain)
		{
			$fn = ['\\lib\\app\\pagebuilder\\config\\'. $one_contain, 'ready_for_save_db'];

			if(is_callable($fn))
			{
				$data = call_user_func_array($fn, [$data, $_saved_detail]);
			}
		}

		$ready_for_db = \lib\pagebuilder\line\tools::call_fn_args($_element, 'ready_for_db', $data, $_saved_detail);

		return $ready_for_db;

	}

}
?>