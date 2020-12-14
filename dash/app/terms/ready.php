<?php
namespace dash\app\terms;


class ready
{
	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'term_id':
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


				case 'url':
					$result[$key] = $value;
					break;

				case 'meta':
					if($value && is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		if(isset($result['url']))
		{
			if(\dash\engine\store::inStore())
			{
				$my_link = \lib\store::url(). '/';
			}
			else
			{
				$my_link = \dash\url::kingdom(). '/';
			}

			$my_link.= $result['url'];
			$result['link'] = $my_link;
		}


		return $result;
	}
}
?>