<?php

namespace Admin;

use Child;
use Registration;

use Carbon\Carbon;

use DB;
use Input;
use Redirect;
use View;

class PrintoutController extends AdminBaseController {

    //
    // Allows an admin user to print out a list of the children
    // in a given team on a given day - but only the ones who have
    // registered on that day.
    //
    public function teamPrintout($day = 'wednesday', $team = 1)
    {
        $this->layout->with('title', 'Printing');
        $this->layout->with('subtitle', 'team list');

        $dow = date('N', strtotime($day));

        $registrations = 
            Registration::join('children', 'registrations.child_id', '=', 'children.id')
                ->select('registrations.*')
                ->where(DB::raw('DAYNAME(registrations.created_at)'), '=', $day)
                ->where('children.team', $team)
                ->orderBy('children.first_name')
                ->orderBy('children.last_name')
                ->get();

        $this->layout->content = 
            View::make('admin/printouts/team')
                    ->with('day', ucwords($day))
                    ->with('team', $team)
                    ->with('registrations', $registrations)
                    ->with('teams', Child::$teams);
    }

    public function doTeamPrintout()
    {
        $day  = Input::get('day');
        $team = Input::get('team');

        return Redirect::route('printout.team', array('day' => $day, 'team' => $team));
    }


    //
    // Allows an admin user to print out a list of the children
    // doing a given activity on a given day - but only the ones who have
    // registered on that day.
    //
    public function activityPrintout($team = 1, $activity = 'Dancing')
    {
        $this->layout->with('title', 'Printing');
        $this->layout->with('subtitle', 'activity list');

        $registrations = 
            Registration::join('children', 'registrations.child_id', '=', 'children.id')
                ->select('registrations.*')
                ->where(DB::raw('DATE(registrations.created_at)'), '=', DB::raw('current_date'))
                ->where('children.team', $team)
                ->where(function($query) use($activity) {
                        $query->where('children.activity_choice_1', $activity)
                              ->orWhere('children.activity_choice_2', $activity)
                              ->orWhere('children.activity_choice_3', $activity);
                    })
                ->orderBy('children.first_name')
                ->orderBy('children.last_name')
                ->get();

        $this->layout->content = 
            View::make('admin/printouts/activity')
                    ->with('activity', $activity)
                    ->with('activities', Child::$activities)
                    ->with('team', $team)
                    ->with('registrations', $registrations)
                    ->with('teams', Child::$teams);
    }

    public function doActivityPrintout()
    {
        $activity  = Input::get('activity');
        $team      = Input::get('team');

        return Redirect::route('printout.activity', array('activity' => $activity, 'team' => $team));
    }


    //
    // Allows an administrator to print a name badge label for a leader
    //
    public function printLeadersLabel()
    {
        $this->layout->with('title', 'Printing');
        $this->layout->with('subtitle', 'print a label for a leader');
        $this->layout->content = 
            View::make('admin/printouts/leaders-label');
    }

}
