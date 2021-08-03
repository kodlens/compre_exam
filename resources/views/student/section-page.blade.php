@extends('layouts.student-app')

@section('content')

    <section-page sections='@json($sections)' 
        @if(session('error') == 'not_allowed')
            not-allowed="1"
        @else
            not-allowed="0"
        @endif

        @if(session('error') == 'exist')
            is-exist="1"
        @else
            is-exist="0"
        @endif>

    </section-page>
    

@endsection
