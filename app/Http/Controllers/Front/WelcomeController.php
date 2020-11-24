<?php

namespace App\Http\Controllers\Front;

use App\Front\Festival;
use App\Front\Language;
use App\Front\Country;
use App\Front\Specialization;
use App\Front\PlaceFormat;
use App\Helpers\Helpme;
use App\Proposal;
use App\BizProposal;
use App\Notifications\ProposalNew;
use App\Notifications\ProposalSendImage;
use Notification;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class WelcomeController extends Controller
{
    public function index()
    {
 
        $festival = Festival::with(['sliders', 'partners', 'membersRandom.country'])->defaultFestival()->firstOrFail();

        $count_festivals = Festival::active()->count();

        $locale = app()->getLocale();
        $language = Language::whereEncoding($locale)->first();

        $countries =  Country::orderByName()->get();
       
        $specializations = Specialization::forMembers()->get();
        $placeformats = PlaceFormat::forMembers()->get();

        return view('front.index', compact('festival', 'language', 'countries','specializations', 'placeformats','count_festivals'));
    }

    public function festival($slug)
    {
        
        $festival = Festival::otherFestival($slug)->firstOrFail();

        $count_festivals = Festival::active()->count();

        $locale = app()->getLocale();
        $language_id= Language::select('id')->whereEncoding($locale)->first()->value('id');

        $countries =  Country::orderByName()->get();
        $specializations = Specialization::forMembers()->get();
        $placeformats = PlaceFormat::forMembers()->get();

        return view('front.index', compact('festival', 'language_id', 'countries','specializations', 'placeformats','count_festivals'));

    }

    public function allMembers($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::with('members')->defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::with('members')->otherFestival($slug)->firstOrFail();

        }

        return view('front.member_all', compact('festival'));

    }        

    public function condition($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::has('condition')->defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::has('condition')->otherFestival($slug)->firstOrFail();

        }

        return view('front.condition', compact('festival'));

    }

    public function disposition($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::has('disposition')->defaultFestival()->firstOrFail();
            $dispositionPlaces = $festival->disposition->dispositionPlaces()->paginate(50);

        } else {

            $festival = Festival::has('disposition')->otherFestival($slug)->firstOrFail();
            $dispositionPlaces = $festival->disposition->dispositionPlaces()->paginate(50);

        }

        if (Request::ajax()) {
            return view('front.components.disposition', compact('festival','dispositionPlaces'));
        }
        
        return view('front.disposition', compact('festival','dispositionPlaces'));

    }

    public function program($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::has('programs')->defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::has('programs')->otherFestival($slug)->firstOrFail();

        }

        return view('front.program', compact('festival'));

    }

    public function hotel($slug=null)
    {
        
        if( is_null($slug) ) {

            $festival = Festival::has('hotel')->defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::has('hotel')->otherFestival($slug)->firstOrFail();

        }

        return view('front.hotel', compact('festival'));

    }

    public function create_proposal($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::otherFestival($slug)->firstOrFail();

        }

        $locale = app()->getLocale();
        $language_id= Language::select('id')->whereEncoding($locale)->first()->value('id');

        $countries =  Country::orderByName()->get();

        $specializations = Specialization::forMembers()->get();
        $placeformats = PlaceFormat::forMembers()->get();

        return view('front.proposal', compact('festival','language_id','countries','specializations','placeformats'));


    }

    public function store_proposal()
    {
        //dd($request->all());
    
/*         return response()->json([
            'success' => Request::get('logo'),
           // 'member' => Request::all(),

        ]); */

        try{
            \DB::beginTransaction();

            $locale = app()->getLocale();
            $languages= Helpme::languages()->toArray();

            foreach ($languages as $lang){

                if ($locale==$lang) {
    
                    $member[$lang] = Request::input('member');
                    $city[$lang] = Request::input('city');
                    $studio[$lang] = Request::input('studio');

                } else {
                    
                    $member[$lang] = '';
                    $city[$lang] = '';
                    $studio[$lang] = '';
                }
                
            }
            //dd(Request::all());
            // загрузка лого
            if(Request::get('logo') !== 'null'){

                $directory = 'members/upload'; 

                $uploadedFile = Request::file('logo');

                $filename = $uploadedFile->getClientOriginalName();

                $logo = Storage::disk('public')->putFileAs(
                    $directory,
                    $uploadedFile,
                    $filename
                );
                $logo = '/storage/' . $logo; 
            }
            $portfolio = null;
            // загрузка портфолио  
            if(Request::hasFile('portfolio')){

                $directory = 'members/upload/portfolio'; 

                $portfolioArrays = Request::file('portfolio');

                foreach ($portfolioArrays as $item){

                    $uploadedFile = $item;

                    $filename = $uploadedFile->getClientOriginalName();
    
                    $portfolio[] = '/storage/' . Storage::disk('public')->putFileAs(
                        $directory,
                        $uploadedFile,
                        $filename
                    );
                    
                }
            }

            $proposal = Proposal::create(
                [
                    'member' => json_encode($member),
                    'city' => json_encode($city),
                    'studio' => json_encode($studio),
                    'social' => (Request::input('social')),
                    'portfolio' => $portfolio ? json_encode($portfolio) : null,
                    'phone' => Request::input('phone'),
                    'logo' => $logo ?? null,
                    'place_number' => Request::input('place_number'),
                    //'count_worker' => Request::input('count_worker'),
                    'comment' => Request::input('comment'),
                    'place_format_id' => Request::input('place_format_id'),
                    'language_id' => Request::input('language_id'),
                    'specialization_id' => Request::input('specialization_id'),
                    'country_id' => Request::input('country_id'),
                    'festival_id' => Request::input('festival_id'),
                    'status_id' => Request::input('status_id'),
                ]
            );


            \DB::commit();

            $subject="Новая заявка на участие";

            Helpme::sendProposalMail($proposal, $subject);

            $users = User::whereRole(User::ROLE_ADMIN)->get();

            Notification::send($users, new ProposalNew($proposal,$subject));

            Notification::send($users, new ProposalSendImage('Фото профиля', config('app.url') . $proposal->logo));

            $files = json_decode($proposal->portfolio); 

            if($files > 0) {
                foreach ($files as $file) { 
                    Notification::send($users, new ProposalSendImage('Портфолио', config('app.url') . $file));
                }
            }
        
        } catch(\Exception $e){

            \DB::rollback();

            // удаление лого
            if(isset($logo)){

                $logo = Str::after($logo, '/storage');

                Storage::disk('public')->delete($logo);
            }

            // удаление портфолио  
            if(Request::hasFile('portfolio')){

                $directory = 'members/upload/portfolio'; 

                $portfolioArrays = Request::file('portfolio');
                //portfolioArrays    
                foreach ($portfolioArrays as $item){

                    $item = Str::after($item, '/storage');

                    Storage::disk('public')->delete($item);

                }
            }
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 401;

            return response()->json(['message' => $e->getMessage(), 'success' => false], $status);
            
        } 

        return response()->json([ 'success' => __('front.msg_success'),]);

    } 

    public function create_bizproposal($slug=null)
    {
        if( is_null($slug) ) {

            $festival = Festival::defaultFestival()->firstOrFail();

        } else {

            $festival = Festival::otherFestival($slug)->firstOrFail();

        }

        $locale = app()->getLocale();
        $language_id= Language::select('id')->whereEncoding($locale)->first()->value('id');

        $specializations = Specialization::forShopPlaces()->get();
        $placeformats = PlaceFormat::forShopPlaces()->get();

        return view('front.biz-proposal', compact('festival','language_id','specializations','placeformats'));


    }

    public function store_biz_proposal()
    {
        //dd($request->all());
    
/*         return response()->json([
            'member' => Request::all(),

        ]); */

        try{
            \DB::beginTransaction();

            $locale = app()->getLocale();
            $languages= Helpme::languages()->toArray();

            foreach ($languages as $lang){

                if ($locale==$lang) {
    
                    $member[$lang] = Request::input('member');

                } else {
                    
                    $member[$lang] = '';

                }
                
            }
            $fotos = [];
            // загрузка портфолио  
            if(Request::hasFile('fotos')){

                $directory = 'members/upload/photos'; 

                $portfolioArrays = Request::file('fotos');

                foreach ($portfolioArrays as $item){

                    $uploadedFile = $item;

                    $filename = $uploadedFile->getClientOriginalName();
    
                    $fotos[] = '/storage/' . Storage::disk('public')->putFileAs(
                        $directory,
                        $uploadedFile,
                        $filename
                    );
                    
                }
            }

            $bizProposal = BizProposal::create(
                [
                    'member' => json_encode($member),
                    'social' =>  (Request::input('social')),
                    'fotos' => json_encode($fotos) == '[]' ? '[""]' : json_encode($fotos),
                    'phone' => Request::input('phone'),
                    'place_number' => Request::input('place_number'),
                    'count_worker' => Request::input('count_worker'),
                    'product' => Request::input('product'),
                    'fitting_room' => Request::input('fitting_room') ? (Request::input('fitting_room')== 'true' ? 1 : 0) : 0,
                    'illumination' => Request::input('illumination'),
                    'comment' => Request::input('comment'),
                    'place_format_id' => Request::input('place_format_id'),
                    'language_id' => Request::input('language_id'),
                    'specialization_id' => Request::input('specialization_id'),
                    'festival_id' => Request::input('festival_id'),
                    'status_id' => Request::input('status_id'),
    
                ]
            );

            \DB::commit();
    
            $subject="Новоя заявка на торговое место";
    
            Helpme::sendBizProposalMail($bizProposal, $subject);  
    
            $users = User::whereRole(User::ROLE_ADMIN)->get();
    
            Notification::send($users, new BizProposalNew($bizProposal,$subject));
    
            $files = json_decode($bizProposal->fotos); 
    
            if($files > 0) {
                foreach ($files as $file) { 
                     if(!empty(trim($file))) {
                    Notification::send($users, new ProposalSendImage('Изображения', config('app.url') . $file));
                    }
                }
            }
        
        } catch(\Exception $e){

            \DB::rollback();


            // удаление портфолио  
            if(Request::hasFile('fotos')){

                $directory = 'members/upload/photos'; 

                $portfolioArrays = Request::file('fotos');

                foreach ($portfolioArrays as $item){

                    $item = Str::after($item, '/storage');

                    Storage::disk('public')->delete($item);

                }
            }
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 401;

            return response()->json(['message' => $e->getMessage(), 'success' => false], $status);
            
        } 

        return response()->json([ 'success' => __('front.msg_success'),]);

    } 
}
