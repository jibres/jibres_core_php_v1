<?php
namespace content_a\product\gallery;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Gallery product!'). ' | '. \dash\data::dataRow_title());
		\dash\data::page_desc(T_('Set image of product to show as gallery also you can set main photo for this product as thumbnail.'));
		\dash\data::page_pictogram('images');


		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		\dash\data::maxUploadSize(\dash\utility\upload::max_file_upload_size(true));
	}
}
?>
