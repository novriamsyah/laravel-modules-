@extends('layouts.app')
@section('content')


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <!-- Notifikasi menggunakan flash session data -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <form action="{{ route('blog.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="judul">Title</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" value="{{ old('judul') }}" required>

                            <!-- error message untuk title -->
                            @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                name="penulis" value="{{ old('penulis') }}" required>

                            <!-- error message untuk title -->
                            @error('penulis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea
                                name="isi" id="isi"
                                class="form-control @error('content') is-invalid @enderror"
                                rows="5"
                                required>{{ old('isi') }}</textarea>

                            <!-- error message untuk content -->
                            @error('isi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                        <a href="{{ url('/blog') }}" class="btn btn-md btn-secondary">back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 250, //set editable area's height
        });
    })
</script>
    
@endsection