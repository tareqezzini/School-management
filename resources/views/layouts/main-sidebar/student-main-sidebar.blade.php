<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('student/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <!-- Exams -->
        <li>
            <a href="{{ route('student_exams.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.exams') }}</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('student_profile.index') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
