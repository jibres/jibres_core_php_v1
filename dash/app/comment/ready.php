<?php
namespace dash\app\comment;


class ready
{
	public static function row($_data)
	{
		$_data = \dash\app::fix_avatar($_data);
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'user_id':
				case 'post_id':
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

				case 'status':
					$result[$key]      = $value;
					$result['tstatus'] = T_(ucfirst($value));
					break;

				case 'product_thumb':
					if($value)
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = \dash\app::static_image_url();
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