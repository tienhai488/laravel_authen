@extends('layouts.admin')

@section('title', 'Cập nhập nhóm người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhập nhóm người dùng</h1>
    </div>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif

    @if (session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif
    <form method="POST" action="">
        <div class="form-group">
            <label for="">Tên nhóm</label>
            <input class="form-control" type="text" placeholder="Tên nhóm..." name="name"
                value="{{ $group->name ?? old('name') }}">
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        @csrf

        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a href="{{ route('admin.groups.index') }}" class="btn btn-warning">Quay lại</a>

    </form>
@endsection
