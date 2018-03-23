@extends('masters.master')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <form>
            @csrf
            <label><b>From</b></label>
            <input type="date" name="from" value="{{Session::get('from')??''}}">
            <br/>
            <label><b>To</b></label>
            <input type="date" name="to" value="{{Session::get('to')??''}}">
            <br/>
            <input type="submit" value="Submit">
        </form>
        <br/>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <tr>
                <th class="alphOrder"><div>Owner's Name</div></th>
                <th class="alphOrder"><div>Dog's Name</div></th>
                <th class="alphOrder"><div>Arrival Date</div></th>
                <th class="alphOrder"><div>Departure Date</div></th>
                <th class="alphOrder"><div>No Days</div></th>
                <th class="alphOrder"><div>Training?</div></th>
                <th class="alphOrder"><div>Dog's Size</div></th>
                <th class="alphOrder"><div>Day Rate</div></th>
                <th class="alphOrder"><div>Night Rate</div></th>
            </tr>
            @foreach($bookings as $booking)
            <tr>
                <td><a href="{{ route('profile',['model' => 'owner', 'id' => $booking["owner"]["id"]]) }}">{{$booking["owner"]["first_name"].' '.$booking["owner"]["last_name"]}}</a></td>
                <td><a href="{{ route('profile',['model' => 'dog', 'id' => $booking["dog"]["id"]]) }}">{{$booking["dog"]["name"]}}</a></td>
                <td>{{$booking["arrival"]}}</td>
                <td>{{$booking["departure"]}}</td>
                <td>{{strToDatetime($booking["arrival"])->diff(strToDatetime($booking["departure"]))->days}}</td>
                <td>{{$booking["train"] ? 'Yes' : 'No'}}</td>
                <td>{{$booking["dog"]["size"]["size"]}}</td>
                <td>{{$booking["dog"]["size"]["rate_day"]}}</td>
                <td>{{$booking["dog"]["size"]["rate_night"]}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
