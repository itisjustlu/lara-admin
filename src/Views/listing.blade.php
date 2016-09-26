<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $name }}</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                @include('admin::lists.table', ['columns' => $columns, 'actions' => $actions, 'information' => $information, 'bulker' => $bulker])
            </div>
        </div>
    </div>
</div>