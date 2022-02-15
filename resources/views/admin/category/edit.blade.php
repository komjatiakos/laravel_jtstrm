<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Holy guacamole! {{ session('success') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                  <div class="card-header">Edit Category</div>
                    <div class="card-body">
                      <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="categoryInput">Update Category name</label>
                          <input type="text" name="category_name" class="form-control" 
                          id="categoryInput" value="{{ $categories->category_name }}">
                          @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:1%">Update</button>
                      </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
