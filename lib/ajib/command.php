<?php
namespace lib\ajib;


interface command
{
    public function execute(array $_args) : void;
}