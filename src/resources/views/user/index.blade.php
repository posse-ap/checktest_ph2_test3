@extends('layouts.user')

@php
function get_day_of_week($w)
{
    $day_of_week_list = ['日', '月', '火', '水', '木', '金', '土'];
    return $day_of_week_list["$w"];
}

function status_colour($status_id, $id)
{
    if ($status_id == $id) {
        echo 'bg-blue-600 text-white';
    } else {
        echo 'bg-white';
    }
    return;
}
$user_id = Auth::id();
@endphp
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='user_id' content={{ Auth::id() }}>
@endsection
@section('who_are_you')
    <p class="ml-5 mt-3">ようこそ{{ Auth::user()->name }}さん</p>
@endsection


@section('filter')
    <div id="filter" class="mb-8 mt-8">
        <?php ?>
        <div class="flex">
            <a href="/"
                class="px-2 py-2 text-md font-bold mr-2 rounded-md shadow-md {{ status_colour($status_id, null) }} ">全て</a>
            <a href="/?status_id=1"
                class="px-2 py-2 text-md font-bold mr-2 rounded-md shadow-md {{ status_colour($status_id, 1) }} ">参加</a>
            <a href="/?status_id=2"
                class="px-2 py-2 text-md font-bold mr-2 rounded-md shadow-md {{ status_colour($status_id, 2) }}">不参加</a>
            <a href="/?status_id=3"
                class="px-2 py-2 text-md font-bold mr-2 rounded-md shadow-md {{ status_colour($status_id, 3) }}">提出済み</a>
            <a href="/?status_id=not_submitted"
                class="px-2 py-2 text-md font-bold mr-2 rounded-md shadow-md {{ status_colour($status_id, 'not_submitted') }}">未回答</a>
        </div>
    </div>
@endsection

@section('event_list')
    @if(!isset($events[0]))
        <p class="px-2 py-2 text-md font-bold mr-2 text-danger">該当するイベントがありません。</p>
    @else
        @foreach ($events as $index => $event)
            @php
                $start_date = strtotime($event->start_at);
                $end_date = strtotime($event->end_at);
                $day_of_week = get_day_of_week(date('w', $start_date));
            @endphp
            <div class="modal-open bg-white mb-3 p-4 flex justify-between rounded-md shadow-md cursor-pointer"
                id="event-{{ $event->id }}">
                <div>
                    <h3 class="font-bold text-lg mb-2">{{ $event->name }}</h3>
                    <p id="event-{{ $event->id }}-date"><?php echo date("Y年m月d日（${day_of_week}）", $start_date); ?></p>
                    <p class="text-xs text-gray-600" id="event-{{ $event->id }}-time">
                        <?php echo date('H:i', $start_date) . '~' . date('H:i', $end_date); ?>
                    </p>
                </div>
                <div class="flex flex-col justify-between text-right">
                    <div>
                        @empty($event->event_attendances->where('user_id', $user_id)->first())
                            <p class="text-sm font-bold text-yellow-400">未回答</p>
                            <p class="text-xs text-yellow-400">期限 <?= date('m月d日G時', strtotime($event->deadline)); ?></p>
                        @else
                            @switch($event->event_attendances->where('user_id', $user_id)->first()->status_id)
                                @case(1)
                                    <p class="text-sm font-bold text-green-400">参加</p>
                                    @break
                                @case(2)
                                    <p class="text-sm font-bold text-gray-400">不参加</p>
                                    @break
                                @case(3)
                                    <p class="text-sm font-bold text-green-400">提出済み</p>
                                    @break
                                @default
                                    
                            @endswitch
                        @endempty
                    </div>
                    @if ($event->questionnaire_id== 1)
                        <ul class="menu">
                            <li class="menu__item">
                                <a class="text-sm menu__item__link js-menu__item__link">
                                    <span class="text-xl">{{ $event->event_attendances->where('status_id', 1)->count() }}</span>人参加 >
                                </a>
                                <ul class="submenu" style="display: none;">
                                    @foreach ($event->event_attendances->where('status_id', 1) as $user)
                                    <li class="submenu__item"><?= $user->user->name ?></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection
