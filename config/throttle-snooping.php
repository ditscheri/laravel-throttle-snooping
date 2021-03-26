<?php

return [
    'middleware' => ['web', 'api'],

    /**
     * Status codes that should trigger a throttle increment.
     */
    'status_codes' => [
        401, // Unauthorized - false positive: happens for expired sessions
        403, // Forbidden - this is the obvious one to track.
        404, // Not Found - e.g. trying to guess HashIds
    ],

    'limit' => 6,
];
