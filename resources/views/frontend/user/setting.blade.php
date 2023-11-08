
@extends('layouts.app')

@section('web_style')
    <style type="text/css" media="screen">
        .profile-image{
        position: relative;
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
        }

        .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 23%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

        /*.text:hover {
        opacity: 0.3;
        }*/

        .middle:hover {
        opacity: 0.8;
        }

        .text {
        background-color: #04AA6D;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        }
        .list li{
            border-top:2px sloid rgb(14, 13, 13);
        }
    </style>
@endsection
    @section('navbar')
        {{-- @include('website.include.navbar') --}}
    @endsection

@section('content')



  <div class="container mt-4">

    @include('frontend.include.user.header')



    <div class="row">
      <div class="col-md-4">

        @include('frontend.include.user.profile')

      </div>
      <div class="col-md-8">

        <div class="card">
          <div class="card-body">
            <h4>Write your valiable review based on our product quantity and service.</h4>

            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Shipping Name:</label>
                    <input type="text" class="form-control" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <input type="text" class="form-control" name="address">
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" name="country">
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" class="form-control" name="zipcode">
                        @error('zipcode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

              <button type="submit" class="btn btn-primary">Save</button>
            </form>

          </div>
        </div>


        {{-- password change section --}}
        <div class="card my-3">
          <div class="card-body">
            <h4>Change Your Password</h4>

            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="oldpassword">Old Password:</label>
                    <input type="password" name="old_password" class="form-control" name="oldpassword" placeholder="old password">
                    @error('oldpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="mew password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Confirmed Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="confirmed password">
                    @error('confirmed_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>



              <button type="submit" class="btn btn-primary">Save</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('web_script')
    <script>


    </script>

@endpush
