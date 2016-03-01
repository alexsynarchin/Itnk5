<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Option;

class documentResiduesEnteringComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $document_type='residues_entering';
        $view -> with(compact('document_type'));
    }
}