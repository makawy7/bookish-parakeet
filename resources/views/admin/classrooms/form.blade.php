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
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title">Repeating Forms </h5>
                <div class="repeater">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item>
                            <form class=" row mb-30">
                                <div class="col-lg-2">
                                    <input class="form-control" type="text" placeholder="Name" />
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control" type="text" placeholder="Email" />
                                </div>
                                <div class="col-lg-2">
                                    <textarea class="form-control" placeholder="Your Message">Your Message</textarea>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control" type="text" value="+(704) 279-1249" />
                                </div>
                                <div class="col-lg-2">
                                    <div class="box">
                                        <select name="select-input" class="fancyselect">
                                            <option value="1">Sex</option>
                                            <option value="2">Male</option>
                                            <option value="3">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                        value="Delete" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-12">
                            <input class="button" data-repeater-create type="button" value="Add new" />
                        </div>
                    </div>
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
