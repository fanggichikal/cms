@foreach($users as $item)
<div class="modal fade" id="modalDelete{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('users/'.$item->id)}}" method="post">
            @method('Delete')
            @csrf
            <div class="mb-3">
                <p>Are you sure to delete category, name {{$item->name}}, ..?</p>
                <!-- <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old ('name', $item->name)}}">
                @error('name')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror   -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach