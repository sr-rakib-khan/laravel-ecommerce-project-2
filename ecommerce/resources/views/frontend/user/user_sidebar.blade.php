        <div class="col-md-3">
            <div class="card">
                <h3 class="mt-3 ml-2"><strong class="text-success">{{Auth::user()->name}}</strong></h3>
                <div class="card-body">
                    <hr>
                    <a href="{{route('my.wishlist')}}">Wishlist</a>
                    <hr>
                    <a href="{{route('order.truck')}}">My order</a>
                    <hr>
                    <a href="{{route('user.settings')}}">Settings</a>
                </div>
            </div>
        </div>