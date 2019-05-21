<?php

namespace App\Http\Controllers\Main;

use App\Model\Main\BrandSlider;
use App\Model\Main\Industries;
use App\Model\Main\IndustriesContents;
use App\Model\Main\MainIndustries;
use App\Model\Main\MainIndustries2;
use App\Model\Main\MainIndustries3;
use App\Model\Main\MainIndustries4;
use App\Model\Main\MainIndustries5;
use App\Model\Main\MainJoin;
use App\Model\Main\MainSlider;
use App\Model\Main\MainTailor;
use App\Model\Main\Markers;
use App\Model\Visitors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Main\MainPageDescription;
class MainController extends Controller
{
    public function main_page_view(){
        $main_slider = MainSlider::orderBy('position','ASC')->get();
        Visitors::set_visitor();
        return view('welcome',[
            'main_slider' => $main_slider
        ]);
    }

    public function brands_page_view(){
        $slider = BrandSlider::orderBy('position','ASC')->get();
        $brand_descr = MainPageDescription::where('type','=','brand_descr')->select('text')->first();
        if(empty($brand_descr)){
            $brand_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.brands',[
            'slider' => $slider,
            'brand_descr' => $brand_descr
        ]);
    }

    public function industries_page_view2(){
        $slider = MainIndustries2::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr2')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.our-industries',[
            'ind_descr' => $ind_descr,
            'slider' => $slider
        ]);
    }


    public function industries_page_view(){
        $slider = MainIndustries::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        return view('main.industries',[
            'slider' => $slider,
            'ind_descr' => $ind_descr
        ]);
    }
    public function our_industries_page_view(){
        $industries = Industries::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr2')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.our-industries',[
            'industries' => $industries,
            'ind_descr' => $ind_descr
        ]);
    }

    public function industries_name_view($name){
        if($industries = Industries::where('link','=',$name)->first()) {
            $industries->contents = IndustriesContents::where('industries_id','=',$industries->id)
                ->orderBy('position','ASC')
                ->get();
            return view('main.industries', [
                'industries' => $industries
            ]);
        }

        return redirect()->back();
    }

    public function tailor_page_view(){
        $slider = MainTailor::orderBy('position','ASC')->get();
        $tailor_descr = MainPageDescription::where('type','=','tailor_descr')->select('text')->first();
        if(empty($tailor_descr)){
            $tailor_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.tailor',[
            'slider' => $slider,
            'tailor_descr' => $tailor_descr
        ]);
    }

    public function main_about_page_view(){
        $wwa_main_descr = MainPageDescription::where('type','=','wwa_descr')->select('text')->first();
        if(empty($wwa_main_descr)){
            $wwa_main_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.about',[
            'wwa_main_descr' => $wwa_main_descr
        ]);
    }

    public function main_about_long_page_view(){
        $first_descr = MainPageDescription::where('type','=','first_text_wwa')->select('text','src')->first();
        if(empty($first_descr)){
            $first_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        $second_descr = MainPageDescription::where('type','=','second_text_wwa')->select('text','src')->first();
        if(empty($second_descr)){
            $second_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        return view('main.about_long',[
            'first_descr' => $first_descr,
            'second_descr' => $second_descr
        ]);
    }

    public function join_page_view(){
        $slider = MainJoin::orderBy('position','ASC')->get();
        $join_descr = MainPageDescription::where('type','=','join_descr')->select('text')->first();
        if(empty($join_descr)){
            $join_descr = (object)[
                'text' => ''
            ];
        }
        return view('main.join',[
            'join_descr' => $join_descr,
            'slider' => $slider
        ]);
    }
    public function join_popup_page_view(){
        return view('main.join-popup');
    }
    public function paint_page_view(){
        $slider = MainIndustries3::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr3')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        return view('main.paint',[
            'slider' => $slider,
            'ind_descr' => $ind_descr
        ]);
    }
    public function sanitary_page_view(){
        $slider = MainIndustries4::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr4')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        return view('main.sanitary',[
            'slider' => $slider,
            'ind_descr' => $ind_descr
        ]);
    }
    public function cooling_page_view(){
        $slider = MainIndustries5::orderBy('position','ASC')->get();
        $ind_descr = MainPageDescription::where('type','=','industries_descr5')->select('text','src')->first();
        if(empty($ind_descr)){
            $ind_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        return view('main.cooling',[
            'slider' => $slider,
            'ind_descr' => $ind_descr
        ]);
    }
    public function contact_page_view(){
        $contact_descr = MainPageDescription::where('type','=','contact_descr')->select('text','src')->first();
        if(empty($contact_descr)){
            $contact_descr = (object)[
                'text' => '',
                'src' => ''
            ];
        }
        $markers = Markers::get();
        return view('main.contact',[
            'contact_descr' => $contact_descr,
            'markers' => $markers
        ]);
    }
}
