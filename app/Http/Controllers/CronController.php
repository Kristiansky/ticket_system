<?php

namespace App\Http\Controllers;

use App\Record;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    /**
     * Cron every day from 09:00 to 16:30
    */
    public function notifyMorning()
    {
        $records = Record::where('status', '=', 'new')
            ->where('created_at', '>', date('Y-m-d') . ' 09:00:00')
            ->where('created_at', '<', date('Y-m-d') . ' 12:30:00')
            ->get();
        foreach ($records as $record) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $diff_in_hours = $to->diffInHours($from);
            if ($diff_in_hours > 3){
                $this->sendNotification($record, 1);
                $record->status = 'reminded';
                $record->save();
            }
        }
        return true;
    }
    
    /**
     * Cron once a day at 17:00
     */
    public function notifyAfternoon()
    {
        $records = Record::where('status', '=', 'new')
            ->where('created_at', '>', date('Y-m-d') . ' 12:30:00')
            ->where('created_at', '<', date('Y-m-d') . ' 16:30:00')
            ->get();
        
        foreach ($records as $record) {
            $this->sendNotification($record, 1);
            $record->status = 'reminded';
            $record->save();
        }
        return true;
    }
    
    /**
     * Cron once a day at 09:30
     */
    public function notifyNextDay()
    {
        $date = new DateTime();
        $date->modify("-1 day");
        $yesterday = $date->format("Y-m-d");
        
        $records = Record::where('status', '=', 'new')
            ->where('created_at', '>', $yesterday . ' 16:30:00')
            ->where('created_at', '<', date('Y-m-d') . ' 09:00:00')
            ->get();
        foreach ($records as $record) {
            $this->sendNotification($record, 1);
            $record->status = 'reminded';
            $record->save();
        }
        return true;
    }
    
    /**
     * Cron once every hour
     */
    public function notifyAgain()
    {
        $records = Record::where('status', '=', 'reminded')
            ->get();
    
        foreach ($records as $record) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $diff_in_hours = $to->diffInHours($from);
            if ($diff_in_hours > 23){
                $this->sendNotification($record, 2);
                $record->status = 'late';
                $record->save();
            }
        }
        return true;
    }
    
    public function sendNotification(Record $record, $count)
    {
        $subject = '';
        $html = '';
        if ($count == 1){
            $html = 'Здравейте,<br/>Напомняме Ви, че имате нова заявка, за която клиент очаква вашата реакция. Моля влезте в системата, за да я обработите. За по-лесен достъп може да проследите посочения линк:<br/><a href="' . route('records.show', $record) . '">Кликнете тук за да видите детайлите</a>.<br/>Поздрави,<br/>Екипът на Метрика';
            $subject = 'Напомняне за НЕПРИЕТА – нова заявка';
        }elseif ($count == 2){
            $html = 'Здравейте,<br/>Имате заявка в системата, на изчакване 24часа. Моля влезте в системата, за да я обработите. За по-лесен достъп може да проследите посочения линк:<br/><a href="' . route('records.show', $record) . '">Кликнете тук за да видите детайлите</a>.<br/>Поздрави,<br/>Екипът на Метрика';
            $subject = 'Напомняне - закъсняла Нова заявка с повече от 24ч';
        }
    
        Mail::send([], [], function ($message) use ($html, $subject, $record) {
            $message->to($record->dealer->email)
                ->subject($subject)
                ->from('toyota.leads@metrica.bg')
                ->setBody($html, 'text/html');
        });
    }
}
