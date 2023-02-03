@extends('layouts.admin')

@section('title', 'Quản lý nhóm người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý nhóm người dùng</h1>
    </div>
    <p>
        <a href="{{ route('admin.groups.add') }}" class="btn btn-primary">Thêm nhóm người dùng</a>
    </p>
    <hr>
    @if (session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên nhóm</th>
                <th>Người tạo</th>
                <th width="15%">Phân quyền</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if ($listGroup->count() > 0)
                @foreach ($listGroup as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }} ({{ $item->users->count() }})</td>
                        <td>{{ $item->userDetail->name ?? '' }}</td>
                        <td><a href="#" class="btn btn-primary">Phân quyền</a></td>
                        <td><a href="{{ route('admin.groups.edit', [$item]) }}" class="btn btn-warning">Sửa</a></td>
                        @if ($item->users->count() == 0)
                            <td><a href="{{ route('admin.groups.delete', [$item]) }}" class="btn btn-danger"
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
