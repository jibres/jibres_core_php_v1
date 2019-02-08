<?php
namespace lib\db\factor;

trait search
{

	public static function search($_string = null, $_options = [])
	{
		$default_option = [];

		if($_string !== null && $_string)
		{
			$_string   = trim($_string);
			$en_number = \dash\utility\convert::to_en_number($_string);

			$string_decode = \dash\coding::decode($_string);
			if(!$string_decode)
			{
				$string_decode = null;
			}
			else
			{
				$string_decode = " OR factors.id  = $string_decode ";
			}
			$search_in_id = null;

			if(\dash\coding::is($_string))
			{
				$search_in_id = "factors.id = '". \dash\coding::decode($_string). "' OR ";
			}

			if(is_numeric($en_number))
			{
				$search =
				"
					(
						$search_in_id
						userstores.displayname  LIKE '%$_string%' OR
						factors.date       = '$en_number'
					)
					$string_decode
				";

			}
			else
			{
				$search =
				"
				(
					userstores.displayname  LIKE '%$_string%'
				)
					$string_decode
				";
			}
			$default_option['search_field'] = $search;
		}

		$_options = array_merge($default_option, $_options);

		$result = \dash\db\config::public_search('factors', $_string, $_options);
		return $result;

	}
}
?>