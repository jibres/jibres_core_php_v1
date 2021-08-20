<?php
namespace content_site\assemble;


class fire
{

	public static function me($_args)
	{
		if(array_key_exists('coverratio', $_args))
		{
			$_args['coverratio:class'] = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		}

		if(array_key_exists('radius', $_args))
		{
			$_args['radius:class'] = \content_site\options\radius\radius_full::class_name(a($_args, 'radius'));
		}

		$_args['font:class'] = \content_site\assemble\font::class($_args);

		if(array_key_exists('height', $_args))
		{
			$_args['height:class'] = \content_site\options\height::class_name(a($_args, 'height'));
		}

		$_args['background:style']      = \content_site\assemble\background::style($_args);
		$_args['background:full_style'] = " style='".$_args['background:style']."'";

		$_args['text_color:style']      = \content_site\assemble\text_color::style($_args);
		$_args['text_color:full_style'] = " style='".$_args['text_color:style']."'";

		$_args['secition:id']           = \content_site\assemble\tools::section_id(a($_args, 'type'), a($_args, 'id'));

		$_args['heading:class']         = \content_site\options\heading\heading_full::class_name($_args);

		return $_args;


	}
}
?>