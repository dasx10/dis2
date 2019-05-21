<?php

    namespace App\Model\Contact;
    use Illuminate\Database\Eloquent\Model;

    class Contact extends Model{
        protected $table = 'contact';
        protected $fillable = ['id','email','name','message','department','phone','subject'];
        protected $dateFormat = 'U';

    }