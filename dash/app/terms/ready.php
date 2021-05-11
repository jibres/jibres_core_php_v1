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


				// hidden filed
				case 'user_id':
				// case 'count':
				case 'meta':
				case 'desc':
				case 'language':
				case 'type':
				case 'parent':
				case 'status':
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

			// if(isset($result['type']) && $result['type'] === 'tag')
			{
				$my_link.= 'hashtag/';
			}

			$my_link.= $result['url'];
			$result['link'] = $my_link;
		}


		return $result;
	}
}
?>