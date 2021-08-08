<?php
$preview  = \dash\data::myPreviewDetail();
$html = '';
$html .= a($preview, 'preview_html');
echo $html;
?>