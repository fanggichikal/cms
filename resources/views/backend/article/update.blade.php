<x-layout>
  @push('css')
  <link href="{{asset('css/dataTables.bootstrap5.css')}}" rel="stylesheet">
  @endpush
  @push('title')
    <title> Page Update Article </title>
  @endpush
  <h1>Update Data Article</h1>
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
    
    <form action="{{ route('article.update', $article->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf  
    @method('PUT')
    <input type="hidden" name="oldimg" value="{{$article->img}}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                    value="{{old('title',$article->title)}}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $item)
                            @if($item->id == $article->category_id)
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                            @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" value="">{{old('desc',$article->desc)}}</textarea>
            </div>
            <div class="mb-3">
                <label for="img">Image</label>
                <input type="file" name="img" id="img" class="form-control" accept="img/*">
                <div class="mt-1">
                    <small>Gambar Lama</small>
                    <img src="{{asset('storage/'.$article->img)}}" alt="" width="50px">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select type="text" name="status" id="status" class="form-control">
                        <option value="1" {{$article->status == 1 ? 'selected' : null}}>Publish</option>
                        <option value="0" {{$article->status == 0 ? 'selected' : null}}>Private</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="publish_date">Publish</label>
                    <input type="date" name="publish_date" id="publish_date" class="form-control"  value="{{old('publish_date',$article->publish_date)}}">
                </div>
            </div>

        </div>
        <div class="float-end">
            <button class="btn btn-primary mb-3 form-control" type="submit">Update Article</button>
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