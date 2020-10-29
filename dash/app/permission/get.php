<?php
namespace dash\app\permission;


class get
{
	public static function get($_id, $_ready = false)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}


		$load = \lib\db\setting\get::by_id($id);

		if(isset($load['id']) && isset($load['cat']) && $load['cat'] === 'permission')
		{
			// ok nothing
		}
		else
		{
			\dash\notif::error(T_("Invalid permission id"));
			return false;
		}

		if(isset($load['value']) && is_string($load['value']))
		{
			$load['value'] = json_decode($load['value'], true);
		}

		if(isset($load['value']) && is_array($load['value']))
		{
			// ok nothing
		}
		else
		{
			$load['value'] = [];
		}

		if($_ready)
		{

			$list = \dash\permission::categorize_list();

			foreach ($load['value'] as $key => $value)
			{
				if(isset($value['access']) && $value['access'] === 'customized' && isset($value['contain']) && is_array($value['contain']))
				{
					$contain = $value['contain'];
					if(isset($list[$key]['advance']) && is_array($list[$key]['advance']))
					{

						foreach ($list[$key]['advance'] as  $caller_detail)
						{
							if(in_array($caller_detail['caller'], $contain))
							{
								if(!isset($load['value'][$key]['allow_access_title']))
								{
									$load['value'][$key]['allow_access_title'] = [];
								}

								$load['value'][$key]['allow_access_title'][] = $caller_detail['title'];
							}
							else
							{
								if(!isset($load['value'][$key]['disallow_access_title']))
								{
									$load['value'][$key]['disallow_access_title'] = [];
								}

								$load['value'][$key]['disallow_access_title'][] = $caller_detail['title'];


							}
						}

					}
				}
			}

		}


		return $load;

	}


	public static function list()
	{
		$list = \lib\db\setting\get::by_cat('permission');

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;

	}
}
?>