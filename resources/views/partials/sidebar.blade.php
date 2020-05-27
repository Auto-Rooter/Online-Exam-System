@inject('request', 'Illuminate\Http\Request')
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">

            @if(Auth::user()->isStudent())

            <li class="{{ $request->segment(1) == 'students' ? 'active' : '' }}">
                <a href="{{ route('exams.student_index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">My Exams</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'results' ? 'active' : '' }}">
                <a href="{{ route('results.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">My Results</span>
                </a>
            </li>

                <li class="{{ $request->segment(1) == 'subjects' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-gears"></i>
                        <span class="title"> My Subjects </span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="sub-menu">

                        <li class="{{ $request->segment(1) == 'subjects' ? 'active active-sub' : '' }}">
                            <a href="{{ route('SubjectsHome') }}">
                                <i class="fa fa-gears"></i>
                                <span class="title"> Registered Subjects </span>
                            </a>
                        </li>

                        <li class="{{ $request->segment(1) == 'subjects' ? 'active active-sub' : '' }}">
                            <a href="{{ route('subjects.index') }}">
                                <i class="fa fa-gears"></i>
                                <span class="title"> Register For Subjects </span>
                            </a>
                        </li>


                    </ul>

                </li>




            @endif

            @if(Auth::user()->isTeacher())

                    <li class="{{ $request->segment(1) == 'exams' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span class="title"> Exams </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">


                            <li class="{{ $request->segment(1) == 'exams' ? 'active active-sub' : '' }}">
                                <a href="{{ route('exams.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title"> Show Exams </span>
                                </a>
                            </li>

                            <li class="{{ $request->segment(1) == 'exams' ? 'active active-sub' : '' }}">
                                <a href="{{ route('exams.create') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title"> Add new Exam </span>
                                </a>
                            </li>

                            <li class="{{ $request->segment(1) == 'exams' ? 'active active-sub' : '' }}">
                                <a href="{{ route('exams.correct_index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title"> Correct Exams </span>
                                </a>
                            </li>

                        </ul>




                    <li class="{{ $request->segment(1) == 'topics' ? 'active' : '' }}">
                        <a href="{{ route('topics.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">@lang('quickadmin.topics.title')</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span class="title">@lang('quickadmin.questions.title')</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                                <a href="{{ route('questions.create') }}">
                                    <i class="fa fa-plus"></i>
                                    <span class="title">
                                @lang('quickadmin.questions.add-new-MC')
                            </span>
                                </a>
                            </li>

                            <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                                <a href="{{ route('QuestionEssay.essay_create') }}">
                                    <i class="fa fa-plus"></i>
                                    <span class="title">
                                @lang('quickadmin.questions.add-new-essay')
                            </span>
                                </a>
                            </li>

                            <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                                <a href="{{ route('questions.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span class="title">
                                    @lang('quickadmin.questions.title')
                            </span>
                                </a>
                            </li>



                        </ul>





                    </li>
                    <li class="{{ $request->segment(1) == 'questions_options' ? 'active' : '' }}">
                        <a href="{{ route('questions_options.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">@lang('quickadmin.questions-options.title')</span>
                        </a>
                    </li>

            @endif

            @if(Auth::user()->isAdmin())
            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'user_actions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span class="title">
                                @lang('quickadmin.user-actions.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.logout')</span>
                </a>
            </li>
        </ul>


    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
