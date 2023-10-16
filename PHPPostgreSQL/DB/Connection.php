<?php

namespace AppPHP\DB;

class Connection
{
    protected static $connection;

    public function __construct()
    {
        self::$connection ??= pg_connect("host=127.0.0.1 port=5432 dbname=stat4market user=postgres password=")
            or die("Can't connect to database" . pg_last_error());
    }

    protected function sendQuery(string $query): void
    {
        if (!pg_connection_busy(self::$connection)) {
            pg_send_query(self::$connection, $query);
        } else {
            pg_connection_reset(self::$connection);
            pg_send_query(self::$connection, $query);
        }
    }

    protected function select(string $query)
    {
        $this->sendQuery($query);

        $request = pg_get_result(self::$connection);
        $result = [];
        while ($row = pg_fetch_array($request)) {
            $result[] = $row;
        }

        return $result;
    }
}
