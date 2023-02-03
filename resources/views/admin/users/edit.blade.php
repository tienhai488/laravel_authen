@extends('layouts.admin')

@section('title', 'Cập nhập người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhập người dùng</h1>
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
            <label for="">Tên người dùng</label>
            <input class="form-control" type="text" placeholder="Tên người dùng..." name="name"
                value="{{ $user->name ?? old('name') }}">
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="text" placeholder="Email..." name="email"
                value="{{ $user->email ?? old('email') }}">
            @error('email')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Mật khẩu (Nếu không thay đổi thì để trống)</label>
            <input class="form-control" type="password" placeholder="Mật khẩu..." name="password">
            @error('password')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Nhóm người dùng</label>
            <select class="form-control" name="group_id" id="">
                <option value="0">Chọn nhóm</option>
                @if ($groups->count() > 0)
                    @foreach ($groups as $item)
                        <option {{ ($user->group_id ?? old('group_id')) == $item->id ? 'selected' : false }}
                            value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        @csrf

        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning">Quay lại</a>

    </form>
@endsection
