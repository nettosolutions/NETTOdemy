<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Blog;
use App\Models\Bundle;
use App\Models\Category;
use App\Models\Config;
use App\Models\Course;
use App\Models\CourseTimeline;
use App\Models\Faq;
use App\Models\Lesson;
use App\Models\Page;
use App\Models\Reason;
use App\Models\Sponsor;
use App\Models\System\Session;
use App\Models\Tag;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Newsletter;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    private $path;

    public function __construct()
    {

        $path = 'frontend';
        if(session()->has('display_type')){
            if(session('display_type') == 'rtl'){
                $path = 'frontend-rtl';
            }else{
                $path = 'frontend';
            }
        }else if(config('app.display_type') == 'rtl'){
            $path = 'frontend-rtl';
        }
        $this->path = $path;
    }

    public function index()
    {
        if (request('page')) {
            $page = Page::where('slug', '=', request('page'))
                ->where('published', '=', 1)->first();
            if ($page != "") {
                return view($this->path.'.pages.index', compact('page'));
            }
            abort(404);
        }
        $type = config('theme_layout');
        $sections = Config::where('key', '=', 'layout_' . $type)->first();
        $sections = json_decode($sections->value);

        $popular_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('popular', '=', 1)->take(6)->get();

        $featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)
            ->whereHas('category')
            ->where('featured', '=', 1)->take(8)->get();

        $course_categories = Category::with('courses')->where('icon', '!=', "")->take(12)->get();

        $trending_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('trending', '=', 1)->take(2)->get();

        $teachers = User::role('teacher')->with('courses')->where('active', '=', 1)->take(7)->get();

        $sponsors = Sponsor::where('status', '=', 1)->get();

        $news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        $faqs = Category::with('faqs')->get()->take(6);

        $testimonials = Testimonial::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        $reasons = Reason::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        if ((int)config('counter') == 1) {
            $total_students = config('total_students');
            $total_courses = config('total_courses');
            $total_teachers = config('total_teachers');
        } else {
            $total_course = Course::where('published', '=', 1)->get()->count();
            $total_bundle = Bundle::where('published', '=', 1)->get()->count();
            $total_students = User::role('student')->get()->count();
            $total_courses = $total_course+$total_bundle;
            $total_teachers = User::role('teacher')->get()->count();
        }

        return view($this->path.'.index-' . config('theme_layout'), compact('popular_courses', 'featured_courses', 'sponsors', 'total_students', 'total_courses', 'total_teachers', 'testimonials', 'news', 'trending_courses', 'teachers', 'faqs', 'course_categories', 'reasons', 'sections'));
    }

    public function getFaqs()
    {
        $faq_categories = Category::has('faqs', '>', 0)->get();
        return view($this->path.'.faq', compact('faq_categories'));
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);

        if (config('mail_provider') != "" && config('mail_provider') == "mailchimp") {
            try {
                if (!Newsletter::isSubscribed($request->subs_email)) {
                    if (config('mailchimp_double_opt_in')) {
                        Newsletter::subscribePending($request->subs_email);
                        session()->flash('alert', "We've sent you an email, Check your mailbox for further procedure.");
                    } else {
                        Newsletter::subscribe($request->subs_email);
                        session()->flash('alert', "You've subscribed successfully");
                    }
                    return back();
                } else {
                    session()->flash('alert', "Email already exist in subscription list");
                    return back();

                }
            } catch (Exception $e) {
                \Log::info($e->getMessage());
                session()->flash('alert', "Something went wrong, Please try again Later");
                return back();
            }

        } elseif (config('mail_provider') != "" && config('mail_provider') == "sendgrid") {
            try {
                $apiKey = config('sendgrid_api_key');
                $sg = new \SendGrid($apiKey);
                $query_params = json_decode('{"page": 1, "page_size": 1}');
                $response = $sg->client->contactdb()->recipients()->get(null, $query_params);
                if ($response->statusCode() == 200) {
                    $users = json_decode($response->body());
                    $emails = [];
                    foreach ($users->recipients as $user) {
                        array_push($emails, $user->email);
                    }
                    if (in_array($request->subs_email, $emails)) {
                        session()->flash('alert', "Email already exist in subscription list");
                        return back();
                    } else {
                        $request_body = json_decode(
                            '[{
                             "email": "' . $request->subs_email . '",
                             "first_name": "",
                             "last_name": ""
                              }]'
                        );
                        $response = $sg->client->contactdb()->recipients()->post($request_body);
                        if ($response->statusCode() != 201 || (json_decode($response->body())->new_count == 0)) {

                            session()->flash('alert', "Email already exist in subscription list");
                            return back();
                        } else {
                            $recipient_id = json_decode($response->body())->persisted_recipients[0];
                            $list_id = config('sendgrid_list');
                            $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->_($recipient_id)->post();
                            if ($response->statusCode() == 201) {
                                session()->flash('alert', "You've subscribed successfully");
                            } else {
                                session()->flash('alert', "Check your email and try again");
                                return back();
                            }

                        }
                    }
                }
            } catch (Exception $e) {
                \Log::info($e->getMessage());
                session()->flash('alert', "Something went wrong, Please try again Later");
                return back();
            }
        }

    }

    public function getTeachers()
    {
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $teachers = User::role('teacher')->paginate(12);
        return view( $this->path.'.teachers.index', compact('teachers', 'recent_news'));
    }

    public function showTeacher(Request $request)
    {
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $teacher = User::role('teacher')->where('id', '=', $request->id)->first();
        $courses= NULL;
        if(count($teacher->courses)> 0){
            $courses = $teacher->courses()->paginate(12);
        }
        return view($this->path.'.teachers.show', compact('teacher', 'recent_news','courses'));
    }

    public function getDownload(Request $request)
    {
        if (auth()->check()) {
            $lesson = Lesson::findOrfail($request->lesson);
            $course_id = $lesson->course_id;
            $course = Course::findOrfail($course_id);
            $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
            if ($purchased_course) {
                $file = public_path() . "/storage/uploads/" . $request->filename;

                return Response::download($file);
            }
            return abort(404);

        }
        return abort(404);

    }

    public function searchCourse(Request $request)
    {
        $courses = Course::where('title', 'LIKE', '%' . $request->q . '%')
            ->orWhere('description', 'LIKE', '%' . $request->q . '%')
            ->where('published', '=', 1)
            ->paginate(12);
        $q = $request->q;
        return view($this->path.'.search-result.courses', compact('courses', 'q'));
    }

    public function searchBlog(Request $request)
    {
        $blogs = Blog::where('title', 'LIKE', '%' . $request->q . '%')
            ->paginate(12);
        $categories = Category::has('blogs')->where('status', '=', 1)->paginate(10);
        $popular_tags = Tag::has('blogs', '>', 4)->get();


        $q = $request->q;
        return view($this->path.'.search-result.blogs', compact('blogs', 'q', 'categories', 'popular_tags'));
    }
}

