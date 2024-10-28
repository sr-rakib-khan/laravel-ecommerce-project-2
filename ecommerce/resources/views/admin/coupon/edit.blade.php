<form action="{{route('coupon.update')}}" method="Post" id="update_coupon">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="coupon_code" class="form-label">Coupon Code</label>
            <input type="text" class="form-control" name="code" value="{{$coupon->coupon_code}}">

            <input type="hidden" class="form-control" name="id" value="{{$coupon->id}}">
        </div>
        <div class="mb-3">
            <label for="coupon_type" class="form-label">Coupon Type</label>
            <select class="form-select" name="type" id="">
                <option value="1" {{($coupon->type == 1)?'selected':''}}>Fixed</option>
                <option value="2" {{($coupon->type == 2)?'selected':''}}>percentage</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="coupon_code" class="form-label">Coupon Status</label>
            <select class="form-select" name="status" id="coupon_status">
                <option value="1" {{($coupon->status == 1)?'selected':''}}>Active</option>
                <option value="2" {{($coupon->status == 2)?'selected':''}}>Deactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="coupon_amount" class="form-label">Coupon Amount</label>
            <input type="text" class="form-control" name="amount" value="{{$coupon->amount}}">
        </div>
        <div class="mb-3">
            <label for="coupon_date" class="form-label">Coupon Date</label>
            <input type="date" class="form-control" name="date" value="{{$coupon->date}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="update_coupon" class="btn btn-primary">Update</button>
    </div>
</form>

<script type="text/javascript">
    //coupon update ajax code
    $('#update_coupon').submit(function(e) {
        var table = $('.ytable').DataTable();
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#update_coupon')[0].reset();
                $("#editcouponModal").modal('hide');
                table.ajax.reload();
            }
        });

    });
</script>