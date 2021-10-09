@extends('layouts.admin')

@section('content')
<div class="bg-white mb-4 mt-5 p-4 rounded-md shadow-md">
    イベント名:{{$event->name}}
</div>
@switch($event->questionnaire_id)
    @case(1)
    <div class="bg-white mb-4 mt-5 p-4 rounded-md shadow-md">
        <div class="font-bold text-lg mb-2">[参加者]</div>
        @foreach ($participant_list as $participant)
            <div>・{{$participant->name}}
            @if ($participant->comment)
                [{{$participant->comment}}]
            @endif
            </div>
        @endforeach
    </div>
    <div class="bg-white mb-4 mt-5 p-4 ounded-md shadow-md">   
        <div class="font-bold text-lg mb-2">[不参加者]</div>
        @foreach ($nonParticipant_list as $nonParticipant)
            <div>・{{$nonParticipant->name}}
            @if ($nonParticipant->comment)
                [{{$nonParticipant->comment}}]
            @endif
            </div>
        @endforeach
    </div>
        @break
    @case(2)
    <div class="bg-white mb-4 mt-5 p-4 rounded-md shadow-md">
        <div class="font-bold text-lg mb-2">[提出者]</div>
        @foreach ($submitted_list as $submitted)
            <div>・{{$submitted->name}}
            @if ($submitted->comment)
                [{{$submitted->comment}}]
            @endif
            </div>
        @endforeach
    </div>
        @break
    @default
        <div>エラー</div>
@endswitch


<div class="bg-white mb-4 mt-5 p-4 rounded-md shadow-md">  
    <div class="font-bold text-lg mb-2">[未提出者]</div>
    @foreach ($notSubmitted_list as $notSubmitted)
        <div>・{{$notSubmitted->name}}</div>
    @endforeach
</div>

<a href="{{route('list_event')}}" class="d-block text-center button cursor-pointer w-full p-3 text-md text-white bg-blue-400 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-300">戻る</a>

@endsection