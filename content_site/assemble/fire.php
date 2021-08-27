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

		if(array_key_exists('container', $_args))
		{
			$_args['container:class'] = \content_site\options\container\container_gallery::class_name(a($_args, 'container'));
		}

		if(array_key_exists('magicbox_gap', $_args))
		{
			$_args['magicbox_gap:class'] = \content_site\options\magicbox\magicbox_gap::class_name(a($_args, 'magicbox_gap'));
		}
		// maybe all section have this variable

		$_args['font:class']            = \content_site\assemble\font::class($_args);

		$_args['background:style']      = \content_site\assemble\background::style($_args);
		$_args['background:full_style'] = " style='".$_args['background:style']."'";

		$_args['color_text:style']      = \content_site\assemble\color::style($_args, 'color_text');
		$_args['color_text:full_style'] = " style='".$_args['color_text:style']."'";

		$_args['color_heading:style']      = \content_site\assemble\color::style($_args, 'color_heading');
		$_args['color_heading:full_style'] = " style='".$_args['color_heading:style']."'";

		$_args['secition:id']           = \content_site\assemble\tools::section_id(a($_args, 'model'), a($_args, 'id'));

		$_args['heading:class']         = \content_site\options\heading\heading_full::class_name($_args);

		return $_args;


	}



}
?>