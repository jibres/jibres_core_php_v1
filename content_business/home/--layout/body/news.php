<?php
$blockData = \dash\app\posts\load::template($line_detail);

echo \lib\app\website\generator\datablock::html($line_detail, $blockData);
?>