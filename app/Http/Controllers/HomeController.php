<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Traits\Messages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Messages;


    protected $resources = [
        'styles' => [],
        'scripts' => []
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->resources['card_title'] = 'Dashboard';
        $this->resources['total_students'] = Student::where('status',1)->get()->count();
        $this->resources['total_subjects'] = Subject::where('status',1)->get()->count();;
        return view('home')->with($this->resources);
    }
}
