<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "./index.php";

use PhpAmqpLib\Message\AMQPMessage;
use LeadGenerator\Generator;
use LeadGenerator\Lead;

$channel = $connection->channel();
$queue = "leads";
$channel->queue_declare($queue, false, false, false, false);

$generator = new Generator();

$generator->generateLeads(10000, function (Lead $lead) use ($channel, $queue) {
    $body = json_encode([
        'id' => $lead->id,
        'categoryName' => $lead->categoryName
    ]);

    $msg = new AMQPMessage($body);
    $channel->basic_publish($msg, '', $queue);
});

$channel->close();
$connection->close();
