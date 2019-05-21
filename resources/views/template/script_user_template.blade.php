<script src="/public/js/jquery3-2-1.js"></script>
<script src="/public/js/popover.js"></script>
<script src="/public/js/bootstrap.js"></script>
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
        $('.nav-link').each(function () {
            var location = window.location.href;
            var link = this.href;
            if(location == link) {
                $(this).addClass('active');
            }
        });
        $(function(){
            $('.btn_open_navbar').click(function(){
                $('.sidebar-nav').toggleClass('sidebar-open');
                $('.logo-header').toggleClass('bg-logo');
            });
        });
        $(function(){
            $('.hide-menu').click(function(){
                $('.nav-second-level').toggleClass('open');
            });
        });
    });

    function sweet_modal(text,type,time) {
        $.sweetModal({
            content: text,
            icon: type,
            timeout:time
        });
    }
</script>
