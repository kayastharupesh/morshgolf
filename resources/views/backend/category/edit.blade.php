@extends('backend.layouts.master')



@section('main-content')
  <div class="card">

    <h5 class="card-header">Edit Category</h5>

    <div class="card-body">

      <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PATCH')

        <div class="form-group">

          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{ $category->title }}"
            class="form-control">

          @error('title')
            <span class="text-danger">{{ $message }}</span>
          @enderror

        </div>



        <div class="form-group">

          <label for="summary" class="col-form-label">Summary</label>

          <textarea class="form-control" id="summary" name="summary">{{ $category->summary }}</textarea>

          @error('summary')
            <span class="text-danger">{{ $message }}</span>
          @enderror

        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Catagory Image <span class="text-danger">*</span></label>
          <input  type="file" name="photo" value="{{old('photo')}}" class="form-control">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <img src="{{ asset('frontend/images/banner/' . $category->photo) }}" class="img-fluid zoom"
                        style="max-width:120px" alt="{{ $category->photo }}">
        <div class="form-group">

          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>

          <select name="status" class="form-control">

            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>

            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>

          </select>

          @error('status')
            <span class="text-danger">{{ $message }}</span>
          @enderror

        </div>

        <div class="form-group mb-3">

          <button class="btn btn-success" type="submit">Update</button>

        </div>

      </form>

    </div>

  </div>
@endsection



@push('styles')
  <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

  <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>

  <script>
    $('#lfm').filemanager('image');



    $(document).ready(function() {

      $('#summary').summernote({

        placeholder: "Write short description.....",

        tabsize: 2,

        height: 150

      });

    });
  </script>

  <script>
    $('#is_parent').change(function() {

      var is_checked = $('#is_parent').prop('checked');

      // alert(is_checked);

      if (is_checked) {

        $('#parent_cat_div').addClass('d-none');

        $('#parent_cat_div').val('');

      } else {

        $('#parent_cat_div').removeClass('d-none');

      }

    })
  </script>
@endpush
