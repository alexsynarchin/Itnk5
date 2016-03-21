<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Option;

class documentPurchaseComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $document_type='purchase';
        $view -> with(compact('document_type'));
    }
}