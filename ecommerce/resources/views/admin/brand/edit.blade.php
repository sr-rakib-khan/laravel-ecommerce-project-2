<form action="{{route('brand.update')}}" method="Post">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="id" value="{{$brand->id}}">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Brand name</label>
            <input type="text" name="brand_name" value="{{$brand->brand_name}}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="status" class="form-select" id="">
                <option @if($brand->status == 1) Selected @endif value="1">Active</option>
                <option @if($brand->status == 0) Selected @endif value="0">Deactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
    </div>
</form>