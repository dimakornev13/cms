<?php

namespace App\Services\Logs;

use DB;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class MysqlHandler extends AbstractProcessingHandler
{
    protected function write(array $record):void
    {
        $record['context']['request'] = [
            'headers' => (array)request()->headers,
            'cookies' => (array)request()->cookies,
            'server' => (array)request()->server,
            'json' => (array)request()->json,
            'attributes' => (array)request()->attributes,
            'request' => (array)request()->request,
            'query' => (array)request()->query,
        ];

        $data = [
            'instance'    => gethostname(),
            'message'     => $record['message'],
            'channel'     => $record['channel'],
            'level'       => $record['level'],
            'level_name'  => $record['level_name'],
            'context'     => json_encode($record['context']),
            'created_at'  => $record['datetime']->format('Y-m-d H:i:s')
        ];

        DB::connection(config('DB_CONNECTION', 'mysql'))
            ->table('logs')
            ->insert($data);
    }
}
