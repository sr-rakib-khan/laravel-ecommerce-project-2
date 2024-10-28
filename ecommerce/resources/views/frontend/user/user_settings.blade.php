@extends('layouts.front');
@section('content');

<div class="container" style="margin-top: 50px; margin-bottom:100px">
    <div class="row">
        @include('frontend.user.user_sidebar');

        <div class="card col-md-8">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <h3 class="text-start">Your default shipping address</h3>
                    <div class="card-body">
                        <form action="{{route('shipping.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">City</label>
                                <input type="text" name="city" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Zip Code</label>
                                <input type="text" name="zipcode" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Profile Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <h3 class="text-start">Change Your Password</h3>
                    <div class="card-body">
                        <div>
                            <form action="{{route('change.user.password')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Current Password</label>
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                                </div>

                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class=" mb-3">
                                    <label for="" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                                </div>

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection