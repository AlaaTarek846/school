<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\ParentsMeeting;
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
        $meetings = ParentsMeeting::with(['details.educationStage', 'details.schoolClass'])->oldest()->get();
        $dayOrder = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];
        $meetingsData = [];

        foreach ($meetings as $meeting) {
            $schedule = [];

            foreach ($dayOrder as $day) {
                $schedule[$day] = [];
            }

            foreach ($meeting->details as $detail) {
                $stageTitle = app()->getLocale() === 'ar'
                    ? ($detail->educationStage->title_ar ?? '')
                    : ($detail->educationStage->title_en ?? '');

                if ($detail->schoolClass?->name) {
                    $stageTitle .= ' - ' . $detail->schoolClass->name;
                }

                $timeFrom = $meeting->is_general_time ? $meeting->time_from : $detail->time_from;
                $timeTo = $meeting->is_general_time ? $meeting->time_to : $detail->time_to;

                foreach ($detail->days ?? [] as $day) {
                    if (!isset($schedule[$day])) {
                        continue;
                    }

                    $schedule[$day][] = [
                        'stage' => $stageTitle,
                        'time_from' => $timeFrom,
                        'time_to' => $timeTo,
                    ];
                }
            }

            $schedule = array_filter($schedule, fn ($items) => count($items) > 0);

            $meetingsData[] = [
                'meeting' => $meeting,
                'schedule' => $schedule,
            ];
        }

        return $this->view('parents-meeting', [
            'page_title' => 'parents Meeting',
            'meetingsData' => $meetingsData,
        ]);
    }


}
