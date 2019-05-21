<?php
namespace App\Http\Middleware\Web;
use App\Model\Sessions;
use Illuminate\Support\Facades\DB;
use Closure;
use Exception;

const ERORRAccess = 'You do not have permission!';
class CheckRoleTypeAccess
{
    private static function get_type_of_admins($token){
        $data = DB::table('sessions')->where('token','=',$token)->join('admins','admins.id','=','sessions.admins_id')->select('admins.role')->first();
        return $data->role;
    }

    private static function get_admins_id_by_token($token){
        $data = DB::table('sessions')->where('token','=',$token)->first();
        return $data->admins_id;
    }
    public static function check_add_delete_admin(){
        $type_accept=['super_admin'];
        $type = self::get_type_of_admins(Sessions::get_token());
        if(!in_array($type,$type_accept)) {
            throw new Exception(ERORRAccess, 404);
        }
    }

    public static function check_edit_access($admins_id,$token,$role){
        $type_accept=['super_admin'];
        $curr_admin_id = self::get_admins_id_by_token($token);
        $curr_admin_type = self::get_type_of_admins($token);
        if(in_array($curr_admin_type,$type_accept)) {
            return false;
        }
        if($curr_admin_id!=$admins_id) {
            throw new Exception(ERORRAccess, 404);
        }elseif ($curr_admin_type!=$role){
            throw new Exception(ERORRAccess, 404);
        }
    }
}