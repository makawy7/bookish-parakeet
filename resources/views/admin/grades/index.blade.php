@extends('layouts.master')
@section('css')
    <link href="toastr.css" rel="stylesheet" />
@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('admin.grades.title') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <button type="button" class="button x-small" data-toggle="modal" data-target="#addModal">
                    {{ trans('admin.grades.add_new_grade') }}
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('admin.grades.name') }}</th>
                                <th>{{ trans('admin.grades.notes') }}</th>
                                <th>{{ trans('admin.grades.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editModal-{{ $grade->id }}"
                                            title="{{ trans('admin.actions.edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <form method="POST" action="{{ route('grades.destroy', $grade->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete" title="{{ trans('admin.actions.delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- edit grade modal -->
                                <div class="modal fade" id="editModal-{{ $grade->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="editModalLabel">
                                                    Edit grade {{ $grade->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('admin.grades.name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                class="form-control"
                                                                value="{{ $grade->getTranslation('name', 'ar') }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                class="mr-sm-2">{{ trans('admin.grades.name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control" name="name_en"
                                                                value="{{ $grade->getTranslation('name', 'en') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('admin.grades.notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('admin.actions.cancel') }}</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add grade modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="addModalLabel">
                        {{ trans('admin.grades.add_new_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('admin.grades.name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('admin.grades.name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('admin.grades.notes') }}
                                :</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('admin.actions.cancel') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('admin.actions.submit') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script src="toastr.js"></script>
@endsection
