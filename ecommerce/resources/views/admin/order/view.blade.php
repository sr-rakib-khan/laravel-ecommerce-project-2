<div class="modal-body">
    <div class="card">
        <div class="card-body">
        </div>
        <h3>Product Details</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Product Name:</strong> {{$order_details->product_name}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Color:</strong> {{$order_details->color}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Size:</strong> {{$order_details->size}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Quantity:</strong> {{$order_details->quantity}}</p>
            </div>
        </div>
        <hr>
        <h3>Delivery Details</h3>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Name:</strong> {{$order_details->f_name}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Phone:</strong> {{$order_details->phone}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Email:</strong> {{$order_details->email}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Country:</strong> {{$order_details->country}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Shipping Address:</strong> {{$order_details->address}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Zip Code:</strong> {{$order_details->zip}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>City:</strong> {{$order_details->city}}</p>
            </div>
        </div>
        <hr>
        <h3>Amount Details</h3>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Total:</strong> {{$order_details->total}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Subtotal:</strong> {{$order_details->subtotal}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Coupon Code:</strong> {{$order_details->coupon_code}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Coupon Discount:</strong> {{$order_details->discount}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p><strong>After Discount amount:</strong></p>
            </div>
            <div class="col-md-3">
                <p><strong>Payment Type:</strong></p>
            </div>
            <div class="col-md-3">
                @if($order_details->status == 0)
                <p class="text-danger"><strong>Status:</strong> Order Pending</p>
                @elseif($order_details->status == 1)
                <p><strong>Status:</strong> Order Received</p>
                @elseif($order_details->status == 2)
                <p><strong>Status:</strong> Order Shipped</p>
                @elseif($order_details->status == 3)
                <p><strong>Status:</strong> Order Completed</p>
                @elseif($order_details->status == 4)
                <p><strong>Status:</strong> Order Return</p>
                @else
                <p><strong>Status:</strong> Order Cancled</p>
                @endif
            </div>
            <div class="col-md-3">
                <p><strong>Date:</strong> {{$order_details->date}}</p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</form>