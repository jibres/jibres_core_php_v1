<?php
namespace lib\app\plan;

interface plan 
{

    public function name(): string;


    public function title(): string;


    public function type(): string;


    public function description(): string;


    public function contain() : array;

}
