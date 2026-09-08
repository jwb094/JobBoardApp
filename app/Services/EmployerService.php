<?php


namespace App\Services;

use App\Models\Company;
use App\Models\JobListing;
use App\Models\JobListingsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function newJobFormsValue()
    {

        $jobTypes = [
            "Full-time",
            "Part-time",
            "Contract",
            "Remote"
        ];
         $jobStatuses =["open"=>"Open",
        "closed"=>"Closed"];

        return [
           "jobTypes" =>  $jobTypes,
           "jobStatuses" => $jobStatuses
        ];
    }

    public function getJobsAndApplicants(object $user): mixed
    {

        $jobsAndApplicants = JobListing::where('company_id', $user->company_id)
            ->where('status', 'open')
            ->with('applications.applicantUsers')
            ->get();
        
        return $jobsAndApplicants;
    }

    public function getCompanyDetails(object $user): mixed
    {
        $companyName =   Company::where("id", $user->company_id)->select("company_name")->get();
        $companyName = json_decode($companyName, true);
        $companyName = ucfirst($companyName[0]['company_name']);

        return $companyName;
    }

    public function newJob(array $newJobFormData, object $user): mixed
    {

        $newJobFormData['user_id']    = $user->id;
        $newJobFormData['company_id'] = $user->company_id;
        $newJobFormData['salary_min'] = $newJobFormData['salary_min'] ?? null;
        $newJobFormData['salary_max'] = $newJobFormData['salary_max'] ?? null;
        $newJobFormData['expires_at'] = strtotime($newJobFormData['expires_at']);
        $newJobFormData['slug']       = Str::slug($newJobFormData['title']) . '-' . rand(1000, 9999);


        $newJobDesc = JobListing::create($newJobFormData);
        return $newJobDesc;
    }


    public function editJob(array $editJobFormData, int $jobId, object $user): mixed
    {

        $editJobFormData['user_id'] = $user->id;
        $editJobFormData['salary_min'] = $editJobFormData['salary_min'] ?? '';
        $editJobFormData['salary_max'] = $editJobFormData['salary_max'] ?? '';
        $editJobFormData['company_id'] = $user->company_id;
        $editJobFormData['expires_at'] =  strtotime($editJobFormData['expires_at']);

        $updatedJobDesc = JobListing::where('id', $jobId)->update($editJobFormData);
        return $updatedJobDesc;
    }


    public function login() {}


    public function register(array $employerRegisteredDetails): mixed
    {

        DB::beginTransaction();

        try {


            $company = Company::create(
                [
                    'company_name' => $employerRegisteredDetails['company_name'],
                    'company_tel' => $employerRegisteredDetails['company_tel'],
                    'company_size' => $employerRegisteredDetails['company_size']
                ]
            );

            $userData = ([
                'first_name' => $employerRegisteredDetails['first_name'],
                'last_name' => $employerRegisteredDetails['last_name'],
                'email' => $employerRegisteredDetails['email'],
                'password' => $employerRegisteredDetails['password']
            ]);

            if (!empty($employerRegisteredDetails['password'])) {
                $userData['password'] = Hash::make($employerRegisteredDetails['password']);
            }

            $userData['role'] = 'employer';
            $userData['company_id'] = $company->id;

            JobListingsUser::create($userData);

            DB::commit();

            if ($userData && $company) {
                return [
                    'success' => true,
                    'message' => 'new Employer and Company was Registered successfully.'
                ];
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return $e;
        }
    }

}
