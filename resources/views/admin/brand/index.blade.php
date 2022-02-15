<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Brand</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole! {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                  <div class="card-header">All Brand</div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Row Number</th>
                        <th scope="col">Brand name</th>
                        <th scope="col">Brand image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($brands as $brand)
                      <tr>
                        <th scope="row">{{ $brands->firstItem()+$loop->index}}</th>
                        <td>{{ $brand->brand_name }}</td>
                        <td><img src="" alt=""/></td>
                        <td>{{ $brand->created_at }}</td>
                        <td>
                          <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                          <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>

                      @endforeach
                    </tbody>
                  </table>
                  {{ $brands->links() }}
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Add Brand</div>
                    <div class="card-body">
                      <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="brandNameInput">Brand name</label>
                          <input type="text" name="brand_name" class="form-control" 
                          id="brandNameInput">
                          @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="brandImageInput">Brand image</label>
                          <input type="file" name="brand_image" class="form-control" 
                          id="brandImageInput">
                          @error('brand_image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:1%">Create</button>
                      </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</x-app-layout>
