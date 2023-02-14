@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('accounts.edit_invoices') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('accounts.edit_invoices') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('Fees.update', 'test') }}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">{{ trans('accounts.name') }}</label>
                            <input type="text" value="{{ $fee->title }}" name="title" class="form-control">
                            <input type="hidden" value="{{ $fee->id }}" name="id" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4">{{ trans('accounts.amount') }}</label>
                            <input type="number" value="{{ $fee->amount }}" name="amount" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{ trans('accounts.fees_type') }}</label>
                            <select class="custom-select mr-sm-2" name="Fee_type">
                                <option <?php echo $fee->Fee_type == 1 ? 'slected' : ''; ?> value="1">{{ trans('accounts.fees_study') }}</option>
                                <option <?php echo $fee->Fee_type == 2 ? 'selcted' : ''; ?> value="2">{{ trans('accounts.fees_bus') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputState">{{ trans('accounts.grade') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id">
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}"
                                        {{ $Grade->id == $fee->Grade_id ? 'selected' : '' }}>{{ $Grade->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">{{ trans('accounts.classroom') }}</label>
                            <select class="custom-select mr-sm-2" name="Classroom_id">
                                <option value="{{ $fee->Classroom_id }}">{{ $fee->classroom->Name_Class }}</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{ trans('Students_trans.academic_year') }}</label>
                            <select class="custom-select mr-sm-2" name="year">
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}" {{ $year == $fee->year ? 'selected' : ' ' }}>
                                        {{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">{{ trans('accounts.desc') }}</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ $fee->description }}</textarea>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">{{ trans('accounts.save') }}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
