@extends('layouts.admin')

@section('content')
    <div class="form w-full mx-auto py-10">
        <h2 class="title text-md font-bold mb-5">イベント編集</h2>
        @foreach ($event_info as $event)
            <form action="{{route('add_event')}}" method="post">
                @csrf
                <p class="sub">イベント名</p>
                <input class="event__add__form__event__name  event__add__form__item w-full p-4 text-sm mb-3" type="textarea" name="name"
                    value="{{$event->name}}">
                <p class="sub" class="event__add__form__event__name  event__add__form__item w-full p-4 text-sm mb-3">種類</p>
                <select name="questionnaire_id" >
                    <option value="1" @if ($event->questionnaire_id == 1) selected @endif>イベント</option>
                    <option value="2" @if ($event->questionnaire_id == 2) selected @endif>提出物</option>
                </select>
                <p class="sub">開始日時</p>
                <input placeholder="2020-08-09 20:00:00" class="event__add__form__event__date event__add__form__item w-full p-4 text-sm mb-3" type="text"
                    name="start_at" value="{{$event->start_at}}">
                <p class="sub">終了日時</p>
                <input placeholder="2020-08-09 22:00:00" class="event__add__form__event__date event__add__form__item w-full p-4 text-sm mb-3" type="text"
                    name="end_at" value="{{$event->end_at}}">
                <p class="sub">締切日(任意)</p>
                <input placeholder="2020-08-09 22:00:00" class="event__add__form__event__date event__add__form__item w-full p-4 text-sm mb-3" type="text"
                    name="deadline" value="{{$event->deadline}}">
                <p class="sub">イベント詳細</p>
                <textarea class="event__add__form__event__detail w-full p-4 text-sm mb-4" name="detail" rows="7"
                    cols="150">{{$event->detail}}</textarea>
                <input type="hidden" value="{{$event->id}}" name="id">
                <input type="submit" value="送信" class="event__add__form__button cursor-pointer w-full p-3 text-md text-white bg-blue-400 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-300">
            </form>
        @endforeach
    </div>
@endsection
