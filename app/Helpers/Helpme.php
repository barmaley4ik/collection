<?php
namespace App\Helpers;

use Brackets\Translatable\Facades\Translatable;
use App\Language;
use App\User;
use App\Mail\ProposalEmail;
use App\Mail\BizProposalEmail;
use Illuminate\Support\Facades\Mail;

class Helpme
{

    /**
     *
     * @return array directives robots
     */
    public static function robots() {
		$robots = [
					'index,follow',
					'index,nofollow',
					'noindex,nofollow',
					'noindex,follow',
		];

        return $robots;
	}
	
    public static function getReplaceString($arrName) {

		$inArray = array('[', '][', ']', '[]');
		$outArray = array('.','.','','');

		$clearString = str_replace($inArray, $outArray,($arrName));
		$tempString = $clearString;

		$dot = substr($tempString, -1);
		if($dot === '.')
		{
			$clearString = substr($clearString, 0, -1);
		}
        return $clearString;
	}
	
    /**
     *
     * @return collect languages
     */
    public static function languages() {

		$languages = Language::orderBy('is_default', 'desc')->orderByName()->pluck('encoding');
		
		return $languages;

	}
	
   /**
     *
     * @return string default language
     */
    public static function defaultLanguage() {

		$defaultLanguage = Language::isDefault()->select('encoding')->first();
		
		return $defaultLanguage->encoding;

	}

	 public static function sendProposalMail($model, $subject){

		$dataAdmins = User::whereRole('Admin')->whereNotNull('email')->get();
		$dataMarketings = User::whereRole('Marketing')->whereNotNull('email')->get();
		//$when = \Carbon\Carbon::now()->addSeconds(20);
		$data['admin'] = [];
		$data['marketing'] = [];
		$i=0;

		foreach ($dataAdmins as $item) {
			$data['admin'][$i]['name'] = $item->name;
			$data['admin'][$i]['email'] = $item->email;
			$i++;
		}

		foreach ($dataMarketings as $item) {
			$data['marketing'][$i]['name'] = $item->name;
			$data['marketing'][$i]['email'] = $item->email;
			$i++;
		}            
		

		if ($model->status_id == $model::STATUS_NEW){

			Mail::to($data['admin'])
			->queue(new ProposalEmail($model, $subject));   
			
		} elseif ($model->status_id == $model::STATUS_PAYMENT){

			Mail::to($data['admin'])
			->bcc($data['marketing'])
			->queue(new ProposalEmail($model, $subject));   
		}
  		 
	 }

	 public static function sendBizProposalMail($model, $subject){

		$dataAdmins = User::whereRole('Admin')->whereNotNull('email')->get();
		$dataMarketings = User::whereRole('Marketing')->whereNotNull('email')->get();
		//$when = \Carbon\Carbon::now()->addSeconds(20);
		$data['admin'] = [];
		$data['marketing'] = [];
		$i=0;

		foreach ($dataAdmins as $item) {
			$data['admin'][$i]['name'] = $item->name;
			$data['admin'][$i]['email'] = $item->email;
			$i++;
		}

		foreach ($dataMarketings as $item) {
			$data['marketing'][$i]['name'] = $item->name;
			$data['marketing'][$i]['email'] = $item->email;
			$i++;
		}            
		

		if ($model->status_id == $model::STATUS_NEW){

			Mail::to($data['admin'])
			->queue(new BizProposalEmail($model, $subject));   
			
		} elseif ($model->status_id == $model::STATUS_PAYMENT){

			Mail::to($data['admin'])
			->bcc($data['marketing'])
			->queue(new BizProposalEmail($model, $subject));   
		}
  		 
	 }	 
	
}
