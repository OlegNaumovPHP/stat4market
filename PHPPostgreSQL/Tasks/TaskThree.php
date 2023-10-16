<?php

namespace AppPHP\Tasks;

use AppPHP\DB\Connection;

class TaskThree extends Connection
{
    public function __construct()
    {
        echo '<h1>Task Three</h1><br>';

        $this->getCountSearchWeeksDayInPeriod();
    }

    private function getCountSearchWeeksDayInPeriod(int $searchDay = 2 /* Вторник */, string $startDate = '2022-10-10', string $finalDate = '2023-10-10'): void
    {
        $firstDay = date('w', strtotime($startDate));

        $datediff = strtotime($finalDate) - strtotime($startDate);
        $daysInterval = floor($datediff / (60 * 60 * 24));
        $count = floor($daysInterval / 7);
        $remainderDays = $daysInterval % 7;
        if ($firstDay <= $searchDay && $searchDay <= ($firstDay + $remainderDays)) {
            $count++;
        }

        echo "В промежутке с {$startDate} по {$finalDate} насчитывается {$count} искомых дней недели";
    }
}
