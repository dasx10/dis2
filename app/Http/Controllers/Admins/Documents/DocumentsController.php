<?php

namespace App\Http\Controllers\Admins\Documents;

use App\Model\Admins\Documents\AdminDocuments;
use App\Model\Logs\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sessions;

class DocumentsController extends Controller{
    private $documents_model,$data;

    /**
     * AdminsController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->documents_model = new AdminDocuments();
        $this->data = $request->post();
    }

    public function documents_main_view(Request $request){
        //Get Data
        $documents = $this->documents_model->get_documents_list();
        $categories = $this->documents_model->admins_documents_category_model->get_categories();


        return view('admin.documents',[
            'token' => Sessions::get_token(),
            'documents' => $documents,
            'categories' => $categories,
            'admin_role' => $request->acc_data->role
        ]);
    }

    public function delete_documents(Request $request){
        //Delete
        $this->documents_model->delete_documents('id',$this->data['documents_id']);

        //Add Logs
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') removed the document',
            'type' => 'prizes'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'success delete documents'
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload_file(Request $request){
        //Upload file
        $url = $this->documents_model->upload_file($request->file('afile'));

        //Category Set
        $category = (!empty($this->data['category_name']))? $this->data['category_name']: $this->data['category'];

        //Creating doc
        $doc_id = $this->documents_model->create_documents($url,[
            'admins_id' => $request->acc_data->id,
            'title' => $this->data['title'],
            'category' => $category
        ]);

        //Create Category
        if(!empty($this->data['category_name']) && $this->documents_model->admins_documents_category_model->check_exists($this->data['category_name'])){
            $this->documents_model->admins_documents_category_model->create_new($this->data['category_name']);
        }

        //Create Logs
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') uploaded a new document',
            'type' => 'prizes'
        ]);


        return response()->json([
            'success' => true,
            'data' => 'success added',
            'documents_id' => $doc_id,
            'last_email' => $request->acc_data->email,
            'filename' => $url,
            'category' => $this->data['category'],
            'title' => $this->data['title'],
            'date' => date('j M Y')
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reupload_file(Request $request){
        //Upload File
        $url = $this->documents_model->upload_file($request->file('afile'));

        //Reupload File
        $this->documents_model->create_documents_version([
            'admins_documents_id' => $this->data['documents_id'],
            'edit_admins_id' => $request->acc_data->id,
            'url' => $url
        ]);

        //Create Logs
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') re-uploaded a document',
            'type' => 'prizes'
        ]);


        return response()->json([
            'success' => true,
            'data' => 'success changed',
            'last_email' => $request->acc_data->email,
            'filename' => $url,
            'date' => date('j M Y')
        ],200);
    }

    /**
     *Destruct
     */
    public function __destruct(){
        unset($this->documents_model);
        unset($this->data);
    }
}
