<?php

namespace App\Http\Controllers\Admins\DolchemContents;

use App\Model\Dolchem\DolchemContent;
use App\Model\Dolchem\DolchemMarkers;
use App\Model\Logs\Logs;
use App\Model\Photos\Photos;
use App\Model\Sessions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DolchemContentsController extends Controller{
    private $data,$dolchem_content_model;

    /**
     * DolchemContentsController constructor.
     */
    public function __construct(Request $request) {
        $this->data = $request->post();
        $this->dolchem_content_model = new DolchemContent();
    }

    public function dolchem_content_view(Request $request){
        $dolchem_main_page_content = $this->dolchem_content_model->dolchem_main_page_content->get_content();
        $dolchem_about_brand_profile = $this->dolchem_content_model->dolchem_about_brand_profile->get_content();
        $dolchem_certifications = $this->dolchem_content_model->dolchem_certifications->get_content();
        $dolchem_quality_assurance = $this->dolchem_content_model->dolchem_quality_assurance->get_content();
        $dolchem_quality_assurance_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('quality_assurance_content');
        $dolchem_packing = $this->dolchem_content_model->dolchem_packing->get_content();
        $dolchem_download_kit = $this->dolchem_content_model->dolchem_download_kit->get_content();
        $dolchem_markers = $this->dolchem_content_model->dolchem_markers->get_content();
        $dolchem_address_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('address');
        $dolchem_address1_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('address1');
        $dolchem_email_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('email');
        $dolchem_linkedin_link_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('linkedin_link');
        $dolchem_products_categories = $this->dolchem_content_model->dolchem_products_categories->get_content();
        $dolchem_products = $this->dolchem_content_model->dolchem_products->get_products();
        $dolchem_brand_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('brand_text');
        $dolchem_contact_us_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('contact_us_text');
        $dolchem_about_markets_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('about_markets_text');
        $dolchem_telephone_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('telephone');
        $dolchem_telephone1_text = $this->dolchem_content_model->dolchem_text->get_text_by_type('telephone1');



        return view('admin.dolchem_content',[
            'token' => Sessions::get_token(),
            'dolchem_main_page_content' => $dolchem_main_page_content,
            'dolchem_about_brand_profile' => $dolchem_about_brand_profile,
            'dolchem_certifications' => $dolchem_certifications,
            'dolchem_quality_assurance' => $dolchem_quality_assurance,
            'dolchem_quality_assurance_text' => $dolchem_quality_assurance_text,
            'dolchem_packing' => $dolchem_packing,
            'dolchem_download_kit' => $dolchem_download_kit,
            'dolchem_markers' => $dolchem_markers,
            'dolchem_address_text' => $dolchem_address_text,
            'dolchem_address1_text' => $dolchem_address1_text,
            'dolchem_email_text' => $dolchem_email_text,
            'dolchem_linkedin_link_text' => $dolchem_linkedin_link_text,
            'dolchem_products_categories' => $dolchem_products_categories,
            'dolchem_products' => $dolchem_products,
            'dolchem_brand_text' => $dolchem_brand_text,
            'dolchem_contact_us_text' => $dolchem_contact_us_text,
            'dolchem_about_markets_text' => $dolchem_about_markets_text,
            'dolchem_telephone_text' => $dolchem_telephone_text,
            'dolchem_telephone1_text' => $dolchem_telephone1_text
        ]);
    }

    public function dolchem_main_page_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';
        $insert_data['title1'] = (!empty($this->data['title1']))? $this->data['title1']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_main_page_content->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_main_page_content->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_main_page_content->create_new($insert_data);
        }


        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_packing_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';
        $insert_data['descr'] = (!empty($this->data['descr']))? $this->data['descr']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_packing->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($request->file('file1'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_packing->get_photo_url_hover_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file1'),'/dolchem_photo/');
            $insert_data['photo_url_hover'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_packing->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_packing->create_new($insert_data);
        }

        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_products_categories_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_products_categories->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($request->file('file1'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_products_categories->get_photo_url_hover_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file1'),'/dolchem_photo/');
            $insert_data['photo_url_hover'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_products_categories->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_products_categories->create_new($insert_data);
        }

        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_download_kit_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_download_kit->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($request->file('file1'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_download_kit->get_photo_url_hover_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file1'),'/dolchem_photo/');
            $insert_data['photo_url_hover'] = $src;
        }

        if(!empty($request->file('link'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_download_kit->get_link_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('link'),'/dolchem_photo/');
            $insert_data['link'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_download_kit->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_download_kit->create_new($insert_data);
        }

        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_about_brand_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';
        $insert_data['title1'] = (!empty($this->data['title1']))? $this->data['title1']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_about_brand_profile->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_about_brand_profile->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_about_brand_profile->create_new($insert_data);
        }


        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_certifications_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_certifications->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_certifications->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_certifications->create_new($insert_data);
        }


        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_quality_assurance_content_edit(Request $request){
        $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';

        if(!empty($request->file('file'))){
            if(!empty($this->data['slide_id'])) {
                $last_photo = $this->dolchem_content_model->dolchem_quality_assurance->get_photo_url_by_slide_id($this->data['slide_id']);
                Photos::delete_photo($last_photo);
            }
            $src = Photos::upload_photo($request->file('file'),'/dolchem_photo/');
            $insert_data['photo_url'] = $src;
        }

        if(!empty($this->data['slide_id'])){
            $type = 'edit';
            $this->dolchem_content_model->dolchem_quality_assurance->update_slide($this->data['slide_id'],$insert_data);
        }else{
            $type = 'create';
            $this->dolchem_content_model->dolchem_quality_assurance->create_new($insert_data);
        }


        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dolchem-content',
            'type' => 'dis'
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ],200);
    }

    public function dolchem_main_page_content_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_main_page_content->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty slide id'
        ],200);
    }

    public function dolchem_about_brand_content_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_about_brand_profile->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty slide id'
        ],200);
    }

    public function dolchem_certifications_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_certifications->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty certification id'
        ],200);
    }

    public function dolchem_quality_assurance_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_quality_assurance->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty certification id'
        ],200);
    }

    public function dolchem_content_save(Request $request){
        $insert_data['text'] = (!empty($this->data['text']))? $this->data['text']:'';
        $insert_data['text1'] = (!empty($this->data['text1']))? $this->data['text1']:'';
        $insert_data['text2'] = (!empty($this->data['text2']))? $this->data['text2']:'';
        $insert_data['type'] = $this->data['type'];
        if($id = $this->dolchem_content_model->dolchem_text->check_exists($this->data['type'])){
            $this->dolchem_content_model->dolchem_text->update_text($id,$insert_data);
        }else{
            $this->dolchem_content_model->dolchem_text->create_new($insert_data);
        }

        return response()->json([
            'success' => true
        ],200);
    }

    public function dolchem_packing_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_packing->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty packing id'
        ],200);
    }

    public function dolchem_download_kit_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_download_kit->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty packing id'
        ],200);
    }


    public function dolchem_products_categories_delete(Request $request){
        if(!empty($this->data['slide_id'])){
            $this->dolchem_content_model->dolchem_products_categories->delete_slide($this->data['slide_id']);
            return response()->json([
                'success' => true
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Empty packing id'
        ],200);
    }

    public function edit_create_markers(Request $request){
        $insert_data = [];
        $f_names = [
            'lat' => 'latitude',
            'lng' => 'longitude',
            'title' => 'title'
        ];
        $fields = ['lat','lng','title','type'];
        foreach ($fields as $field) {
            if(isset($this->data[$field])) {
                $insert_data[$field] = $this->data[$field];
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid parameter. Empty '.$f_names[$field]
                ],200);
            }
        }
        $insert_data['content'] = (isset($this->data['content']))? $this->data['content'] : '';

        if(!empty($this->data['marker_id'])){
            $marker_id = $this->data['marker_id'];
            DolchemMarkers::where('id','=',$this->data['marker_id'])
                ->update($insert_data);
        }else{
            $markers_data = DolchemMarkers::create($insert_data);
            $marker_id = $markers_data->id;
        }

        return response()->json([
            'success' => true,
            'marker_id' => $marker_id
        ],200);
    }

    public function delete_markers(Request $request){
        DolchemMarkers::where('id','=',$this->data['marker_id'])
            ->delete();

        return response()->json([
            'success' => true
        ],200);
    }

    public function dolchem_category_select(Request $request){
        $this->dolchem_content_model->dolchem_products->delete_prod_from_cat($this->data['products_id']);
        $this->dolchem_content_model->dolchem_products->add_prod_to_cat($this->data['products_id'],$this->data['cat_id']);
        return response()->json([
            'success' => true
        ],200);
    }

    public function dolchem_main_page_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_main_page_content->update_slide($value,['position'=>$key]);
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

    public function dolchem_about_brand_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_about_brand_profile->update_slide($value,['position'=>$key]);
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

    public function dolchem_certifications_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_certifications->update_slide($value,['position'=>$key]);
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

    public function dolchem_quality_assurance_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_quality_assurance->update_slide($value,['position'=>$key]);
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

    public function dolchem_packing_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_packing->update_slide($value,['position'=>$key]);
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

    public function dolchem_download_kit_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_download_kit->update_slide($value,['position'=>$key]);
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

    public function dolchem_products_categories_pos_set(Request $request){
        if(!empty($this->data['positions'])){
            $array_id = explode(',',$this->data['positions']);
            foreach ($array_id as $key=>$value) {
                $this->dolchem_content_model->dolchem_products_categories->update_slide($value,['position'=>$key]);
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
     * Destruct
     */
    public function __destruct(){
        unset($this->data);
        unset($this->dolchem_content_model);
    }
}
