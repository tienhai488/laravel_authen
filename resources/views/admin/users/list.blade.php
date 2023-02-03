@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý người dùng</h1>
    </div>
    <p>
        <a href="{{ route('admin.users.add') }}" class="btn btn-primary">Thêm người dùng</a>
    </p>
    <hr>
    @if (session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Nhóm</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if ($listUser->count() > 0)
                @foreach ($listUser as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->group->name }}</td>
                        <td><a href="{{ route('admin.users.edit', [$item]) }}" class="btn btn-warning">Sửa</a></td>
                        @if ($item->id != Auth::user()->id)
                            <td><a href="{{ route('admin.users.delete', [$item]) }}" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa!')">
                                    Xóa
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
