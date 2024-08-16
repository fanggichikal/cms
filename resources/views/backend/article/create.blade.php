<x-layout>
  @push('css')
  <link href="{{asset('css/dataTables.bootstrap5.css')}}" rel="stylesheet">
  @endpush
  @push('title')
    <title> Page Create Article </title>
  @endpush
  <h1>Input Data Article</h1>
  <div class="mt-3">
    <a href="{{url('article')}}" class="btn btn-primary mb-3">Back</a>
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
    
    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                    value="{{old('title')}}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="title">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="" hidden>-- Choose--</option>
                        @foreach($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="img">Image</label>
                <input type="file" name="img" id="img" class="form-control" accept="img/*">
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select type="text" name="status" id="status" class="form-control">
                        <option value="" hidden>-- Choose --</option>
                        <option value="1" >Publish</option>
                        <option value="0" >Private</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="publish_date">Publish</label>
                    <input type="date" name="publish_date" id="publish_date" class="form-control">
                </div>
            </div>

        </div>
        <div class="float-end">
            <button class="btn btn-primary mb-3 form-control" type="submit">Add Article</button>
        </div>
    </form>
</div>
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
