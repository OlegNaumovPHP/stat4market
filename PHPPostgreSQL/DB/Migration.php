<?php

namespace AppPHP\DB;

use AppPHP\DB\Connection;
use AppPHP\Traits\TraitSql;

class Migration extends Connection
{
    use TraitSql;

    public function __construct()
    {
        $this->execute();
    }

    private function execute(): void
    {
        $sqlRequests = $this->getDefaultQueries();

        foreach ($sqlRequests as $sql) {
            $this->sendQuery($sql);
        }

        header('Location: index.php');
    }
}
