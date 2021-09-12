<?php

$html = '';

$post_meta = \dash\data::currentPageDetail_meta();
$post_setting_preview = a($post_meta, 'preview');

\dash\temp::set('forceChangePreviewJsonFromPostMeta', $post_setting_preview);

$html .= \content_site\call_function::option_admin_html('font');
$html .= \content_site\call_function::option_admin_html('background_pack');

echo $html;
?>