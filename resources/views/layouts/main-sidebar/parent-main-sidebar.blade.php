<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <!-- ِChildren -->
        <li>
            <a href="{{ Route('children') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.children') }}</span></a>
        </li>

        <!-- Attandence -->
        <li>
            <a href="{{ Route('attendance.children') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></a>
        </li>

        <!-- Finance report -->
        <li>
            <a href="{{ Route('fees.children') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.finance_report') }}</span></a>
        </li>


        <!-- Profile -->
        <li>
            <a href="{{ Route('parents.profile') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">
                    {{ trans('main_trans.profile') }} </span></a>
        </li>


    </ul>
</div>
