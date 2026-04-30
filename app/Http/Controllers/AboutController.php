<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\PrincipalMessage;
use App\Models\SchoolDisciplinePolicy;

class AboutController extends BaseController
{
    // homepage one
    public function principalMessage(){
        $principal_message = PrincipalMessage::first();
        return $this->view('principal-message',[
            'page_title' => 'principal-message',
            'principal_message' => $principal_message
        ]);
    }

    // Core Values
    public function coreValues(){
        $core_values = \App\Models\HowWeWelcomeChild::get();
        return $this->view('core-values', [
            'page_title' => 'Core Values',
            'core_values' => $core_values
        ]);
    }

    // homepage three
    public function schoolDisciplinePolicy(){
        $policies = SchoolDisciplinePolicy::get();
        return $this->view('school-discipline-policy', [
            'page_title' => 'School discipline policy',
            'policies' => $policies
        ]);
    }

    // homepage four

    public function parentsMeeting(){
        return $this->view('parents-meeting', [
            'page_title' => 'parents Meeting'
        ]);
    }


}
