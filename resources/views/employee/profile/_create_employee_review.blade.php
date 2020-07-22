<form method="post" action="/employee/review/create">

    {{ csrf_field() }}

    <input name="employee_id" type="hidden" value="{{ $employee->id }}">
    <input name="company_id" type="hidden" value="{{ $employee->company_id }}">

    <div class="card my-2">
        <div class="card-header">
            <h2 class="mb-0">
                Create Review
            </h2>
        </div>

        <div class="card-body">
            <div class="form-group mb-0">
                <label for="punctuality_score" style="width: 128px;">Punctuality</label>
                <input id="punctuality_score" name="punctuality_score" type="hidden">

                <i id="punctuality_score_1" class="fas fa-star mx-0"></i><i id="punctuality_score_2"
                                                                            class="fas fa-star"></i><i
                    id="punctuality_score_3" class="fas fa-star"></i><i id="punctuality_score_4"
                                                                        class="fas fa-star"></i><i
                    id="punctuality_score_5" class="fas fa-star"></i>
            </div>

            <div class="form-group mb-0">
                <label for="performance_score" style="width: 128px;">Performance</label>
                <input id="performance_score" name="performance_score" type="hidden">

                <i id="performance_score_1" class="fas fa-star mx-0"></i><i id="performance_score_2"
                                                                            class="fas fa-star"></i><i
                    id="performance_score_3" class="fas fa-star"></i><i id="performance_score_4"
                                                                        class="fas fa-star"></i><i
                    id="performance_score_5" class="fas fa-star"></i>
            </div>

            <div class="form-group mb-0">
                <label for="personality_score" style="width: 128px;">Personality</label>
                <input id="personality_score" name="personality_score" type="hidden">

                <i id="personality_score_1" class="fas fa-star mx-0"></i><i id="personality_score_2"
                                                                            class="fas fa-star"></i><i
                    id="personality_score_3" class="fas fa-star"></i><i id="personality_score_4"
                                                                        class="fas fa-star"></i><i
                    id="personality_score_5" class="fas fa-star"></i>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" type="text" class="form-control" maxlength="8096"
                          rows="5"></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>

</form>
