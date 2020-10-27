<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Proposal;
use App\BizProposal;
use App\Festival;
use App\Member;
use App\Partner;

class DashboardController extends Controller
{
    public function __invoke()
    {

        return Inertia::render('Dashboard/Index', [
            'partners' => Partner::count(),
            'festivals' => Festival::count(),
            'proposals' => Proposal::count(),
            'members' => Member::count(),
            'biz_proposals' => BizProposal::count(),
        ]);        
    }
}
