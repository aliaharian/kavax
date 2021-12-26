<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Mail\TeamCheck;
use App\Model\ServiceRequest;
use Illuminate\Http\Request;
use App\Mail\SenderEmail;
use Illuminate\Support\Facades\Mail;

class ServiceRequestController extends Controller {
    /* Request Form Page */
    public function show() {
        return view('site.pages.services.request');
    }

    /* Submit Request */
    public function store(Request $request) {
        $ServiceRequestData = $request->all();


        $ServiceRequestData['service_type'] = json_encode($request->service_type);
        $ServiceRequestData['request_meta'] = json_encode($request->request_meta);
        $ServiceRequestData['status'] = 'new';



        if ($ServiceRequest = ServiceRequest::create($ServiceRequestData)) {
            /* User Email Object */
            $objEmail = new \stdClass();
            $objEmail->sender = env('MAIL_FROM_ADDRESS');
            $objEmail->receiver = $request->email;
            $objEmail->name = $request->full_name;

            /* Team Email Object */
            $TeamObjEmail = new \stdClass();
            $TeamObjEmail->name = $request->full_name;
            $TeamObjEmail->link = 'http://kavax/dashboard/services-request/'. $ServiceRequest->id . '/edit';

            Mail::to($request->email)->send(new SenderEmail($objEmail));
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new TeamCheck($TeamObjEmail));

            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Your Request has been successfully registered and we will contact you shortly.'
            ]);
        }
    }

    /* Show All Request */
    public function index() {
        $ServiceRequest = ServiceRequest::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.service-request.index', compact('ServiceRequest'));
    }

    /* Show Request */
    public function edit($id) {
        $ServiceRequest = ServiceRequest::find($id);
        return view('admin.service-request.edit', compact('ServiceRequest'));
    }
}
