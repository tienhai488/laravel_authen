@extends('layouts.admin')

@section('title', 'Thêm bài viết')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm bài viết</h1>
    </div>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif

    <form method="POST" action="">
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input class="form-control" type="text" placeholder="Tiêu đề ..." name="title" value="{{ old('name') }}">
            @error('title')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Nội dung...">{{ old('content') }}</textarea>
            @error('content')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        @csrf

        <button type="submit" class="btn btn-primary">Thêm bài viết </button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-warning">Quay lại</a>

    </form>
@endsection
