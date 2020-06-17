<?php
$job_posts = \App\Models\JobPost\JobPost::all();
?>

@foreach($job_posts as $job_post)
    <div class="card">

    </div>
@endforeach
