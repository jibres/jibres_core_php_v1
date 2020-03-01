<?php
namespace lib\app\nic_poll;


class get
{
	public static function list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$poll = \lib\nic\exec\poll::request();

		if(isset($poll['count']) && is_numeric($poll['count']) && intval($poll['count']) > 0)
		{
			$count = intval($poll['count']);

			for ($i=1; $i <= $count ; $i++)
			{
				if(isset($poll['id']))
				{
					$insert =
					[
						'notif_count' => isset($poll['count']) ? $poll['count'] : null,
						'server_id'   => isset($poll['id']) ? $poll['id'] : null,
						'index'       => isset($poll['index']) ? $poll['index'] : null,
						'note'        => isset($poll['note']) ? $poll['note'] : null,
						'domain'      => isset($poll['domain']) ? $poll['domain'] : null,
						'detail'      => isset($poll['detail']) ? json_encode($poll['detail'], JSON_UNESCAPED_UNICODE) : null,
						'datecreated' => date("Y-m-d H:i:s"),
					];

					$poll_id = \lib\db\nic_poll\insert::new_record($insert);
					if($poll_id)
					{
						$set_as_acknowledge = \lib\nic\exec\poll::acknowledge($poll['id']);
						if($set_as_acknowledge)
						{
							\lib\db\nic_poll\update::update(['acknowledge' => 1], $poll_id);
						}
					}
				}
				else
				{
					break;
				}

				$poll = \lib\nic\exec\poll::request();

			}
		}
		return $poll;

	}



	public static function my_list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$list = \lib\db\nic_poll\get::my_list(\dash\user::id());

		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				if(isset($value['index']))
				{
					switch ($value['index'])
					{
						case 'DomainUpdateStatus':
							$list[$key]['taction'] = T_("Your domain status was updated");
							$list[$key]['class']   = '';
							$list[$key]['meta']   = $value['domain'];
							$list[$key]['icon']    = '<i class="sf-refresh fc-blue"></i>';
							break;

						default:
							$list[$key]['taction'] = $value['action'];
							break;
					}
				}
			}
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>