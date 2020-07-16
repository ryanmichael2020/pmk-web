@if(session()->has('response_type'))
    <?php
    $error_type = session()->get('response_type')
    ?>

    <div
        class="card @if($error_type == 'error'){{ 'bg-red' }} @elseif($error_type == 'warning'){{ 'bg-orange' }} @elseif($error_type == 'success'){{ 'bg-green' }} @endif my-2">
        <div
            class="card-body text-white">
            <p class="mb-0">
                {{ session()->get('message') }}
            </p>
        </div>
    </div>
@endif
