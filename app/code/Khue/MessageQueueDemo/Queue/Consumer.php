<?php
declare(strict_types=1);

namespace Khue\MessageQueueDemo\Queue;

use Psr\Log\LoggerInterface;

/**
 * Class Consumer
 * @package Khue\MessageQueueDemo\Queue
 */
class Consumer
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param MessageInterface $message
     */
    public function process(MessageInterface $message)
    {
        if ($text = $message->getText()) {
            $this->logger->info("Queue text message: {$text}");
            return;
        }

        $this->logger->info("No queue text message received!");
    }
}