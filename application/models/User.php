<?php
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'sys_users';
    public $timestamps = false;

    public static function _info(){

        if(!isset($_SESSION['uid'])){
            echo 'You have logged out. <a href="'.U.'login/">Click Here to Login.</a>';
            exit;
        }

        $id = $_SESSION['uid'];

        $d = ORM::for_table('sys_users')->find_one($id);



        return $d;
    }

}