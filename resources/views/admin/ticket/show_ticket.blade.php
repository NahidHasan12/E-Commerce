
@extends('layouts.admin')
@section('title','SuperAdmin- Suport Ticket')
@section('admin_style')
    <style>
        /* Ticket Message*/
        .message{
            width: 660px;
            min-height: 100px;
            border: 2px solid blue;
            margin: 10px 5px 10px 10px;
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
            margin-bottom: 10px;
        }
        .reply{
            width: 600px;
            min-height: 100px;
            border: 2px solid red;
            margin: 10px 5px 10px 320px;
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
            margin-bottom: 10px;
            font-size: 20px;
            text-align: right;
        }
        .ticket_img{
            margin-left: 19px;
            margin-top: 10px;
            border-radius: 20px;
            margin-bottom: -10px;
            height: 150px;
            width: 200px;
        }
    </style>
@endsection
@section('admin_content')
 <!-- BREADCRUMB-->
 <section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ route('admin.ticket.index') }}">Ticket</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Show Ticket</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>


    <div class="card mt-3" style="color: black">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title text-light pl-3 pt-2 pb-2 bg-dark">Your Ticket Details</h4>
                <p class="pl-3" style="color: black"><strong>Subject: </strong>{{ $ticket->subject }}</p>
                <p class="pl-3" style="color: black"><strong>Service: </strong>{{ $ticket->service }}</p>
                <p class="pl-3" style="color: black"><strong>Priority: </strong>{{ $ticket->priority }}</p>
                <p class="pl-3" style="color: black"><strong>Message: </strong>{{ $ticket->message }}</p>
            </div>
            <div class="col-4">
                <a href="{{ asset('frontend/ticket_img/'.$ticket->image) }}" target="_blank">
                    <img width="250px" height="200px" src="{{ asset('frontend/ticket_img/'.$ticket->image) }}" alt="{{ $ticket->subject }}">
                </a>
            </div>
        </div>

    </div>
    <div class="card mt-3">
            <h4 class="card-title text-light pl-3 pt-2 pb-2 bg-dark">All Reply Message</h4>
        <div class="card-body" style="height:300px; overflow-y: scroll">

        @isset($reply)
            @foreach ($reply as $item)
                {{-- Reply --}}
                <div class="@if ($item->user_id==0) reply @else message @endif">
                    @isset($item->image)
                    <img class="ticket_img" src="{{ asset('frontend/ticket_img/'.$item->image) }}" alt="">
                    @endisset

                    <p class="@if ($item->user_id==0) r_sms @else m_sms @endif">
                        {{ $item->message }}
                        <span class="@if ($item->user_id==0) r_sms_time @else m_sms_time @endif">{{$item->reply_date}}</span>
                    </p>
                    <h4 class="@if ($item->user_id==0) customer @else admin @endif">  @if ($item->user_id==0) Admin @else {{ Auth::user()->name }} @endif <i class="fa fa-user"></i></h4>
                </div>
            @endforeach
        @endisset
        </div>
    </div>
    <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title">Reply Message</h5>
        <form action="{{ route('admin.ticket.reply.store') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="message" class="form-label">Write Your Message</label>
            <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
          </div>
          <div class="form-group">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control dropify" name="image">
          </div>
          <button type="submit" class="btn btn-primary">Submit Ticket</button>
          <a href="{{ route('admin.ticket.close',$ticket->id) }}" class="btn btn-danger">Close Ticket</a>
        </form>
      </div>
    </div>

</section>

@endsection
