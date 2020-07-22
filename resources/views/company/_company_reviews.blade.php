@if(count($company_reviews) > 0)
    @foreach($company_reviews as $company_review)
        <div class="card my-2">
            <div class="card-header">
                <div class="d-flex">
                    <img src="{{ asset($company_review->employee->user->userDetail->image) }}"
                         style="height: 48px; width: 48px;"/>

                    <div class="mx-2 flex-grow-1">
                        <strong class="mb-0">
                            {{ $company_review->employee->user->userDetail->name() }}
                        </strong>

                        <p class="text-small mb-0">
                            {{ $company_review->employee->user->email }}
                        </p>
                    </div>

                    <span class="mb-0 pr-2 my-auto" data-toggle="tooltip"
                          data-placement="right" title="{{ $company_review->created_at }}">
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $company_review->created_at)->diffForHumans() }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <p class="mb-0">
                    @for($i = 0; $i < $company_review->score; $i++)
                        <i class="fas fa-star text-yellow"></i>
                    @endfor
                </p>

                @if($company_review->comment != null)
                    <p class="mb-0">
                        {{ $company_review->comment }}
                    </p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="card my-2">
        <div class="card-body">
            <p class="mb-0">
                No company reviews found.
            </p>
        </div>
    </div>
@endif
