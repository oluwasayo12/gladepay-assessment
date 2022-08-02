<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Fetches all activity logs
     *
     * @return void
     */
    public function show() {
        $activities = Activity::select('id','description')->paginate(10);
        return $this->successResponse('Activity logs', $activities);
    }
}
