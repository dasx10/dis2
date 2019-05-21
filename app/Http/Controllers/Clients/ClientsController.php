<?php

    namespace App\Http\Controllers\Clients;
    use App\Model\Admins\Admins;
    use App\Model\Admins\PriceComponents;
    use App\Model\Basket\Basket;
    use App\Model\InviteLinks\InviteLinks;
    use App\Model\Logs\Logs;
    use App\Model\Notifications\Notifications;
    use App\Model\Orders\Orders;
    use App\Model\Orders\OrdersCategory;
    use App\Model\Orders\OrdersCategoryFiles;
    use App\Model\Orders\OrdersProducts;
    use App\Model\Orders\OrdersStatus;
    use App\Model\Points\PointsMed;
    use App\Model\Prize\Prize;
    use App\Model\Prize\PrizeBuy;
    use App\Model\Products\Products;
    use App\Model\Products\ProductsDocument;
    use App\Model\Products\ProductsPhoto;
    use App\Model\Sessions;
    use App\Model\Clients\ClientsData;
    use App\Model\Clients\Clients;
    use App\Model\SimpleSignUp\SimpleSignUp;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Points\Points;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;

    class ClientsController extends Controller{
        private $users_model,$data;

        /**
         * AdminsController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->users_model = new Clients;
            $this->data = $request->post();
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function main_view(Request $request){
            $products = [];
            $prod_sum = [];
            $reg_data = date('F j, Y',strtotime($request->acc_data->created_at));

            $basket_data = Basket::where('users_id','=',$request->acc_data->users_id)->get();
            foreach ($basket_data as $basket) {
                $products[] = Products::where('id','=',$basket->products_id)->first();
            }

            //Get History Points
            $points_count = Points::where('users_id','=',$request->acc_data->users_id)
                ->select(DB::raw("SUM(count) as sum"))->value('sum');;
            $points_data = Points::where('users_id','=',$request->acc_data->users_id)->get();
            $products_data = Products::where([['active','=','1'],['absent','=','1'],['is_deleted','=','0']])
                ->limit(10)->get();


            //Orders data

            $orders_data = Orders::where('orders.users_id','=',$request->acc_data->users_id)
                ->where('orders.status','!=','Arrived')
                ->get();

            $prizes_buy = PrizeBuy::where('users_id','=',$request->acc_data->users_id)->get();
            $array_prize_id = [];
            foreach ($prizes_buy as $prize) {
                $array_prize_id[] = $prize->prize_id;
            }
            $prizes = Prize::whereNotIn('id',$array_prize_id)->orderBy('points','ASC')->get();


            return view('user.welcome',[
                'data'=>$request->acc_data,
                'last_visit'=>Sessions::get_last_visit($request->acc_data->users_id),
                'reg_data'=>$reg_data,
                'users_id' => $request->acc_data->users_id,
                'token' => Sessions::get_token(),
                'basket_data' => $basket_data,
                'prod_sum' => $prod_sum,
                'orders_data' => $orders_data,
                'points_count' => $points_count,
                'points_data' => $points_data,
                'products_data' => $products_data,
                'prizes' => $prizes
                ]);
        }

        public function client_edit_base(Request $request){
            //Update Data
            $this->users_model->users_data_model->update_users_data($this->data['client_id'],$request->update_data);

            //Create Log
            if(Sessions::check_type_session('admins_id')) {
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                $name = ClientsData::where('users_id', '=', $this->data['client_id'])->value('contact_name');
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'] . '(' . $admin_name_role['role'] . ') edit client profile ( ' . $name . ' )',
                    'type' => 'prizes'
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $this->data
            ],200);
        }


        /**
         * @param $id
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function product_overview_view($id){
            if(Products::where('id', '=', $id)->where('is_deleted','=','0')->exists()) {
                $data = Products::where('id', '=', $id)->first();
                $data->photos = ProductsPhoto::where('products_id', '=', $id)->get();
                $data->documents = ProductsDocument::where('products_id', '=', $id)->get();
                $pallet_price = PriceComponents::where('type','=','pallet_price')->value('value');
                return view('user.product_view', [
                    'data' => $data,
                    'pallet_price' => $pallet_price
                ]);
            }else{
                return redirect('/panel/user/products');
            }
        }

        public function add_product_to_cart(Request $request){
            //Creating
            Basket::create($request->insert_data);

//            Products::where('id','=',$this->data['products_id'])->decrement($request->insert_data['quantity_decr_key'],(int)$request->insert_data['quantity']);
            return response()->json([
                'success' => true
            ],200);
        }


        public function delete_product_from_cart(Request $request){
            if(!empty($this->data['cart_id'])){
                $basket = Basket::where('id','=',$this->data['cart_id'])->select('products_id','quantity','quantity_decr_key')->first();
//                Products::where('id','=',$basket->products_id)->increment($basket->quantity_decr_key,(int)$basket->quantity);
                Basket::where('id','=',$this->data['cart_id'])->delete();
                return response()->json([
                    'success' => true
                ],200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ],200);

        }

        public function purchase_orders_view(Request $request){
            $v = 0;
            $pallets_count = 0;
            $quantity = 0;
            $products = [];
            $basket_data = Basket::where('basket.users_id','=',$request->acc_data->id)
                ->select('basket.*','basket.id as basket_id','p.*')
                ->leftJoin('products as p','basket.products_id','=','p.id')
                ->get();
            $total_q = 0;
            foreach ($basket_data as $products){
                $pallets_count+=(!empty($products->quantity_decr_key))? $products->quantity_decr_key:0;
                $type_p = 'wp';
                $type_pack = str_replace('type','',$products->packaging_type);
                if($products->pallet_type == 'pallet'){
                    $type_p = 'p';
                }
                $total_q+=str_replace('q','',$products->quantity);
                $length = 'length_of_pack_'.$type_pack.'_'.$type_p;
                $width = 'width_of_pack_'.$type_pack.'_'.$type_p;
                $height = 'height_of_pack_'.$type_pack.'_'.$type_p;
                $v += ($products->$length*$products->$width*$products->$height)*str_replace('q','',$products->quantity);
            }

            $count_g = ceil($v/28);
            if(empty($count_g)){
                $count_g = 1;
            }
            $f_v_proc = ceil((($v/$count_g)*100)/(28*$count_g));
            $exists_v = (28*$count_g) - $v;
            $f_v_proc2 = ceil(($v*100)/28);
            $products_data = Products::where('active','=','1')
                ->select('id','product_name')
                ->limit(8)->get();


            //price components
            $p_c = [];
            $price_components = PriceComponents::get();
            foreach ($price_components as $component) {
                $p_c[$component->type] = $component->value;
            }


//            dd($points_count);
            return view('user.purchase_orders',[
                'points_users' => $request->acc_data->dis_points,
                'p_c' => $p_c,
                'total_q' => $total_q,
                'users_data' => $request->acc_data,
                'basket_data' => $basket_data,
                'products' => $products,
                'f_v_proc' => $f_v_proc,
                'v' => $v,
                'quantity' => $quantity,
                'exists_v' => $exists_v,
                'products_data' => $products_data,
                'count_g' => $count_g,
                'f_v_proc2' => $f_v_proc2,
                'token' => Sessions::get_token(),
                'price_components' => $price_components,
                'pallets_count' => $pallets_count
            ]);
        }

        public function dis_points_view(Request $request){
            $user_money_spent = Orders::where('users_id','=',$request->acc_data->id)->select(DB::raw('SUM(points) as count'))->value('count');
            $dis_points = 0;
            $max_amount = 500;
            $dis_points_arr = Points::where('users_id','=', $request->acc_data->id)
                ->get();

            $prizes = Prize::whereNotIn('id',PrizeBuy::select('prize_id')->where('users_id','=', $request->acc_data->id)->get())
                ->orderBy('points','DESC')
                ->get();
            $sum_points = ClientsData::where('users_id','=', $request->acc_data->id)->value('dis_points');
            $array_points = [
                ['orders_name'=>'','orders_date'=>'','count'=>10],
                ['orders_name'=>'','orders_date'=>'','count'=>25],
                ['orders_name'=>'','orders_date'=>'','count'=>50],
                ['orders_name'=>'','orders_date'=>'','count'=>100],
                ['orders_name'=>'','orders_date'=>'','count'=>150],
                ['orders_name'=>'','orders_date'=>'','count'=>300],
                ['orders_name'=>'','orders_date'=>'','count'=>500]
            ];


            $max_amount = 0;
            foreach ($prizes as $prize) {
                $temporaryMax = (int)$prize->points * $user_money_spent;
                if($temporaryMax > $max_amount) {
                    $max_amount = $prize->points * $user_money_spent;
                }
                if($prize->points>500){
                    $array_points[] = ['orders_name'=>'','orders_date'=>'','count'=>$prize->points*$user_money_spent];
                }
            }

            for($i=0;$i<count($array_points);$i++){
//                if($sum_points>=$array_points[$i]['count']) {
                $count = (!empty($dis_points_arr[$i]->count))?$dis_points_arr[$i]->count : $array_points[$i]['count'];
                    $array_points[$i] = [
                        'count' => $count,
                        'orders_name' => (!empty($dis_points_arr[$i]))?'Ref '.$dis_points_arr[$i]->orders_name : '',
                        'orders_date' =>(!empty($dis_points_arr[$i]))?date('M d, o', strtotime($dis_points_arr[$i]->created_at)):''
                    ];
//                }
            }

            if(!empty($array_points)) {
                sort($array_points);
                usort($array_points, function ($a, $b) {
                    return ($a['count'] - $b['count']);
                });
            }

            $i_d = 0;
            foreach ($array_points as $key => $array_point) {
                if(($i_d<count($dis_points_arr)+1) && $array_points[$key]['orders_name']==''){
                    $array_points[$key]['orders_name'] = ' ';
                    $i_d++;
                }
            }

            foreach ($dis_points_arr as $item) {
                $dis_points+=$item->count;
            }


            $l_points = $max_amount-$sum_points;
            return view('user.reedem_dis_points',[
                'count' => $sum_points,
                'dis_points' => $dis_points_arr,
                'l_points' => $l_points,
                'array_points' => $array_points,
                'prizes' => $prizes,
                'token' => Sessions::get_token(),
                'sum_points' => $sum_points,
                'user_money_spent' =>$user_money_spent
            ]);
        }

        public function order_purchase(Request $request){
            $count_points = Clients::get_points($this->data['total_amount']);
            $request->insert_data['points'] = $count_points;
            $request->insert_data['created_at'] = time();
            $request->insert_data['updated_at'] = time();
            $orders_id = Orders::insertGetId($request->insert_data);
            $baskets_data = Basket::where('users_id','=',$request->acc_data->id)->get();
            foreach ($baskets_data as $product) {
                OrdersProducts::insertGetId([
                    'orders_id' => $orders_id,
                    'products_id' => $product->products_id,
                    'quantity' => substr($product->quantity,1),
                    'quantity_val' => $product->quantity_val,
                    'products_name' => Products::where('id','=',$product->products_id)->value('product_name'),
                    'products_specification' => Products::where('id','=',$product->products_id)->value('specification'),
                    'products_packaging_type' => $product->packaging_type,
                    'products_pallet_wpallet' => $product->pallet_type,
                    'products_unit_price' => $product->unit_price,
                    'created_at' => time(),
                    'updated_at' => time()
                ]);
            }

            PointsMed::insertGetId([
                'users_id' => $request->acc_data->id,
                'count' => $count_points,
                'orders_id' => $orders_id,
                'created_at' => time(),
                'updated_at' => time()
            ]);

            OrdersStatus::insertGetId([
                'orders_id' => $orders_id,
                'created_at' => time(),
                'updated_at' => time()
            ]);

            Notifications::insertGetId([
                'title' => 'New order',
                'message' => 'The new order Ref ' . Orders::where('id', '=', $orders_id)->value('dis_ref') . ' was issued',
                'is_new' => 1,
                'is_view' => 1,
                'src' => asset('/panel/admin/orders/documents/'.$orders_id),
                'created_at' => time(),
                'updated_at' => time()
            ]);
            Basket::where('users_id', '=', $request->acc_data->id)->delete();

            foreach (['Proforma Invoice','Commercial Invoice','Packing List','Certificate of Analysis',
                         'Bill of Lading','Certificate of Origin','Shipment Confirmation'] as $title) {
                OrdersCategory::insertGetId([
                    'orders_id' => $orders_id,
                    'title' => $title,
                    'created_at' => time(),
                    'updated_at' => time()
                ]);
            }
            return response()->json([
                'success' => true
            ],200);
        }

        public function current_orders_view(Request $request){
            $orders = Orders::where('orders.users_id','=',$request->acc_data->id)
                ->orderBy('orders.created_at','DESC')
                ->where('orders.status','!=','Arrived')->get();

            return view('user.current_orders',[
                'orders' => $orders
            ]);
        }

        public function archives_view(Request $request){
            $response = [];
            $users_id = Sessions::get_users_id_by_token(Sessions::get_token());
            $orders = Orders::where('users_id','=',$users_id)->where('status','=','Arrived')->get();
            foreach ($orders as $order) {
                $response[date('o',strtotime($order->created_at))][] = $order;
            }
            return view('user.archives',[
                'response' => $response
            ]);
        }

        public function current_orders_by_id_view($id){
            if(!Orders::where('id','=',$id)->exists() || empty($id)){
                return redirect('/panel/user/current-orders');
            }else {
                $orders_data = Orders::where('id', '=', $id)->first();
                $products_data = OrdersProducts::where('orders_id', '=', $id)->get();
                return view('user.ordersid', [
                    'orders_data' => $orders_data,
                    'products_data' => $products_data
                ]);
            }
        }

        public function prize_buy(Request $request){
            PrizeBuy::create([
               'prize_id' => $this->data['prize_id'],
               'users_id' => $request->acc_data->id
            ]);

            Points::create([
                'users_id' => $request->acc_data->id,
                'count' => $this->data['cost'],
                'end_date' => $this->data['end_date']
            ]);
            $dis_points = ClientsData::where('users_id','=',$request->acc_data->id)->value('dis_points');
            if($dis_points-$this->data['cost'] >= 0) {
                ClientsData::where('users_id', '=', $request->acc_data->id)->decrement('dis_points', $this->data['cost']);
            }else{
                ClientsData::where('users_id', '=', $request->acc_data->id)->update(['dis_points'=>0]);
            }

            Notifications::create([
                'title' => 'New bought',
                'message' => 'The user bought a prize for '.$this->data['cost'].' points',
                'is_new' => 1,
                'is_view' => 1,
                'src' => asset('/panel/admin/clients/view/'.$request->acc_data->id)
            ]);


            return response()->json([
                'success' => true
            ],200);
        }

        public function clients_main_page_add(Request $request){
            $email = $request->admin_email;

            //register
            $users_id =  $this->users_model->create_users();
            $request->insert_data['users_id'] = $users_id;
            $this->users_model->users_data_model->create_users_data($request->insert_data);


            $token = str_random(10);
            SimpleSignUp::create([
                'users_id' => $users_id,
                'token' => $token
            ]);
            $confirm = asset('/user/confirm_by_admin/'.$token);
            $cancel = asset('/user/cancel_by_admin/'.$token);

            Mail::send('email.invite_links', [
                'cancel'=>$cancel,
                'confirm' =>$confirm,
                'mail_data'=> $request->mail_data
            ], function ($m) use ($email) {
                $m->from('dis@yobibyte.in.ua', 'DIS');
                $m->to($email)->cc('info@dis-company.com')->subject('New user registration request');
            });

            return response()->json([
                'success' => true,
                'message' => 'success created'
            ],200);
        }

        public function confirm_new_user($token){
            $user_id = SimpleSignUp::where('token','=',$token)->value('users_id');
            if($user_id) {
                $pass = str_random(10);
                ClientsData::where('users_id','=',$user_id)->update([
                    'can_see' => 1,
                    'password' => md5($pass)
                ]);
                $email = ClientsData::where('users_id','=',$user_id)->value('email');
                $this->data['data_email'] = $email;
                $contact_name = ClientsData::where('users_id','=',$user_id)->value('contact_name');

                $token = InviteLinks::generate_token();
                InviteLinks::create_invite(['token'=>$token,'users_id'=>$user_id]);


                $text = "Dear ".$contact_name."<br><br><br>";
                $text.= "Your account was confirmed. Now you can login to the system <a href='".asset('/login')."'>by this link</a> , using these credentials:<br><br>";
                $text.= "Login: ".$email."<br><br><br>";
                $text.= "Password: <a href='".asset('/signup/'.$token)."'>use this link to create your password</a><br><br><br>";
                $text.="Thank you.";

                Mail::send('email.lala', ['text'=>$text], function ($m) use ($email) {
                    $m->from('dis@yobibyte.in.ua', 'DIS');
                    $m->to($email)->cc('info@dis-company.com')->subject('DIS: Registration approved');
                });
                SimpleSignUp::where('token','=',$token)->delete();
                return redirect('/login');
            }

            return redirect('/');
        }

        public function confirm_new_user_success($token){
            $user_id = SimpleSignUp::where('token','=',$token)->value('users_id');
            if($user_id) {
                $pass = str_random(10);
                ClientsData::where('users_id','=',$user_id)->update([
                    'can_see' => 1,
                    'password' => md5($pass)
                ]);
                $email = ClientsData::where('users_id','=',$user_id)->value('email');
                $this->data['data_email'] = $email;
                $contact_name = ClientsData::where('users_id','=',$user_id)->value('contact_name');

                $token = InviteLinks::generate_token();
                InviteLinks::create_invite(['token'=>$token,'users_id'=>$user_id]);

                $text = "Dear ".$contact_name."<br><br><br>";
                $text.= "Your account was confirmed. Now you can login to the system <a href='".asset('/login')."'>by this link</a> , using these credentials:<br><br>";
                $text.= "Login: ".$email."<br><br><br>";
                $text.= "Password: <a href='".asset('/signup/'.$token)."'>use this link to create your password</a><br><br><br>";
                $text.="Thank you.";
                Mail::send('email.lala', ['text'=>$text], function ($m) use ($email) {
                    $m->from('dis@yobibyte.in.ua', 'DIS');
                    $m->to($email)->cc('info@dis-company.com')->subject('DIS: Registration approved');
                });
                SimpleSignUp::where('token','=',$token)->delete();
                return redirect('/login');
            }else{
                return redirect('/');
            }
        }

        public function confirm_new_user_cancel($token){
            $user_id = SimpleSignUp::where('token','=',$token)->value('users_id');
            if($user_id) {
                $email = ClientsData::where('users_id','=',$user_id)->value('email');
                $this->data['data_email'] = $email;
                $contact_name = ClientsData::where('users_id','=',$user_id)->value('contact_name');
                Clients::where('id','=',$user_id)->delete();

                $text = "Dear ".$contact_name."<br><br>";
                $text.="Your account registration was declined.<br><br>";
                $text.="Contact us if you think this is a mistake.<br><br>";
//                Mail::raw($text,function ($message){
//                    $message->to($this->data['data_email']);
//                    $message->from('dis@yobibyte.in.ua');
//                    $message->subject('DIS: Registration declined');
//                });

                Mail::send('email.lala', ['text'=>$text], function ($m) use ($email) {
                    $m->from('dis@yobibyte.in.ua', 'DIS');
                    $m->to($email)->cc('info@dis-company.com')->subject('DIS: Registration declined');
                });
                SimpleSignUp::where('token','=',$token)->delete();
                return redirect('/');
            }else{
                return redirect('/');
            }
        }

        public function track_your_order_main(){
            $orders = Orders::select('id','dis_ref')->get();
            return view('user.track_your_orders',[
                'orders' => $orders,
                'dis_ref' => ''
            ]);
        }

        public function track_your_order_by_dis_ref($id){
            if($orders_data = Orders::where('dis_ref','=',$id)->first()) {
                $statuses = [];
                $dis_ref = $orders_data->dis_ref;
                $files_src = '';
                $orders = Orders::select('id', 'dis_ref')->get();
                $orders_statuses = OrdersStatus::select('orders_status.status')
                    ->leftJoin('orders as o','orders_status.orders_id','=','o.id')
                    ->where('o.dis_ref','=',$dis_ref)
                    ->get();
                $files = OrdersCategoryFiles::select('orders_category_files.src')
                    ->leftJoin('orders_category as oc','orders_category_files.orders_category_id','=','oc.id')
                    ->leftJoin('orders as o','oc.orders_id','=','o.id')
                    ->where('o.dis_ref','=',$dis_ref)
                    ->get();
                $link = OrdersCategory::where('orders_id', '=', $id)
                    ->where('title', '=', 'Shipment Confirmation')
                    ->value('link');
                foreach ($files as $file) {
                    $files_src.=$file->src.',';
                }
                foreach ($orders_statuses as $orders_status) {
                    $statuses[] = $orders_status->status;
                }

                $files_src = substr($files_src,0,-1);
                return view('user.track_your_orders', [
                    'orders' => $orders,
                    'orders_data' => $orders_data,
                    'dis_ref' => $dis_ref,
                    'orders_statuses' => $statuses,
                    'files_src' => $files_src,
                    'link' => $link
                ]);
            }

            return redirect('/panel/user/track-your-orders')->with('status','Dis ref was not found');
        }
        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->users_model);
            unset($this->data);
        }
    }
