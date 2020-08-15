# Message Queue Demo

Run the following commands:

1. ```bin/magento khue:message_queue:publish --text='Hello World'``` to send message with the text "Hello World" to queue
2. ```bin/magento queue:consumers:start khueQueueProcessor``` to consume the message from the queue

The consumed message will have its text data logged in ```var/log/system.log``` file.
