<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Admins\Admins;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Model\Sessions;

    class AuthtokenAdmin
    {
        /**
         * @param $request
         * @param Closure $next
         *
         * @return \Illuminate\Http\JsonResponse|mixed
         */
        public function handle($request, Closure $next)
        {
            try{
                if(!Sessions::check_exists_session_data()){
                    throw new Exception();
                }
                if(!Sessions::check_type_session('admins_id')){
                    throw new Exception();
                }
                $admins_data = Sessions::where('sessions.token','=',Sessions::get_token())
                    ->leftJoin('admins','sessions.admins_id','=','admins.id')
                    ->select('admins.*')
                    ->first();
                $request->acc_data = $admins_data;
                $request->acc_type = 'admin';

//                //Set Name Role
//                Config::set('app.admin_name', $request->acc_data->name);
//                if($request->acc_data->role=='opm'){
//                    $role = 'Operation manager';
//                }else{
//                    $expl = explode('_',$request->acc_data->role);
//                    $role = ucfirst($expl[0]);
//                    if(!empty($expl[1])){
//                        $role.=' '.$expl[1];
//                    }
//                }
//                Config::set('app.admin_role', $role);
//                Config::set('app.admin_id', $request->acc_data->id);
//                Config::set('app.admin_users_id', $request->acc_data->users_id);
                return $next($request);
            }catch (Exception $e){
                return redirect('/login');
            }
        }


    }