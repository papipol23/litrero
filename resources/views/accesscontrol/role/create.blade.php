@extends('layouts.master')
@section('breadcrumbs')
    <ul class="navbar-nav mr-lg-2">
        <li class="nav-item ml-0">
            <h4 class="mb-0">CREATE ROLE</h4>
        </li>
        <li class="nav-item">
            <div class="d-flex align-items-baseline">
                <p class="mb-0">KCCF SMS</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Role</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Create</p>
            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Role</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('role.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="title" placeholder="Enter Role Name">
                            </div>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-light" href="{{route('role.index')}}">Cancel</a>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection
@section('script')
@endsection
