<?php

\content_site\load\load::detect_header();

$website_header = \dash\data::website_header();

echo a($website_header, 'body_layout');

?>