@extends('layouts.admin')

@section('title', 'Quản lý bài viết')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý bài viết</h1>
    </div>
    <p>
        <a href="{{ route('admin.posts.add') }}" class="btn btn-primary">Thêm bài viết</a>
    </p>
    <hr>
    @if (session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tiêu đề</th>
                <th>Đăng bởi</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if ($listPost->count() > 0)
                @foreach ($listPost as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td><a href="{{ route('admin.posts.edit', [$item]) }}" class="btn btn-warning">Sửa</a></td>
                        <td><a href="{{ route('admin.posts.delete', [$item]) }}" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa!')">
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
