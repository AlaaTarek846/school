<?php

namespace Database\Seeders;

use App\Models\EducationStage;
use App\Models\ParentsMeeting;
use App\Models\ParentsMeetingDetail;
use Illuminate\Database\Seeder;

class ParentsMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (EducationStage::count() === 0) {
            $this->call(EducationStageSeeder::class);
        }

        $stages = EducationStage::all()->keyBy('title_en');

        $meetings = [
            [
                'title_ar' => 'مقابلة اولياء الامور كى جى',
                'title_en' => 'Parent-Teacher Meeting – KG',
                'note_ar' => null,
                'note_en' => null,
                'is_general_time' => true,
                'time_from' => '10:30',
                'time_to' => '13:30',
                'details' => [
                    ['stage' => 'KG 1', 'days' => ['sunday']],
                    ['stage' => 'KG 2', 'days' => ['monday']],
                    ['stage' => 'Primary 1', 'days' => ['tuesday']],
                    ['stage' => 'Primary 2', 'days' => ['wednesday']],
                ],
            ],
            [
                'title_ar' => 'مقابلة أولياء الأمور الابتدائي',
                'title_en' => 'Primary School Parent-Teacher Meeting',
                'note_ar' => null,
                'note_en' => null,
                'is_general_time' => false,
                'time_from' => null,
                'time_to' => null,
                'details' => [
                    ['stage' => 'Primary 1', 'days' => ['sunday'], 'time_from' => '10:45', 'time_to' => '11:15'],
                    ['stage' => 'Primary 2', 'days' => ['monday'], 'time_from' => '10:45', 'time_to' => '11:15'],
                    ['stage' => 'Primary 3', 'days' => ['tuesday'], 'time_from' => '10:45', 'time_to' => '11:15'],
                    ['stage' => 'Primary 4', 'days' => ['sunday', 'monday', 'tuesday'], 'time_from' => '11:50', 'time_to' => '12:25'],
                    ['stage' => 'Primary 5', 'days' => ['wednesday'], 'time_from' => '11:55', 'time_to' => '12:25'],
                    ['stage' => 'Primary 6', 'days' => ['thursday'], 'time_from' => '11:55', 'time_to' => '12:30'],
                ],
            ],
            [
                'title_ar' => 'مقابلة أولياء الأمور الإعدادي',
                'title_en' => 'Preparatory School Parent-Teacher Meeting',
                'note_ar' => 'ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات',
                'note_en' => 'ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات  ملاحظات',
                'is_general_time' => true,
                'time_from' => '12:00',
                'time_to' => '12:35',
                'details' => [
                    ['stage' => 'Preparatory 1', 'days' => ['sunday']],
                    ['stage' => 'Preparatory 2', 'days' => ['monday']],
                    ['stage' => 'Preparatory 2', 'days' => ['tuesday']],
                ],
            ],
        ];

        foreach ($meetings as $meetingData) {
            $details = $meetingData['details'];
            unset($meetingData['details']);

            $meeting = ParentsMeeting::updateOrCreate(
                ['title_en' => $meetingData['title_en']],
                $meetingData
            );

            $meeting->details()->delete();

            foreach ($details as $detail) {
                $stage = $stages->get($detail['stage']);

                if (!$stage) {
                    continue;
                }

                ParentsMeetingDetail::create([
                    'parents_meeting_id' => $meeting->id,
                    'education_stage_id' => $stage->id,
                    'time_from' => $detail['time_from'] ?? null,
                    'time_to' => $detail['time_to'] ?? null,
                    'days' => $detail['days'],
                ]);
            }
        }
    }
}
