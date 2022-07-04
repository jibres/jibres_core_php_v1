<?php
namespace lib\app\form\condition;


class choice
{
	public static function get($_form_id, $_if)
	{
		$item = \lib\app\form\item\get::items($_form_id, true, false, true);

		$if = \dash\validate::id($_if);

		$load_choice = [];

		if($if && is_array($item))
		{

			foreach ($item as $key => $value)
			{
				if($value['id'] == $if)
				{

					switch ($value['type'])
					{
						case 'yes_no':
							$load_choice = [['id' => 'yes', 'title' => T_("Yes")],['id' => 'no', 'title' => T_("No")]];
							break;

						case 'single_choice':
							$load_choice = $value['choice'];
							break;

						case 'dropdown':
							$load_choice = $value['choice'];
							break;

						case 'country':
							$countryList = \dash\utility\location\countres::$data;
							foreach ($countryList as $key => $value)
							{
								$load_choice[] = ['id' => $key, 'title' => $value['localname']];
							}
							break;

						case 'province':
							$proviceList = \dash\utility\location\provinces::$data;
							foreach ($proviceList as $key => $value)
							{
								$load_choice[] = ['id' => $key, 'title' => $value['localname']];
							}
							break;

						case 'gender':
							$load_choice = [['id' => 'male', 'title' => T_("Male")],['id' => 'female', 'title' => T_("Female")]];
							break;

						case 'list_amount':
							$load_choice = $value['choice'];
							break;

						default:
							// code...
							break;
					}
				}
			}
		}

		return $load_choice;


	}
}
?>


