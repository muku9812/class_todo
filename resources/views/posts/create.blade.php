@extends('layouts.master')
@section('title', 'Add todo')
@section('pageTitle','Add Todo')
@section('content')
    <div class="card col-md-11 center-form">
        <div class="col-md-11 center-form">

            <div class="card-body">

                <!-- Form for Creating Post -->
                <div class="justify-content-center ">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="name" id="title"
                                   class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                   required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"
                                      class="form-control @error('description') is-invalid @enderror" rows="4"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Image Upload Field -->
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                                onchange="previewImage(this)"
                            >
                            @error('image')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                        </div>

                        <!-- Image Preview -->
                        <div>
                            <br>
                            <img
                                id="imagePreview"
                                src="#"
                                alt="Image Preview"
                                style="display:none; width:200px; height:200px; object-fit:cover;"
                            >
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                                    required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('style')
    <style>
        .center-form {
            margin: auto;
        }
    </style>
@endsection

@section('script')

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
