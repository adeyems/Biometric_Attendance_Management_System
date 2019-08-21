<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class RequestReport extends Model {

  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'request_reports';
    protected $primaryKey = 'report_no';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'report_no', 'student_no', 'start_date', 'end_date',
    ];

    public static function create(Request $request) {
        $report = new RequestReport();
        $report->report_no = $request->report_no;
        $report->start_date = $request->start_date;
        $report->end_date = $request->end_date;
        $report->parent_no = session()->get('user')[0]->parent_no;
        $report->student_no =  $request->student_no;

        return $report->save();

    }

}