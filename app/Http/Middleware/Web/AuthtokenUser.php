<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Model\Sessions;

    class AuthtokenUser
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
                $data = $request->post();
                if(!Sessions::check_exists_session_data()){
                    throw new Exception();
                }elseif(!Sessions::check_type_session('users_id')){
                    throw new Exception();
                }

                $users_data = Sessions::where('sessions.token','=',Sessions::get_token())
                    ->leftJoin('users_data as ud','sessions.users_id','=','ud.users_id')
                    ->select('ud.*','ud.id as id2','ud.users_id as id')
                    ->first();

                $request->acc_data = $users_data;
                $request->acc_type = 'user';
                return $next($request);
            }catch (Exception $e){
                return redirect('/login');
            }
        }


    }