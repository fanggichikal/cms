<x-layout>
  @push('css')
  <link href="{{asset('css/dataTables.bootstrap5.css')}}" rel="stylesheet">
  @endpush
  @push('title')
    <title> Page Article Admin</title>
  @endpush
  @push('Judul')
    <h1 class="h2">Data Article</h1>
  @endpush
  <div class="mt-3">
    <a href="{{url('article/create')}}" class="btn btn-primary mb-3">Create</a>
    @if ($errors->any())
    <div class="div my-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
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
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Views</th>
          <th>Publish</th>
          <th>Function</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->Category->name}}</td>
            @if($item->status==0)
              <td>
                <span class="badge bg-danger">Private</span>
              </td>
            @else
              <td>
                <span class="badge bg-success">Publish</span>
              </td>
            @endif
            <td>{{$item->views}}</td>
            <td>{{$item->publish_date}}</td>
            <td>
                <div class="text-center">
                  <a href="{{ route('article.show', $item->id) }}" class="btn btn-success">
                    <span data-feather="book-open"></span>
                  </a>
                  <a href="{{ route('article.edit', $item->id) }}" class="btn btn-secondary">
                    <span data-feather="edit"></span>
                  </a>
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
  <!-- MODAL DELETE --> 
  @include('backend.article.delete')
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
