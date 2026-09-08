<?php


namespace App\Services;

use App\Models\Company;
use App\Models\JobListing;
use Illuminate\Support\Str;
class  EmployerService
{

    public function dashboard(object $applicantUser)
    {
        return [
            "applicantCount" =>  JobListing::where('company_id', '=', $applicantUser->company_id)->join('applications', 'job_listings.id', '=', 'applications.job_id')->count(),
            "jobCount" =>    JobListing::where('company_id', '=', $applicantUser->company_id)->count()
        ];
    }



    public function getJobsAndApplicants(object $user): mixed {

        $jobsAndApplicants = JobListing::where('company_id', $user->company_id)
            ->where('status', 'open')
            ->with('applications.applicantUsers')
            ->get();

            return $jobsAndApplicants;
    }

    public function getCompanyDetails(object $user): mixed {
        $companyName =   Company::where("id", $user->company_id)->select("company_name")->get();
        $companyName = json_decode($companyName, true);
        $companyName = ucfirst($companyName[0]['company_name']);

        return $companyName;
    }

    public function newJob(array $newJobFormData,object $user): mixed {

        $newJobFormData['user_id']    = $user->id;
        $newJobFormData['company_id'] = $user->company_id;
        $newJobFormData['salary_min'] = $newJobFormData['salary_min'] ?? null;
        $newJobFormData['salary_max'] = $newJobFormData['salary_max'] ?? null;
        $newJobFormData['expires_at'] = strtotime($newJobFormData['expires_at']);
        $newJobFormData['slug']       = Str::slug($newJobFormData['title']) . '-' . rand(1000, 9999);

   
        $newJobDesc = JobListing::create($newJobFormData);
        return $newJobDesc;
    }


    public function editJob() {}
}
