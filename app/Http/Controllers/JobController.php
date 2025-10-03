<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Metric;

class JobController extends Controller
{
    /**
     * Get all available jobs
     * @return array Array of job data
     */
    public function getJobs()
    {
        return [
            [
                'id' => 1,
                'title' => 'Frontend Developer (Level 2)',
                'type' => 'Full-time',
                'location' => 'Kuala Lumpur, Malaysia',
                'department' => 'Engineering',
                'salary' => 'RM5,000 to RM6,999',
                'featured' => false,
                'description' => 'Join our engineering team to develop and optimize frontend applications for Billplz\'s payment products and dashboards. Work with cutting-edge technologies and help shape the future of digital payments.',
                'responsibilities' => [
                    'Develop, maintain, and optimize frontend applications for Billplz\'s payment products and dashboards',
                    'Translate UI/UX wireframes into responsive, high-quality, and scalable code',
                    'Collaborate closely with backend developers, designers, and product managers to deliver end-to-end features',
                    'Ensure performance, security, and cross-browser compatibility of web applications',
                    'Continuously improve user experience by incorporating feedback, A/B testing, and analytics',
                    'Troubleshoot, debug, and resolve frontend issues quickly',
                    'Stay updated with the latest frontend technologies and best practices to improve code quality'
                ],
                'skills' => [
                    'Strong proficiency in HTML, CSS, and JavaScript',
                    'Strong experience in API integration',
                    'Proficient in React.js/Next.js',
                    'Hands-on experience with UI libraries (e.g., shadcn/ui, MUI, TailwindCSS)',
                    'Familiar with frontend performance optimization and best practices'
                ],
                'posted_date' => '2024-01-15',
                'application_email' => 'love@billplz.com',
                'referral_note' => 'This position is available through referral. Please mention "Ahmad Syaafi" as your referrer when applying.'
            ],
            [
                'id' => 2,
                'title' => 'Enterprise Solutions Executive (Level 1)',
                'type' => 'Full-time',
                'location' => 'Kuala Lumpur, Malaysia',
                'department' => 'Sales',
                'salary' => 'RM3,000 to RM4,500',
                'featured' => false,
                'description' => 'Join our sales team to drive enterprise solutions and build strong relationships with key clients. Help businesses integrate Billplz payment solutions into their operations.',
                'responsibilities' => [
                    'Work closely with larger enterprise clients to understand complex requirements.',
                    'Assist in planning and executing solution rollouts, including integration of Billplz\'s payment gateway.',
                    'Support the Enterprise Solutions Manager in preparing proposals, RFPs, and solution demonstrations.',
                    'Maintain strong relationships with enterprise stakeholders (C-level, finance, and tech teams).',
                    'Coordinate internally with teams to ensure smooth solution deployment.',
                    'Monitor usage and provide insights to improve enterprise customer satisfaction and retention.'
                ],
                'skills' => [
                    'Strong analytical and problem-solving skills.',
                    'Ability to communicate independently and effectively with technical and non-technical stakeholders.',
                    'Basic understanding of API integrations, online payment flows, and compliance requirements.',
                    'Strong project coordination and follow-up skills.',
                    'Proactive and adaptable in handling enterprise-level client expectations.'
                ],
                'posted_date' => '2024-01-20',
                'application_email' => 'love@billplz.com',
                'referral_note' => 'This position is available through referral. Please mention "Ahmad Syaafi" as your referrer when applying.'
            ],
            [
                'id' => 3,
                'title' => 'SME Solutions Executive (Level 1)',
                'type' => 'Full-time',
                'location' => 'Kuala Lumpur, Malaysia',
                'department' => 'Sales',
                'salary' => 'RM3,000 to RM4,500',
                'featured' => false,
                'description' => 'Help small and medium enterprises adopt Billplz payment solutions. Build relationships with SME clients and drive business growth in this dynamic market segment.',
                'responsibilities' => [
                    'Prospect and qualify SME leads through various channels',
                    'Conduct product demonstrations and presentations to SME clients',
                    'Build and maintain a pipeline of potential SME customers',
                    'Provide consultative sales approach to understand client needs',
                    'Collaborate with marketing team on SME-focused campaigns',
                    'Track and report on sales activities and results',
                    'Ensure customer satisfaction and identify upselling opportunities'
                ],
                'skills' => [
                    'Bachelor\'s degree in Business, Marketing, or related field',
                    '1-2 years of experience in B2B sales or customer service',
                    'Excellent interpersonal and communication skills',
                    'Understanding of SME business challenges and needs',
                    'Experience with lead generation and prospecting',
                    'Basic knowledge of payment systems and e-commerce',
                    'Self-motivated with strong organizational skills'
                ],
                'posted_date' => '2024-01-20',
                'application_email' => 'love@billplz.com',
                'referral_note' => 'This position is available through referral. Please mention "Ahmad Syaafi" as your referrer when applying.'
            ],
        ];
    }

    /**
     * Get a specific job by ID
     * @param int $job_id Job ID
     * @return array|null Job data or null if not found
     */
    public function getJobById($job_id)
    {
        $jobs = $this->getJobs();
        foreach ($jobs as $job) {
            if ($job['id'] == $job_id) {
                return $job;
            }
        }
        return null;
    }

    /**
     * Format date for display
     * @param string $date Date string
     * @return string Formatted date
     */
    public function formatDate($date)
    {
        return date('M j, Y', strtotime($date));
    }

    /**
     * Generate job application email subject
     * @param string $job_title Job title
     * @return string Email subject
     */
    public function getApplicationSubject($job_title)
    {
        return $job_title . ' Application - JkOpie Careers';
    }

    /**
     * Check if job is featured
     * @param array $job Job data
     * @return bool True if featured
     */
    public function isJobFeatured($job)
    {
        return isset($job['featured']) && $job['featured'] === true;
    }

    /**
     * Get job type class for styling
     * @param string $type Job type
     * @return string CSS class
     */
    public function getJobTypeClass($type)
    {
        $classes = [
            'Full-time' => 'job-type-fulltime',
            'Part-time' => 'job-type-parttime',
            'Contract' => 'job-type-contract',
            'Internship' => 'job-type-internship'
        ];

        return isset($classes[$type]) ? $classes[$type] : 'job-type-default';
    }

    /**
     * Display the careers page
     */
    public function index()
    {
        $jobs = $this->getJobs();
        return view('careers', compact('jobs'));
    }

    /**
     * Handle subscription request
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower($validated['email']);

        $already = Subscription::where('email', $email)->first();
        if ($already) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already subscribed to job notifications.'
            ]);
        }

        Subscription::create([
            'email' => $email,
            'status' => 'active',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Successfully subscribed to job notifications! You'll be notified when new positions are available."
        ]);
    }

    public function track(Request $request)
    {
        $validated = $request->validate([
            'event' => 'required|in:page_view,view_details,apply_click',
            'job_id' => 'nullable|integer',
            'path' => 'nullable|string|max:255',
        ]);

        Metric::create([
            'event' => $validated['event'],
            'job_id' => $validated['job_id'] ?? null,
            'path' => $validated['path'] ?? $request->path(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['ok' => true]);
    }
}
