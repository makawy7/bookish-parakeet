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
            <h4 class="mb-0"> {{ __('admin.classrooms.title') }}</h4>
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
                    {{ __('admin.classrooms.add_new_classroom') }}
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.classrooms.name') }}</th>
                                <th>{{ __('admin.classrooms.grade') }}</th>
                                <th>{{ __('admin.classrooms.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editModal-{{ $classroom->id }}"
                                            title="{{ __('admin.actions.edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <form method="POST" action="{{ route('classrooms.destroy', $classroom->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete" title="{{ __('admin.actions.delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- edit classroom modal -->
                                <div class="modal fade" id="editModal-{{ $classroom->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="editModalLabel">
                                                    Edit classroom {{ $classroom->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{ route('classrooms.update', $classroom->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ __('admin.classrooms.name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                class="form-control"
                                                                value="{{ $classroom->getTranslation('name', 'ar') }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                class="mr-sm-2">{{ __('admin.classrooms.name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control" name="name_en"
                                                                value="{{ $classroom->getTranslation('name', 'en') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ __('admin.classrooms.grade') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $classroom->notes }}</textarea>
                                                    </div>
                                                    <br><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('admin.actions.cancel') }}</button>
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

    <!-- add classroom modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="addModalLabel">
                        {{ __('admin.classrooms.add_new_classroom') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class=" row mb-30" action="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>

                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ __('admin.classrooms.name_ar') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name" required />
                                            </div>
                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ __('admin.classrooms.name_en') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name_class_en"
                                                    required />
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ __('admin.classrooms.grade') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">

                                                        <option value="dsd">dsasd
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ __('admin.actions.actions') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button"
                                                    value="{{ __('admin.actions.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ __('admin.actions.addmore') }}" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('admin.actions.submit') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ __('admin.actions.cancel') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script src="toastr.js"></script>
@endsection
