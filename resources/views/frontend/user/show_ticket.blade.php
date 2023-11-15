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

        /* Ticket Message*/
        .message{
            width: 486px;
            min-height: 100px;
            border: 2px solid blue;
            margin: 10px 5px 10px 0px;
            border-radius: 50px 30px 30px 0px;
        }
        .message .m_sms{
            color: black;
            font-family: inherit;
            margin: 14px 10px 5px 15px;
            padding: 4px;
            text-align: justify;
            font-size: 15px;
            line-height: 1.3;
        }
        .message .m_sms .m_sms_time{
            color: #c10303;
            font-weight: bold;
            font-size: 12px;
            font-family: cursive;
            word-spacing: -4.9px;
            background: #caf768;
        }
        .message .admin{
            color: #091a59;
            margin-left: 15px;
            font-size: 20px;
        }
        .reply{
            width: 486px;
            min-height: 100px;
            border: 2px solid red;
            margin: 10px 5px 10px 209px;
            border-radius: 30px 30px 0px 30px;
        }
        .reply .r_sms{
            color: black;
            font-family: inherit;
            margin: 14px 10px 5px 15px;
            padding: 4px;
            text-align: justify;
            font-size: 15px;
            line-height: 1.3;
        }
        .reply .r_sms .r_sms_time{
            color: #2b0a9f;
            font-weight: bold;
            font-size: 12px;
            font-family: cursive;
            word-spacing: -4.9px;
            background: #caf768;
        }
        .reply .customer{
            color: #ac2303;
            margin-right: 15px;
            font-size: 20px;
            text-align: right;
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
        <div class="card mt-2" style="color: black">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title text-light pl-3 pt-2 pb-2 bg-dark">Your Ticket Details</h4>
                    <p class="pl-3" style="color: black"><strong>Subject: </strong>{{ $show_ticket->subject }}</p>
                    <p class="pl-3" style="color: black"><strong>Service: </strong>{{ $show_ticket->service }}</p>
                    <p class="pl-3" style="color: black"><strong>Priority: </strong>{{ $show_ticket->priority }}</p>
                    <p class="pl-3" style="color: black"><strong>Message: </strong>{{ $show_ticket->message }}</p>
                </div>
                <div class="col-4">
                    <a href="{{ asset('frontend/ticket_img/'.$show_ticket->image) }}" target="_blank">
                        <img width="250px" height="200px" src="{{ asset('frontend/ticket_img/'.$show_ticket->image) }}" alt="{{ $show_ticket->subject }}">
                    </a>
                </div>
            </div>

        </div>
        <div class="card mt-2">
                <h4 class="card-title text-light pl-3 pt-2 pb-2 bg-dark">All Reply Message</h4>
            <div class="card-body" style="height:300px; overflow-y: scroll">
                {{-- message --}}
                <div class="message">
                    <p class="m_sms">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi architecto nihil
                        quia praesentium nam quasi saepe ut optio doloribus. Totam ipsa deserunt pariatur,
                        dolorem maxime cupiditate officiis suscipit.
                        <span class="m_sms_time"> 1 November-2023, 05:30 PM</span>
                    </p>
                    <h4 class="admin"><i class="fa fa-user"> </i> Admin</h4>
                </div>
                {{-- Reply --}}
                <div class="reply">
                    <p class="r_sms">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi architecto nihil
                        quia praesentium nam quasi saepe ut optio doloribus. Totam ipsa deserunt pariatur,
                        dolorem maxime cupiditate officiis suscipit.
                        <span class="r_sms_time"> 1 November-2023, 05:30 PM</span>
                    </p>
                    <h4 class="customer">  Customer <i class="fa fa-user"></i></h4>
                </div>
                {{-- message --}}
                <div class="message">
                    <p class="m_sms">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi architecto nihil
                        quia praesentium nam quasi saepe ut optio doloribus. Totam ipsa deserunt pariatur,
                        dolorem maxime cupiditate officiis suscipit.
                        <span class="m_sms_time"> 1 November-2023, 05:30 PM</span>
                    </p>
                    <h4 class="admin"><i class="fa fa-user"> </i> Admin</h4>
                </div>
                {{-- Reply --}}
                <div class="reply">
                    <p class="r_sms">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi architecto nihil
                        quia praesentium nam quasi saepe ut optio doloribus. Totam ipsa deserunt pariatur,
                        dolorem maxime cupiditate officiis suscipit.
                        <span class="r_sms_time"> 1 November-2023, 05:30 PM</span>
                    </p>
                    <h4 class="customer">  Customer <i class="fa fa-user"></i></h4>
                </div>

            </div>
        </div>
        <div class="card mt-2">
          <div class="card-body">
            <h5 class="card-title">Reply Message</h5>
            <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                @csrf

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
