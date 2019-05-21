var BaseConfig = {
    selector: ".textarea",
    resize: true,
    autosave_ask_before_unload: false,
    codesample_dialog_width: 300,
    codesample_dialog_height: 425,
    template_popup_width: 600,
    template_popup_height: 450,
    powerpaste_allow_local_images: true,
    plugins: [
        " advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen imagetools",
        " lists link linkchecker media mediaembed noneditable powerpaste preview",
        " searchreplace table textcolor tinymcespellchecker visualblocks wordcount"
    ], //removed:  charmap insertdatetime print
    external_plugins: {
        mentions: "//www.tinymce.com/pro-demo/mentions/plugin.min.js",
        moxiemanager: "//www.tinymce.com/pro-demo/moxiemanager/plugin.min.js"
    },
    toolbar:
        "undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image | fontsizeselect fontselect",
    content_css: ['/fonts.css'],
    fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 48px 72px',
    font_formats: 'Arial Black=ArialBlack;' +
        'Arial=Arial;' +
        'Algerian=Algerian;' +
        'Arial Narrow=ArialNarrow;'+
        'Bahnschrift=Bahnschrift;' +
        'Baskerville Old Face=BaskervilleOldFace;' +
        'Bauhaus 93=Bauhaus93;' +
        'Bell MT SemiBold=BellMTSemiBold;' +
        'Bell MT Italic=BellMTItalic;' +
        'Berlin Sans FB SemiBold=BerlinSansFBSemiBold;' +
        'Bernand MT Condensed=BernandMTCondensed;' +
        'Bodoni MT Poster Compressed=BodoniMTPosterCompressed;' +
        'Book Antiqua=BookAntiqua;' +
        'Bookman Old Style=BookmanOldStyle;' +
        'Bookman Old Style Semibold=BookmanOldStyleSemibold;' +
        'Bookman Old Style SemiItalic=BookmanOldStyleSemiItalic;' +
        'Bookman Old Style Italic=BookmanOldStyleItalic;' +
        'Britannic Semibold=BritannicSemibold;' +
        'Berlin Sans FB Demi Semibold=BerlinSansFBDemiSemibold;' +
        'Berlin Sans FB=BerlinSansFB;' +
        'Broadway=Broadway;' +
        'Brush Script MT Italic=BrushScriptMTItalic;' +
        'Calibri=Calibri;' +
        'Calibri SemiBold=CalibriSemiBold;' +
        'Calibri Light=CalibriLight;' +
        'Calibri Light Italic=CalibriLightItalic;' +
        'Calibri Bold Italic=CalibriBoldItalic;' +
        'Californian FB Semibold=CalifornianFBSemibold;' +
        'Californian FB Italic=CalifornianFBItalic;' +
        'Californian FB=CalifornianFB;' +
        'Cambria=Cambria;' +
        'Cambria Bold=CambriaBold;' +
        'Cambria Italic=CambriaItalic;' +
        'Cambria Bold Italic=CambriaBoldItalic;' +
        'Candara=Candara;' +
        'Candara Bold=CandaraBold;' +
        'Candara Italic=CandaraItalic;' +
        'Candara Bold Italic=CandaraBoldItalic;' +
        'Centaur=Centaur;' +
        'Century=Century;' +
        'Chiller=Chiller;' +
        'Colonna MT=ColonnaMT;' +
        'Comic Sans MS=ComicSansMS;' +
        'Comic Sans MS Semibold=ComicSansMSSemibold;' +
        'Comic Sans MS Italic=ComicSansMSItalic;' +
        'Consola=Consola;' +
        'Consola Bold=ConsolaBold;' +
        'Consola Italic=ConsolaItalic;' +
        'Consola Bold Italic=ConsolaBoldItalic;' +
        'Constantia=Constantia;' +
        'Constantia Bold=ConstantiaBold;' +
        'Constantia Italic=ConstantiaItalic;' +
        'Constantia Bold Italic=ConstantiaBoldItalic;' +
        'Dodger=Dodger;' +
        'Ebrima=Ebrima;' +
        'Franklin Gothic Medium=FranklinGothicMedium;' +
        'Franklin Gothic Medium Italic=FranklinGothicMediumItalic;' +
        'Freestyle Script=FreestyleScript;' +
        'Gabriola=Gabriola;' +
        'Georgia=Georgia;' +
        'Georgia SemiBold=GeorgiaSemiBold;' +
        'Georgia Italic=GeorgiaItalic;' +
        'Georgia SemiItalic=GeorgiaSemiItalic;' +
        'Harlow Solid Italic=HarlowSolidItalic;' +
        'Harrington=Harrington;' +
        'High Towe Text=HighToweText;' +
        'Impact=Impact;' +
        'Informal Rome=InformalRome;' +
        'Kunstler Script=KunstlerScript;' +
        'Lucida Console=LucidaConsole;' +
        'Magneto Bold=MagnetoBold;' +
        'Malgun Gothic=MalgunGothic;' +
        'Mistral=Mistral;' +
        'Myanmar Text=MyanmarText;' +
        'Monotype Corsive=MonotypeCorsive;' +
        'MV Boli=MVBoli;' +
        'Niagara Engraved=NiagaraEngraved;' +
        'Niagara Solid=NiagaraSolid;' +
        'Nirmala UI=NirmalaUI;' +
        'New Tai Lue=NewTaiLue;' +
        'Old English Text MT=OldEnglishTextMT;' +
        'Palatino Linotype=PalatinoLinotype;' +
        'Raleway Bold=RalewayBold;' +
        'Raleway Light=RalewayLight;' +
        'Raleway Medium=RalewayMedium;' +
        'Raleway Regular=RalewayRegular;' +
        'Raleway SemiBold=RalewaySemiBold;' +
        'Raleway Italic=RalewayItalic;' +
        'Sans Serif=SansSerif;' +
        'Segoe MDL2 Assets=SegoeMDL2Assets;' +
        'Segoe Print=SegoePrint;' +
        'Segoe UI Black=SegoeUIBlack;' +
        'Sitka Text=SitkaText;' +
        'Sylfaen=Sylfaen;' +
        'Symbol=Symbol;' +
        'Tahoma=Tahoma;' +
        'Times New Roman=TimesNewRoman;' +
        'Trebuchet MS=TrebuchetMS;' +
        'Verdana=Verdana;' +
        'Viner Hand ITC=VinerHandITC;' +
        'Vivaldi Italic=VivaldiItalic;' +
        'Yu Gothic Bold=YuGothicBold;' +
        'Yu Gothic Light=YuGothicLight;' +
        'Yu Gothic Medium=YuGothicMedium;' +
        'Yu Gothic Regular=YuGothicRegular;'
};
tinymce.init(BaseConfig);