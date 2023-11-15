@extends('layouts.app')

@section('web_style')

    {{-- summernote link --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{-- drofify link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <h5 class="card-title">Submit your ticket we will reply</h5>
            <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" required>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-control" name="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="service" class="form-label">Service</label>
                        <select class="form-control" name="service" style="min-width: 200px">
                            <option value="technical">Technical</option>
                            <option value="payment">Payment</option>
                            <option value="affiliate">Affiliate</option>
                            <option value="return">Return</option>
                            <option value="refund">Refund</option>
                        </select>
                    </div>
                </div>
              <div class="form-group">
                <label for="message" class="form-label">Write Your Message</label>
                <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control dropify" name="image">
              </div>
              <button type="submit" class="btn btn-primary">Submit Ticket</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





@endsection

@push('web_script')
    {{-- Dropify link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- summer note js link --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>


    </script>

@endpush
