@extends('layouts.master')
@section('breadcrumbs')
    <ul class="navbar-nav mr-lg-2">
        <li class="nav-item ml-0">
            <h4 class="mb-0">EDIT ROLE</h4>
        </li>
        <li class="nav-item">
            <div class="d-flex align-items-baseline">
                <p class="mb-0">KCCF SMS</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Roles</p>
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
                    <h4 class="card-title">Edit Role</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('role.update',['role'=>$item->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name"  class="form-control" id="startyear" value="{{$item->name}}" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Permissions</label>
                            <div class="col-sm-9">
                                <select name="permissions[]" id="permissions" class="form-control form-control-lg select2" multiple>
                                    <option disabled="disabled">Select an item</option>
                                    @foreach($permissions as $permission)
                                        <option {{ $item->hasPermissionTo($permission->name) ? 'selected' : '' }} value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-light" href="{{route('role.index')}}">Cancel</a>
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
<script>
    $(document).ready(function() {
    $('#permissions').select2();
});
</script>
@endsection
