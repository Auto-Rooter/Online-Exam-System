<div class="page-header-inner">
    <div class="page-header-inner">
        <div class="navbar-header">
            <a href="{{ url('/') }}"
               class="navbar-brand">
                @lang('quickadmin.quickadmin_title')
            </a>


        </div>
        <a href="javascript:;"
           class="menu-toggler responsive-toggler"
           data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>

        <div class="top-menu">
            <ul >


                <a href="{{ url('/') }}"
                   class="navbar-brand" class="nav navbar-nav pull-right" >
                    {{ Auth::user()->name }} <small>({{ Auth::user()->role_id == 1 ? 'Admin' :( Auth::user()->role_id == 2 ? 'Student' : 'Teacher') }})</small>
                </a>
            </ul>
        </div>
    </div>
</div>
