@if(session()->has('response_type'))
    <?php
    $error_type = session()->get('response_type')
    ?>

    <div class="card">
        <div
            class="text-white card-body @if($error_type == 'error'){{ 'bg-red' }} @elseif($error_type == 'warning'){{ 'bg-orange' }} @elseif($error_type == 'success'){{ 'bg-green' }} @endif">
            {{ session()->get('message') }}
        </div>
    </div>
@endif
