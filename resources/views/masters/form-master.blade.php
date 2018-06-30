@extends('masters.master')

@section('content')
    @foreach($forms as $form)
        <h2>{{$form['formName']}}</h2>
        <form method="post">
            <input name="model" value="{{$form['model']}}" hidden>
            @csrf
            @foreach($form['components'] as $component)
                @include('new-data.form-components.'.$component['type'], $component)
            @endforeach
            <input type="submit" value="Submit">
        </form>
    @endforeach
    @if ($errors->any()||Session::get('customError'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <li>{{Session::get('customError')}}</li>
            </ul>
        </div>
    @endif
    {{Session::get('success')??''}}
@endsection
