<?php

namespace App\Http\Controllers\Admins\Notifications;

use App\Model\Notifications\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller{
    private $notifications_model,$data;

    /**
     * AdminsController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->notifications_model = new Notifications();
        $this->data = $request->post();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main_page_view(Request $request){
        //Update Status
        $this->notifications_model->set_is_new(0);

        //Get Data
        $notifications = $this->notifications_model->get_notifications();

        return view('admin.notifications',[
            'notifications' => $notifications,
            'admin_role' => $request->acc_data->role
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_notification(Request $request){
        //Deleting
        if(!empty($this->data['notification_id'])){
            $this->notifications_model->delete_notifications_by_id($this->data['notification_id']);
        }

        return response()->json([
            'success' => true,
            'message' => 'success deleted'
        ],200);
    }


    /**
     *Destruct
     */
    public function __destruct(){
        unset($this->notifications_model);
        unset($this->data);
    }

}
