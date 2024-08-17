<x-layout>
  @push('title')
    <title> Page Category Admin</title>
  @endpush
  @push('Judul')
    <h1 class="h2">Detail Article</h1>
  @endpush
  <div class="mt-3">   
    <table class="table table-striped table-bordered">
      <tr>
        <th>Title</th>
        <td> {{$article->title}}</td>
      </tr>
      <tr>
        <th>Category</th>
        <td> {{$article->category_id}}</td>
      </tr>
      <tr>
        <th>Desc</th>
        <td> {{$article->desc}}</td>
      </tr>
      <tr>
        <th>Img</th>
        <td>
            <!-- <img src="{{asset('storage/'.$article->img)}}" alt="" width="30%"> -->
            <img src="{{ asset('storage/' . $article->img) }}" alt="Image for {{ $article->title }}" width="30%">
        </td>
      </tr>
      <tr>
        <th>Status</th>
        @if($article->status==0)
              <td> 
                <span class="badge bg-danger">Private</span>
              </td>
            @else
              <td> 
                <span class="badge bg-success">Publish</span>
              </td>
            @endif
      </tr>
      <tr>
        <th>View</th>
        <td> {{$article->views}}</td>
      </tr>
      <tr>
        <th>Publish</th>
        <td>{{$article->publish_date}}</td>
      </tr>
    </table>
    <div class="float-end">
            <a href="{{url('article')}}" class="btn btn-primary mb-3 form-control" type="submit">Back</a>
        </div>
  </div>
   
</x-layout>
