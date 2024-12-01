<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentSchedule;
use App\Models\Order;
use Auth;
class AppointmentScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){

        $auth_user = Auth::guard('web')->user();

        $schedules = AppointmentSchedule::orderBy('id','desc')->where('user_id', $auth_user->id)->get();

        return view('provider.appointment_schedule')->with([
            'schedules' => $schedules
        ]);
    }

    public function create(){
        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );

        return view('provider.create_appointment_schedule')->with([
            'days' => $days
        ]);
    }


    public function store(Request $request){

        $auth_user = Auth::guard('web')->user();

        $rules = [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
        $customMessages = [
            'day.required' => trans('user_validation.Day is required'),
            'start_time.required' => trans('user_validation.Start time is required'),
            'end_time.required' => trans('user_validation.End time is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        if($request->schedule_allows){
            $days = array(
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            );

            foreach ($days as $day){
                $schedule = new AppointmentSchedule();
                $schedule->user_id = $auth_user->id;
                $schedule->day = $day;
                $schedule->start_time = $request->start_time;
                $schedule->end_time = $request->end_time;
                $schedule->status = $request->status;
                $schedule->save();
            }

        }else{
            $schedule = new AppointmentSchedule();
            $schedule->user_id = $auth_user->id;
            $schedule->day = $request->day;
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
            $schedule->status = $request->status;
            $schedule->save();
        }


        $notification= trans('user_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function edit($id){
        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );

        $schedule = AppointmentSchedule::find($id);

        return view('provider.edit_appointment_schedule')->with([
            'days' => $days,
            'schedule' => $schedule,
        ]);
    }

    public function update(Request $request, $id){

        $auth_user = Auth::guard('web')->user();

        $rules = [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
        $customMessages = [
            'day.required' => trans('user_validation.Day is required'),
            'start_time.required' => trans('user_validation.Start time is required'),
            'end_time.required' => trans('user_validation.End time is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $schedule = AppointmentSchedule::find($id);
        $schedule->user_id = $auth_user->id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        $notification= trans('user_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('provider.appointment-schedule.index')->with($notification);

    }

    public function destroy($id){
        $exist = Order::where('appointment_schedule_id', $id)->count();
        if($exist == 0){
            $schedule = AppointmentSchedule::find($id);
            $schedule->delete();

            $notification= trans('user_validation.Deleted Successfully');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.appointment-schedule.index')->with($notification);
        }else{
            $notification= trans('user_validation.You can not delete this item, there are multiple booking exist under this schedule');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('provider.appointment-schedule.index')->with($notification);
        }


    }

}
