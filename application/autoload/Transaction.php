<?php

class Transaction
{
    public static function deposit($data = [])
    {
    }

    public static function delete($id)
    {
        //find the transaction
        $t = ORM::for_table('sys_transactions')->find_one($id);
        if ($t) {
            $a = ORM::for_table('sys_accounts')
                ->where('account', $t['account'])
                ->find_one();
            $cr = $t['cr'];
            $dr = $t['dr'];
            if ($a) {
                $cbal = $a['balance'];
                if ($cr != '0.00') {
                    $nbal = $cbal - $cr;
                } else {
                    $nbal = $cbal + $dr;
                }
                $a->balance = $nbal;
                $a->save();
            }

            $t->delete();
            return true;
        } else {
            return false;
        }

        //        if($t){
        //            //find affected rows
        //            $d = ORM::for_table('sys_transactions')->where_gt('id',$id)->where('account',$t['account'])->find_many();
        //
        //        }
    }
}
