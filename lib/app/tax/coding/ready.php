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

		// if(isset($_data['group_title']) && $_data['group_title'])
		// {
		// 	$full_title[] = $_data['group_title'];
		// }


		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'title':
					$full_title[] = $value;
					$result[$key] = $value;
					break;

				case 'code':
					$full_title[] = $value;
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
					$result['add_child_text'] = T_("Add new accounting total");
					$child_type = 'total';
					break;

				case 'total':
					$result['add_child_text'] = T_("Add new accounting assistant");
					$child_type = 'assistant';
					break;

				case 'assistant':
					$result['add_child_text'] = T_("Add new accounting details");
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

		if(isset($_data['detail_title']) && $_data['detail_title'])
		{
			$full_title = [];
			$full_title[] = a($result, 'code');
		}

		if(isset($_data['total_title']) && $_data['total_title'])
		{
			$full_title[] = $_data['total_title'];
		}

		if(isset($_data['assistant_title']) && $_data['assistant_title'])
		{
			$full_title[] = $_data['assistant_title'];
		}


		if(isset($_data['detail_title']) && $_data['detail_title'])
		{
			$full_title[] = $_data['detail_title'];
		}


		$result['full_title'] = implode(' - ', $full_title);
		return $result;
	}

}
?>