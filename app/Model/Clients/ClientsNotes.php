<?php

namespace App\Model\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientsNotes extends Model{
    protected $table = 'users_notes';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','text'];

    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_clients_notes($users_id){
        $notes = self::where('users_id','=',$users_id)
            ->orderBy('updated_at','DESC')
            ->get();

        foreach ($notes as $note) {
            $note->last_time = Clients::get_how_long($note->updated_at,'2');
        }

        return $notes;
    }

    /**
     * @param $array
     *
     * @return mixed
     */
    public function create_new($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }

    /**
     * @param $notes_id
     * @param $array
     *
     * @return mixed
     */
    public function update_note($notes_id, $array){
        return self::where('id','=',$notes_id)
            ->update($array);
    }

    /**
     * @param $notes_id
     *
     * @return mixed
     */
    public function delete_note($notes_id){
        return self::where('id','=',$notes_id)
            ->delete();
    }
}
