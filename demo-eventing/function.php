<?php

function hanlder($eventData)
{
    return [
        'statusCode' => 200,
        'body' => \json_encode([
            'blar' => 'foobar',
            'incoming_event' => $eventData,
        ]),
    ];
}
