<x-layout>
  @push('css')
  <link href="{{asset('css/dataTables.bootstrap5.css')}}" rel="stylesheet">
  @endpush
  @push('title')
    <title> Page User Admin</title>
  @endpush
  @push('Judul')
    <h1 class="h2">Data Kategori</h1>
  @endpush
  <div class="mt-3">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Register</button>
    @if ($errors->any())
    <div class="div my-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="div my-3">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
    @endif
    
    <table id="datatable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Access</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->access}}</td>
            <td>
                <div class="text-center">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$item->id}}">
                      <span data-feather="edit"></span>
                    </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$item->id}}">
                      <span data-feather="trash"></span>
                    </button>
                <div>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- MODAL CREATE --> 
  @include('backend.user.create')
  <!-- MODAL DELETE --> 
  @include('backend.user.delete')
  <!-- MODAL UPDATE --> 
  @include('backend.user.update')
  @push('js')
  <script src="{{asset('js/jquery-3.7.1.js')}}"></script>
   <script src="{{asset('js/dataTables.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap5.js')}}"></script>
   <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
   </script>
  @endpush
</x-layout>