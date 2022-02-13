<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Category</b>
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
                  <div class="card-header">All Category</div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Row Number</th>
                        <th scope="col">Category name</th>
                        <th scope="col">User name</th>
                        <th scope="col">Created At</th>
                        <!-- <th scope="col">Created At Time Stamp</th> -->
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($categories as $category)
                      <tr>
                        <th scope="row">{{ $categories->firstItem()+$loop->index}}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <!-- <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td> -->
                        <td>
                          <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                          <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>

                      @endforeach
                    </tbody>
                  </table>
                  {{ $categories->links() }}
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Add Category</div>
                    <div class="card-body">
                      <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="categoryInput">Category name</label>
                          <input type="text" name="category_name" class="form-control" 
                          id="categoryInput">
                          @error('category_name')
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


        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Trash List</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Row Number</th>
                      <th scope="col">Category name</th>
                      <th scope="col">User name</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($trashCat as $category)
                    <tr>
                      <th scope="row">{{ $categories->firstItem()+$loop->index}}</th>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->created_at }}</td>
                      <td>
                        <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ url('category/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>

                    @endforeach
                  </tbody>
                </table>
                {{ $trashCat->links() }}
              </div>
            </div>
            <div class="col-md-4">
            </div>
          </div>
      </div>
    </div>
</x-app-layout>
