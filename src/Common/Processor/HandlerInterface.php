<?php

namespace App\Common\Processor;

interface HandlerInterface
{
    public function handle(mixed &$data): void;

    public function supports(mixed $data): bool;
}