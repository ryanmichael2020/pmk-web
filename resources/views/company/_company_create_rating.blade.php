<form method="post" action="/company/review">
    {{ csrf_field() }}

    <input name="employee_id" type="hidden" value="{{ auth()->user()->employee->id }}"/>
    <input name="company_id" type="hidden" value="{{ $company->id }}"/>

    <div class="card my-2">
        <div class="card-header">
            <h2 class="mb-0">
                Rate {{ $company->name }}
            </h2>
        </div>

        <div class="card-body">
            <div class="form-group mb-2">
                <label class="mr-2">Rating</label>
                @include('shared.stars_rating', ['var_name' => 'rating'])
            </div>

            <div class="form-group mb-0">
                <label for="comment">Comment (Optional)</label>
                <textarea id="comment" name="comment" class="form-control" rows="5" maxlength="8096"></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>
