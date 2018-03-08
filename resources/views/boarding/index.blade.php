<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' type='text/css' href="css/app.css" />

        <title>Dog Boarding</title>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form>
                    <label><b>From</b></label>
                    <input type="date" name="from" value="{{Session::get('from')??''}}">
                    <br/>
                    <label><b>To</b></label>
                    <input type="date" name="to" placeholder="Departure" value="{{Session::get('to')??''}}">
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
                <table>
                    <tr>
                        <th>Owner's Name</th>
                        <th>Dog's Name</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>No Days</th>
                        <th>Training?</th>
                        <th>Dog's Size</th>
                        <th>Day Rate</th>
                        <th>Night Rate</th>
                    </tr>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking["owner"]["first_name"].' '.$booking["owner"]["last_name"]}}</td>
                        <td>{{$booking["dog"]["name"]}}</td>
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
    </body>
</html>
<script type="text/javascript" src="js/app.js"></script>
