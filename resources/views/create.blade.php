@extends('home')

    @section('title')
    User Form
    @endsection

    

    @section('content')
    <div class="container mt-5">
        <div class="card shadow-lg rounded-4 p-4">
          <h2 class="mb-4 text-center">User Registration Form</h2>
    
          <form class="row g-4" method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
              </div>
          @endif
            @csrf
            <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
    
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? '') }}" required>
            </div>
    
            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="tel" class="form-control" pattern="[0-9]{10}" maxlength="10"  name="phone" value="{{ old('phone', $user->phone ?? '') }}" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);">
            </div>
    
            <div class="col-12">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" value="{{ old('address', $user->address ?? '') }}" required>
            </div>
    
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" class="form-control" name="city" value="{{ old('city', $user->city ?? '') }}" required>
            </div>
    
            <div class="col-md-6">
              <label class="form-label">State</label>
              <select class="form-select" name="state" required>
                <option disabled selected>Choose...</option>

                @php
                    $states =  [
                        "Andhra Pradesh",
                        "Arunachal Pradesh",
                        "Assam",
                        "Bihar",
                        "Chhattisgarh",
                        "Goa",
                        "Gujarat",
                        "Haryana",
                        "Himachal Pradesh",
                        "Jammu and Kashmir",
                        "Jharkhand",
                        "Karnataka",
                        "Kerala",
                        "Madhya Pradesh",
                        "Maharashtra",
                        "Manipur",
                        "Meghalaya",
                        "Mizoram",
                        "Nagaland",
                        "Odisha",
                        "Punjab",
                        "Rajasthan",
                        "Sikkim",
                        "Tamil Nadu",
                        "Telangana",
                        "Tripura",
                        "Uttarakhand",
                        "Uttar Pradesh",
                        "West Bengal",
                        "Andaman and Nicobar Islands",
                        "Chandigarh",
                        "Dadra and Nagar Haveli",
                        "Daman and Diu",
                        "Delhi",
                        "Lakshadweep",
                        "Puducherry"
              ];

                    
                @endphp
                @foreach ($states as $state)
                  <option value="{{ $state }}" @if(old('state', $user->state ?? '') == $state) selected @endif>
                    {{ ucfirst($state) }}
                  </option>
                @endforeach
              </select>
            </div>
    
            <div class="col-12">
              <label class="form-label d-block">Gender</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'checked' : '' }}>
                <label class="form-check-label">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'checked' : '' }}>
                <label class="form-check-label">Female</label>
              </div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Aadhaar Image</label>
              @if (!empty($user->aadhaar_card))
                <div class="mb-2">
                  <img src="{{ $user->getImageUrl($user->aadhaar_card) }}" alt="Aadhaar Image" class="img-thumbnail" width="150">
                </div>
              @endif
              <input type="file" class="form-control" name="aadhaar_card">
              @error('aadhaar_card')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="col-md-4">
              <label class="form-label">PAN Image</label>
              @if (!empty($user->pan_card))
                <div class="mb-2">
                  <img src="{{ $user->getImageUrl($user->pan_card) }}" alt="PAN Image" class="img-thumbnail" width="150">
                </div>
              @endif
              <input type="file" class="form-control" name="pan_card">
              @error('pan_card')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="col-md-4">
              <label class="form-label">Profile Photo</label>
              @if (!empty($user->profile_photo))
                <div class="mb-2">
                  <img src="{{ $user->getImageUrl($user->profile_photo) }}" alt="Profile Photo" class="img-thumbnail" width="150">
                </div>
              @endif
              <input type="file" class="form-control" name="profile_photo">
              @error('profile_photo')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            
    
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          </form>
        </div>
      </div>
      

    @endsection
