@extends('backend.master')


@section('title','Category Manage')


@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Category Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Category </a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Category </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Responsive Table</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">Sl No</th>
                            <th class="wd-15p border-bottom-0">Category name</th>
                            <th class="wd-20p border-bottom-0">Description</th>
                            <th class="wd-15p border-bottom-0">Image</th>
                            <th class="wd-10p border-bottom-0">Status</th>
                            <th class="wd-25p border-bottom-0">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <img src="{{asset($category->image)}}" alt="" height="100" width="120">
                                </td>
                                <td>{{$category->status == 1 ? 'published' : 'unpublished'}}</td>
                                <td class="d-flex">
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-success bnt-sm me-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{route('category.destroy',$category->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bnt-sm" onclick="return confirm('Are you sure to delete this')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- /row -->



@endsection








