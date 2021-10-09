@extends('layouts.admin')

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

@section('content')
    @foreach ($events as $index => $event)
    @php
        $start_date = strtotime($event->start_at);
        $end_date = strtotime($event->end_at);
        $day_of_week = get_day_of_week(date('w', $start_date));
    @endphp
    <div class="modal-open bg-white mb-4 mt-5 p-4 flex justify-between rounded-md shadow-md"
        id="event-{{ $event->id }}">
        <div>
            <h3 class="font-bold text-lg mb-2">{{ $event->name }}</h3>
            <p id="event-{{ $event->id }}-date"><?php echo date("Y年m月d日（${day_of_week}）", $start_date); ?></p>
            <p class="text-xs text-gray-600" id="event-{{ $event->id }}-time">
                <?php echo date('H:i', $start_date) . '~' . date('H:i', $end_date); ?>
            </p>
        </div>
        <div class="flex justify-between text-right">
            <ul class="menu">
                <li class="menu__item mb-2">
                    <a class="text-sm menu__item__link js-menu__item__link" href="{{route('detail_event',"eventId=$event->id")}}">
                        参加者一覧
                    </a>
                </li>
                <li class="menu__item mb-2">
                    <a class="text-sm menu__item__link js-menu__item__link" href="{{route('event_edit',$event->id)}}">編集</a>
                </li>
                <li class="menu__item mb-2">
                    <a class="text-sm menu__item__link js-menu__item__link" href="{{route('event_delete',$event->id)}}" onclick="delete_alert(event);return false;">削除</a>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
@endsection

