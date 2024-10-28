<form action="{{route('blog.cat.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="id" value="{{$blog_cat->id}}">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Blog Category name</label>
            <input type="text" name="blog_cat_name" value="{{$blog_cat->blog_cat_name}}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="status" class="form-control" id="">
                <option @if($blog_cat->status == 1) Selected @endif value="1">Active</option>
                <option @if($blog_cat->status == 0) Selected @endif value="0">Deactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
    </div>
</form>