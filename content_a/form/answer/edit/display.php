<?php
$html = '';

$html .= \lib\app\form\generator::edit_html(\dash\request::get('id'), \dash\request::get('aid'));

echo $html;
?>