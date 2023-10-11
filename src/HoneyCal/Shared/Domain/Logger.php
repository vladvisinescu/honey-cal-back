<?php

namespace HoneyCal\Shared\Domain;

interface Logger
{
    public function info(string $message, array $context = []): void;

    public function warning(string $message, array $context = []): void;

    public function critical(string $message, array $context = []): void;
}
