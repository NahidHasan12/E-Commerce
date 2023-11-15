@extends('layouts.app')
@section('title', 'User Dashboard')
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
            <div class="row my-3">

            <h4 class="card-title ml-2"> All Ticket
                <a href="{{ route('new.ticket') }}" style="float: right; font-size:14px;margin-left: 533px;"><i class="fa fa-pencil-alt"></i> New Ticket</a>
            </h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Service</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
                <tbody>
                    @foreach ($ticket as $item)
                        <tr>
                            <td>{{ date('d F, Y'),strtotime($item->date) }}</td>
                            <td>{{ $item->service }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($item->status == 1)
                                    <span class="badge badge-info">Replied</span>
                                @elseif ($item->status == 2)
                                    <span class="badge badge-primary">closed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('show.ticket', $item->id) }}" class="btn btn-sm btn-primary" title="View Ticket"> <i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-danger" title="Delete Ticket"> <i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
