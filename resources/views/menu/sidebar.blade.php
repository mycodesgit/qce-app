@php
    $current_route=request()->route()->getName();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header text-gray">Main Navigation</li>
        <li class="nav-item ripple-effect">
            <a href="{{ route('dash') }}" class="nav-link {{$current_route=='dash'?'active':''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item {{ $current_route == 'instructionStore' || $current_route == 'categoryStore' || $current_route == 'questionStore' || $current_route == 'semesterStore' ? 'menu-open' : '' }}">
            <a href="starter.html" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Manage
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('instructionStore') }}" class="nav-link {{ request()->is('conf/instruction*') ? 'active' : '' }}">
                        <i class="fas fa-pencil nav-icon"></i>
                        <p>Instruction</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categoryStore') }}" class="nav-link {{ request()->is('conf/category*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group nav-icon"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('questionStore') }}" class="nav-link {{ request()->is('conf/question*') ? 'active' : '' }}">
                        <i class="fas fa-question nav-icon"></i>
                        <p>Questions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('semesterStore') }}" class="nav-link {{ request()->is('conf/semester*') ? 'active' : '' }}">
                        <i class="fas fa-calendar nav-icon"></i>
                        <p>Semester</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item ripple-effect">
            <a href="{{ route('indexformpdf') }}" class="nav-link  {{$current_route=='indexformpdf'?'active':''}}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Forms
                </p>
            </a>
        </li>

        <li class="nav-item ripple-effect">
            <a href="{{ route('evalformStore') }}" class="nav-link  {{$current_route=='evalformStore'?'active':''}}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Preview
                </p>
            </a>
        </li>

        <li class="nav-item ripple-effect">
            <a href="{{ route('userStore') }}" class="nav-link  {{$current_route=='userStore'?'active':''}}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                </p>
            </a>
        </li>

        <li class="nav-header text-gray">Reports</li>

        <li class="nav-item ripple-effect">
            <a href="starter.html" class="nav-link">
                <i class="nav-icon fas fa-file-excel"></i>
                <p>
                    Reports
                </p>
            </a>
        </li>
    </ul>
</nav>