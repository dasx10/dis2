<script src="/public/js/jquery3-2-1.js"></script>
<script src="/public/js/popover.js"></script>
<script src="/public/js/bootstrap.js"></script>
{{--<script src="/public/js/admin_font_awesome.js"></script>--}}
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="/public/js/jquery.sweet-modal.js"></script>
<script src="/public/js/tether.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/public/js/jquery.sweet-modal.js"></script>
<script>
    $(function () {
        $('.nav-link-sidebar').each(function () {
            var location = window.location.href;
            var link = this.href;
            if(location == link) {
                $(this).addClass('a_active');
                $(this).append(' <span class="float-right"><img class="sidebar-img" src="/public/img/admin/nav_menu.png" alt=""></span>');
            }
        });
    });

    function sweet_modal(text,type,time) {
        $.sweetModal({
            content: text,
            icon: type,
            timeout:time
        });
    }

    $(function(){
        $('.btn_open_navbar').click(function(){
            $('.sidebar-nav').toggleClass('sidebar-open');
            $('.logo-header').toggleClass('bg-logo');
        });
    });
    $(function(){
        $('.hide-menu').click(function(){
            $('.nav-second-level').toggleClass('open');
            $('.fa-angle-right').toggleClass('vertical-icon')
        });
    });

    function location_people(id) {
        window.location = '/panel/admin/chat/'+id;
    }

    $( function() {

        $( "input[name='search_people_chat']" ).autocomplete({
            minLength: 1,
            source: function( request, response ) {
                console.log(request.term);
                $.ajax({
                    url: "/api/admin/chat/search",
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    data: {
                        token:'{{\App\Model\Sessions::get_token()}}',
                        text:request.term,
                        type:'people'
                    },
                    success: function (data) {
                        $('.latest_from_text').css('display','none');
                        $('input[name="search_people_chat"]').removeClass('ui-autocomplete-loading');
                        console.log(data);
                        $('.search_people').html('');
                        for(var k in data.items){
                            var out = '<div style="cursor: pointer" onclick="location_people('+data.items[k].id+')" class=" col text-center">\n' +
                                '                            <span data-msg="'+data.items[k].value.slice(0,1)+'"></span>\n' +
                                '                            <p style="margin:0;font-size: 1.125rem;"><b>'+data.items[k].value+'</b></p>\n' +
                                '                            <p style="margin:0;font-size: 0.875rem;">'+data.items[k].time+'</p>\n' +
                                '                        </div>';

                            $('.search_people').append(out);
                        }
                    },error:function (data) {
                        console.log(data);
                    }
                });
            },
            focus: function( event, ui ) {
                return false;
            },
            select: function( event, ui ) {
                window.location = '/panel/admin/chat/'+ui.item.id;
                console.log(ui);
                return false;
            }
        })
    } );

    function delete_notifications_block(id) {
        $.ajax({
            url:"/api/admin/notifications/inactive",
            type:"POST",
            data:{notification_id:id},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                '_token': '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success:function (data) {
                console.log(data);
                if(data.success==true){
//                    sweet_modal('Success','success',1000);
                }else{
//                    sweet_modal(data.message,'error',1000);
                }
                $(".btn_submit").removeAttr('disabled');
            },error:function (data) {
                console.log(data);
//                sweet_modal('Something went wrong','error',1000);
                $(".btn_submit").removeAttr('disabled');
            }
        });
        $('.notifications_item[data-id="'+id+'"]').remove();
    }
</script>