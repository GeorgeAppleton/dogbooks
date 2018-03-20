<form href={{route('newBoardingBooking')}}>
    <label><b>Dog</b></label>
    <select name="dog">
        <option value="0"></option>
        @foreach($dog as $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
        @endforeach
    <select>
    <label><b>Owner</b></label>
    <select name="owner">
        <option value="0"></option>
        @foreach($owner as $value)
            <option value="{{$value['id']}}">{{$value['first_name'].' '.$value['last_name']}}</option>
        @endforeach
    <select>
    <label><b>Arrival</b></label>
    <input type="date" name="arrival" value="{{Session::get('arrival')??''}}">
    <br/>
    <label><b>Departure</b></label>
    <input type="date" name="departure" value="{{Session::get('departure')??''}}">
    <label><b>Training?</b></label>
    <input name="train" type="checkbox"></input>
    <input type="submit"></input>
</form>
