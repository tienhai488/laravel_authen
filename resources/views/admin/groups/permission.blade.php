@extends('layouts.admin')

@section('title', 'Phân quyền nhóm: ' . $group->name)

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm: {{ $group->name }}</h1>
    </div>
    <hr>
    @if (session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif

    <form action="" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Module</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                @if ($modules->count() > 0)
                    @foreach ($modules as $key => $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                <div class="row">
                                    @foreach ($roleList as $roleValue => $roleLabel)
                                        <div class="col-2">
                                            <label for="role_{{ $item->name }}_{{ $roleValue }}">
                                                <input class="checkbox_permission" name="role[{{ $item->name }}][]"
                                                    value="{{ $roleValue }}" type="checkbox"
                                                    id="role_{{ $item->name }}_{{ $roleValue }}"
                                                    {{ isRole($roleCheckeds, $item->name, $roleValue) ? 'checked' : false }}>
                                                {{ $roleLabel }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($item->name == 'groups')
                                        <div class="col-2">
                                            <label for="role_{{ $item->name }}_permission">
                                                <input class="checkbox_permission" name="role[{{ $item->name }}][]"
                                                    value="permission" type="checkbox"
                                                    id="role_{{ $item->name }}_permission"
                                                    {{ isRole($roleCheckeds, $item->name, 'permission') ? 'checked' : false }}>
                                                Phân quyền
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button class="btn btn-danger btn-drop">Hủy tất cả</button>
        <hr>
        <button type="submit" class="btn btn-primary">Phân quyền</button>
        <a href="{{ route('admin.groups.index') }}" class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection

@section('script')
    const btn_drop = document.querySelector('.btn-drop');
    const checkboxs = document.querySelectorAll('.checkbox_permission');
    btn_drop.onclick = (e)=>{
    e.preventDefault();
    checkboxs.forEach(item=>item.checked = false)
    }
@endsection
