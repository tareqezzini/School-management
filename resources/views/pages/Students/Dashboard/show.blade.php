@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
@section('title')
    {{ trans('exams_trans.pass_exam') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('exams_trans.pass_exam') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

@livewire('show-questions', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
@toastr_js
@toastr_render
@livewireScripts
@endsection
