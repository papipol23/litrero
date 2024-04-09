@extends('layouts.master')
@section('breadcrumbs')
    <ul class="navbar-nav mr-lg-2">
        <li class="nav-item ml-0">
            <h4 class="mb-0">EDIT SECTION</h4>
        </li>
        <li class="nav-item">
            <div class="d-flex align-items-baseline">
                <p class="mb-0">KCCF SMS</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Sections</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Edit</p>
            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Section</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('section.update',['section'=>$item->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Level</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="level_id">
                                    <option disabled>Please Select an Item</option>
                                    @foreach($levels as $level)
                                    <option {{($level->id==$item->level_id) ? 'selected="selected"' : '' }} value="{{$level->id}}">{{$level->desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Section</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="title" value="{{$item->title}}" placeholder="Enter Level">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="desc" id="descTextarea1" rows="4"  placeholder="Enter Description">{{$item->desc}}</textarea>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-light" href="{{route('section.index')}}">Cancel</a>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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
