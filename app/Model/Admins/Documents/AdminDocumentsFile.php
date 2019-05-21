<?php

    namespace App\Model\Admins\Documents;
    use Illuminate\Database\Eloquent\Model;

    class AdminDocumentsFile extends Model{
        protected $table = 'admins_documents_file';
        protected $dateFormat = 'U';
        protected $fillable = ['id','admins_documents_id','edit_admins_id','url'];

    }