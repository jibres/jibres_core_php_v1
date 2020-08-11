<?php
namespace lib\app\tax\coding;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];
		$full_title = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'title':
					$full_title[] = $value;
					$result[$key] = $value;
					break;

				case 'code':
					$full_title[] = \dash\fit::text($value);
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['type']) && isset($result['id']))
		{
			$add_child_link = null;
			$child_type = null;
			switch ($result['type'])
			{
				case 'group':
					$child_type = 'total';
					break;

				case 'total':
					$child_type = 'assistant';
					break;

				case 'assistant':
					$child_type = 'details';
					break;

				case 'details':
				default:
					# code...
					break;
			}

			if($child_type)
			{
				$url = \dash\url::this();
				$url .= '/coding/add?type='. $child_type;
				$url .= '&parent='. $result['id'];
				$url .= '&view='. $result['id'];
				$add_child_link = $url;
			}

			$result['add_child_link'] = $add_child_link;
		}

		$result['full_title'] = implode(' - ', $full_title);
		return $result;
	}

}
?>