<?php
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Storage;
    use App\Model\Logs\Logs;
    use App\Exports\Model\Products\ProductsExport;
    use Maatwebsite\Excel\Facades\Excel;
    //Migration
    Route::get('/migrate',function () {
        Artisan::call('migrate');
        return response()->json([
            'success' => true,
            'message' => 'Success migrate'
        ],200);
    });


    //View cache clear
    Route::get('/view',function () {
        Artisan::call('view:clear');
        return response()->json([
            'success' => true,
            'message' => 'Success migrate'
        ],200);
    });


    //--------------------------------
    //oAuth
    Route::get('/login','oAuth\LoginController@login_view');
    Route::get('/logout','oAuth\LoginController@logout');

    //Sign Up
    Route::get('/sign-up',function (){
        return view('main.signup',[
            'referal_id' => ''
        ]);
    });
    Route::get('/sign-up/{referal_id}',function ($referal_id=''){
        return view('main.signup',[
            'referal_id' => $referal_id
        ]);
    });
    Route::get('/signup','oAuth\Clients\RegisterController@clients_register_view');
    Route::get('/signup/{token}',function ($token){
        return redirect()->action('oAuth\Clients\RegisterController@clients_register_view', ['token' => $token]);
    });


    //Confirms
    Route::get('/confirm/user/{token}','Clients\ClientsController@confirm_new_user');

    Route::get('/user/confirm_by_admin/{token}','Clients\ClientsController@confirm_new_user_success');
    Route::get('/user/cancel_by_admin/{token}','Clients\ClientsController@confirm_new_user_cancel');
    //------------------------------------



//------------ MAIN PAGES ------------///
Route::get('/under',function (){
    return view('main.under');
});
Route::get('/dolpack',function (){
    return view('main.dolpack');
});
Route::get('/dolec',function (){
    return view('main.dolec');
});
Route::get('/ice',function (){
    return view('main.ice');
});
Route::get('/aliva-food',function (){
    return view('main.aliva-food');

});
    Route::get('/', 'Main\MainController@main_page_view');//
    Route::get('/brands', 'Main\MainController@brands_page_view');

//    Route::get('/food-industry', 'Main\MainController@industries_page_view');
//    Route::get('/paint-industry', 'Main\MainController@paint_page_view');
//    Route::get('/sanitary-industry', 'Main\MainController@sanitary_page_view');
//    Route::get('/cooling-industry', 'Main\MainController@cooling_page_view');

    Route::get('/our-industries', 'Main\MainController@our_industries_page_view');
    Route::get('/tailor', 'Main\MainController@tailor_page_view');
    Route::get('/about', 'Main\MainController@main_about_page_view');
    Route::get('/about/about-long', 'Main\MainController@main_about_long_page_view');
    Route::get('/join', 'Main\MainController@join_page_view');
    Route::get('/join-popup', 'Main\MainController@join_popup_page_view');
    Route::get('/contact', 'Main\MainController@contact_page_view');
    Route::get('/industries/{name}', 'Main\MainController@industries_name_view');
//------------ MAIN PAGES ------------//

//------------ USER ADMIN PANEL PAGES ------------//
    Route::group(['middleware' => 'authtoken_user'], function() {
        Route::get('/panel/user', 'Clients\ClientsController@main_view');
        Route::get('/panel/user/current-orders', 'Clients\ClientsController@current_orders_view');
        Route::get('/panel/user/archives', 'Clients\ClientsController@archives_view');
        Route::get('/panel/user/products', 'Admins\Products\ProductsController@products_user_view');
        Route::get('/panel/user/products/overview/{id}', 'Clients\ClientsController@product_overview_view');
        Route::get('/panel/user/file-a-claim', 'Clients\Fileaclaim\FileaclaimController@main_view');
        Route::get('/panel/user/reedem-dis-points', 'Clients\ClientsController@dis_points_view');
        Route::get('/panel/user/my-dis-points', function () {
            return view('user.my_dis_points');
        });
        Route::get('/panel/user/purchase-orders','Clients\ClientsController@purchase_orders_view');
        Route::get('/panel/user/current-orders/{id}','Clients\ClientsController@current_orders_by_id_view');
        Route::get('/panel/user/track-your-orders', 'Clients\ClientsController@track_your_order_main');
        Route::get('/panel/user/track-your-orders/{dis_ref}', 'Clients\ClientsController@track_your_order_by_dis_ref');
        Route::get('/panel/user/messages','Admins\Chat\ChatController@main_view_user');
        Route::get('/panel/user/chat/{chat_id}', 'Admins\Chat\ChatController@chat_view_user');
    });
//------------ USER ADMIN PANEL PAGES ------------//

//------------ ADMIN ADMIN PANEL PAGES ------------//
    Route::group(['middleware' => 'authtoken_admin'], function() {
        Route::get('/panel/admin', 'Admins\AdminsController@main_page_view');
        Route::get('/panel/admin/catalog','Admins\Products\ProductsController@catalog_view');
        Route::get('/panel/admin/add-products', 'Admins\Products\ProductsController@add_product_view');
        Route::get('/panel/admin/edit-products', function () {
            return view('admin.edit_products');
        });

        Route::get('/panel/admin/clients/view','Admins\Clients\ClientsController@client_edit_view');
        Route::get('/panel/admin/view-products/{id}','Admins\Products\ProductsController@products_view_by_id');

        Route::get('/panel/admin/orders', 'Admins\AdminsController@orders_view');
        Route::get('/panel/admin/orders/documents/{id}','Admins\AdminsController@orders_documents_view');
        Route::get('/panel/admin/orders/track', function () {
            return view('admin.track');
        });
        Route::get('/panel/admin/clients', 'Admins\Clients\ClientsController@clients_main_view');
        Route::get('/panel/admin/clients/edit', function () {
            return view('admin.clients_edit');
        });
        Route::get('/panel/admin/product/edit/{id}','Admins\Products\ProductsController@edit_products_view');
        Route::get('/panel/admin/clients/add','Admins\Clients\ClientsController@client_add_view');
        Route::get('/panel/admin/clients/view/{users_id}','Admins\Clients\ClientsController@client_edit_view');

        Route::get('/panel/admin/admins', 'Admins\AdminsController@main');

        Route::get('/panel/admin/admins/edit/{id}','Admins\AdminsController@admin_edit_view');

        Route::get('/panel/admin/admins/add', 'Admins\AdminsController@add_admins_view');
        Route::get('/panel/admin/documents', 'Admins\Documents\DocumentsController@documents_main_view');

        Route::get('/panel/admin/dis-content', 'Admins\DisContents\DisContentsController@edit_dis_content');
        Route::get('/panel/admin/messages','Admins\Chat\ChatController@main_view');
        Route::post('/api/admin/chat/get_messages','Admins\Chat\ChatController@get_messages');
        Route::get('/panel/admin/chat/{chat_id}', 'Admins\Chat\ChatController@chat_view');


        Route::get('/panel/admin/notifications', 'Admins\Notifications\NotificationsController@main_page_view');
        Route::get('/panel/admin/my-desk-content', function () {
            return view('admin.my_desk_content');
        });

        Route::get('/xls/get',function (){
            return Excel::download(new ProductsExport, 'products.xlsx');
        });

        Route::get('/panel/admin/dolchem-content', 'Admins\DolchemContents\DolchemContentsController@dolchem_content_view');
    });
//------------ ADMIN ADMIN PANEL PAGES ------------//


//------------ API ------------//
    Route::group(['middleware' => 'check_token'], function() {

        //Admin Reg New Admin
        Route::post('/api/admin/signup','oAuth\Admin\RegisterController@register')
            ->middleware('/api/admin/signup');

        //Edit admin
        Route::post('/api/admin/edit','Admins\AdminsController@edit_admin_data')
            ->middleware('/api/admin/edit');

        //Delete admin
        Route::post('/api/admin/delete','Admins\AdminsController@delete_admin')
            ->middleware('/api/admin/delete');

        //Delete admin documents
        Route::post('/api/admin/delete/documents','Admins\Documents\DocumentsController@delete_documents');

        //Download admin documents
        Route::post('/api/admin/upload_file','Admins\Documents\DocumentsController@upload_file')
            ->middleware('/api/admin/upload_file');

        //Update admin documents
        Route::post('/api/admin/reupload_file','Admins\Documents\DocumentsController@reupload_file')
            ->middleware('/api/admin/reupload_file');

        //Update Status Of Product
        Route::post('/api/admin/product/change_status','Admins\Products\ProductsController@change_status')
            ->middleware('/api/admin/product/change_status');

        //Delete Product
        Route::post('/api/admin/delete/product','Admins\Products\ProductsController@delete_products')
            ->middleware('/api/admin/delete/product');

        //Delete Prize
        Route::post('/api/admin/delete/prize','Admins\Products\ProductsController@delete_prize');

        //Add Brands
        Route::post('/api/admin/brand/add','Admins\Products\ProductsController@add_brand')
            ->middleware('/api/admin/brand/add');

        //Add Category
        Route::post('/api/admin/category/add','Admins\Products\ProductsController@add_category')
            ->middleware('/api/admin/category/add');

        //Delete Brand
        Route::post('/api/admin/brand/delete','Admins\Products\ProductsController@delete_brand');

        //Delete Category
        Route::post('/api/admin/category/delete','Admins\Products\ProductsController@delete_category');

        //Add Product
        Route::post('/api/admin/add_product','Admins\Products\ProductsController@add_product')
            ->middleware('/api/admin/add_product');

        //Update Product
        Route::post('/api/admin/update_product','Admins\Products\ProductsController@update_product')
            ->middleware('/api/admin/update_product');

        //Add Prize
        Route::post('/api/admin/add_prize','Admins\Products\ProductsController@add_prize')
            ->middleware('/api/admin/add_prize');

        //Update Prize
        Route::post('/api/admin/update_prize','Admins\Products\ProductsController@update_prize')
            ->middleware('/api/admin/update_prize');

        //Delete Notifications
        Route::post('/api/admin/notification/delete','Admins\Notifications\NotificationsController@delete_notification');

        //Create Chat
        Route::post('/api/panel/admin/chat/create','Admins\Chat\ChatController@chat_create')
            ->middleware('/api/panel/admin/chat/create');

        //Delete Chat
        Route::post('/api/panel/admin/chat/delete','Admins\Chat\ChatController@delete_chat')
            ->middleware('/api/panel/admin/chat/delete');

        //Send Message To Chat
        Route::post('/api/admin/chat/send_message','Admins\Chat\ChatController@send_message')
            ->middleware('/api/admin/chat/send_message');

        //Delete Messages by ids
        Route::post('/api/admin/chat/delete_messages','Admins\Chat\ChatController@delete_messages');

        //Search Messages
        Route::post('/api/admin/chat/search','Admins\Chat\ChatController@search_message');

        //Clients edit
        Route::post('/api/admin/clients/base/edit','Clients\ClientsController@client_edit_base')
            ->middleware('/api/admin/clients/base/edit');

        //File a Claim Create
        Route::post('/panel/user/file-a-claim/create', 'Clients\Fileaclaim\FileaclaimController@create_claim')
            ->middleware('/panel/user/file-a-claim/create');

        //Edit Industries
        Route::post('/api/admin/page/industries/edit','Admins\DisContents\DisContentsController@industries_edit');

        //Edit Descr Photo
        Route::post('/api/admin/page/industries_descr_photo/edit','Admins\DisContents\DisContentsController@industries_descr_photo_edit');

        //Industries Slide Edit
        Route::post('/api/admin/page/industries_slide/delete','Admins\DisContents\DisContentsController@industries_slider_delete');

        //Industry Slide Edit
        Route::post('/api/admin/page/industries_slider/edit','Admins\DisContents\DisContentsController@industries_slider_edit');

        //Industries position set
        Route::post('/api/admin/page/industries/set_position','Admins\DisContents\DisContentsController@industries_set_position');

        //Delete Industry
        Route::post('/api/admin/page/industry/delete','Admins\DisContents\DisContentsController@delete_industry');

        //Set Industry slides Position
        Route::post('/api/admin/page/industries_slider/set_position','Admins\DisContents\DisContentsController@industries_slider_set_position');

        //Set join position
        Route::post('/api/admin/page/join_slider/set_position','Admins\DisContents\DisContentsController@join_slider_set_position');

        //Create Edit Marker
        Route::post('/api/admin/page/markers/edit','Admins\DisContents\DisContentsController@edit_create_markers');

        //Delete Marker
        Route::post('/api/admin/page/marker/delete','Admins\DisContents\DisContentsController@delete_markers');

        //Clients search
        Route::post('/api/admin/clients/search','Admins\Clients\ClientsController@search_user');

        //Notes Edit
        Route::post('/api/admin/notes/edit','Admins\Clients\ClientsController@client_edit_notes')
            ->middleware('/api/admin/clients/base/edit');

        //Notes Delete
        Route::post('/api/admin/notes/delete','Admins\Clients\ClientsController@client_delete_notes')
            ->middleware('/api/admin/clients/base/edit');

        //Set Access Brands
        Route::post('/api/admin/brand/set_access','Admins\Clients\ClientsController@client_set_access_brand')
            ->middleware('/api/admin/clients/base/edit');

        //Upload XLS
        Route::post('/api/admin/product/upload_xls','Admins\Products\ProductsController@upload_xls_file');


        //Create Edit Page Main Slide
        Route::post('/api/admin/dolchem_page/main_page/edit','Admins\DolchemContents\DolchemContentsController@dolchem_main_page_content_edit');

        //Pos Set Main Page
        Route::post('/api/admin/dolchem_page/main_page/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_main_page_pos_set');

        //Create Edit About Brand
        Route::post('/api/admin/dolchem_page/about_brand/edit','Admins\DolchemContents\DolchemContentsController@dolchem_about_brand_content_edit');

        //Pos Set Brand About
        Route::post('/api/admin/dolchem_page/about_brand/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_about_brand_pos_set');

        //Delete Slide Main Page
        Route::post('/api/admin/dolchem_page/main_page/delete','Admins\DolchemContents\DolchemContentsController@dolchem_main_page_content_delete');

        //Delete About Brand
        Route::post('/api/admin/dolchem_page/about_brand/delete','Admins\DolchemContents\DolchemContentsController@dolchem_about_brand_content_delete');

        //Delete Certifications
        Route::post('/api/admin/dolchem_page/certifications/delete','Admins\DolchemContents\DolchemContentsController@dolchem_certifications_delete');

        //Pos Set Certifications
        Route::post('/api/admin/dolchem_page/certifications/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_certifications_pos_set');

        //Create Edit Certification
        Route::post('/api/admin/dolchem_page/certifications/edit','Admins\DolchemContents\DolchemContentsController@dolchem_certifications_content_edit');

        //Create Edit Quality Assurance
        Route::post('/api/admin/dolchem_page/quality_assurance/edit','Admins\DolchemContents\DolchemContentsController@dolchem_quality_assurance_content_edit');

        //Delete Quality Assurance
        Route::post('/api/admin/dolchem_page/quality_assurance/delete','Admins\DolchemContents\DolchemContentsController@dolchem_quality_assurance_delete');

        //Pos Set Certifications
        Route::post('/api/admin/dolchem_page/quality_assurance/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_quality_assurance_pos_set');

        //Save Content
        Route::post('/api/admin/dolchem_page/content/edit','Admins\DolchemContents\DolchemContentsController@dolchem_content_save');

        //Create Edit Packing
        Route::post('/api/admin/dolchem_page/packing/edit','Admins\DolchemContents\DolchemContentsController@dolchem_packing_content_edit');

        //Delete packing
        Route::post('/api/admin/dolchem_page/packing/delete','Admins\DolchemContents\DolchemContentsController@dolchem_packing_delete');

        //Pos Set Packing
        Route::post('/api/admin/dolchem_page/packing/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_packing_pos_set');

        //Create edit
        Route::post('/api/admin/dolchem_page/download_kit/edit','Admins\DolchemContents\DolchemContentsController@dolchem_download_kit_content_edit');

        //Delete Download Kit
        Route::post('/api/admin/dolchem_page/download_kit/delete','Admins\DolchemContents\DolchemContentsController@dolchem_download_kit_delete');

        //Pos Set Download Kit
        Route::post('/api/admin/dolchem_page/download_kit/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_download_kit_pos_set');

        //Dolchem Marker Add Edit
        Route::post('/api/admin/page/dolchem_marker/edit','Admins\DolchemContents\DolchemContentsController@edit_create_markers');

        //Delete Dolchem Marker
        Route::post('/api/admin/page/dolchem_marker/delete','Admins\DolchemContents\DolchemContentsController@delete_markers');

        //Create edit prod category
        Route::post('/api/admin/dolchem_page/products_categories/edit','Admins\DolchemContents\DolchemContentsController@dolchem_products_categories_content_edit');

        //Delete prod category
        Route::post('/api/admin/dolchem_page/products_categories/delete','Admins\DolchemContents\DolchemContentsController@dolchem_products_categories_delete');

        //Pos Set prod category
        Route::post('/api/admin/dolchem_page/products_categories/set_position','Admins\DolchemContents\DolchemContentsController@dolchem_products_categories_pos_set');

        //Cat Add
        Route::post('/api/admin/page/dolchem_category/edit','Admins\DolchemContents\DolchemContentsController@dolchem_category_select');

        //Prize Buy
        Route::post('/api/user/prize/buy','Clients\ClientsController@prize_buy');

        //Add To Basket
        Route::post('/api/user/product/add_to_cart','Clients\ClientsController@add_product_to_cart')
            ->middleware('/api/user/product/add_to_cart');

        //main_slider edit
        Route::post('/api/admin/page/main_slider/edit','Admins\AdminsController@main_slider_edit');

        //brand_slider edit
        Route::post('/api/admin/page/brand_slider/edit','Admins\AdminsController@brand_slider_edit');

        //main_slider delete
        Route::post('/api/admin/page/main_slider/delete','Admins\AdminsController@main_slider_delete');

        //brand_slider delete
        Route::post('/api/admin/page/brand_slider/delete','Admins\AdminsController@brand_slider_delete');

        //Delete Prod from cart
        Route::post('/api/user/product/delete_from_cart','Clients\ClientsController@delete_product_from_cart');

        //Purchase Order
        Route::post('/api/orders/purchase','Clients\ClientsController@order_purchase')
            ->middleware('/api/orders/purchase');

        //Edit order info
        Route::post('/api/order/info/save','Admins\AdminsController@edit_orders_info');

        //Change order status
        Route::post('/api/orders/change_status','Admins\AdminsController@change_order_status');

        //Edit price components
        Route::post('/api/admin/price_components/edit','Admins\AdminsController@edit_price_components');

        //Create Region
        Route::post('/api/admin/regione/create','Admins\AdminsController@create_region');


        Route::post('/api/admin/delete/region','Admins\AdminsController@delete_region');
    });

    Route::get('/ttt',function (){
       dd(\App\Model\Main\Industries::get_link('<p><span style="color:#253756"><span style="font-family:RalewayMedium">PAINT &amp; COATING&nbsp;<br />INDUSTRY</span></span></p>'));
    });

    //Login
    Route::post('/api/login','oAuth\LoginController@login')
        ->middleware('/api/login');



    //Clients add
    Route::post('/api/admin/clients/add',[
        'middleware'=>'/api/admin/clients/add',
        'uses'=>'oAuth\Clients\RegisterController@register'
    ]);


    Route::post('/api/signup/clients',[
       'middleware'=>'/api/signup/clients',
       'uses'=>'oAuth\Clients\RegisterController@confirm_password'
    ]);





    Route::post('/api/admin/notifications/inactive','Admins\AdminsController@notification_set_inactive');
    Route::post('/api/admin/page/main_slider/set_position','Admins\AdminsController@main_slider_set_position');
    Route::post('/api/admin/page/descr_main/edit','Admins\AdminsController@main_descr_edit');
    Route::post('/api/admin/page/brand_slider/set_position','Admins\AdminsController@brand_slider_set_position');


    Route::post('/api/admin/page/tailor_slider/edit','Admins\AdminsController@tailor_slider_edit');
    Route::post('/api/admin/page/tailor/delete','Admins\AdminsController@tailor_slider_delete');
    Route::post('/api/admin/page/tailor_slider/set_position','Admins\AdminsController@tailor_slider_set_position');
    Route::post('/api/admin/page/join_slider/edit','Admins\AdminsController@join_slider_edit');
    Route::post('/api/admin/page/join/delete','Admins\AdminsController@join_slider_delete');
    Route::post('/api/admin/page/join_slider/set_position','Admins\AdminsController@join_slider_set_position');

    Route::post('/api/orders/delete','Admins\AdminsController@delete_order');

    Route::post('/api/order/category/create','Admins\AdminsController@category_order_create');
    Route::post('/api/order/category/delete','Admins\AdminsController@category_order_delete');

    Route::post('/api/contact_send',[
        'uses'=>'Contact\ContactController@send_email'
    ]);

    Route::post('/api/join_send',[
        'uses'=>'Contact\ContactController@join_send'
    ]);



    Route::post('/api/admin/orders/category/delete','Admins\Products\ProductsController@delete_order_category');


    Route::post('/api/admin/prod_photo/delete','Admins\Products\ProductsController@prod_photo_delete');
    Route::post('/api/admin/prod_doc/delete','Admins\Products\ProductsController@prod_doc_delete');
    Route::post('/api/admin/clients/main_page/add','Clients\ClientsController@clients_main_page_add')
        ->middleware('/api/admin/clients/main_page/add');

//------------ API ------------//

    Route::get('/test',function (){
        \App\Model\Clients\ClientsData::ref_points_updates(8,10,'C-11118-2853',2);
    });

