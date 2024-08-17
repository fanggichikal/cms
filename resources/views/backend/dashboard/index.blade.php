<x-layout>
  @push('title')
    <title> Page Dashboard Admin</title>
  @endpush
  @push('Judul')
    <h1 class="h2">Dashboard</h1>
  @endpush
  <div class="row">
    <div class="col-6">
      <div class="card text-white bg-primary mb-3" style="max-width: 100%;">
        <div class="card-header">Total Article</div>
        <div class="card-body">
          <h5 class="card-title">{{$total_articles}} Article</h5>
          <p class="card-text">
            <a href="{{url('article')}}" class="text-white">View</a> 
          </p>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card text-white bg-secondary mb-3" style="max-width: 100%;">
        <div class="card-header">Populer Article</div>
        <div class="card-body">
          <h5 class="card-title">{{$total_category}} Category</h5>
          <p class="card-text">
            <a href="{{url('article')}}" class="text-white">View</a> 
          </p>
         </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <table class="table table-border table-striped">
        <thead>
          <tr>
            <td>No</td>
            <td>Title</td>
            <td>Category</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($latest_articles as $item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->title}}</td>
              <td>{{$item->category->name}}</td>
              <td>
                <a href="{{ route('article.show', $item->id) }}" class="btn btn-success">
                  <span data-feather="book-open"></span>
                </a></td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
    <div class="col-6">
      <table class="table table-border table-striped">
        <thead>
          <tr>
            <td>No</td>
            <td>Title</td>
            <td>View</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($popular_articles as $item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->title}}</td>
              <td>{{$item->views}}</td>
              <td>
                <a href="{{url('categories')}}" class="btn btn-success">
                  <span data-feather="book-open"></span>
                </a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  

</x-layout>