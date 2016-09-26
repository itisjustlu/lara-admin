<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $name }}</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                @include(\LucasRuroken\Backoffice\Constants\ViewConstants::BACKOFFICE_LIST . '.table', ['columns' => $columns, 'actions' => $actions, 'information' => $information])
            </div>
        </div>
    </div>
</div>