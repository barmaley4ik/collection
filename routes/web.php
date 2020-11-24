<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use Helpme;
//use Illuminate\Support\Facades\Storage;

Route::group(['prefix' => 'admin'], function() {
// Auth
Route::get('login')->name('login')->uses('Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');

Route::post('logout')->name('logout')->uses('Auth\LoginController@logout')->middleware('auth');

// Dashboard
Route::get('/')->name('dashboard')->uses('DashboardController')->middleware('auth');

// Users
Route::get('users')->name('users')->uses('UsersController@index')->middleware('remember', 'auth');
Route::get('users/create')->name('users.create')->uses('UsersController@create')->middleware('auth');
Route::post('users')->name('users.store')->uses('UsersController@store')->middleware('auth');
Route::get('users/{user}/edit')->name('users.edit')->uses('UsersController@edit')->middleware('auth');
Route::put('users/{user}')->name('users.update')->uses('UsersController@update')->middleware('auth');
Route::delete('users/{user}')->name('users.destroy')->uses('UsersController@destroy')->middleware('auth');
Route::put('users/{user}/restore')->name('users.restore')->uses('UsersController@restore')->middleware('auth');

// Images
Route::get('/img/{path}', 'ImagesController@show')->where('path', '.*');

//Translate
Route::post('translate', 'Api\Translation@index')->name('translate.index')->middleware('auth');

//FileManager
Route::post('upload')->name('filemanager.upload')->uses('FilemanagerController@upload')->middleware('auth');
Route::get('fm/index')->name('filemanager.index')->uses('FilemanagerController@index')->middleware('auth');

// Languages
Route::get('languages')->name('languages')->uses('LanguagesController@index')->middleware('remember', 'auth');
Route::get('languages/create')->name('languages.create')->uses('LanguagesController@create')->middleware('auth');
Route::get('languages/{language}/edit')->name('languages.edit')->uses('LanguagesController@edit')->middleware('auth');
Route::post('languages')->name('languages.store')->uses('LanguagesController@store')->middleware('auth');
Route::put('languages/{language}')->name('languages.update')->uses('LanguagesController@update')->middleware('auth');
Route::delete('languages/{language}')->name('languages.destroy')->uses('LanguagesController@destroy')->middleware('auth');

// Partners
Route::get('partners')->name('partners')->uses('PartnersController@index')->middleware('remember', 'auth');
Route::get('partners/create')->name('partners.create')->uses('PartnersController@create')->middleware('auth');
Route::get('partners/{partner}/edit')->name('partners.edit')->uses('PartnersController@edit')->middleware('auth');
Route::post('partners')->name('partners.store')->uses('PartnersController@store')->middleware('auth');
Route::put('partners/{partner}')->name('partners.update')->uses('PartnersController@update')->middleware('auth');
Route::delete('partners/{partner}')->name('partners.destroy')->uses('PartnersController@destroy')->middleware('auth');

// Countries
Route::get('countries')->name('countries')->uses('CountriesController@index')->middleware('remember', 'auth');
Route::get('countries/create')->name('countries.create')->uses('CountriesController@create')->middleware('auth');
Route::get('countries/{country}/edit')->name('countries.edit')->uses('CountriesController@edit')->middleware('auth');
Route::post('countries')->name('countries.store')->uses('CountriesController@store')->middleware('auth');
Route::put('countries/{country}')->name('countries.update')->uses('CountriesController@update')->middleware('auth');
Route::delete('countries/{country}')->name('countries.destroy')->uses('CountriesController@destroy')->middleware('auth');

// Members
Route::get('members')->name('members')->uses('MembersController@index')->middleware('remember', 'auth');
Route::get('members/create')->name('members.create')->uses('MembersController@create')->middleware('auth');
Route::get('members/{member}/edit')->name('members.edit')->uses('MembersController@edit')->middleware('auth');
Route::post('members')->name('members.store')->uses('MembersController@store')->middleware('auth');
Route::put('members/{member}')->name('members.update')->uses('MembersController@update')->middleware('auth');
Route::delete('members/{member}')->name('members.destroy')->uses('MembersController@destroy')->middleware('auth');
Route::get('members/create-from-proposal')->name('members.createfromproposal')->uses('MembersController@createFromPorposal')->middleware('auth');

// Settings
Route::get('settings/{setting}/edit')->name('settings.edit')->uses('SettingsController@edit')->middleware('auth');
Route::put('settings/{setting}')->name('settings.update')->uses('SettingsController@update')->middleware('auth');

// Festivals
Route::get('festivals')->name('festivals')->uses('FestivalsController@index')->middleware('remember', 'auth');
Route::get('festivals/create')->name('festivals.create')->uses('FestivalsController@create')->middleware('auth');
Route::get('festivals/{festival}/edit')->name('festivals.edit')->uses('FestivalsController@edit')->middleware('auth');
Route::post('festivals')->name('festivals.store')->uses('FestivalsController@store')->middleware('auth');
Route::put('festivals/{festival}')->name('festivals.update')->uses('FestivalsController@update')->middleware('auth');
Route::delete('festivals/{festival}')->name('festivals.destroy')->uses('FestivalsController@destroy')->middleware('auth');

// Sliders
Route::get('sliders')->name('sliders')->uses('SlidersController@index')->middleware('remember', 'auth');
Route::get('sliders/create')->name('sliders.create')->uses('SlidersController@create')->middleware('auth');
Route::get('sliders/{slider}/edit')->name('sliders.edit')->uses('SlidersController@edit')->middleware('auth');
Route::post('sliders')->name('sliders.store')->uses('SlidersController@store')->middleware('auth');
Route::put('sliders/{slider}')->name('sliders.update')->uses('SlidersController@update')->middleware('auth');
Route::delete('sliders/{slider}')->name('sliders.destroy')->uses('SlidersController@destroy')->middleware('auth');

// Nominations
Route::get('nominations')->name('nominations')->uses('NominationsController@index')->middleware('remember', 'auth');
Route::get('nominations/create')->name('nominations.create')->uses('NominationsController@create')->middleware('auth');
Route::get('nominations/{nomination}/edit')->name('nominations.edit')->uses('NominationsController@edit')->middleware('auth');
Route::post('nominations')->name('nominations.store')->uses('NominationsController@store')->middleware('auth');
Route::put('nominations/{nomination}')->name('nominations.update')->uses('NominationsController@update')->middleware('auth');
Route::delete('nominations/{nomination}')->name('nominations.destroy')->uses('NominationsController@destroy')->middleware('auth');

// Programs
Route::get('programs')->name('programs')->uses('ProgramsController@index')->middleware('remember', 'auth');
Route::get('programs/create')->name('programs.create')->uses('ProgramsController@create')->middleware('auth');
Route::get('programs/{program}/edit')->name('programs.edit')->uses('ProgramsController@edit')->middleware('auth');
Route::post('programs')->name('programs.store')->uses('ProgramsController@store')->middleware('auth');
Route::put('programs/{program}')->name('programs.update')->uses('ProgramsController@update')->middleware('auth');
Route::delete('programs/{program}')->name('programs.destroy')->uses('ProgramsController@destroy')->middleware('auth');

// Conditions
Route::get('conditions')->name('conditions')->uses('ConditionsController@index')->middleware('remember', 'auth');
Route::get('conditions/create')->name('conditions.create')->uses('ConditionsController@create')->middleware('auth');
Route::get('conditions/{condition}/edit')->name('conditions.edit')->uses('ConditionsController@edit')->middleware('auth');
Route::post('conditions')->name('conditions.store')->uses('ConditionsController@store')->middleware('auth');
Route::put('conditions/{condition}')->name('conditions.update')->uses('ConditionsController@update')->middleware('auth');
Route::delete('conditions/{condition}')->name('conditions.destroy')->uses('ConditionsController@destroy')->middleware('auth');

// Dispositions
Route::get('dispositions')->name('dispositions')->uses('DispositionsController@index')->middleware('remember', 'auth');
Route::get('dispositions/create')->name('dispositions.create')->uses('DispositionsController@create')->middleware('auth');
Route::get('dispositions/{disposition}/edit')->name('dispositions.edit')->uses('DispositionsController@edit')->middleware('auth');
Route::post('dispositions')->name('dispositions.store')->uses('DispositionsController@store')->middleware('auth');
Route::put('dispositions/{disposition}')->name('dispositions.update')->uses('DispositionsController@update')->middleware('auth');
Route::delete('dispositions/{disposition}')->name('dispositions.destroy')->uses('DispositionsController@destroy')->middleware('auth');

// Hotels
Route::get('hotels')->name('hotels')->uses('HotelsController@index')->middleware('remember', 'auth');
Route::get('hotels/create')->name('hotels.create')->uses('HotelsController@create')->middleware('auth');
Route::get('hotels/{hotel}/edit')->name('hotels.edit')->uses('HotelsController@edit')->middleware('auth');
Route::post('hotels')->name('hotels.store')->uses('HotelsController@store')->middleware('auth');
Route::put('hotels/{hotel}')->name('hotels.update')->uses('HotelsController@update')->middleware('auth');
Route::delete('hotels/{hotel}')->name('hotels.destroy')->uses('HotelsController@destroy')->middleware('auth');

// Proposals
Route::get('proposals')->name('proposals')->uses('ProposalsController@index')->middleware('remember', 'auth');
Route::get('proposals/create')->name('proposals.create')->uses('ProposalsController@create')->middleware('auth');
Route::get('proposals/{proposal}/edit')->name('proposals.edit')->uses('ProposalsController@edit')->middleware('auth');
Route::post('proposals')->name('proposals.store')->uses('ProposalsController@store')->middleware('auth');
Route::put('proposals/{proposal}')->name('proposals.update')->uses('ProposalsController@update')->middleware('auth');
Route::delete('proposals/{proposal}')->name('proposals.destroy')->uses('ProposalsController@destroy')->middleware('auth');
Route::get('getmembers')->name('proposals.getmembers')->uses('ProposalsController@getMembers')->middleware('auth');

// BizProposals
Route::get('biz-proposals')->name('biz-proposals')->uses('BizProposalsController@index')->middleware('remember', 'auth');
Route::get('biz-proposals/create')->name('biz-proposals.create')->uses('BizProposalsController@create')->middleware('auth');
Route::get('biz-proposals/{biz_proposal}/edit')->name('biz-proposals.edit')->uses('BizProposalsController@edit')->middleware('auth');
Route::post('biz-proposals')->name('biz-proposals.store')->uses('BizProposalsController@store')->middleware('auth');
Route::put('biz-proposals/{biz_proposal}')->name('biz-proposals.update')->uses('BizProposalsController@update')->middleware('auth');
Route::delete('biz-proposals/{biz_proposal}')->name('biz-proposals.destroy')->uses('BizProposalsController@destroy')->middleware('auth');

/* Route::resource('biz-proposals', 'BizProposalsController')->middleware('auth'); */

// Specializations
Route::get('specializations')->name('specializations')->uses('SpecializationsController@index')->middleware('remember', 'auth');
Route::get('specializations/create')->name('specializations.create')->uses('SpecializationsController@create')->middleware('auth');
Route::get('specializations/{specialization}/edit')->name('specializations.edit')->uses('SpecializationsController@edit')->middleware('auth');
Route::post('specializations')->name('specializations.store')->uses('SpecializationsController@store')->middleware('auth');
Route::put('specializations/{specialization}')->name('specializations.update')->uses('SpecializationsController@update')->middleware('auth');
Route::delete('specializations/{specialization}')->name('specializations.destroy')->uses('SpecializationsController@destroy')->middleware('auth');

// PlaceFormats
Route::get('placeformats')->name('placeformats')->uses('PlaceFormatsController@index')->middleware('remember', 'auth');
Route::get('placeformats/create')->name('placeformats.create')->uses('PlaceFormatsController@create')->middleware('auth');
Route::get('placeformats/{placeformat}/edit')->name('placeformats.edit')->uses('PlaceFormatsController@edit')->middleware('auth');
Route::post('placeformats')->name('placeformats.store')->uses('PlaceFormatsController@store')->middleware('auth');
Route::put('placeformats/{placeformat}')->name('placeformats.update')->uses('PlaceFormatsController@update')->middleware('auth');
Route::delete('placeformats/{placeformat}')->name('placeformats.destroy')->uses('PlaceFormatsController@destroy')->middleware('auth');

// Translation
Route::get('translations')->name('translations')->uses('TranslationsController@index')->middleware('remember', 'auth');
Route::get('translations/create')->name('translations.create')->uses('TranslationsController@create')->middleware('auth');
Route::get('translations/{translation}/edit')->name('translations.edit')->uses('TranslationsController@edit')->middleware('auth');
Route::post('translations')->name('translations.store')->uses('TranslationsController@store')->middleware('auth');
Route::put('translations/{translation}')->name('translations.update')->uses('TranslationsController@update')->middleware('auth');
Route::delete('translations/{translation}')->name('translations.destroy')->uses('TranslationsController@destroy')->middleware('auth');
  });
// 500 error
/* Route::get('500', function () {
    // Force debug mode for this endpoint in the demo environment
    if (App::environment('demo')) {
        Config::set('app.debug', true);
    }

    echo $fail;
}); */


Route::group(['domain' => '{domain}.tattoo-collection.kiev.ua', 'middleware' => 'multilang'], function () {

    Route::multilingual('/', 'Front\WelcomeController@festival')->name('fest.home');
    Route::multilingual('/members', 'Front\WelcomeController@allMembers')->name('fest.allmembers');    
    Route::multilingual('/members/{member}', 'Front\MembersController@fest')->name('fest.member');
    Route::multilingual('/condition', 'Front\WelcomeController@condition')->name('fest.condition');
    Route::multilingual('/disposition', 'Front\WelcomeController@disposition')->name('fest.disposition');     
    Route::multilingual('/program', 'Front\WelcomeController@program')->name('fest.program');
    Route::multilingual('/hotel', 'Front\WelcomeController@hotel')->name('fest.hotel'); 
    Route::multilingual('/partners/{partner}', 'Front\PartnersController@fest')->name('fest.partner');    
    Route::multilingual('/proposal', 'Front\WelcomeController@create_proposal')->name('fest.proposal-member'); 
    Route::multilingual('/biz-proposal', 'Front\WelcomeController@create_bizproposal')->name('fest.proposal-biz'); 
});

Route::group(['middleware' => 'multilang'], function() {

    Route::multilingual('/', 'Front\WelcomeController@index')->name('home');
    Route::multilingual('/members', 'Front\WelcomeController@allMembers')->name('allmembers');    
    Route::multilingual('/members/{member}', 'Front\MembersController@index')->name('member');
    Route::multilingual('/condition', 'Front\WelcomeController@condition')->name('condition');
    Route::multilingual('/disposition', 'Front\WelcomeController@disposition')->name('disposition');
    Route::multilingual('/program', 'Front\WelcomeController@program')->name('program');     
    Route::multilingual('/hotel', 'Front\WelcomeController@hotel')->name('hotel');    
    Route::multilingual('/partners/{partner}', 'Front\PartnersController@index')->name('partner');     
    Route::multilingual('/proposal', 'Front\WelcomeController@create_proposal')->name('proposal-member');    
    Route::multilingual('/biz-proposal', 'Front\WelcomeController@create_bizproposal')->name('proposal-biz');    


/*     Route::get('/php', function(){
        $locale = app()->getLocale();
        $languages= Helpme::languages()->toArray();

        foreach ($languages as $lang){

            if ($locale==$lang) {

                $member[$lang] = 'memberName';
            } else {
                
                $member[$lang] = '';
            }
            
        }
        dd(json_encode($member), $locale); 

    });*/
    
});

Route::post('/store-proposal', 'Front\WelcomeController@store_proposal')->name('store-proposal');    
Route::post('/store-biz-proposal', 'Front\WelcomeController@store_biz_proposal')->name('store-biz-proposal');    

Route::get('tr', function () {
    dd(GoogleTranslate::translate('Привет мир First Item', 'en', 'html')['translated_text']);

});