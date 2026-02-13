<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    // homepage one
    public function principalMessage(){
        return $this->view('principal-message',[
            'page_title' => 'principal-message'
        ]);
    }

    // homepage two
    public function howWeWelcomeTheChild(){
        return $this->view('how-we-welcome-the-child', [
            'page_title' => 'How we welcome the child'
        ]);
    }

    // homepage three
    public function schoolDisciplinePolicy(){
        return $this->view('school-discipline-policy', [
            'page_title' => 'School discipline policy'
        ]);
    }

    // homepage four

    public function parentsMeeting(){
        return $this->view('parents-meeting', [
            'page_title' => 'parents Meeting'
        ]);
    }


}
