<?php

namespace App\Services;

use Aws\Laravel\AwsFacade as AWS;

class IoTService
{
    public function publishMessage(string $payload): void
    {
        $iot = AWS::createClient('iotdataplane');
        $iot->publish([
            'payload' => $payload,
            'retain' => false,
            'qos' => 1,
            'topic' => 'ecoWise/0001/sub',
        ]);
    }
}
