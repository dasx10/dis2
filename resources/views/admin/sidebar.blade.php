        <?php
                use App\Model\Admins\Admins;
                use App\Model\Sessions;
                use App\Model\Notifications\Notifications;
                use App\Model\Chat\ChatMessages;
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admins_data = Admins::where('id','=',$admins_id)->select('role')->first();
                $role = $admins_data->role;
                $dis_contents = ['super_admin','customer_service'];
                $admins = ['super_admin'];

                $clients = ['super_admin','admin','finance','customer_service','sales'];
                $catalog = ['super_admin','admin','sales','purchase','customer_service','purchase_assistant','opm'];

                $count_total = ChatMessages::where('users_to','=',$admins_id)
                    ->where('status','=','send')->count();
                $notifications_new = Notifications::where('is_new','=','1')->count();
        ?>
        <nav class="sidebar-nav sidebar-open">
                <ul class="ul-nav" style="margin-bottom: 6rem!important;">
                    <li><a class="nav-link nav-link-sidebar" href="/panel/admin">DASHBOARD</a></li>
                    @if(in_array($role,$catalog))
                        <li><a class="nav-link nav-link-sidebar" href="/panel/admin/catalog">CATALOGUE</a></li>
                    @endif
                    @if(in_array($role,['super_admin','purchase','customer_service','purchase_assistant']))
                        <li><a class="nav-link nav-link-sidebar" href="/panel/admin/orders">ORDERS</a></li>
                    @endif
                    @if(in_array($role,$clients))
                        <li><a class="nav-link nav-link-sidebar" href="/panel/admin/clients">CLIENTS</a></li>
                    @endif
                    @if(in_array($role,$admins))
                        <li><a class="nav-link nav-link-sidebar" href="/panel/admin/admins">ADMINS</a></li>
                    @endif
                    @if($role!='sales' && $role!='purchase_assistant')
                    <li><a class="nav-link nav-link-sidebar" href="/panel/admin/documents">DOCUMENTS</a></li>
                    @endif
                    @if(in_array($role,$dis_contents))
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link hide-menu"  href="#">WEB CONTENT <i class="fas fa-angle-right" style="float: right;
    font-size: 14px;"></i></a>
                        <ul class="ul-nav nav-second-level">
                            <li class="nav-item">
                                <a class="nav-link" style="padding-left:3.5rem;" href="/panel/admin/dis-content" target="_top">DIS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="padding-left:3.5rem;" href="/panel/admin/dolchem-content" target="_top">DOLCHEM</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li class="d-xs-block d-sm-block d-md-none d-xl-none"><a class="nav-link nav-link-sidebar" href="/panel/admin/messages">MESSAGES <span class="msg_inf">{{$count_total}}</span></a></li>
                    <li class="d-xs-block d-sm-block d-md-none d-xl-none"><a class="nav-link nav-link-sidebar" href="/panel/admin/notifications">NOTIFICATIONS <span class="notif_inf">{{$notifications_new}}</span></a></li>
                    <li class="d-xs-block d-sm-block d-md-none d-xl-none"><a class="nav-link nav-link-sidebar" href="/logout">LOG OUT</a></li>
                    <hr class="hide_name_sidebar" style="border-top:0.05rem solid #596b8a!important">
                    <li class="hide_name_sidebar"><a class="nav-link nav-link-hover nav-link-sidebar" href="#" style="text-transform:uppercase;text-align: center;padding-left: .5rem;"><span>Jonathan Washington</span> <br> <span>Operation manager</span></a></li>
                </ul>
            </nav>
