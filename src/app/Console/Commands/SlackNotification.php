<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SlackNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $slack_authorization = env('SLACK_AUTHORIZATION','test');
        $headers = [
            "Authorization: Bearer ".$slack_authorization,
            'Content-Type: application/json;charset=utf-8'
        ];

        $url = "https://slack.com/api/chat.postMessage";

        $threeDaysLater = new Carbon('+3 day');
        $notSubmitted_people = Event::select('events.*', DB::raw("group_concat(users.slack_id  separator '>,<@')  as user_id "))->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('event_attendances.status_id', null)->whereDate('events.deadline', $threeDaysLater->format('Y-m-d'))->groupBy('events.id')->get();
        
        
        $notSubmitted_text = "`人人人人人人人人人人人人人人人人人人`\n"
                ."`イベントの入力締め切り【3日前】です！！`\n"
                ."`未入力の方は早めに入力しろください！！！！！！！！`\n"
                ."`Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y^Y`\n";
        foreach ($notSubmitted_people as $index => $notSubmitted_person) {
            $date = date('m月d日G時i分', strtotime($notSubmitted_person->start_at));
            $detail = $notSubmitted_person->detail??"詳細なし";
            $notSubmitted_text = $notSubmitted_text 
                . "*【{$notSubmitted_person->name}】*\n"
                . "末入力者一覧\n"
                . "<@$notSubmitted_person->user_id>\n"
                . "開催日\n"
                . "{$date}\n"
                . "詳細\n"
                . "```{$detail}```\n"
                ."==============================\n";
            $slack_deadline = env('SLACK_CHANNEL_DEADLINE');
            if (($index+1) == count($notSubmitted_people)) {
                $post_fields = [
                    "channel" => $slack_deadline,
                    "text" => $notSubmitted_text,
                    "as_user" => true
                ];

                $options = [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($post_fields)
                ];

                $ch = curl_init();

                curl_setopt_array($ch, $options);

                $result = curl_exec($ch);

                curl_close($ch);
            }
        }

        $tomorrow = new Carbon('+1 day');
        $submitted_people = Event::select('events.*', DB::raw("group_concat(users.slack_id separator '>,<@') as user_id"))->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('event_attendances.status_id', 1)->whereDate('events.start_at', $tomorrow->format('Y-m-d'))->groupBy('events.id')->get();
        
        
        $submitted_text = 
                "`イベントの前日です！！`\n"
                ."`ドタキャンはしないように！！`\n";
        foreach ($submitted_people as $index => $submitted_person) {
            $date = date('m月d日G時i分', strtotime($submitted_person->start_at));
            $detail = $submitted_person->detail??"詳細なし";
            $submitted_text = $submitted_text 
                . "*【{$submitted_person->name}】*\n"
                . "参加者一覧\n"
                . "<@$submitted_person->user_id>\n"
                . "開催日\n"
                . "{$date}\n"
                . "詳細\n"
                . "```{$detail}```\n"
                ."==============================\n";
                $slack_remind = env('SLACK_CHANNEL_REMIND');
            if (($index+1) == count($submitted_people)) {
                $post_fields = [
                    "channel" => $slack_remind,
                    "text" => $submitted_text,
                    "as_user" => true
                ];

                $options = [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($post_fields)
                ];

                $ch = curl_init();

                curl_setopt_array($ch, $options);

                $result = curl_exec($ch);

                curl_close($ch);
            }
        }
    }
}
