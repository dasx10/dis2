<?php

    namespace App\Model;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
    use App\Model\Clients\ClientsData;
    class Visitors extends Model{

        protected $table = 'visitors';
        protected $hidden = ['ip','user_agent'];
        protected $dateFormat = 'U';
        protected $fillable = ['id','ip','user_agent'];



        public static function set_visitor(){
            $templ = self::where([
                ['ip','=',\Request::ip()],
            ]);
            //Exists check
            $exists_id = $templ->value('id');
            if(!$exists_id) {
                self::create([
                    'ip' => \Request::ip(),
                    'user_agent' => \Request::header('User-Agent')
                ]);
            }
            return true;
        }


        public static function get_count(){
            return self::select(DB::raw('count(*) as count'))
                ->groupBy('ip')
                ->value('count');
        }

    }