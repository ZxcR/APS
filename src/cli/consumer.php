<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "./index.php";

use LeadGenerator\Lead;

$channel = $connection->channel();
$channel->queue_declare('leads', false, false, false, false);
$lead = new Lead();

$callback = function ($msg) use ($lead) {
    sleep(2);

    $file = "/var/www/html/log/log.txt";
    $body = json_decode($msg->body);

    $lead->id = $body->id;
    $lead->categoryName = $body->categoryName;

    try {
        // imagine if Learning category can't be processed
        if($lead->categoryName == "Learning") {
            throw new Exception("Something went wrong");
        }
        file_put_contents($file, $lead->id . " | " . $lead->categoryName . " | " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        $msg->ack();
    } catch (Exception $e) {
        $msg->reject();
        //reject or send to dead letters queue
    }
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('leads', '', false, false, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}
