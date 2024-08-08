<?php

namespace App\Common\Processor;

class BaseProcessor implements ProcessorInterface
{
    private array $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function process(mixed &$data): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($data)) {
                $handler->handle($data);
            }
        }
    }
}