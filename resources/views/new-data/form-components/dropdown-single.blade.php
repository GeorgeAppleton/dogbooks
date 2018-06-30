<label>{{$label}}</label>
<select class="select2 dropdown-single" name="{{$name}}">
    @foreach ($options as $option)
    <option value="{{$option['value']}}" {{isset($option['selected'])?'selected':''}}>{{$option['text']}}</option>
    @endforeach
</select>
