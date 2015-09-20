<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <div style="display: block; width: 100%; margin-top: 90px;"></div>

    {{--<!-- Blog Search Well -->--}}
    {{--<div class="well">--}}
        {{--<h4>Blog Search</h4>--}}
        {{--<div class="input-group">--}}
            {{--<input type="text" class="form-control">--}}
            {{--<span class="input-group-btn">--}}
              {{--<button class="btn btn-default" type="button">--}}
                  {{--<span class="glyphicon glyphicon-search"></span>--}}
              {{--</button>--}}
            {{--</span>--}}
        {{--</div>--}}
        {{--<!-- /.input-group -->--}}
    {{--</div>--}}

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Highlighted</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    @foreach($highlighted as $highlightedjob)
                        <li><a href="{{ URL::route('view-job', $highlightedjob->id) }}">{{ $highlightedjob->job_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    {{--<div class="well">--}}
        {{--<h4>Side Widget Well</h4>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>--}}
    {{--</div>--}}

</div>