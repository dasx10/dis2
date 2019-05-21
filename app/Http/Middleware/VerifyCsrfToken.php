<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/login',
        '/api/login/user',
        '/api/login/admin',
        '/api/admin/signup',
        '/api/admin/edit',
        '/api/admin/delete',
        '/api/admin/upload_file',
        '/api/admin/delete/documents',
        '/api/admin/reupload_file',
        '/api/admin/clients/add',
        '/api/admin/clients/search',
        '/api/signup/clients',
        '/api/admin/add_product',
        '/api/admin/update_product',
        '/api/admin/add_prize',
        '/api/admin/delete/product',
        '/api/admin/product/change_status',
        '/chat/message',
        '/panel/user/file-a-claim/create',
        '/api/panel/admin/chat/create',
        '/api/panel/admin/chat/delete',
        '/contact',
        '/api/admin/delete/prize',
        '/test/array',
        '/api/admin/update_prize',
    ];
}
