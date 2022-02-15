<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Brand</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Edit Brand</div>
                    <div class="card-body">
                      <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="brandNameInput">Update Brand Name</label>
                          <input type="text" name="brand_name" class="form-control" 
                          id="brandNameInput" value="{{ $brands->brand_name }}">
                          @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="brandImageInput">Update Brand Image</label>
                            <input type="file" name="brand_image" class="form-control" 
                            id="brandImageInput" value="{{ $brands->brand_image }}">
                            @error('brand_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                              <img src="{{ asset($brands->brand_image) }}" style="width:200px; heigth:100px"/>
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
