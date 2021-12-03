<?php
namespace content_site\options\image;


class image_mask
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'none', 	     	   'title' => T_('None'),                'class' => ''];
		$enum[] = ['key' => 'squircle', 		   'title' => T_('Squircle'),            'class' => 'mask mask-squircle'];
		$enum[] = ['key' => 'heart', 			     'title' => T_('Heart'),               'class' => 'mask mask-heart'];
		$enum[] = ['key' => 'hexagon', 		     'title' => T_('Hexagon'),             'class' => 'mask mask-hexagon'];
		$enum[] = ['key' => 'hexagon-2', 		   'title' => T_('Hexagon'). ' 2',       'class' => 'mask mask-hexagon-2'];
		$enum[] = ['key' => 'decagon', 		     'title' => T_('Decagon'),             'class' => 'mask mask-decagon'];
		$enum[] = ['key' => 'pentagon', 		   'title' => T_('Pentagon'),            'class' => 'mask mask-pentagon'];
		$enum[] = ['key' => 'diamond', 		     'title' => T_('Diamond'),             'class' => 'mask mask-diamond'];
		$enum[] = ['key' => 'square', 			   'title' => T_('Square'),              'class' => 'mask mask-square'];
		$enum[] = ['key' => 'circle', 			   'title' => T_('Circle'),              'class' => 'mask mask-circle'];
		$enum[] = ['key' => 'parallelogram', 	 'title' => T_('Parallelogram'),       'class' => 'mask mask-parallelogram'];
		$enum[] = ['key' => 'parallelogram-2', 'title' => T_('Parallelogram'). ' 2', 'class' => 'mask mask-parallelogram-2'];
		$enum[] = ['key' => 'parallelogram-3', 'title' => T_('Parallelogram'). ' 3', 'class' => 'mask mask-parallelogram-3'];
		$enum[] = ['key' => 'parallelogram-4', 'title' => T_('Parallelogram'). ' 4', 'class' => 'mask mask-parallelogram-4'];
		$enum[] = ['key' => 'star', 			     'title' => T_('Star'),                'class' => 'mask mask-star'];
		$enum[] = ['key' => 'star-2', 			   'title' => T_('Star'). ' 2',          'class' => 'mask mask-star-2'];
		$enum[] = ['key' => 'triangle', 		   'title' => T_('Triangle'),            'class' => 'mask mask-triangle'];
		$enum[] = ['key' => 'triangle-2', 		 'title' => T_('Triangle'). ' 2',      'class' => 'mask mask-triangle-2'];
		$enum[] = ['key' => 'triangle-3', 		 'title' => T_('Triangle'). ' 3',      'class' => 'mask mask-triangle-3'];
		$enum[] = ['key' => 'triangle-4', 		 'title' => T_('Triangle'). ' 4',      'class' => 'mask mask-triangle-4'];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Mask')]);
	}


	public static function default()
	{
		return 'm';
	}


	public static function class_name($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
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
			$default = static::default();
		}

		$title = T_("Image mask");

		$html = '';

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, $title);
		}
  		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>