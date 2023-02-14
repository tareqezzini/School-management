<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>


        <!-- Classroom-->
        <li>
            <a href="{{ route('sections') }}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_trans.List_classes') }}</span></a>
        </li>

        <!-- Students-->
        <li>
            <a href="{{ route('students.index') }}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('main_trans.students') }}</span></a>
        </li>


        <!-- Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('main_trans.exams') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('quizzes.index') }}">{{ trans('main_trans.list_exams') }}</a></li>

            </ul>

        </li>

        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('main_trans.OnlineClasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('online_zoom_classes.index') }}">
                        {{ trans('main_trans.OnlineClasses_zoom') }}</a> </li>
            </ul>
        </li>

        <!-- Repport-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#report-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('main_trans.report') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="report-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('attendance.report') }}">{{ trans('main_trans.Attendance') }}</a></li>
            </ul>

        </li>

        <!-- Profile -->
        <li>
            <a href="{{ route('profile_teacher') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
