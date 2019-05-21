<?php
    /**
     * Created by PhpStorm.
     * User: Bogdan
     * Date: 15.01.2018
     * Time: 10:54
     */

    namespace App\Http\Controllers\oAuth\Admin;

    use App\Http\Controllers\Controller;
    use App\Model\Clients\Clients;
    use Illuminate\Http\Request;
    use App\Model\Admins\Admins;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;

    class RegisterController extends Controller{
        private $admin_model,$data;

        /**
         * RegisterController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->admin_model = new Admins;
            $this->data = $request->post();
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(Request $request){
            //Creating
           $insertData = $request->only('name', 'email', 'role', 'regione');
            $usersObj = Clients::create([
                'type_acc' => 'admin'
            ]);
            $insertData['users_id'] = $usersObj->id;
            $insertData['password'] = md5($request->post('password'));
            $insertData['created_at'] = time();
            $insertData['updated_at'] = time();
//            $this->admin_model->create_new_admin($insertData);
            DB::table('admins')->insert($insertData);
            return response()->json([
                'success' => true,
                'message' => 'Success'
            ],200);
        }

        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->admin_model);
            unset($this->data);
        }

    }