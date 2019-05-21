<?php

namespace App\Http\Controllers\Admins\DisContents;

use App\Model\Admins\Documents\AdminDocuments;
use App\Model\Clients\Clients;
use App\Model\Fileaclaim\FileaclaimFiles;
use App\Model\Logs\Logs;
use App\Model\Main\BrandSlider;
use App\Model\Main\Industries;
use App\Model\Main\IndustriesContents;
use App\Model\Main\MainIndustries;
use App\Model\Main\MainIndustries2;
use App\Model\Main\MainIndustries3;
use App\Model\Main\MainIndustries4;
use App\Model\Main\MainIndustries5;
use App\Model\Main\MainJoin;
use App\Model\Main\MainPageDescription;
use App\Model\Main\MainSlider;
use App\Model\Main\MainTailor;
use App\Model\Main\Markers;
use App\Model\Notifications\Notifications;
use App\Model\Orders\Orders;
use App\Model\Orders\OrdersCategory;
use App\Model\Orders\OrdersCategoryFiles;
use App\Model\Orders\OrdersProducts;
use App\Model\Photos\Photos;
use App\Model\Points\Points;
use App\Model\Points\PointsMed;
use App\Model\Products\Products;
use App\Model\Sessions;
use App\Model\Clients\ClientsData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admins\Admins;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DisContentsController extends Controller{
    private $data;

    /**
     * AdminsController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->data = $request->post();
    }


    public function edit_dis_content(){
        $main_slider = MainSlider::orderBy('position','ASC')->get();
        $brand_slider = BrandSlider::orderBy('position','ASC')->get();
        $industries_slider = MainIndustries::orderBy('position','ASC')->get();
        $tailor_slider = MainTailor::orderBy('position','ASC')->get();
        $join_slider = MainJoin::orderBy('position','ASC')->get();

        //Get brand descr

        $brand_descr = MainPageDescription::where('type','=','brand_descr')->select('text')->first();
        if(empty($brand_descr)){
            $brand_descr = (object)[
                'text' => ''
            ];
        }

//        $ind_descr = MainPageDescription::where('type','=','industries_descr')->select('text','src')->first();
//        if(empty($ind_descr)){
//            $ind_descr = (object)[
//                'text' => '',
//                'src' => ''
//            ];
//        }

        $ind_descr = MainPageDescription::where('type','=','industries_descr2')->value('text');

        $tailor_descr = MainPageDescription::where('type','=','tailor_descr')->select('text')->first();
        if(empty($tailor_descr)){
            $tailor_descr = (object)[
                'text' => ''
            ];
        }

        $www_descr_main = MainPageDescription::where('type','=','wwa_descr')->select('text')->first();
        if(empty($www_descr_main)){
            $www_descr_main = (object)[
                'text' => ''
            ];
        }

        $first_text_wwa = MainPageDescription::where('type','=','first_text_wwa')->select('text','src')->first();
        if(empty($first_text_wwa)){
            $first_text_wwa = (object)[
                'text' => '',
                'src' => ''
            ];
        }

        $second_text_wwa = MainPageDescription::where('type','=','second_text_wwa')->select('text','src')->first();
        if(empty($second_text_wwa)){
            $second_text_wwa = (object)[
                'text' => '',
                'src' => ''
            ];
        }

        $join_desc = MainPageDescription::where('type','=','join_descr')->select('text')->first();
        if(empty($join_desc)){
            $join_desc = (object)[
                'text' => ''
            ];
        }

        $contact_descr = MainPageDescription::where('type','=','contact_descr')->select('text','src')->first();
        if(empty($contact_descr)){
            $contact_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }

        //Address

        $address1 = MainPageDescription::where('type','=','address1')->select('text')->first();
        if(empty($address1)){
            $address1 = (object)[
                'text' => ''
            ];
        }
        $address2 = MainPageDescription::where('type','=','address2')->select('text')->first();
        if(empty($address2)){
            $address2 = (object)[
                'text' => ''
            ];
        }
        $email = MainPageDescription::where('type','=','email')->select('text')->first();
        if(empty($email)){
            $email = (object)[
                'text' => ''
            ];
        }
        $linkedin = MainPageDescription::where('type','=','linkedin')->select('text')->first();
        if(empty($linkedin)){
            $linkedin = (object)[
                'text' => ''
            ];
        }

        //Industries
        $industries = Industries::orderBy('position','ASC')
            ->get();
        foreach ($industries as $industry) {
            $industry->full_name = Industries::get_name($industry->link);
            $industry->contents = IndustriesContents::where('industries_id','=',$industry->id)
                ->orderBy('position','ASC')
                ->get();
        }

        $markers = Markers::orderBy('created_at','ASC')->get();

        $n_t_1 = MainPageDescription::where('type','=','navigations_type_1')->select('text')->first();
        if(empty($n_t_1)){
            $n_t_1 = (object)[
                'text' => ''
            ];
        }
        $n_t_2 = MainPageDescription::where('type','=','navigations_type_2')->select('text')->first();
        if(empty($n_t_2)){
            $n_t_2 = (object)[
                'text' => ''
            ];
        }
        $n_t_3 = MainPageDescription::where('type','=','navigations_type_3')->select('text')->first();
        if(empty($n_t_3)){
            $n_t_3 = (object)[
                'text' => ''
            ];
        }

        $n_t_4 = MainPageDescription::where('type','=','navigations_type_4')->select('text')->first();
        if(empty($n_t_4)){
            $n_t_4 = (object)[
                'text' => ''
            ];
        }
        $n_t_5 = MainPageDescription::where('type','=','navigations_type_5')->select('text')->first();
        if(empty($n_t_5)){
            $n_t_5 = (object)[
                'text' => ''
            ];
        }
        $n_t_6 = MainPageDescription::where('type','=','navigations_type_6')->select('text')->first();
        if(empty($n_t_6)){
            $n_t_6 = (object)[
                'text' => ''
            ];
        }

        return view('admin.dis_content',[
            'all_industries'=> $industries,
            'main_slider'=>$main_slider,
            'token' => Sessions::get_token(),
            'brand_slider' => $brand_slider,
            'brand_descr' => $brand_descr,
            'industries_slider' => $industries_slider,
            'tailor_slider' => $tailor_slider,
            'tailor_descr' => $tailor_descr,
            'www_descr_main' => $www_descr_main,
            'first_text_wwa' => $first_text_wwa,
            'second_text_wwa' => $second_text_wwa,
            'join_slider' =>$join_slider,
            'join_desc' => $join_desc,
            'contact_descr' => $contact_descr,
            'address1' => $address1,
            'address2' => $address2,
            'email' => $email,
            'linkedin' => $linkedin,
            'ind_descr'=>$ind_descr,
            'markers' => $markers,
            'n_t_1' => $n_t_1,
            'n_t_2' => $n_t_2,
            'n_t_3' => $n_t_3,
            'n_t_4' => $n_t_4,
            'n_t_5' => $n_t_5,
            'n_t_6' => $n_t_6,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_descr_photo_edit(Request $request){
        $insert_data['descr'] = (!empty($this->data['descr']))? $this->data['descr']:'';
        if(!empty($request->file('descr_photo_url')) && !empty($this->data['industry_id'])){
            $last_photo = Industries::where('id', '=', $this->data['industry_id'])->value('descr_photo_url');
            Photos::delete_photo($last_photo);
            $src = Photos::upload_photo($request->file('descr_photo_url'),'/dis_photo/');
            $insert_data['descr_photo_url'] = $src;
        }

        if(!empty($this->data['industry_id'])){
            Industries::where('id','=',$this->data['industry_id'])
                ->update($insert_data);
        }

        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
        ],200);

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';
        if(!empty($request->file('file')) && !empty($this->data['industries_slide_id'])){
            $last_photo = Industries::where('id', '=', $this->data['industries_slide_id'])->value('photo_url');
            Photos::delete_photo($last_photo);
            $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($request->file('file1')) && !empty($this->data['industries_slide_id'])){
            $last_photo = Industries::where('id', '=', $this->data['industries_slide_id'])->value('photo_url_hover');
            Photos::delete_photo($last_photo);
            $src = Photos::upload_photo($request->file('file1'),'/dis_photo/');
            $insert_data['photo_url_hover'] = $src;
        }

        if(!empty($insert_data['title'])) {
            $error = false;
            $insert_data['link'] = Industries::get_link($insert_data['title']);
            if(empty($this->data['industries_slide_id']) && Industries::where('link','=',$insert_data['link'])->exists()){
                $error = true;
            }elseif (!empty($this->data['industries_slide_id']) && Industries::where('link','=',$insert_data['link'])
                    ->where('id','!=',$this->data['industries_slide_id'])->exists()){
                $error = true;
            }
            if($error){
                return response()->json([
                    'success' => false,
                    'message' => 'Industries name is already exists'
                ],200);
            }
        }

        if(!empty($this->data['industries_slide_id'])){
            $slide_id = $this->data['industries_slide_id'];
            Industries::where('id','=',$this->data['industries_slide_id'])
                ->update($insert_data);
        }else{
            $response = Industries::create($insert_data);
            $slide_id = $response->id;
        }

        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'id' => $slide_id
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_slider_delete(Request $request){
        if(!empty($this->data['industry_slide_id'])){
            $ind_content = IndustriesContents::where('id','=',$this->data['industry_slide_id'])
                ->select('src','src1')->first();
            Photos::delete_photo($ind_content->src);
            Photos::delete_photo($ind_content->src1);
            IndustriesContents::where('id','=',$this->data['industry_slide_id'])->delete();
            return response()->json([
                'success' => true
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Industries slide id was not found'
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_slider_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']: '';
        $insert_data['descr'] = (!empty($this->data['descr']))? $this->data['descr']: '';
        $insert_data['link'] = (!empty($this->data['link']))? $this->data['link']: '';

        if(!empty($request->file('file'))){
            if(!empty($this->data['industry_slide_id'])) {
                $src = IndustriesContents::where('id', '=', $this->data['industry_slide_id'])->value('src');
                Photos::delete_photo($src);
            }
            $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
            $insert_data['src'] =$src;
        }

        if(!empty($request->file('file2'))){
            if(!empty($this->data['industry_slide_id'])) {
                $src = IndustriesContents::where('id', '=', $this->data['industry_slide_id'])->value('src_hover');
                Photos::delete_photo($src);
            }
            $src = Photos::upload_photo($request->file('file2'),'/dis_photo/');
            $insert_data['src_hover'] =$src;
        }

        if(!empty($request->file('file1'))){
            if(!empty($this->data['industry_slide_id'])) {
                $src1 = IndustriesContents::where('id', '=', $this->data['industry_slide_id'])->value('src1');
                Photos::delete_photo($src1);
            }
            $src1 = Photos::upload_photo($request->file('file1'),'/dis_photo/');
            $insert_data['src1'] = $src1;
        }

        if(!empty($this->data['industry_slide_id'])){
            IndustriesContents::where('id','=',$this->data['industry_slide_id'])
                ->update($insert_data);
            $type = 'edit';
        }else{
            $insert_data['industries_id'] = $this->data['industry_id'];
            IndustriesContents::create($insert_data);
            $type = 'create';
        }

        //Create Logs
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_set_position(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                Industries::where('id', '=', $value)->update([
                    'position' => $key
                ]);
            }

            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                'type' => 'dis'
            ]);
        }

        return response()->json([
            'success' => true
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_industry(Request $request){
        if(!empty($this->data['industry_id'])) {
            $photos_i = Industries::where('id','=',$this->data['industry_id'])->first();
            Photos::delete_photo($photos_i->descr_photo_url);
            Photos::delete_photo($photos_i->photo_url);
            $i_contents = IndustriesContents::where('industries_id','=',$this->data['industry_id'])->get();
            foreach ($i_contents as $i_content) {
                Photos::delete_photo($i_content->src);
                Photos::delete_photo($i_content->src1);
                $i_content->delete();
            }
            $photos_i->delete();


            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name . '(' . $request->acc_data->role . ') changed the dis-content',
                'type' => 'dis'
            ]);
        }

        return response()->json([
            'success' => true
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function industries_slider_set_position(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                IndustriesContents::where('id', '=', $value)->update([
                    'position' => $key
                ]);
            }

            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                'type' => 'dis'
            ]);
        }

        return response()->json([
            'success' => true
        ],200);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function join_slider_set_position(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                MainJoin::where('id', '=', $value)->update([
                    'position' => $key
                ]);
            }

            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                'type' => 'dis'
            ]);
        }

        return response()->json([
            'success' => true
        ],200);
    }

    public function edit_create_markers(Request $request){
        $insert_data = [];
        $fields = ['lat','lng','title','type','content'];
        foreach ($fields as $field) {
            $insert_data[$field] = $this->data[$field];
        }

        if(!empty($this->data['marker_id'])){
            $marker_id = $this->data['marker_id'];
            Markers::where('id','=',$this->data['marker_id'])
                ->update($insert_data);
        }else{
            $markers_data = Markers::create($insert_data);
            $marker_id = $markers_data->id;
        }

        return response()->json([
            'success' => true,
            'marker_id' => $marker_id
        ],200);
    }

    public function delete_markers(Request $request){
        Markers::where('id','=',$this->data['marker_id'])
            ->delete();

        return response()->json([
            'success' => true
        ],200);
    }
}
