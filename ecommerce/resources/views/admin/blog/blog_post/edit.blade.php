<form action="{{route('blog.post.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$blog->id}}">
    <input type="hidden" name="old_thumbnail" value="{{$blog->thumbnail}}">
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog title</label>
            <input type="text" name="blog_title" class="form-control" value="{{$blog->blog_title}}">
        </div>
        @php
        $blog_category = DB::table('blog_categories')->where('status', 1)->get();
        @endphp
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Category</label>
            <select name="blog_category_id" class="form-control" id="">
                @foreach($blog_category as $row)
                <option @if($blog->blog_cat_name == $row->blog_cat_name) selected @endif value="{{$row->id}}">{{$row->blog_cat_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Description-1</label>
            <textarea class="form-control" name="description_1" id="">{{$blog->blog_description_1}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Description-2</label>
            <textarea class="form-control" name="description_2" id="">{{$blog->blog_description_2}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Description-3</label>
            <textarea class="form-control" name="description_3" id="">{{$blog->blog_description_3}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Description-4</label>
            <textarea class="form-control" name="description_4" id="">{{$blog->blog_description_4}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog tag</label>
            <input type="text" name="tag" class="form-control" value="{{$blog->blog_tag}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            <img width="60px" src="{{$blog->thumbnail}}" alt="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Status</label>
            <select name="status" class="form-control" id="">
                <option @if($blog->status==1) selected @endif value="1">Active</option>
                <option @if($blog->status==0) selected @endif value="0">Deactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{$blog->date}}">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>