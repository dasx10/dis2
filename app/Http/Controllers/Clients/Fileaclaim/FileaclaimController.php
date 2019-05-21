<?php

    namespace App\Http\Controllers\Clients\Fileaclaim;
    use App\Model\Notifications\Notifications;
    use App\Model\Orders\Orders;
    use App\Model\Sessions;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Fileaclaim\Fileaclaim;
    use App\Model\Fileaclaim\FileaclaimFiles;

    class FileaclaimController extends Controller{
        private $file_a_claim_model,$order_model,$data;

        /**
         * AdminsController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->file_a_claim_model = new Fileaclaim();
            $this->order_model = new Orders();
            $this->data = $request->post();
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function main_view(Request $request){
            //Get Data
            $claims = $this->file_a_claim_model->get_claims($request->acc_data->id);
            $orders = $this->order_model->get_order_by_users_id($request->acc_data->id);

            return view('user.file_a_claim',[
                'claims' => $claims,
                'orders' => $orders,
                'token' => Sessions::get_token()
            ]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function create_claim(Request $request){
            $claims_id = $this->file_a_claim_model->create_new($request->insert_data);

            if(!empty($request->file('images'))) {
                $this->file_a_claim_model->file_a_claim_files_model->create_new($claims_id, $request->file('images'), 'images');
            }
            if(!empty($request->file('imagesvideos'))) {
                $this->file_a_claim_model->file_a_claim_files_model->create_new($claims_id, $request->file('imagesvideos'), 'imagesvideos');
            }

            //Notifications Create
            Notifications::create(['title' => 'File a claim','message' => 'You have a new claim','is_new' => 1, 'is_view' => 1, 'src' => asset('/panel/admin/clients/view/'.$request->acc_data->id)]);

            return response()->json([
                'success' => true,
                'message' => 'Success created claim'
            ],200);
        }


        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->file_a_claim_model);
            unset($this->order_model);
            unset($this->data);
        }
    }
