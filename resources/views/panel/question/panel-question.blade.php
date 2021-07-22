@extends('layouts.panel-app')

@section('content')

    <panel-question data-sections='@json($sections)'></panel-question>
{{--    <panel-question data-levels="test"></panel-question>--}}
@endsection
