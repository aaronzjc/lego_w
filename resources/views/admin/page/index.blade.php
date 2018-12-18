@extends("admin.tpl.main")

@section("content")
    <div class="columns">
        <div class="column is-2">
            <input class="input" type="text" placeholder="ID或者名称">
        </div>
        <div class="column is-2">
            <input class="input" type="text" placeholder="其他">
        </div>
        <div class="column is-2">
            <div class="select">
                <select>
                    <option>专题类型</option>
                    <option>电视剧</option>
                    <option>综艺</option>
                </select>
            </div>
        </div>
        <div class="column is-1">
            <a class="button is-info">检索</a>
        </div>
        <div class="column is-1">
            <a class="button is-primary" href="{{ route('edit_page') }}">添加</a>
        </div>
    </div>
    <div>
        @if (empty($modules))
            <h3>没有数据</h3>
        @else
        <table class="table is-fullwidth">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>类型</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($modules as $module)
                <tr>
                    <td>{{ $module["id"] }}</td>
                    <td>{{ $module["title"] }}</td>
                    <td>{{ $module["type_name"] }}</td>
                    <td><span class="tag {{ $module["status"]?"is-success":"is-warning" }}">{{ $module["status_name"] }}</span></td>
                    <td>{{ $module["create_at"] }}</td>
                    <td>
                        <div class="buttons">
                            <a href="{{ route('edit_page', ["id" => $module["id"]]) }}" class="button is-small is-primary">编辑</a>
                            <a href="{{ route('config_page', ["id" => $module["id"]]) }}" class="button is-small is-primary">编辑页面</a>
                            <a class="button is-small is-danger">删除</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav class="pagination is-small is-right" role="navigation" aria-label="pagination">
            <a class="pagination-previous">上一页</a>
            <a class="pagination-next">下一页</a>
            <ul class="pagination-list"></ul>
        </nav>
        @endif
    </div>
@endsection