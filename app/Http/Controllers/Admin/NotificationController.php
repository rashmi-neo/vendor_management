<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;
use Illuminate\Http\Request;
use DataTables;

class NotificationController extends Controller
{

    private $notificationRepository;

    public function __construct(NotificationsInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            //get the current user_id and fetch the notifications related to that id
            $currentUser = \Auth::user();
            $whereData = ['user_id'=>$currentUser->id];
            $data = $this->notificationRepository->getWhereData($whereData);
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('title', function($data){
                return $data->title;
            })
            ->addColumn('text', function($data){
                return $data->text;
            })
            ->addColumn('company_name', function($data){
                return $data->type;
            })
            ->addColumn('status', function($data){
                
                $status = \Config::get('constants.NOTIFICATION_STATUS');

                if($data->status == "read"){
                    return $status['read'];
                }elseif($data->status == "unread"){
                    return $status['unread'];
                }
                return "Rejected";
            })
            ->addColumn('created_at', function($data){
                return \Carbon\Carbon::parse($data->created_at)->toFormattedDateString();
            })
            ->addColumn('action', function($row){
                return view('admin.notifications.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    *   Mark notification as read
    */
    public function markAsRead($id)
    {
        $notification = $this->notificationRepository->get($id);
        if($notification)
        {
            $notifStatus = ['status'=>'read'];
            $update = $this->notificationRepository->update($id,$notifStatus);
            if($update)
                echo "true";
        }
        else
            echo "false";
    }
}
