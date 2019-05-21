{{--<script src="/public/js/jquery.3.2.1_slim.js"></script>--}}
<script src="/public/js/jquery3-2-1.js"></script>
<script src="/public/js/popover.js"></script>
<script src="/public/js/bootstrap.js"></script>
<script src="/public/js/jquery.cssslider.js"></script>
<script src="/public/js/jquery.webui-popover.js"></script>
<script src="/public/js/jquery.sweet-modal.js"></script>
<script>
    $(function () {
        $('.nav-item a').each(function () {
            var location = window.location.href;
            var link = this.href;
            if(location == link) {
                $(this).addClass('active');
            }
        });
         if(window.location.pathname=='/about/about-long'){
                $('a.about_long').addClass('active');
            }
    });
    setTimeout(function() {
        var height  = $(window).height();
        // updateFooter(height);
    }, 500);
    var heroArray = [
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588089_Wu1hd_food-hover1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588092_IQ9B5_paint-hover1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588093_fXYFG_des-hover1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588137_ze1Yh_cooler-hover1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588306_6vrRb_machinery1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588398_slxTl_equip.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588614_83WHG_chemichal-hov.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588361_CyFzJ_natural-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588444_t64Bd_machinery1.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588584_pBdC5_chemichal-hov.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588646_rw7pw_chemichal-hov.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588661_kspXh_packing-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588719_zC7Rd_cooling-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541588741_oQ9kk_gas-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601911_YN1lR_by-form-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601910_af5nE_partner-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601908_os0Wn_join-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601848_DqqMo_lang-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601845_UN9B0_consal-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601844_jnZVx_label-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1541601840_duhEn_pack-hover.svg',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540305846_9hsPz_dolec.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540305554_bKXkt_ice.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540305850_H0uMD_dolchem.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540305850_H0uMD_dolchem.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540306413_krz8D_dolec.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540306470_pfG4G_dolchem.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540306835_QLbQk_dolchem.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540307059_Dwf47_dolpack-brands.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540307310_lvkXG_dolec.png',
        'http://disdebug.yobibyte.in.ua/public/dis_photo/1540307368_fMGVI_dolchem.png',
    ]
    function preCacheHeros(){
        $.each(heroArray, function(){
            var img = new Image();
            img.src = this;
        });
    };
    $(window).on("load", function() {
        preCacheHeros();
    });

    // $(window).bind('resize', function(){
    //     updateFooter($(this).height());
    // });

    // function updateFooter(wh){
    //     var h=wh;
    //     var wrh = $('.main-content').height();
    //     var fh = $('.main-footer').height();
    //     var ch = h-wrh-fh;
    //     if(ch>0){
    //         $('.main-footer').addClass("bottomWrapper");
    //     }else{
    //         $('.main-footer').removeClass("bottomWrapper");
    //     }
    // }

    $(document).ready(function () {
        $('.dropdown-toggle').mouseover(function() {
            $('.dropdown-menu').show();
        })

        $('.dropdown-toggle').mouseout(function() {
            t = setTimeout(function() {
                $('.dropdown-menu').hide();
            }, 150);

            $('.dropdown-menu').on('mouseenter', function() {
                $('.dropdown-menu').show();
                clearTimeout(t);
            }).on('mouseleave', function() {
                $('.dropdown-menu').hide();
            })
        })
    });
    $('.dropdown-mob').click(function() {
            window.location = '/our-industries';
    });
    // $('.dropdown-mob').off('click');
</script>