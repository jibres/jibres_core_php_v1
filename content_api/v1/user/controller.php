<?php
namespace content_api\v1\user;


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

		if($dir_2 !== 'user')
		{
			\content_api\v1::invalid_url();
		}

		\dash\permission::access('contentCrm');

		$dir_3 = \dash\url::dir(3);

		$user_id = \dash\url::dir(3);
		if($user_id)
		{
			$user_id = \dash\coding::decode($user_id);
		}

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			\content_api\v1\user\add::route_add();
		}
		elseif($dir_3 === 'list')
		{
			\content_api\v1\user\get::route_list();
		}
		elseif(is_numeric($user_id) && intval($user_id) > 0 && !\dash\number::is_larger($user_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{

				case 'edit':
					if(\dash\url::dir(5))
					{
						\content_api\v1::invalid_url();
					}
					\content_api\v1\user\add::route_edit($user_id);
					break;

				case 'address':
					// set user id as current logined user id
					// in crm call this function but set user id from api parameter
					\content_api\v1\user\address::set_user_id($user_id);

					$dir_5 = \dash\url::dir(5);

					if(\dash\url::dir(5) === 'add')
					{
						if(\dash\url::dir(6))
						{
							\content_api\v1::invalid_url();
						}

						if(!\dash\request::is('post'))
						{
							\content_api\v1::invalid_method();
						}

						$detail = \content_api\v1\user\address::add_address();
						\content_api\v1::say($detail);

					}
					elseif(\dash\url::dir(5) === 'list')
					{
						if(\dash\url::dir(6))
						{
							\content_api\v1::invalid_url();
						}

						if(!\dash\request::is('get'))
						{
							\content_api\v1::invalid_method();
						}

						$detail = \content_api\v1\user\address::list_address();
						\content_api\v1::say($detail);

					}
					elseif(\dash\coding::is($dir_5) && in_array(\dash\url::dir(6), ['edit', 'remove']) && !\dash\url::dir(7))
					{
						if(\dash\url::dir(6) === 'edit')
						{
							if(!\dash\request::is('patch'))
							{
								\content_api\v1::invalid_method();
							}

							$detail = \content_api\v1\user\address::edit_address($dir_5);
							\content_api\v1::say($detail);
						}
						elseif(\dash\url::dir(6) === 'remove')
						{
							if(!\dash\request::is('delete'))
							{
								\content_api\v1::invalid_method();
							}
							$detail = \content_api\v1\user\address::remove_address($dir_5);
							\content_api\v1::say($detail);
						}
					}
					else
					{
						\content_api\v1::invalid_url();
					}
					break;

				case null:
					\content_api\v1\user\get::route_one($user_id);
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