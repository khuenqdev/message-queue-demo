<?php
declare(strict_types=1);

namespace Khue\MessageQueueDemo\Console\Command;

use Khue\MessageQueueDemo\Queue\MessageInterfaceFactory;
use Magento\Framework\MessageQueue\PublisherInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PublishMessage
 * @package Khue\MessageQueueDemo\Console\Command
 */
class PublishMessage extends Command
{
    /**
     * @var PublisherInterface|null
     */
    protected $publisher;

    /**
     * @var MessageInterfaceFactory
     */
    protected $messageInterfaceFactory;

    public function __construct(
        PublisherInterface $publisher,
        MessageInterfaceFactory $messageInterfaceFactory,
        string $name = null
    ) {
        $this->publisher = $publisher;
        $this->messageInterfaceFactory = $messageInterfaceFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                'text',
                't',
                InputOption::VALUE_REQUIRED,
                'Text message to publish'
            )
        ];

        $this->setName('khue:message_queue:publish')
            ->setDescription('Publish a text message to message queue')
            ->setDefinition($options);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $input->getOption('text');

        if (!$text || '' === $text) {
            throw new \Exception("No text message was specified!");
        }

        // Create new message for queue
        $message = $this->messageInterfaceFactory->create();
        $message->setText($text);

        try {
            $this->publisher->publish('khue.mq.demo', $message);
            $output->writeln("<info>Sent message with text {$text} to Magento message queue!</info>");
        } catch (\Exception $e) {
            $output->writeln("Error when publishing message: {$e->getMessage()}");
        }
    }
}