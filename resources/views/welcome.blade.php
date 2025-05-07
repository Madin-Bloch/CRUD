<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Professional Form</title>
  <!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow-lg rounded-4 p-4">
      <h2 class="mb-4 text-center">User Registration Form</h2>

      <form class="row g-4" method="POST" action="{{ route('create') }}">
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
            @foreach (['surat', 'junagadh', 'somnath'] as $state)
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

  <div class="container mt-4">
    <div class="card p-4 shadow-lg rounded-4">
        <h2 class="text-center mb-4">User Records</h2>

        <table id="myTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             @php
                  $coute = 1      
             @endphp
                @foreach ($alldata as $item)
                <tr>
                    <td>{{ $coute++ }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->state }}</td>
                    <td>{{ ucfirst($item->gender) }}</td>

                    <form action="{{ route('delete',$item->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <td> <button class="btn btn-danger" >Delete</button>
                    </form>
                    
                      <a href="{{ route('edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   </td>
                </tr>
                @endforeach
            </tbody>
            @if(session('success'))
               <div class="alert alert-success">
                {{ session('success') }}
                </div>
            @endif

      </div>
  </table>
    </div>
</div>

  </div>
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>

</body>
</html>
