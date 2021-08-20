<?php
namespace content_site\options\image;


class image_mask
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'mask', 				'title' => 'mask', 'class' => 'mask'];
		$enum[] = ['key' => 'mask-squircle', 		'title' => 'mask-squircle', 'class' => 'mask-squircle'];
		$enum[] = ['key' => 'mask-heart', 			'title' => 'mask-heart', 'class' => 'mask-heart'];
		$enum[] = ['key' => 'mask-hexagon', 		'title' => 'mask-hexagon', 'class' => 'mask-hexagon'];
		$enum[] = ['key' => 'mask-hexagon-2', 		'title' => 'mask-hexagon-2', 'class' => 'mask-hexagon-2'];
		$enum[] = ['key' => 'mask-decagon', 		'title' => 'mask-decagon', 'class' => 'mask-decagon'];
		$enum[] = ['key' => 'mask-pentagon', 		'title' => 'mask-pentagon', 'class' => 'mask-pentagon'];
		$enum[] = ['key' => 'mask-diamond', 		'title' => 'mask-diamond', 'class' => 'mask-diamond'];
		$enum[] = ['key' => 'mask-square', 			'title' => 'mask-square', 'class' => 'mask-square'];
		$enum[] = ['key' => 'mask-circle', 			'title' => 'mask-circle', 'class' => 'mask-circle'];
		$enum[] = ['key' => 'mask-parallelogram', 	'title' => 'mask-parallelogram', 'class' => 'mask-parallelogram'];
		$enum[] = ['key' => 'mask-parallelogram-2', 'title' => 'mask-parallelogram-2', 'class' => 'mask-parallelogram-2'];
		$enum[] = ['key' => 'mask-parallelogram-3', 'title' => 'mask-parallelogram-3', 'class' => 'mask-parallelogram-3'];
		$enum[] = ['key' => 'mask-parallelogram-4', 'title' => 'mask-parallelogram-4', 'class' => 'mask-parallelogram-4'];
		$enum[] = ['key' => 'mask-star', 			'title' => 'mask-star', 'class' => 'mask-star'];
		$enum[] = ['key' => 'mask-star-2', 			'title' => 'mask-star-2', 'class' => 'mask-star-2'];
		$enum[] = ['key' => 'mask-triangle', 		'title' => 'mask-triangle', 'class' => 'mask-triangle'];
		$enum[] = ['key' => 'mask-triangle-2', 		'title' => 'mask-triangle-2', 'class' => 'mask-triangle-2'];
		$enum[] = ['key' => 'mask-triangle-3', 		'title' => 'mask-triangle-3', 'class' => 'mask-triangle-3'];
		$enum[] = ['key' => 'mask-triangle-4', 		'title' => 'mask-triangle-4', 'class' => 'mask-triangle-4'];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Mask')]);
	}


	public static function default()
	{
		return 'm';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
				{
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
				}
			}
		}
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('image_mask');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Image mask");

		$html = '';

		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='image_mask'>$title</label>";

	        $html .= '<select name="opt_image_mask" class="select22" id="image_mask" data-placeholder="'. T_("Select hashtag"). '">';


	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';


		return $html;

	}
}
?>