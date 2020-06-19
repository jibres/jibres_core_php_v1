<?php
namespace lib\app\category;


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

				case 'have_child':
					$result[$key] = $value ? true : false;
					break;

				case 'count':
					$result[$key] = floatval($value);
					$result['have_product'] = $value ? true : false;
					break;

				case 'parent_json':
					$result[$key] = json_decode($value, true);
					break;

				case 'properties':
					$result[$key] = json_decode($value, true);
					break;

				case 'file':
					$result[$key] = \lib\filepath::fix($value);;

					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['parent3']))
		{
			$result['last_parent'] = $result['parent3'];
		}
		elseif(isset($result['parent2']))
		{
			$result['last_parent'] = $result['parent2'];
		}
		elseif(isset($result['parent1']))
		{
			$result['last_parent'] = $result['parent1'];
		}

		self::fix_parent_detail($result);

		return $result;
	}


	public static function row_property($_data)
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
				case 'properties':
					$result[$key] = json_decode($value, true);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}



		return $result;
	}



	private static function fix_parent_detail(&$result)
	{
		if(!isset($result['parent_json']))
		{
			$result['parent_json'] = [];
		}

		if(!$result['parent_json'] || !is_array($result['parent_json']))
		{
			$result['parent_json'] = [];
		}

		$parent_json = $result['parent_json'];

		$new_title = [];
		$new_slug = [];

		foreach ($parent_json as $key => $value)
		{
			if(isset($result['parent1']) && $result['parent1'] && isset($value['id']) && floatval($value['id']) === floatval($result['parent1']))
			{
				$new_slug[0]  = $value['slug'];
				$new_title[0] = $value['title'];
			}

			if(isset($result['parent2']) && $result['parent2'] && isset($value['id']) && floatval($value['id']) === floatval($result['parent2']))
			{
				$new_slug[1]  = $value['slug'];
				$new_title[1] = $value['title'];
			}

			if(isset($result['parent3']) && $result['parent3'] && isset($value['id']) && floatval($value['id']) === floatval($result['parent3']))
			{
				$new_slug[2]  = $value['slug'];
				$new_title[2] = $value['title'];
			}
		}

		ksort($new_slug);
		ksort($new_title);

		$implode = \dash\language::dir() === 'ltr' ? ' <- ' : ' -> ';

		$result['parent_slug']  = implode('/', $new_slug);
		$result['parent_title'] = implode($implode, $new_title);


		$new_title[]     = $result['title'];
		$new_slug[]      = $result['slug'];


		$new_title       = implode($implode, $new_title);
		$new_slug        = implode('/', $new_slug);

		$result['full_slug']  = $new_slug;
		$result['full_title'] = $new_title;
	}
}
?>