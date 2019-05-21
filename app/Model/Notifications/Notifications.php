<?php

namespace App\Model\Notifications;

use App\Model\Clients\Clients;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifications extends Model{
    protected $table = 'notifications';
    protected $dateFormat = 'U';
    protected $fillable = ['id','message','admins_id','title','is_new','is_view','src'];


    /**
     * @return mixed
     */
    public function get_notifications(){
        $notifications = self::orderBy('created_at','DESC')
            ->get();
        foreach ($notifications as $notification) {
            $notification->time = Clients::get_how_long($notification->created_at);
        }

        return $notifications;
    }

    /**
     * @param int $val
     *
     * @return bool
     */
    public function set_is_new($val = 0){
        return DB::table('notifications')->update([
            'is_new' => $val
        ]);
    }


    /**
     * @param $notifications_id
     *
     * @return mixed
     */
    public function delete_notifications_by_id($notifications_id){
        return self::where('id','=',$notifications_id)
            ->delete();
    }
}
