@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Profile_trans.profile') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Profile_trans.profile') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


<div class="card-body">

    <section style="background-color: #eee;">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ URL::asset('assets/images/teacher.png') }}" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 style="font-family: Cairo" class="my-3">{{ $information->Name }}</h5>
                        <p class="text-muted mb-1">{{ $information->email }}</p>
                        <p class="text-muted mb-4">{{ trans('Profile_trans.student') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('profile.update', $information->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ trans('Profile_trans.user_name') }}</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <input type="text" name="Name" value="{{ $information->name }}"
                                            class="form-control">
                                    </p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ trans('Profile_trans.old_pass') }}</p>
                                </div>

                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <input type="password" id="password" class="form-control" name="password_old">
                                    </p><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ trans('Profile_trans.new_pass') }}</p>
                                </div>

                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <input type="password" id="password" class="form-control" name="password_new">
                                        <span
                                            style="color: rgb(243, 65, 65)">{{ trans('Profile_trans.change_pass_msg') }}</span>
                                    </p><br><br>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-success">{{ trans('exams_trans.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
