<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use Illuminate\Http\Request;

class SavedJobListingController extends Controller
{
    //


    public function update(Request $request)
    {

        $request->validate([
            'job_id' => 'required|exists:job_listings,id',
        ]);

        $userId = auth()->id();



        $savedJobExists = SavedJob::where('user_id', $userId)
            ->where('job_id', $request->job_id)
            ->exists();

        if ($savedJobExists) {
            SavedJob::where('user_id', $userId)
                ->where('job_id', $request->job_id)
                ->delete();

            return response()->json([
                'status' => true,
                'message' => "removed Job from Saved Jobs List",
            ]);
        }

        SavedJob::create([
            'user_id' => $userId,
            'job_id' => $request->job_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Job added to saved jobs",
        ]);
    }


    public function remove() {}
}
