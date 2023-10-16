<?php

namespace AppPHP\Tasks;

use AppPHP\DB\Connection;

class TaskOne extends Connection
{
    public function __construct()
    {
        echo '<h1>Task One</h1><br>';
        $this->exerciseOne();
        $this->exerciseTwo();
        $this->exerciseThree();
        $this->exerciseFour();
        $this->exerciseFive();
    }

    private function exerciseOne(): void
    {
        $query = 'SELECT * FROM users JOIN users as u ON users.id = u.invited_by_user_id AND u.posts_qty > users.posts_qty';

        echo "<h2>Exercise One</h2><b>Query: </b><pre>{$query}</pre><br><b>Result: </b>";
        vardump($this->select($query));
    }

    private function exerciseTwo(): void
    {

        $query = 'SELECT
                groups.name as group,
                users.*
            FROM users
                JOIN groups ON users.group_id = groups.id
            WHERE (group_id, posts_qty) 
                IN
                (   SELECT
                        group_id, MAX(posts_qty)
                    FROM
                        users
                    GROUP BY group_id
                )';

        echo "<h2>Exercise Two</h2><b>Query: </b><pre>{$query}</pre><br><b>Result: </b>";
        vardump($this->select($query));
    }

    private function exerciseThree(int $countUsers = 1000): void
    {
        $query = "SELECT groups.* FROM users JOIN groups ON users.group_id = groups.id GROUP BY users.group_id, groups.id HAVING count(users.*) > {$countUsers}";

        echo "<h2>Exercise Three</h2><b>Query: </b><pre>{$query}</pre><br><b>Result: </b>";
        vardump($this->select($query));
    }

    private function exerciseFour(): void
    {
        $query = 'SELECT * FROM users JOIN users as u ON users.id = u.invited_by_user_id AND u.group_id <> users.group_id';

        echo "<h2>Exercise Four</h2><b>Query: </b><pre>{$query}</pre><br><b>Result: </b>";
        vardump($this->select($query));
    }

    private function exerciseFive(): void
    {
        $query = 'WITH sum_posts_qty as
            (
                SELECT
                    groups.*,
                    sum(posts_qty) as posts_qty
                FROM users
                    JOIN groups ON users.group_id = groups.id
                GROUP BY
                    groups.id
            )

            SELECT
                spq.*
            FROM
                sum_posts_qty as spq       
            WHERE spq.posts_qty = (
                SELECT
                    max(posts_qty)
                FROM
                    sum_posts_qty
            )';

        echo "<h2>Exercise Five</h2><b>Query: </b><pre>{$query}</pre><br><b>Result: </b>";
        vardump($this->select($query));
    }
}
