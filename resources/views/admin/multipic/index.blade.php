<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Multi Picture</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                  <div class="card-group">
                      @foreach ($images as $image)
                        <div class="col-md-4 mt-5">
                            <div class="card">
                                <img src="{{ asset($image->image) }}"/>
                            </div>
                        </div>
                      @endforeach
                  </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Multi Picture</div>
                    <div class="card-body">
                      <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="MultiPicInput">Multi Picture</label>
                          <input type="file" name="image[]" class="form-control" 
                          id="MultiPicInput" multiple="">
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
