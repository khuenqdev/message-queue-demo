<?php
declare(strict_types=1);

namespace Khue\MessageQueueDemo\Queue;

/**
 * @inheritDoc
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @inheritDoc
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @inheritDoc
     */
    public function setText(?string $text)
    {
        $this->text = $text;

        return $this;
    }
}