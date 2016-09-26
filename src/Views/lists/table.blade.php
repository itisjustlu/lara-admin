<table class="table table-hover">
    <tr>
        @foreach($columns AS $column)
            <th>{{ $titles->get($column, $column) }}</th>
        @endforeach

        @if($actions)
            <th>Actions</th>
        @endif
    </tr>

    @foreach($information AS $row)
        <tr>
            @foreach($columns AS $column)
                <td>{{ $bulker->get($column, $row) }}</td>
            @endforeach

            @if($actions)
                <td>{{ $actions->render($row) }}</td>
            @endif

        </tr>
    @endforeach
</table>