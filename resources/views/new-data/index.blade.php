@extends('masters.master')

@section('content')
    <h1><u>Data Forms</u></h1>
    @include('boarding.new',[$dog,$owner])
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
