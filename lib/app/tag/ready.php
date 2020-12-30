<?php
namespace lib\app\tag;


class ready
{
	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					break;

				case 'url':
					$result[$key] = $value;
					$result['link'] = \lib\store::url(). '/hashtag/'. $value;
					break;


				case 'count':
					$result[$key] = floatval($value);
					$result['have_product'] = $value ? true : false;
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