<div class="modal-body">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Product name</strong></td>
                                <td>{{$product->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Category name</strong></td>
                                <td>{{$product->category_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>brand name</strong></td>
                                <td>{{$product->brand_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Product code</strong></td>
                                <td>{{$product->code}}</td>
                            </tr>
                            <tr>
                                <td><strong>Admin id</strong></td>
                                <td>{{$product->admin_id}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Buying Price</strong></td>
                                <td>{{$product->buying_price}}</td>
                            </tr>
                            <tr>
                                <td><strong>Selling Price</strong></td>
                                <td>{{$product->selling_price}}</td>
                            </tr>
                            <tr>
                                <td><strong>Discount Price</strong></td>
                                <td>{{$product->discount_price}}</td>
                            </tr>
                            <tr>
                                <td><strong>Tag</strong></td>
                                <td>{{$product->tag}}</td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td>{{$product->date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Size</strong></td>
                                <td>{{$product->size}}</td>
                            </tr>
                            <tr>
                                <td><strong>Color</strong></td>
                                <td>{{$product->color}}</td>
                            </tr>
                            <tr>
                                <td><strong>Unit</strong></td>
                                <td>{{$product->unit}}</td>
                            </tr>
                            <tr>
                                <td><strong>Stock</strong></td>
                                <td>{{$product->stock}}</td>
                            </tr>
                            <tr>
                                <td><strong>Month</strong></td>
                                <td>{{$product->month}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>{{$product->status}}</td>
                            </tr>
                            <tr>
                                <td><strong>featured</strong></td>
                                <td>{{$product->featured}}</td>
                            </tr>
                            <tr>
                                <td><strong>Inspired</strong></td>
                                <td>{{$product->inspired_product}}</td>
                            </tr>
                            <tr>
                                <td><strong>views</strong></td>
                                <td>{{$product->views}}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Thumbnail</strong></td>
                                <td><img width="50%" src="{{url('public/files/product/'.$product->thumbnail)}}" alt=""></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td>{{$product->details}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>