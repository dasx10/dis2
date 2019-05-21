@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
    @include('admin.sidebar')
    <main class="main">
        <div class="container-fluid main_container_fluid">
            <div class="card box-shadow">
                <div class="card-header" style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0">
                    <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;"><button onclick='location.href="/panel/admin/admins"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button><a href="/panel/admin/admins" style="color:#4c6897;">ADMINS</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>Add new</span></h5>
                </div>
                <div class="card-block">
                    <div class="row">
                    <form class="container-fluid  p-t-b p-r-l" action="/api/register/admin" method="POST">
                    <div class="row" style="margin-bottom:15px;">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="col form-group">
                                <span class="ico_input text-center"><i class="fas fa-user-circle" aria-hidden="true" style="color: #aab4bc;font-size: 1.5rem;margin-top: .9rem;"></i></span>
                                <input maxlength="20" type="text" name="name" class="form-control addon check_letter" style="text-transform: capitalize"  placeholder="Name" required >
                            </div>
                            <div class="col form-group">
                                <span class="ico_input text-center"><i class="far fa-envelope" aria-hidden="true" style="color: #aab4bc;font-size: 1.5rem;margin-top: .9rem;"></i></span>
                                <input maxlength="40" type="email" name="email" class="form-control addon" placeholder="Email" required>
                            </div>
                            <div class="col form-group">
                                <span class="ico_input text-center"><i class="fa fa-lock" aria-hidden="true" style="color: #aab4bc;font-size: 1.3rem;margin-top: 1.1rem;"></i></span>
                                <input type="password" name="password" placeholder="Password" required class="form-control addon">
                            </div>
                        </div>
                        <input type="hidden" value="{{$token}}" name="token">
                        <div class=" col-md-12 col-lg-6 col-xl-6">
                            <div class="col  form-group">
                                <span class="ico_input text-center"><i class="fa fa-cog" aria-hidden="true" style="color: #aab4bc;font-size: 1.5rem;margin-top: .9rem;"></i></span>
                                <div class="styled-select">
                                    <select name="role" class="form-control addon" required>
                                        <option selected disabled value="">Role</option>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="sales">Sales</option>
                                        <option value="purchase">Purchase</option>
                                        <option value="purchase_assistant">Purchase Assistant</option>
                                        <option value="customer_service">Customer Service</option>
                                        <option value="finance">Finance</option>
                                        <option value="opm">Operation Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col form-group">
                                <span class="ico_input text-center"><i class="fa fa-globe" aria-hidden="true" style="color: #aab4bc;font-size: 1.5rem;margin-top: .9rem;"></i></span>
                                <div class="styled-select">
                                    <select name="regione" class="form-control addon" required>
                                        <option disabled selected value="">Region</option>
                                        <option value="MENA">MENA</option>
                                        <option value="Asia">Asia</option>
                                        <option value="Europe">Europe</option>
                                        <option value="South America">South America</option>
                                        <option value="North America">North America</option>
                                        <option value="Australia">Australia</option>
                                        {{--<option value="other">Other+</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col form-group">
                                <span class="ico_input text-center"><i class="fa fa-lock" aria-hidden="true" style="color: #aab4bc;font-size: 1.3rem;margin-top: 1.1rem;"></i></span>
                                <input type="password" name="password_confirm" placeholder="Confirm password" required class="form-control addon">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="col role_admin">
                            <p style="margin-bottom: 0.5rem;"><b>Super Admin(SA)</b> - <span style="color:#646464;">This account will have access to everything with no restrictions</span></p>
                            <p style="margin-bottom: 0.2rem;"><b>Admin(A)</b> - <span style="color:#646464;">This account is the SA assistant:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Reorganization of files</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Add but not Remove products</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Manage forms + Template</p>
                            <p style="margin-bottom: 0.2rem;"><b>Sales(S)</b> <span style="color:#646464;">will have access to:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Client Details (Customized, not all clients, only clients from certain regions)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Product Details</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Sales Figures (Customized, not all clients, only clients from certain regions)</p>
                            <p style="margin-bottom: 0.2rem;"><b>Purchase(P)</b> <span style="color:#646464;">will have access to:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Supplier Details</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Product Details (technical)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Purchase Documents & Email Templates</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Purchase statistics (Purchase price)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Creating (Adding) products</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Adding TDS,MSDS and other documents related to products</p>
                        </div>
                        </div>
                        <div class=" col-md-12 col-lg-6 col-xl-6">
                            <div class="col role_admin">
                            <p style="margin-bottom: 0.2rem;"><b>Customer Service(CS)</b> <span style="color:#646464;">will have access to:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Client Details</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Product Details (sales)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Sales Figures</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Export Documents & Email Templates</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Creating Products</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Adding certificates and documents related to the company or products</p>
                            <p style="margin-bottom: 0.2rem;"><b>Finance(F)</b> <span style="color:#646464;">will have access to:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Sales Figures</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Export Documents</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Client Details</p>
                            <p style="margin-bottom: 0.2rem;"><b>Operation Manager(OPM)</b> <span style="color:#646464;">will have access to:</span></p>
                            {{--<p style="margin:0;color:#646464;font-style: italic;">- Supplier Details</p>--}}
                            <p style="margin:0;color:#646464;font-style: italic;">- Product Details (technical)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Purchase Documents & Email Templates</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Purchase statistics (Purchase price)</p>
                            <p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Export Documents</p>
                            {{--<p style="margin-bottom: 0.5rem;color:#646464;font-style: italic;">- Client Details</p>--}}
                            <p style="margin-bottom: 0.2rem;"><b>Purchase Assistant(PA)</b> <span style="color:#646464;">will have access to:</span></p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Supplier Details</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Product Details (technical)</p>
                            <p style="margin:0;color:#646464;font-style: italic;">- Purchase Documents & Email Templates</p>
                        </div>
                        </div>
                        </div>
                        <div class="row" style="margin: 15px 0 25px 0">
                            <div class="col-12 text-center">
                                <input type="submit" class="btn_page btn_submit" value="Add New">
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script>
        $('form').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/signup",
                type:"POST",
                data:$(this).serialize(),
                dataType: 'JSON',
                success:function (data) {
		            console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/admins';
                        },1000)
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })

        });

        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }
        $(document).ready(function () {
            $(".header_text").html('Admins');
        });

        $(document).ready(function(){
            $('.check_letter').keypress(validateLeter);
            $('.check_letter').blur(function(){
                $(this).val($.trim($(this).val()));
            });

        });
        function validateLeter(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 32) {
                return true;
            } else if ( (key >= 65 && key <= 90) || (key >= 97 && key <= 122) ){
                return true;
            } else {
                return false;
            }
        };
    </script>
@endsection