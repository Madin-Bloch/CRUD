@extends('home')
        @section('title')
            Show Table
        @endsection    

@section('content')
    <div class="container mt-4">
        <div class="card p-4 shadow-lg rounded-4">
            <h2 class="text-center mb-4">item Records</h2>
    
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
                        <th>Aadhaar</th>
                        <th>PAN</th>
                        <th>Profile</th>
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
                       
                        <td>
                            @if ($item->aadhaar_card)
                                <img src="{{ $item->getImageUrl($item->aadhaar_card) }}" alt="Aadhaar" width="80">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
            
                        <td>
                            @if ($item->pan_card)
                                <img src="{{ $item->getImageUrl($item->pan_card) }}" alt="PAN" width="80">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
            
                        <td>
                            @if ($item->profile_photo)
                                <img src="{{ $item->getImageUrl($item->profile_photo) }}" alt="Profile" width="80">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                        <form action="{{ route('delete',$item->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                           <button class="btn btn-danger">Delete</button>
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

        <script>
            $(document).ready( function () {
    $('#myTable').DataTable();
} );
        </script>
@endsection

