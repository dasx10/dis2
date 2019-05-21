<?php
    /**
     * Created by PhpStorm.
     * User: Bogdan
     * Date: 15.01.2018
     * Time: 10:54
     */

    namespace App\Http\Controllers\oAuth\Clients;

    use App\Http\Controllers\Controller;
    use App\Model\Clients\ClientsData;
    use App\Model\Sessions;
    use Illuminate\Http\Request;
    use App\Model\Clients\Clients;
    use Illuminate\Support\Facades\Mail;
    use App\Model\InviteLinks\InviteLinks;

    class RegisterController extends Controller{
        private $users_model,$data;


        /**
         * RegisterController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->users_model = new Clients();
            $this->data = $request->post();
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(Request $request){
            //Creating User
            $users_id = $this->users_model->create_users($request->created_by);
            $request->insert_data['users_id'] = $users_id;
            $this->users_model->users_data_model->create_users_data($request->insert_data);

            InviteLinks::create_invite(['token'=>InviteLinks::generate_token(),'users_id'=>$users_id]);

            //Send Email
            $text = "Dear ".$this->data['contact_name']."<br><br>";
            $text .= "Now you are registered on <a href='".asset('/login')."'>system</a>.<br> Please use these credentials to login:<br><br>";
            $text.= "Login: ".$request->insert_data['email']."<br><br>";
            $text.= "Password: ".$request->full_pass."<br><br>";
            $text.="If you think this is a mistake contact us for further information.";
            Mail::send('email.lala', ['text'=>$text], function ($m) {
                $m->from('dis@yobibyte.in.ua', 'DIS');
                $m->to($this->data['email'])
                    ->cc('info@dis-company.com')
                    ->subject('DIS: account created');
            });

            return response()->json([
                'success' => true,
                'message' => 'success registered'
            ],200);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
         */
        public function clients_register_view(Request $request){
            if(InviteLinks::check_exists($request->token)) {
                return view('main.register', [
                    'token' => $request->token
                ]);
            }

            return redirect('/login');
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function confirm_password(){
            $users_data = InviteLinks::get_data(['users_id'],'token',$this->data['token']);
            $this->users_model->update_data(['password'=>md5($this->data['password'])],'users_id',$users_data->users_id);
            InviteLinks::delete_link($this->data['token']);

            return response()->json([
                'success' => true,
                'message' => 'Success add password'
            ],200);
        }

        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->users_model);
            unset($this->data);
        }

    }