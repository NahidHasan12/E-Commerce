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

        <div class="card mt-2">
          <div class="card-body">
            <h5 class="card-title">Write your valueable review for our website</h5>
            <form action="{{ route('website.review.sotre') }}" method="post">
                @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Customer Name:</label>
                <input type="text" class="form-control" name="name" readonly="" value="{{ auth::user()->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="review">Write Your Review:</label>
                <textarea name="review" class="form-control" id="review" cols="30" rows="3"></textarea>
                @error('review')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" name="status" class="form-control" style="min-width: 100%" >
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" name="rating" class="form-control" style="min-width: 100%" >
                    <option value="1">1 Star</option>
                    <option value="2">2 Star</option>
                    <option value="3">3 Star</option>
                    <option value="4">4 Star</option>
                    <option value="5">5 Star</option>
                </select>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Submit Review</button>
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
