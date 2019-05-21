<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;

    class DefaultValidation
    {

        public static function check_token($token){
            $data = DB::table('sessions')->where('token','=',$token)->exists();
            if(!$data){
                throw new Exception("Token not found!", 404);
            }
        }

    }