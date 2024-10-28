@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blogpostaddmodal">
                            +Add new
                        </button>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Blog posts List here</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Blog Category</th>
                                        <th>Description</th>
                                        <th>thumbnail</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog_post as $key => $row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->blog_title}}</td>
                                        <td>{{$row->blog_cat_name}}</td>
                                        <td>{{$row->blog_description_1}}</td>
                                        <td><img width="60px" src="{{$row->thumbnail}}" alt=""></td>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm blogedit" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#blogposteditmodal"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{route('blog.post.delete',$row->id)}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!--blog post add Modal -->
    <div class="modal fade" id="blogpostaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('blog.post.store')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog title</label>
                            <input type="text" name="blog_title" class="form-control" placeholder="Blog title">
                        </div>
                        @php
                        $blog_category = DB::table('blog_categories')->where('status', 1)->get();
                        @endphp
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Category</label>
                            <select name="blog_category_id" class="form-control" id="">
                                @foreach($blog_category as $row)
                                <option value="{{$row->id}}">{{$row->blog_cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Description-1</label>
                            <textarea class="form-control" name="description_1" id=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Description-2</label>
                            <textarea class="form-control" name="description_2" id=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Description-3</label>
                            <textarea class="form-control" name="description_3" id=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Description-4</label>
                            <textarea class="form-control" name="description_4" id=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog tag</label>
                            <input type="text" name="tag" class="form-control" placeholder="Blog tag">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" placeholder="Blog title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Blog Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="1">Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" placeholder="Blog title">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- blog post edit modal  -->
    <div class="modal fade" id="blogposteditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Blog post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>

    <!-- ajax cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $('body').on('click', '.blogedit', function() {
            let id = $(this).data('id');
            $.get('blog-post/edit/' + id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>
    @endsection