<form action="{{route('category.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category name</label>
            <input type="text" name="name" value="{{$category->name}}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="status" class="form-select" id="">
                <option @if($category->status == 1) Selected @endif value="1">Active</option>
                <option @if($category->status == 0) Selected @endif value="0">Deactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
    </div>
</form>