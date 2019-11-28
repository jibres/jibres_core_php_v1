<?php
namespace content_api\v1\company;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v1::apikey_required();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'company')
		{
			\content_api\v1::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$company_id = \dash\url::dir(3);

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			\content_api\v1\company\add::route_add();
		}
		elseif($dir_3 === 'list')
		{
			\content_api\v1\company\datalist::route();
		}
		elseif(is_numeric($company_id) && intval($company_id) > 0 && !\dash\number::is_larger($company_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{

				// case 'edit':
				// 	if(\dash\url::dir(5))
				// 	{
				// 		\content_api\v1::invalid_url();
				// 	}
				// 	\content_api\v1\company\add::route_edit($company_id);
				// 	break;

				case null:
					\content_api\v1\company\get::route($company_id);
					break;

				default:
					\content_api\v1::invalid_url();
					break;
			}
		}
		else
		{
			\content_api\v1::invalid_url();
		}

	}


}
?>