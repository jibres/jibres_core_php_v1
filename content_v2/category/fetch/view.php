<?php
namespace content_v2\category\fetch;


class view
{

	public static function config()
	{
		$meta = [];
		$meta['parent1'] = null;
		$meta['parent2'] = null;
		$meta['parent3'] = null;

		$list = \lib\app\category\search::list(\dash\request::get('q'), $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['self', 'ready'], $list);

		\content_v2\tools::say($list);

	}


	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'title':
				case 'slug':
				case 'language':
				case 'desc':
				case 'seotitle':
				case 'seodesc':
				case 'file':
				case 'count':
				case 'parent_slug':
				case 'parent_title':
				case 'full_slug':
				case 'full_title':
				case 'have_child':
				case 'have_product':
					$result[$key] = $value;
					break;

				default:
					// nothing
					break;
			}
		}

		return $result;
	}
}
?>