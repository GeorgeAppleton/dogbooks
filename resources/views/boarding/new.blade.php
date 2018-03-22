<h2>New Booking</h2>
<form method="post">
    <input name="model" value="boardingbooking" hidden>
    @csrf
    <label><b>Dog</b></label>
    <select name="dog_id">
        <option value="0"></option>
        @foreach($dog as $value)
            <option value="{{$value['id']}}" {{Session::get('dog_id')==$value['id']?'selected':''}}>{{$value['name']}}</option>
        @endforeach
    <select>
    <label><b>Owner</b></label>
    <select name="owner_id">
        <option value="0"></option>
        @foreach($owner as $value)
            <option value="{{$value['id']}}" {{Session::get('owner_id')==$value['id']?'selected':''}}>{{$value['first_name'].' '.$value['last_name']}}</option>
        @endforeach
    <select>
    <label><b>Arrival</b></label>
    <input type="date" name="arrival" value="{{Session::get('arrival')??''}}">
    <input name="arrivalTime" type="time" value="{{Session::get('arrivalTime')??''}}">
    <br/>
    <label><b>Departure</b></label>
    <input type="date" name="departure" value="{{Session::get('departure')??''}}">
    <input name="departureTime" type="time" value="{{Session::get('departureTime')??''}}">
    <label><b>Training?</b></label>
    <input name="train" type="checkbox" {{Session::get('checkbox')?'checked':''}}></input>
    <input type="submit" value="Submit">
</form>
