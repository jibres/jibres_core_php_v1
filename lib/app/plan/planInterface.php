<?php

namespace lib\app\plan;


interface planInterface
{
    public function name(): string;

    public function title(): string;

    public function price(): int;
}