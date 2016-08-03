<?php

namespace Registration;

use Child;

use View;

class PrintoutController extends RegistrationBaseController {


    public function printLabel($child_id, $return_url)
    {
        $child = Child::findOrFail($child_id);

        $this->layout->with('title',    'label printing');
        $this->layout->with('subtitle', "{$child->name()}");

        $this->layout->content = 
            View::make('printouts/label')
                ->with('child', $child)
                ->with('return_url', $return_url);
    }


    public function printLeadersLabel()
    {
        $this->layout->with('title', 'Printing');
        $this->layout->with('subtitle', 'print a label for a leader');
        $this->layout->content = 
            View::make('printouts/leaders-label');
    }

}
