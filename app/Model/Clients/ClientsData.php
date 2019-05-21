<?php

namespace App\Model\Clients;
use App\Model\Points\Points;
use Illuminate\Database\Eloquent\Model;

class ClientsData extends Model{
    protected $table = 'users_data';
    protected $dateFormat = 'U';
    protected $fillable = ['created_at','updated_at','id','potential_products',
        'preferred_destination_port','preferred_packaging_style','users_id','bisiness_scope',
        'can_see','password','email','country','contact_name', 'position','phone_number',
        'company_website','company_name','product_of_interest', 'industry','regione','nif',
        'iban','billing_address','banks_details','dis_points','terms','dop_bank1','dop_bank2','ref_id',
        'payment_type_default','payment_type_other','limitations','notes','registered_by'];

    /**
     * @param $array
     *
     * @return mixed
     */
    public function create_users_data($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }

    /**
     * @param $users_id
     * @param $array
     *
     * @return mixed
     */
    public function update_users_data($users_id, $array){
        return self::where('users_id','=',$users_id)
            ->update($array);
    }

    public static function ref_points_updates($users_id,$orders_id,$orders_name,$points){
        $registered_by = self::where('users_id','=',$users_id)->value('registered_by');
        if(!empty($registered_by)){
            $insert_data = [
                'users_id'    => $registered_by,
                'orders_id'   => $orders_id,
                'orders_name' => $orders_name
            ];
            $curr_time = time();
            $reg_time = self::where('users_id','=',$registered_by)->value('created_at');

            $diff = floor(($curr_time-strtotime($reg_time->toDateTimeString()))/31556926);

            if($diff==0){
                $insert_data['count'] = $points;
            }elseif ($diff==1){
                $insert_data['count'] = floor($points/2);
            }

            if($insert_data['count']!=0) {
                Points::create($insert_data);
                self::where('users_id', '=', $registered_by)->increment('dis_points', $insert_data['count']);
            }
        }
        return true;
    }
}