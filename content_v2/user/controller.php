<?php
namespace content_v2\user;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_v2\tools::apikey_required();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'user')
		{
			\content_v2\tools::invalid_url();
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
				\content_v2\tools::invalid_url();
			}

			\content_v2\user\add::route_add();
		}
		elseif($dir_3 === 'list')
		{
			\content_v2\user\get::route_list();
		}
		elseif(is_numeric($user_id) && intval($user_id) > 0 && !\dash\number::is_larger($user_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{

				case 'edit':

					if(\dash\url::dir(5) === 'avatar')
					{
						if(\dash\url::dir(6))
						{
							\content_v2\tools::invalid_url();
						}
						\content_v2\user\add::route_edit_avatar($user_id);
					}
					elseif(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}
					else
					{
						\content_v2\user\add::route_edit($user_id);
					}
					break;

				case 'address':
					// set user id as current logined user id
					// in crm call this function but set user id from api parameter
					\content_v2\user\address::set_user_id($user_id);

					$dir_5 = \dash\url::dir(5);

					if(\dash\url::dir(5) === 'add')
					{
						if(\dash\url::dir(6))
						{
							\content_v2\tools::invalid_url();
						}

						if(!\dash\request::is('post'))
						{
							\content_v2\tools::invalid_method();
						}

						$detail = \content_v2\user\address::add_address();
						\content_v2\tools::say($detail);

					}
					elseif(\dash\url::dir(5) === 'list')
					{
						if(\dash\url::dir(6))
						{
							\content_v2\tools::invalid_url();
						}

						if(!\dash\request::is('get'))
						{
							\content_v2\tools::invalid_method();
						}

						$detail = \content_v2\user\address::list_address();
						\content_v2\tools::say($detail);

					}
					elseif(\dash\coding::is($dir_5) && in_array(\dash\url::dir(6), ['edit', 'remove']) && !\dash\url::dir(7))
					{
						if(\dash\url::dir(6) === 'edit')
						{
							if(!\dash\request::is('patch'))
							{
								\content_v2\tools::invalid_method();
							}

							$detail = \content_v2\user\address::edit_address($dir_5);
							\content_v2\tools::say($detail);
						}
						elseif(\dash\url::dir(6) === 'remove')
						{
							if(!\dash\request::is('delete'))
							{
								\content_v2\tools::invalid_method();
							}
							$detail = \content_v2\user\address::remove_address($dir_5);
							\content_v2\tools::say($detail);
						}
					}
					else
					{
						\content_v2\tools::invalid_url();
					}
					break;

				case null:
					\content_v2\user\get::route_one($user_id);
					break;

				default:
					\content_v2\tools::invalid_url();
					break;
			}
		}
		else
		{
			\content_v2\tools::invalid_url();
		}

	}


}
?>