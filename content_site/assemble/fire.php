<?php
namespace content_site\assemble;


class fire
{

	public static function me($_args)
	{
		if(array_key_exists('coverratio', $_args))
		{
			$_args['coverratio:class'] = \content_site\options\coverratio\coverratio::get_class(a($_args, 'coverratio'));
		}

		if(array_key_exists('radius', $_args))
		{
			$_args['radius:class'] = \content_site\options\radius\radius_full::class_name(a($_args, 'radius'));
		}

		if(array_key_exists('image_mask', $_args))
		{
			$_args['image_mask:class'] = \content_site\options\image\image_mask::class_name(a($_args, 'image_mask'));
		}

		if(array_key_exists('height', $_args))
		{
			$_args['height:class'] = \content_site\options\height\height::class_name(a($_args, 'height'));
		}

		if(array_key_exists('height', $_args))
		{
			$_args['height:class:wo_padding'] = \content_site\options\height\height::class_name_wo_padding(a($_args, 'height'));
		}

		if(array_key_exists('container', $_args))
		{
			$_args['container:class'] = \content_site\options\container\container_gallery::class_name(a($_args, 'container'));
		}

		if(array_key_exists('magicbox_gap', $_args))
		{
			$_args['magicbox_gap:class'] = \content_site\options\magicbox\magicbox_gap::class_name(a($_args, 'magicbox_gap'));
		}

		if(array_key_exists('container_align', $_args))
		{
			$_args['container_align:class'] = \content_site\options\container\container_align::class_name(a($_args, 'container_align'));
		}

		if(array_key_exists('container_justify', $_args))
		{
			$_args['container_justify:class'] = \content_site\options\container\container_justify::class_name(a($_args, 'container_justify'));
		}

		// maybe all section have this variable

		$_args['font:class']            = \content_site\assemble\font::class($_args);

		$_args['background:style']      = \content_site\assemble\background::style($_args);
		$_args['background:full_style'] = " style='".$_args['background:style']."'";

		$_args['color_text:style']      = \content_site\assemble\color::style($_args, 'color_text');
		$_args['color_text:full_style'] = " style='".$_args['color_text:style']."'";

		$_args['color_heading:style']      = \content_site\assemble\color::style($_args, 'color_heading');
		$_args['color_heading:full_style'] = " style='".$_args['color_heading:style']."'";

		$_args['section:id']           = \content_site\assemble\tools::section_id(a($_args, 'model'), a($_args, 'id'));

		$_args['heading:class']         = \content_site\options\heading\heading_full::class_name($_args);

		return $_args;


	}



	/**
	 * Ready store logo, name and description
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function store_detail($_args)
	{

		if(a($_args, 'use_as_logo')   === 'business_logo')
		{
			$_args['logo'] = \lib\store::logo();
		}

		if(a($_args, 'logo'))
		{
			$_args['logo'] = \lib\filepath::fix($_args['logo']);
		}

		if(a($_args, 'use_as_heading')       === 'business_heading')
		{
			$_args['heading'] = \lib\store::title();
		}

		if(a($_args, 'use_as_description')   === 'business_description')
		{
			$_args['description'] = \lib\store::desc();
		}

		return $_args;

	}


	/**
	 * Ready store social networks
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function store_social($_args)
	{
		$social = \lib\store::all_social_list();

		foreach ($social as $key => $value)
		{
			if(a($_args, 'use_as_socialnetwork') === 'business_socialnetwork')
			{
				$my_social = \lib\store::social($key);
				if($my_social)
				{
					$_args[$key] = a($my_social, 'user');
				}
				else
				{
					$_args[$key] = null;
				}
			}

			if(a($_args, $key))
			{
				$_args[$key] = array_merge($value, ['user' => $_args[$key], 'link' => a($value, 'link'). $_args[$key]]);
			}
		}

		return $_args;
	}

}
?>