<?php
class Models_Role extends Model
{
    public static $_table = 'sys_roles';

    public static function isExist($name)
    {
        return ORM::for_table(self::$_table)
            ->where('rname', $name)
            ->find_one();
    }
}
