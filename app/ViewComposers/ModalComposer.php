<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Front\Festival;
class ModalComposer
{
    protected $festivals;


    /**
     * Create a new menu composer.
     *
     * @return void
     */
    public function __construct()
    {
        $festivals= Festival::active()->get();

        $this->festivals = $festivals;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('festivals', $this->festivals);
    }
}