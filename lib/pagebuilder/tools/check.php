<?php
namespace lib\pagebuilder\tools;


class check
{
	public static function input($_folder, $_element, $_id, $_args = [], $_saved_detail = [])
	{
		$args = \lib\pagebuilder\tools\tools::global_clean_input($_args);

		$input_condition = \lib\pagebuilder\tools\tools::call_fn($_folder, $_element, 'input_condition');

		if($input_condition === false)
		{
			return false;
		}

		$contain = \lib\pagebuilder\tools\tools::get_contain($_folder, $_element);

		foreach ($contain as $one_contain)
		{
			$fn = \lib\pagebuilder\tools\tools::get_fn($_folder, $one_contain, 'input_condition');

			if(is_callable($fn))
			{
				$input_condition = call_user_func_array($fn, [$input_condition]);
			}
		}

		$require = [];

		$input_required = \lib\pagebuilder\tools\tools::call_fn($_folder, $_element, 'input_required');

		if(is_array($input_required))
		{
			$require = $input_required;
		}

		$meta = [];

		$input_meta = \lib\pagebuilder\tools\tools::call_fn($_folder, $_element, 'input_meta');

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
			$fn = \lib\pagebuilder\tools\tools::get_fn($_folder, $one_contain, 'ready_for_db');

			if(is_callable($fn))
			{
				$data = call_user_func_array($fn, [$data, $_saved_detail]);
			}
		}

		$ready_for_db = \lib\pagebuilder\tools\tools::call_fn_args($_folder, $_element, 'ready_for_db', $data, $_saved_detail);

		return $ready_for_db;

	}

}
?>