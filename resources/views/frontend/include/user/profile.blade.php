
<div class="card">
    <div class="image-div">
        <img style="width: 155px;height: 150px; border: 8px solid #f2f2f2;" src="{{ asset('frontend/customer_profile_img/user.png') }}" class="profile-image mx-auto mt-4 card-img-top rounded rounded-circle">

    </div>
    <div class="middle zoom-in">
      <!-- <div class="text">John Doe</div> -->
      <button style="cursor: pointer;" class="btn btn-sm btn-outline-secondary px-2"><i class="fas fa-edit px-1"></i>Edit</button>
    </div>

    <div class="card-body">
      <h5 class="card-title text-center"> {{ Auth::user()->name ?? 'Unknown' }} </h5>
      <p class="card-text text-center">Email: john.doe@example.com</p>
      <p class="card-text text-center">Location: New York, USA</p>

      <ul class="list-inline text-dark">
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('customer.dashboard') }}"><i class="fas fa-home px-1"></i> Dashboard</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href=""> <i class="fas fa-file-alt px-1"></i>  Edit Profile</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('wishlist') }}"><i class="far fa-heart px-1"></i> Wishlist</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('my.order') }}"><i class="fas fa-file-alt px-1"></i> My Order</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('profile.setting') }}"><i class="fas fa-edit px-1"></i> Setting</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href=""><i class="fab fa-telegram-plane px-1"></i> Open Ticket</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('customer.logout') }}"><i class="fas fa-sign-out-alt px-1"></i> Logout</a>
        </li>
      </ul>

    </div>
  </div>
