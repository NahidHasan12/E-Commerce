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

            <h4 class="card-title ml-2"> My Order History</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                  <th scope="col">Payment Type</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <th>{{ $item->order_id }}</th>
                            <td>{{ date('d F, Y'),strtotime($item->order_id) }}</td>
                            <td><b class="text-primary">{{ $web_settings->currency }}</b> {{ $item->total }}</td>
                            <td>{{ $item->payment_type }}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($item->status == 1)
                                    <span class="badge badge-info">Order Received</span>
                                @elseif ($item->status == 2)
                                    <span class="badge badge-primary">Order Shipped</span>
                                @elseif ($item->status == 3)
                                    <span class="badge badge-success">Order Complete</span>
                                @elseif ($item->status == 4)
                                    <span class="badge badge-warning">Order Return</span>
                                @elseif ($item->status == 5)
                                    <span class="badge badge-danger">Order Cancel</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" title="View Order"> <i class="fa fa-eye"></i></a>
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
