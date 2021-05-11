<?php
namespace content_a\products\share;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');

		// check load product detail
		if(!\lib\app\product\load::one())
		{
			\dash\header::status(404);
		}

		self::createMessageData();
	}


	public static function createMessageData()
	{
		$id = \dash\request::get('id');


		$property_list = \lib\app\product\property::get_pretty($id, true);
		if(isset($property_list['saved']))
		{
			$myProp = $property_list['saved'];
		}

		if(is_array($myProp) && count($myProp) > 0)
		{
			$seperatorLine = '————————————'. "\n";
			$propStr = $seperatorLine;
			$index = 0;
			// sort array
			// asort($myProp);
			foreach ($myProp as $key => $group)
			{
				$index ++;
				if($index === 1 )
				{
					continue;
				}

			  if(isset($group['title']))
			  {
			    if(is_array($group['list']))
			    {
			      $propStr .= '✅ '. $group['title'];
			      $propStr .= "\n";
			      $keyValue = '';
			      foreach ($group['list'] as $key2 => $item)
			      {
			        $keyValue .= \dash\fit::text($item['key']);
			        $keyValue .= ' <b>'. \dash\fit::text($item['value']). '</b>, ';
			      }
			      $keyValue = trim($keyValue, ', ');
			      $propStr .= $keyValue;
			      $propStr .= "\n". $seperatorLine;;
			    }
			  }
			}
			// $propStr .= "\n";
			\dash\data::propStr($propStr);
		}



		$cat_list = \lib\app\tag\get::product_cat($id);
		if(is_array($cat_list) && $cat_list)
		{
			$cat_list = array_column($cat_list, 'title');
		}
		else
		{
			$cat_list = [];
		}
		$catStr = '';
		foreach ($cat_list as $key => $value)
		{
			$tag = str_replace(' ', '_', $value);
			$catStr .= '#'. $tag. ' ';
		}
		$catStr = trim($catStr);
		\dash\data::catStr($catStr);
	}
}
?>
