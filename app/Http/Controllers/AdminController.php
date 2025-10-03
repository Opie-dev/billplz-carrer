<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Models\Subscription;
use App\Models\Metric;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\JobController;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = strtolower($request->input('email'));
        $password = $request->input('password');

        $user = User::where('email', $email)->where('role', 'admin')->first();
        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put('admin_authenticated', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalViews = Metric::where('event', 'page_view')->count();
        $totalViewDetails = Metric::where('event', 'view_details')->count();
        $totalApplyClicks = Metric::where('event', 'apply_click')->count();

        $perJobViewDetails = Metric::selectRaw('job_id, COUNT(*) as total')
            ->where('event', 'view_details')
            ->whereNotNull('job_id')
            ->groupBy('job_id')
            ->orderByDesc('total')
            ->get();

        // Map job_id to job title using JobController::getJobs()
        $jobs = app(JobController::class)->getJobs();
        $jobIdToTitle = collect($jobs)->mapWithKeys(function ($job) {
            return [$job['id'] => $job['title']];
        });

        $subscriptions = Subscription::orderByDesc('created_at')->paginate(20);

        return view('admin.dashboard', [
            'totalViews' => $totalViews,
            'totalViewDetails' => $totalViewDetails,
            'totalApplyClicks' => $totalApplyClicks,
            'perJobViewDetails' => $perJobViewDetails,
            'subscriptions' => $subscriptions,
            'jobIdToTitle' => $jobIdToTitle,
        ]);
    }
}
