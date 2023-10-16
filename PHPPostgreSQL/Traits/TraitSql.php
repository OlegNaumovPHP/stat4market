<?php

namespace AppPHP\Traits;

trait TraitSql
{
    public function getDefaultQueries(): array
    {
        return [
            'create_groups_table' => 'create table groups
                (
                    id   int         not null primary key,
                    name varchar(50) not null
                )',

            'create_users_table' => 'create table users
                (
                    id                      int         not null primary key,
                    group_id                int         not null,
                    invited_by_user_id      int         not null,
                    name                    varchar(50) not null,
                    posts_qty               int         not null,
                    constraint fk_users_group_id
                        foreign key(group_id) references groups(id)
                            on update cascade on delete cascade
                )',

            'filling_groups_table' => "insert into groups 
                    (id, name)
                values
                    (1, 'Группа 1'),
                    (2, 'Группа 2')",

            'filling_users_table' => "insert into users
                    (id, group_id, invited_by_user_id, name, posts_qty)
                values
                    (1, 1, 0, 'Пользователь 1', 0),
                    (2, 1, 1, 'Пользователь 2', 2),
                    (3, 1, 2, 'Пользователь 3', 5),
                    (4, 2, 3, 'Пользователь 4', 7),
                    (5, 2, 4, 'Пользователь 5', 1)",
        ];
    }
}
