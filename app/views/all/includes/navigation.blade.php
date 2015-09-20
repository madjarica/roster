<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}">HOME</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ URL::route('view-jobs', 'roster') }}">Roster</a>
                </li>
                <li>
                    <a href="{{ URL::route('view-jobs', 'vacancies') }}">Vacancies</a>
                </li>
                <li>
                    <a href="{{ URL::route('view-jobs', 'itb') }}">ITB (Invitation to Bid)</a>
                </li>
                <li>
                    <a href="{{ URL::route('view-jobs', 'rfp') }}">RFP (Request for Proposal)</a>
                </li>
                <li>
                    <a href="{{ URL::route('view-jobs', 'rfq') }}">RFQ (Request for Quation)</a>
                </li>
                <li>
                    <a href="{{ URL::route('view-jobs', 'resume') }}">Resume (CV)</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>