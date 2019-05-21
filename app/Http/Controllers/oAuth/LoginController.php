<?php
namespace App\Http\Controllers\oAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sessions;

class LoginController extends Controller{
    private $data;

    /**
     * LoginController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request){
        $this->data = $request->post();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request){
        //Get Token
        $token = Sessions::generate_token_key();
        switch ($request->type_acc){
            case 'admin':
                $type = 'admin';
                Sessions::set_token_key($token,NULL,$request->acc_id);
            break;
            case 'user':
                $type = 'user';
                Sessions::set_token_key($token,$request->acc_id,NULL);
            break;
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'type' => $type
        ],200);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login_view(){
        if(!Sessions::check_exists_session_data()){
            return view('main.login');
        }

        if(Sessions::check_type_session('users_id')){
            return redirect('/panel/user');
        }
        return redirect('/panel/admin');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        Sessions::delete_key();
        return redirect('/login');
    }


    /**
     * Destruct
     */
    public function __destruct(){
        unset($this->data);
    }

}