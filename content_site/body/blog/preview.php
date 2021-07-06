<?php
namespace content_site\body\blog;


class preview
{

	public static function preview_1()
	{
		return
		[
			'type' => 'type_1',
		];
	}


	public static function preview_gradient_1()
	{
		return
		[
			"type"          => "type_1",
			"heading"       => "daadPost blog",
			"post_template" => "standard",
			"background"    =>
		    [
				"background_pack"          => "gradient",
				"background_gradient_from" => "green-500",
				"background_gradient_via"  => "white",
				"background_gradient_to"   => "red-500",
				"background_gradient_type" => "gradient-to-b",
				"background_opacity"       => "100"
		    ],
		    "height" => "sm"
		];
	}



}
?>