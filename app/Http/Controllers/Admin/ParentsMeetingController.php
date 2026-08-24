<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ParentsMeetingRequest;
use App\Models\ParentsMeeting;
use Illuminate\Support\Arr;

class ParentsMeetingController extends Controller
{
    public function indexPage()
    {
        return view('admin.parentsMeeting.index');
    }

    public function index()
    {
        $data = ParentsMeeting::with(['details.educationStage', 'details.schoolClass'])->latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(ParentsMeetingRequest $request)
    {
        $data = $request->validated();
        $payload = $this->prepareMeetingPayload($data);

        $meeting = ParentsMeeting::create(Arr::except($payload, ['details']));

        foreach ($payload['details'] as $detail) {
            $meeting->details()->create($detail);
        }

        return responseJson([], 'Added Successfully', 200);
    }

    public function update(ParentsMeetingRequest $request, $id)
    {
        $meeting = ParentsMeeting::findOrFail($id);
        $data = $request->validated();
        $payload = $this->prepareMeetingPayload($data);

        $meeting->update(Arr::except($payload, ['details']));

        $meeting->details()->delete();

        foreach ($payload['details'] as $detail) {
            $meeting->details()->create($detail);
        }

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $meeting = ParentsMeeting::findOrFail($id);
        $meeting->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }

    private function prepareMeetingPayload(array $data): array
    {
        $isGeneral = (bool) ($data['is_general_time'] ?? false);

        if ($isGeneral) {
            $data['details'] = array_map(function ($detail) {
                $detail['time_from'] = null;
                $detail['time_to'] = null;
                return $detail;
            }, $data['details']);
        } else {
            $data['time_from'] = null;
            $data['time_to'] = null;
        }

        return $data;
    }
}
