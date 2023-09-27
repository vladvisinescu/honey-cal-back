<?php

namespace HoneyCal\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}
