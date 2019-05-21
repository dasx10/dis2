<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'authtoken_admin'=>\App\Http\Middleware\Web\AuthtokenAdmin::class,
        'authtoken_user'=>\App\Http\Middleware\Web\AuthtokenUser::class,
        'check_token' => \App\Http\Middleware\Api\CheckToken::class,
        '/api/login'=>\App\Http\Middleware\Web\Login::class,
        '/api/admin/signup'=>\App\Http\Middleware\Web\RegisterAdmin::class,
        '/api/admin/edit'=>\App\Http\Middleware\Web\EditAdmin::class,
        '/api/admin/delete'=>\App\Http\Middleware\Web\AdminDelete::class,
        '/api/admin/upload_file'=>\App\Http\Middleware\Web\AdminDownloadDoc::class,
        '/api/admin/delete/documents'=>\App\Http\Middleware\Web\DeleteAdminDocuments::class,
        '/api/admin/reupload_file'=>\App\Http\Middleware\Web\AdminRedownloadFile::class,
        '/api/admin/clients/add' => \App\Http\Middleware\Web\RegisterUser::class,
        '/api/admin/clients/main_page/add' => \App\Http\Middleware\Web\RegisterUserMainPage::class,
        '/api/signup/clients' => \App\Http\Middleware\Web\ConfirmRegister::class,
        '/api/admin/add_product' => \App\Http\Middleware\Web\AddProduct::class,
        '/api/admin/delete/product' => \App\Http\Middleware\Web\DeleteProduct::class,
        '/api/admin/product/change_status' => \App\Http\Middleware\Web\ChangeProductStatus::class,
//        '/panel/user/file-a-claim/create' => \App\Http\Middleware\Web\PanelUserFileAClaimCreate::class,
        '/api/panel/admin/chat/create' => \App\Http\Middleware\Web\ApiPanelAdminChatCreate::class,
        '/api/panel/admin/chat/delete' => \App\Http\Middleware\Web\ApiPanelAdminChatDelete::class,
        '/api/admin/chat/send_message' => \App\Http\Middleware\Web\ApiAdminChatSendMessage::class,
        '/api/admin/clients/base/edit' => \App\Http\Middleware\Web\ClientsEditBase::class,
        '/api/admin/brand/add' => \App\Http\Middleware\Web\Brands\AddBrand::class,
        '/api/admin/category/add' =>  \App\Http\Middleware\Web\Categories\AddCategory::class,
        '/api/admin/update_product' => \App\Http\Middleware\Web\UpdateProduct::class,
        '/api/admin/add_prize' => \App\Http\Middleware\Web\Prize\AddPrize::class,
        '/api/admin/update_prize' => \App\Http\Middleware\Web\Prize\UpdatePrize::class,
        '/panel/user/file-a-claim/create' => \App\Http\Middleware\Web\FileaclaimCreating::class,
        '/api/user/product/add_to_cart' => \App\Http\Middleware\Web\Basket\AddToBasket::class,
        '/api/orders/purchase' => \App\Http\Middleware\Web\Orders\PurchaseOrder::class,
    ];
}
