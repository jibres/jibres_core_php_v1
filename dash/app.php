<?php
namespace dash;

/**
 * Class for application.
 */
class app
{


	/**
	 * return the url of static logo file
	 */
	public static function static_logo_url()
	{
		$url = \dash\url::cdn(). '/img/logo/default.png';
		return $url;
	}


	/**
	 * return the url of static logo file
	 */
	public static function static_image_url()
	{
		$url = \dash\url::cdn(). '/img/default/image.png';
		return $url;
	}


	public static function static_avatar_url($_type = 'default')
	{
		$url = \dash\url::cdn(). '/';
		switch ($_type)
		{
			case 'male':
				$url .= 'img/avatar/man.png';
				break;

			case 'female':
				$url .= 'img/avatar/woman.png';
				break;

			default:
				$url .= 'img/avatar/default.png';
				break;
		}
		return $url;
	}


	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'user_id':
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

				case 'displayname':
					if(!$value && $value != '0')
					{
						$value = T_("Whitout name");
					}
					$result[$key] = $value;
					break;

				case 'logo':
					if($value)
					{
						$result['logo'] = \lib\filepath::fix($value);
					}
					else
					{
						$result['logo'] = \dash\app::static_logo_url();
					}
					break;

				case 'avatar':
					if($value)
					{
						$avatar = \lib\filepath::force_dl($value);
					}
					else
					{
						if(isset($_data['gender']))
						{
							if($_data['gender'] === 'male')
							{
								$avatar = \dash\app::static_avatar_url('male');
							}
							elseif($_data['gender'] === 'female')
							{
								$avatar = \dash\app::static_avatar_url('female');
							}
							else
							{
								$avatar = \dash\app::static_avatar_url();
							}
						}
						else
						{
							$avatar = \dash\app::static_avatar_url();
						}
					}
					$result[$key] = $avatar;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function fix_avatar($_data)
	{
		if(!isset($_data['avatar']))
		{
			$_data['avatar'] = false;
		}

		if(!isset($_data['gender']))
		{
			$_data['gender'] = false;
		}

		if(!isset($_data['displayname']))
		{
			$_data['displayname'] = false;
		}


		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'gender':
					$result[$key] = $value;
					if($value === 'male')
					{
						$result['gender_string'] = T_("Mr");
						$result['genderString']  = T_("Mr");
					}
					elseif($value === 'female')
					{
						$result['gender_string'] = T_("Mrs");
						$result['genderString']  = T_("Mrs");
					}
					else
					{
						$result['gender_string'] = null;
						$result['genderString']  = null;
					}
					break;

				case 'displayname':
					if($value === false)
					{
						$value = T_("Whitout user");
					}
					else
					{
						if(!$value && $value != '0')
						{
							$value = T_("Whitout name");
						}
					}
					$result[$key] = $value;
					break;


				case 'avatar':
					if($value)
					{
						$avatar = \lib\filepath::force_dl($value);
					}
					else
					{
						if(isset($_data['gender']))
						{
							if($_data['gender'] === 'male')
							{
								$avatar = \dash\app::static_avatar_url('male');
							}
							elseif($_data['gender'] === 'female')
							{
								$avatar = \dash\app::static_avatar_url('female');
							}
							else
							{
								$avatar = \dash\app::static_avatar_url();
							}
						}
						else
						{
							$avatar = \dash\app::static_avatar_url();
						}
					}
					$result[$key] = $avatar;
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