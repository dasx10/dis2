<?php

    namespace App\Http\Controllers\Admins\Clients;

    use App\Model\Admins\Admins;
    use App\Model\Basket\Basket;
    use App\Model\Brands\Brands;
    use App\Model\Clients\ClientsAccessBrands;
    use App\Model\Clients\ClientsData;
    use App\Model\Clients\ClientsNotes;
    use App\Model\Fileaclaim\Fileaclaim;
    use App\Model\Fileaclaim\FileaclaimFiles;
    use App\Model\Logs\Logs;
    use App\Model\Orders\Orders;
    use App\Model\Points\Points;
    use App\Model\Products\Products;
    use App\Model\Sessions;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Clients\Clients;

    class ClientsController extends Controller{
        private $clients_model,$data;

        /**
         * AdminsController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->clients_model = new Clients;
            $this->data = $request->post();
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function clients_main_view(Request $request){
            return view('admin.clients',[
                'token' => Sessions::get_token(),
                'admin_role' => $request->acc_data->role
            ]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function search_user(Request $request){
            $admins_data = Admins::where('id','=',$request->acc_data->id)->select('role','regione')->first();
            if ($request->type == 'all') {
                $data = ClientsData::select('company_name', 'users_id')->where('can_see','=',1);
            } elseif ($request->type == 'first') {
                $data = ClientsData::where('company_name', 'LIKE', $request->text . '%')->select('company_name', 'users_id')->where('can_see','=',1);
            }elseif($request->type == 'rc'){
                $arr_expl = explode(',',$request->text);
                if($arr_expl[0]=='ANY' && $arr_expl[1]!='ANY'){
                    $data = ClientsData::where('country','=',$arr_expl[1])->select('company_name', 'users_id')->where('can_see','=',1);
                }elseif ($arr_expl[1]=='ANY' && $arr_expl[0]!='ANY'){
                    $data = ClientsData::where('regione','=',$arr_expl[0])->select('company_name', 'users_id')->where('can_see','=',1);
                }elseif ($arr_expl[0]!='ANY' && $arr_expl[1]!='ANY'){
                    $data = ClientsData::where('regione','=',$arr_expl[0])->where('country','=',$arr_expl[1])->select('company_name', 'users_id')->where('can_see','=',1);
                }else{
                    $data = ClientsData::select('company_name', 'users_id')->where('can_see','=',1);
                }
            } else{
                $data = ClientsData::where('company_name', 'LIKE', '%'.$request->text . '%')->select('company_name', 'users_id')->where('can_see','=',1);
            }
            if(!empty($request->sort)){
                $data = $data->orderBy($request->sort,'DESC');
            }
            if($admins_data->role=='sales'){
                $data = $data->where('regione','=',$admins_data->regione);
            }
            $data = $data->get();
            $data = $this->clients_model->search_filter($data);
            return response()->json($data,200);
        }


        public function client_edit_view($users_id,Request $request){
            if($clients_data = $this->clients_model->check_exists('users_id',$users_id)){
                $reg_data = date('F j, Y',strtotime($clients_data->created_at));

                //Get Notes
                $notes = $this->clients_model->clients_notes_model->get_clients_notes($users_id);

                //Get Brands
                $brands = $this->clients_model->clients_access_brands_model->get_access_brands($users_id);

                //Dis Points
                $dis_points = $this->clients_model->get_sum_points($users_id);

                //Get Basket
                $products = $this->clients_model->get_basket($users_id);

                //Get Claims
                $claims = $this->clients_model->get_claims($users_id);

                //Orders Data
                $order_response = [];
                $o_r = [];
                $order_oper_response = [];
                $orders_data = Orders::where('users_id','=',$users_id)->get();
                foreach ($orders_data as $order) {
                    $order_response[date('o',strtotime($order->created_at))][] = $order;
                    $order_oper_response[date('o',strtotime($order->created_at))][] = 'Order Ref '.$order->dis_ref.' is processed';
                }
                foreach ($order_response as $key => $item_arr) {
                    $orders_sum = 0;
                    foreach ($item_arr as $o_sum) {
                        $orders_sum+=$o_sum->total_amount;
                    }
                    $o_r[$key] = ['total'=>count($item_arr),'sum'=>$orders_sum];
                }


                return view('admin.clients_view',[
                    'data' => $clients_data,
                    'last_visit' => Sessions::get_last_visit($users_id),
                    'reg_data' => $reg_data,
                    'users_id' => $users_id,
                    'token' => Sessions::get_token(),
                    'notes' => $notes,
                    'brands' => $brands,
                    'dis_points' => $dis_points,
                    'products' => $products,
                    'claims' => $claims,
                    'o_r' => $o_r,
                    'order_oper_response' => $order_oper_response,
                    'admin_role' => $request->acc_data->role
                    ]);
            }

            return redirect('/panel/admin/clients');
        }


        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function client_add_view(){
            return view('admin.clients_add',[
                'token' => Sessions::get_token()
            ]);
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function client_edit_notes(Request $request){
            $insert_data = [
              'text' => $this->data['text'],
              'users_id' =>   $this->data['client_id']
            ];
            $time = Clients::get_how_long(strtotime(''),'2');
            if(empty($this->data['note_id'])){
                $type = 'new';
                $note_id = $this->clients_model->clients_notes_model->create_new($insert_data);
                $user_name = ClientsData::select('users_data.contact_name as name')
                    ->leftJoin('users_notes','users_data.users_id','=','users_notes.users_id')
                    ->where('users_notes.id','=',$note_id)
                    ->value('name');
                $text_logs = $request->acc_data->name.'('.$request->acc_data->role.') created a notes for client ( '.$user_name.' )';
            }else{
                $type = 'update';
                $note_id = $this->data['note_id'];
                $this->clients_model->clients_notes_model->update_note($note_id,$insert_data);
                $user_name = ClientsData::select('users_data.contact_name as name')
                    ->leftJoin('users_notes','users_data.users_id','=','users_notes.users_id')
                    ->where('users_notes.id','=',$note_id)
                    ->value('name');
                $text_logs = $request->acc_data->name.'('.$request->acc_data->role.') updated a notes for client ( '.$user_name.' )';
            }

            //Logs Created
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $text_logs,
                'type' => 'prizes'
            ]);


            return response()->json([
                'success' => true,
                'time' => $time,
                'id' => $note_id,
                'text' => $this->data['text'],
                'type' => $type
            ],200);
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function client_delete_notes(Request $request){
            $user_name = ClientsData::select('users_data.contact_name as name')
                ->leftJoin('users_notes','users_data.users_id','=','users_notes.users_id')
                ->where('users_notes.id','=',$this->data['note_id'])
                ->value('name');

            //Deleting
            $this->clients_model->clients_notes_model->delete_note($this->data['note_id']);

            //Logs
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') removed the notes for client ( '.$user_name.' )',
                'type' => 'prizes'
            ]);

            return response()->json([
                'success' => true
            ],200);
        }

        public function client_set_access_brand(Request $request){
            $name = ClientsData::where('users_id','=',$this->data['client_id'])->value('contact_name');

            //Delete Last
            $this->clients_model->clients_access_brands_model->delete_access_brand($this->data['brand_id'],$this->data['client_id']);

            //Creating
            if($this->data['value']==1){
                $this->clients_model->clients_access_brands_model->create_new(['users_id' => $this->data['client_id'], 'brands_id' => $this->data['brand_id']]);
            }

            //Logs
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') set access brands for client ( '.$name.' )',
                'type' => 'prizes'
            ]);

            return response()->json([
                'success' => true
            ],200);
        }

        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->clients_model);
            unset($this->data);
        }
    }
