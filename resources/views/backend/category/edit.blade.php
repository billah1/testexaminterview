@extends('backend.master')


@section('title','Category Edit')


@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Category Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Category </a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Category </li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col">

            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Category From</h6>
                    <form class="form-horizontal" action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" value="{{$category->name}}"  id="floatingInput" placeholder="Category Name">
                            <label for="floatingInput" class="col-md-3 form-label">Category Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="floatingTextarea" name="description" placeholder="Category Description" type="text">{{$category->description}}</textarea>
                            <label for="floatingTextarea" class="col-md-3 form-label">Category Description</label>
                        </div>
                        <div class=" mb-3">
                            <label for="formFileSm" class="form-label">Category Image</label>
                            <input class="form-control form-control-sm bg-dark" name="image" id="formFileSm" type="file">
                            <img src="{{asset($category->image)}}" id="categoryImage" alt="" height="100" width="120">
                        </div>
                        <div class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Publication Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <label><input type="radio"  name="status" {{$category->status == 1 ? 'checked' : '' }}  value="1"><span>Published</span></label>
                                    <label><input type="radio" name="status" {{$category->status == 0 ? 'checked' : '' }} value="0"><span>Unpublished</span></label>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary rounded-0 float-end" type="submit">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->





@endsection


