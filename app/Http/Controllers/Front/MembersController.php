<?php

namespace App\Http\Controllers\Front;

use App\Front\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
class MembersController extends Controller
{
    public function index(Member $member)
    {
        abort_if($member->festival->is_default === 0, 404);

        $festival = $member->festival;

        return view('front.member', compact('festival', 'member'));
    }

    public function fest($domain,Member $member )
    {
        abort_if($domain != $member->festival->slug, 404);

        $festival = $member->festival;

        return view('front.member', compact('festival', 'member'));
    } 

}
