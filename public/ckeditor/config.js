CKEDITOR.editorConfig = function( config ) {
    config.resize_enabled = false;

    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
        {name: 'forms', groups: ['forms']},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
        {name: 'links', groups: ['links']},
        {name: 'insert', groups: ['insert']},
        '/',
        {name: 'styles', groups: ['styles']},
        {name: 'colors', groups: ['colors']},
        {name: 'tools', groups: ['tools']},
        {name: 'others', groups: ['others']},
        {name: 'about', groups: ['about']}
    ];
    config.contentsCss = '/public/css/admin/fonts.css';
    // config.extraPlugins = 'image';
    config.font_names = 'Arial Black/ArialBlack;' +
        'Arial/Arial;' +
        'Algerian/Algerian;' +
        'Arial Narrow/ArialNarrow;' +
        'Bahnschrift/Bahnschrift;' +
        'Baskerville Old Face/BaskervilleOldFace;' +
        'Bauhaus 93/Bauhaus93;' +
        'Bell MT SemiBold/BellMTSemiBold;' +
        'Bell MT Italic/BellMTItalic;' +
        'Berlin Sans FB SemiBold/BerlinSansFBSemiBold;' +
        'Bernand MT Condensed/BernandMTCondensed;' +
        'Bodoni MT Poster Compressed/BodoniMTPosterCompressed;' +
        'Book Antiqua/BookAntiqua;' +
        'Bookman Old Style/BookmanOldStyle;' +
        'Bookman Old Style Semibold/BookmanOldStyleSemibold;' +
        'Bookman Old Style SemiItalic/BookmanOldStyleSemiItalic;' +
        'Bookman Old Style Italic/BookmanOldStyleItalic;' +
        'Britannic Semibold/BritannicSemibold;' +
        'Berlin Sans FB Demi Semibold/BerlinSansFBDemiSemibold;' +
        'Berlin Sans FB/BerlinSansFB;' +
        'Broadway/Broadway;' +
        'Brush Script MT Italic/BrushScriptMTItalic;' +
        'Calibri/Calibri;' +
        'Calibri SemiBold/CalibriSemiBold;' +
        'Calibri Light/CalibriLight;' +
        'Calibri Light Italic/CalibriLightItalic;' +
        'Calibri Bold Italic/CalibriBoldItalic;' +
        'Californian FB Semibold/CalifornianFBSemibold;' +
        'Californian FB Italic/CalifornianFBItalic;' +
        'Californian FB/CalifornianFB;' +
        'Cambria/Cambria;' +
        'Cambria Bold/CambriaBold;' +
        'Cambria Italic/CambriaItalic;' +
        'Cambria Bold Italic/CambriaBoldItalic;' +
        'Candara/Candara;' +
        'Candara Bold/CandaraBold;' +
        'Candara Italic/CandaraItalic;' +
        'Candara Bold Italic/CandaraBoldItalic;' +
        'Centaur/Centaur;' +
        'Century/Century;' +
        'Chiller/Chiller;' +
        'Colonna MT/ColonnaMT;' +
        'Comic Sans MS/ComicSansMS;' +
        'Comic Sans MS Semibold/ComicSansMSSemibold;' +
        'Comic Sans MS Italic/ComicSansMSItalic;' +
        'Consola/Consola;' +
        'Consola Bold/ConsolaBold;' +
        'Consola Italic/ConsolaItalic;' +
        'Consola Bold Italic/ConsolaBoldItalic;' +
        'Constantia/Constantia;' +
        'Constantia Bold/ConstantiaBold;' +
        'Constantia Italic/ConstantiaItalic;' +
        'Constantia Bold Italic/ConstantiaBoldItalic;' +
        'Dodger;' +
        'Ebrima/Ebrima;' +
        'Franklin Gothic Medium/FranklinGothicMedium;' +
        'Franklin Gothic Medium Italic/FranklinGothicMediumItalic;' +
        'Freestyle Script/FreestyleScript;' +
        'Gabriola/Gabriola;' +
        'Georgia/Georgia;' +
        'Georgia SemiBold/GeorgiaSemiBold;' +
        'Georgia Italic/GeorgiaItalic;' +
        'Georgia SemiItalic/GeorgiaSemiItalic;' +
        'Harlow Solid Italic/HarlowSolidItalic;' +
        'Harrington/Harrington;' +
        'High Towe Text/HighToweText;' +
        'Impact/Impact;' +
        'Informal Rome/InformalRome;' +
        'Kunstler Script/KunstlerScript;' +
        'Lucida Console/LucidaConsole;' +
        'Magneto Bold/MagnetoBold;' +
        'Malgun Gothic/MalgunGothic;' +
        'Mistral/Mistral;' +
        'Myanmar Text/MyanmarText;' +
        'Monotype Corsive/MonotypeCorsive;' +
        'MV Boli/MVBoli;' +
        'Niagara Engraved/NiagaraEngraved;' +
        'Niagara Solid/NiagaraSolid;' +
        'Nirmala UI/NirmalaUI;' +
        'New Tai Lue/NewTaiLue;' +
        'Old English Text MT/OldEnglishTextMT;' +
        'Palatino Linotype/PalatinoLinotype;' +
        'Raleway Bold/RalewayBold;' +
        'Raleway Light/RalewayLight;' +
        'Raleway Medium/RalewayMedium;' +
        'Raleway Regular/RalewayRegular;' +
        'Raleway SemiBold/RalewaySemiBold;' +
        'Raleway Italic/RalewayItalic;' +
        'Sans Serif/SansSerif;' +
        'Segoe MDL2 Assets/SegoeMDL2Assets;' +
        'Segoe Print/SegoePrint;' +
        'Segoe UI Black/SegoeUIBlack;' +
        'Sitka Text/SitkaText;' +
        'Sylfaen/Sylfaen;' +
        'Symbol/Symbol;' +
        'Tahoma/Tahoma;' +
        'Times New Roman/TimesNewRoman;' +
        'Trebuchet MS/TrebuchetMS;' +
        'Verdana/Verdana;' +
        'Viner Hand ITC/VinerHandITC;' +
        'Vivaldi Italic/VivaldiItalic;' +
        'Yu Gothic Bold/YuGothicBold;' +
        'Yu Gothic Light/YuGothicLight;' +
        'Yu Gothic Medium/YuGothicMedium;' +
        'Yu Gothic Regular/YuGothicRegular;';
    config.removeButtons = 'CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,Anchor,Table,Flash,Image,SpecialChar,PageBreak,Iframe,ShowBlocks,About,Form,Scayt,SelectAll,Replace,Redo,Undo,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Textarea,TextField,Radio,Checkbox,Select,Button,ImageButton,HiddenField,Language,BidiRtl,BidiLtr,Source,Save,NewPage,Preview,Print,Templates';
};