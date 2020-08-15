<?php
declare(strict_types=1);

namespace Khue\MessageQueueDemo\Queue;

/**
 * Interface MessageInterface
 * @package Khue\MessageQueueDemo\Queue
 */
interface MessageInterface
{
    /**
     * @return string|null
     */
    public function getText(): ?string;

    /**
     * @param string|null $text
     * @return mixed
     */
    public function setText(?string $text);
}