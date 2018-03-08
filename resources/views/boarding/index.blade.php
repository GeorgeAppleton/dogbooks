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

                <table>
                    <tr>
                        <th>Owners Name</th>
                        <th>Dogs Name</th>
                        <th>Here from</th>
                        <th>Here Till</th>
                        <th>No Days</th>
                        <th>Training</th>
                        <th>Dogs Size</th>
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
