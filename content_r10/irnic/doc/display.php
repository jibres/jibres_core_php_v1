<?php
foreach (\dash\data::projectDoc() as $key => $value)
{
    require_once($value);
}
?>


