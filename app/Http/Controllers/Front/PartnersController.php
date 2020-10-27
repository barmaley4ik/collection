<?php

namespace App\Http\Controllers\Front;

use App\Front\Partner;
use App\Http\Controllers\Controller;


class PartnersController extends Controller
{
    public function index(Partner $partner)
    {

        $festival = $partner->festival_default();

        return view('front.partner', compact('festival', 'partner'));
    }

    public function fest($domain,Partner $partner )
    {

        $festival = $partner->festival_other($domain);

        return view('front.partner', compact('festival', 'partner'));
    } 

}
