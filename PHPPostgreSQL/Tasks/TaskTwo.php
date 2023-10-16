<?php

namespace AppPHP\Tasks;

use AppPHP\DB\Connection;

class TaskTwo extends Connection
{
    private string $tableName = 'tests';

    public function __construct()
    {
        echo '<h1>Task Two</h1><br>';

        // TODO: расскоментировать, чтобы создать таблицу и забить данными (500_000 записей)
        // $this->createTestTable();
        $this->getResult();
    }

    private function getResult(): void
    {
        $query = "ALTER TABLE {$this->tableName}
            ADD field1 smallint default null,
            ADD field2 smallint default null,
            ADD field3 smallint default null";
        $this->sendQuery($query);

        $query = "ALTER TABLE {$this->tableName}
            RENAME COLUMN name TO name1";
        $this->sendQuery($query);

        $query = "CREATE INDEX idx_name1 ON {$this->tableName} USING btree (name1);";
        $query .= "CREATE INDEX idx_field1 ON {$this->tableName} USING btree (field1);";
        $this->sendQuery($query);
    }

    private function createTestTable(): void
    {
        $query = "CREATE TABLE If NOT EXISTS {$this->tableName}
                (
                    id   int         not null primary key,
                    name varchar(50) not null
                )";
        $this->sendQuery($query);

        for ($j = 1; $j < 500; $j++) {
            $maxId = $this->select("SELECT MAX(id) FROM {$this->tableName}")[0]['max'] ?? 0;
            $insertQuery = '';
            for ($i = $maxId + 1; $i < $maxId + 1000; $i++) {
                $insertQuery .= "INSERT INTO {$this->tableName} (id, name) VALUES ($i, $i);\n";
            }
            $this->sendQuery($insertQuery);
        }
    }
}
