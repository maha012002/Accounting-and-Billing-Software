<?php
class Tags
{
    public static function save($tags = [], $type = 'Contacts')
    {
        if (is_array($tags)) {
            foreach ($tags as $element) {
                $tg = ORM::for_table('sys_tags')
                    ->where('text', $element)
                    ->where('type', $type)
                    ->find_one();
                if (!$tg) {
                    $tc = ORM::for_table('sys_tags')->create();
                    $tc->text = $element;
                    $tc->type = $type;
                    $tc->save();
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public static function get_all($type = 'Contacts')
    {
        return ORM::for_table('sys_tags')
            ->where('type', $type)
            ->find_many();
    }
}
