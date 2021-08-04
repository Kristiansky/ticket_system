<?php

namespace App\Http\Controllers;

use App\Record;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxRead;

class RecordController extends Controller
{
    
    public $web_forms_options = ['contact', 'test_drive', 'car_configurator', 'tbglc_leasing', 'tdio_test_drive', 'tdio_offer', 'tdio_brochure', 'contact_request', 'used_car', 'test_drive_appointment_request', 'online_reservation'];
    public $cars_options = ['aygo', 'yaris', 'corolla_hatchback', 'corolla_touring_sports', 'corolla_sedan', 'camry', 'yaris_cross', 'c-hr', 'rav4', 'highlander', 'land_cruiser', 'hilux', 'proace', 'proace_verso', 'proace_city', 'proace_city_verso', 'other'];
    public $contact_validation_options = ['call', 'email', 'not_validated'];
    public $status_options = ['new', 'reminded', 'late', 'accepted', 'in_process', 'completed'];
    public $status_options_fill = ['accepted', 'in_process', 'completed'];
    public $dealer_info_options = ['order', 'test_drive_success', 'test_drive_set', 'will_visit_showroom', 'sent_offer', 'sent_borchure', 'sent_leasing_sim', 'second_hand', 'not_serious_interest', 'waiting', 'gave_up', 'no_feedback', 'wrong_contact'];
    public $dealer_progress_status_options = ['client', 'hot', 'warm', 'cold', 'lost'];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $web_forms_options = $this->web_forms_options;
        $dealer_info_options = $this->dealer_info_options;
        $status_options = $this->status_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        $dealers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'dealer');
        })->select('users.id as id', 'users.name as name', 'users.email as email')->get();
    
        if(request('filter') && request('filter') == '1'){
            $records_filter = array(
                'client_name' => request('client_name'),
                'web_form' => request('web_form'),
                'dealer' => request('dealer'),
                'dealer_info' => request('dealer_info'),
                'status' => request('status'),
                'dealer_progress_status' => request('dealer_progress_status'),
                'created_at_from' => request('created_at_from'),
                'created_at_to' => request('created_at_to'),
            );
            session()->put('records_filter', $records_filter);
            return redirect(route('records.index'));
        }elseif (request('reset') && request('reset') == '1'){
            session()->forget('records_filter');
            session()->forget('records_sort');
            session()->forget('records_sort_direction');
            return redirect(route('records.index'));
        }
        
        $records = Record::orderBy('id', 'desc');
        if (auth()->user()->hasRole(['administrator', 'manager'])){
        }elseif(auth()->user()->hasRole(['dealer'])){
            $records->where('dealer_id', '=' , auth()->user()->id);
        }
        $records->where(function ($query){
            if(session('records_filter')['client_name'] && session('records_filter')['client_name'] != ''){
                $query->where('client_name', 'like', '%' . session('records_filter')['client_name'] . '%');
            }
            if(session('records_filter')['web_form'] && session('records_filter')['web_form'] != ''){
                $query->where('web_form', '=', session('records_filter')['web_form']);
            }
            if(session('records_filter')['dealer'] && session('records_filter')['dealer'] != ''){
                $query->where('dealer_id', '=', session('records_filter')['dealer']);
            }
            if(session('records_filter')['dealer_info'] && session('records_filter')['dealer_info'] != ''){
                $query->where('dealer_info', '=', session('records_filter')['dealer_info']);
            }
            if(session('records_filter')['status'] && session('records_filter')['status'] != ''){
                $query->where('status', '=', session('records_filter')['status']);
            }
            if(session('records_filter')['dealer_progress_status'] && session('records_filter')['dealer_progress_status'] != ''){
                $query->where('dealer_progress_status', '=', session('records_filter')['dealer_progress_status']);
            }
            if(session('records_filter')['created_at_from'] && session('records_filter')['created_at_from'] != ''){
                $query->where('created_at', '>', session('records_filter')['created_at_from'].' 00:00:00');
            }
            if(session('records_filter')['created_at_to'] && session('records_filter')['created_at_to'] != ''){
                $query->where('created_at', '<', session('records_filter')['created_at_to'].' 23:59:59');
            }
        });
    
        if(request('export') && request('export') == '1'){
            $records = $records->get();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', __('main.dealer'));
            $sheet->setCellValue('C1', __('main.client_phone'));
            $sheet->setCellValue('D1', __('main.client_email'));
            $sheet->setCellValue('F1', __('main.client_name'));
            $sheet->setCellValue('G1', __('main.city'));
            $sheet->setCellValue('H1', __('main.company'));
            $sheet->setCellValue('I1', __('main.received_at'));
            $sheet->setCellValue('J1', __('main.web_form'));
            $sheet->setCellValue('K1', __('main.content'));
            $sheet->setCellValue('L1', __('main.contact_validation'));
            $sheet->setCellValue('M1', __('main.operator_comment'));
            $sheet->setCellValue('N1', __('main.car'));
            $sheet->setCellValue('O1', __('main.approved_gdpr_messages'));
            $sheet->setCellValue('P1', __('main.approved_gdpr_marketing'));
            $sheet->setCellValue('Q1', __('main.approved_gdpr_no'));
            $sheet->setCellValue('R1', __('main.status'));
            $sheet->setCellValue('S1', __('main.dealer_info'));
            $sheet->setCellValue('T1', __('main.dealer_progress_status'));
            $sheet->setCellValue('U1', __('main.dealer_merchant'));
            $sheet->setCellValue('V1', __('main.dealer_comment'));
            $sheet->setCellValue('W1', __('main.created_at'));
            $sheet->setCellValue('X1', __('main.updated_at'));
            $row = 1;
            foreach ($records as $record) {
                $row++;
                $sheet->setCellValue('A' . $row, $record->id);
                $sheet->setCellValue('B' . $row, '['.$record->dealer->id.'] '.$record->dealer->name);
                $sheet->setCellValue('C' . $row, $record->client_phone);
                $sheet->setCellValue('D' . $row, $record->client_email);
                $sheet->setCellValue('F' . $row, $record->client_name);
                $sheet->setCellValue('G' . $row, $record->city);
                $sheet->setCellValue('H' . $row, $record->company);
                $sheet->setCellValue('I' . $row, $record->received_at);
                $sheet->setCellValue('J' . $row, $record->web_form);
                $sheet->setCellValue('K' . $row, $record->content);
                $sheet->setCellValue('L' . $row, $record->contact_validation);
                $sheet->setCellValue('M' . $row, $record->operator_comment);
                $sheet->setCellValue('N' . $row, $record->car);
                $sheet->setCellValue('O' . $row, $record->approved_gdpr_messages);
                $sheet->setCellValue('P' . $row, $record->approved_gdpr_marketing);
                $sheet->setCellValue('Q' . $row, $record->approved_gdpr_no);
                $sheet->setCellValue('R' . $row, $record->status);
                $sheet->setCellValue('S' . $row, $record->dealer_info);
                $sheet->setCellValue('T' . $row, $record->dealer_progress_status);
                $sheet->setCellValue('U' . $row, $record->dealer_merchant);
                $sheet->setCellValue('V' . $row, $record->dealer_comment);
                $sheet->setCellValue('W' . $row, $record->created_at);
                $sheet->setCellValue('X' . $row, $record->updated_at);
            }
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'. urlencode('records-' . date("H-i-s-d-m-Y") . '.xlsx').'"');
            $writer->save('php://output');
            exit;
        }
        
        $records = $records->paginate(10);
        return view('records.index', compact('records', 'web_forms_options', 'dealer_info_options', 'status_options', 'dealer_progress_status_options', 'dealers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $web_forms_options = $this->web_forms_options;
        $cars_options = $this->cars_options;
        $contact_validation_options = $this->contact_validation_options;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        $dealers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'dealer');
        })->select('users.id as id', 'users.name as name', 'users.email as email')->get();
        return view('records.create', compact('web_forms_options','cars_options', 'contact_validation_options', 'dealers', 'dealer_info_options', 'dealer_progress_status_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = array(
            'user_id' => 'required',
            'dealer_id' => 'required',
        );
    
        $request->validate($validation);
        $inputs = $request->all();
        $inputs['status'] = 'new';
        $record = Record::create($inputs);
    
        $html = 'Здравейте,<br/>Имате нова заявка в системата. За по-лесен достъп може да проследите посочения линк:<br/><a href="' . route('records.show', $record) . '">Кликнете тук за да видите детайлите</a>.<br/>Поздрави,<br/>Екипът на Метрика';
        
        Mail::send([], [], function ($message) use ($html, $record) {
            $message->to($record->dealer->email)
                ->subject('Нова заявка №' . $record->id)
                ->from('toyota.leads@metrica.bg')
                ->setBody($html, 'text/html');
        });
    
        return redirect(route('records.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        $web_forms_options = $this->web_forms_options;
        $cars_options = $this->cars_options;
        $contact_validation_options = $this->contact_validation_options;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        $status_options = $this->status_options;
        $dealers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'dealer');
        })->select('users.id as id', 'users.name as name', 'users.email as email')->get();
        return view('records.edit', compact('record', 'web_forms_options', 'cars_options', 'contact_validation_options', 'dealers', 'dealer_info_options', 'dealer_progress_status_options', 'status_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $validation = array(
            'dealer_id' => 'required',
        );
    
        if(request('fillForm')){
            $validation = array(
                'status' => 'required',
            );
            unset($request['fillForm']);
        }
        
        $request->validate($validation);
        
        $record->update($request->all());
        session()->flash('message', 'Обаждането е редактирано');
    
        return redirect(route('records.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();
    
        session()->flash('message', 'Обаждането е изтрито');
    
        return back();
    }
    
    public function fill(Record $record){
        $status_options_fill = $this->status_options_fill;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        return view('records.fill', compact('record', 'status_options_fill', 'dealer_info_options', 'dealer_progress_status_options'));
    }
}
