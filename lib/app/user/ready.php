<?php
namespace lib\app\user;


class ready
{

	/**
	 * ready data of user to _load_user in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function row($_data, $_id = null)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'permission':
					if($value === 'supervisor' && !\dash\permission::supervisor())
					{
						return false;
					}
					else
					{
						$result[$key] = $value;
					}

					break;
				case 'id':
				case 'creator':
				case 'parent':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'avatar':
					$result['avatar_raw'] = $value;
					if($value)
					{
						$result['avatar'] = $value;
					}
					else
					{
						if(isset($_data['gender']))
						{
							if($_data['gender'] === 'male')
							{
								$avatar = \dash\app::static_avatar_url('male');
							}
							else
							{
								$avatar = \dash\app::static_avatar_url('female');
							}
						}
						else
						{
							$avatar = \dash\app::static_avatar_url();
						}
						$result['avatar'] = $value ? $value : $avatar;
					}
					break;

				case 'sidebar':
					if($value || $value === null)
					{
						$result[$key] = true;
					}
					else
					{
						$result[$key] = false;
					}

					break;
				case 'detail':
					if($value)
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'forceremember':
					if($value === null)
					{
						if(\dash\option::config('enter', 'remember_me'))
						{
							$result[$key] = true;
						}
						else
						{
							$result[$key] = false;
						}
					}
					elseif($value)
					{
						$result[$key] = true;
					}
					else
					{
						$result[$key] = false;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


}
?>