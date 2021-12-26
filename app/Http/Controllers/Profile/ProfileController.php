<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Model\Exam\ExamReport;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function youraccount() {
        return view('site.profile.your-account');
    }
}
