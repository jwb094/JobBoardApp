<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Services\UserAuthService;
use Illuminate\Http\Request;

class SavedJobListingController extends Controller
{
    //  
    protected UserAuthService $userAuthService;

    public function __construct(UserAuthService $userAuthServices)
    {
        $this->userAuthService = $userAuthServices;
    }

    public function update(Request $request)
    {


        $userId = auth()->id();

        $savedJob = $this->userAuthService->userSavedJobs($request,$userId);

        return $savedJob;
    }

}
