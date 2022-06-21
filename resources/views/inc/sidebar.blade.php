 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
      <a class="nav-link" href="/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Interface
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
 

  <!-- Nav Item - Utilities Collapse Menu -->
  @if (auth()->user()->user_role->role->name === "Program Manager")
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Allocations</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Allocation Information</h6>
                <a class="collapse-item" href="{{ route('student_classes.index') }}">Classes</a>
                <a class="collapse-item" href="{{ route('class_section_allocations.index') }}">Class Section Allocation</a>
                {{-- <a class="collapse-item" href="{{ route('exam_allocations.index') }}">Exam Allocation</a> --}}
                <a class="collapse-item" href="{{ route('teacher_allocations.index') }}">Teacher Allocations</a>
            </div>
        </div>
    </li>
  @endif  

  @if (auth()->user()->user_role->role->name === "Admin")
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user"></i>
        <span>User Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User Management:</h6>
            <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
            <a class="collapse-item" href="{{ route('users.index') }}">Users</a>
        </div>
    </div>
</li>
  @endif
  

@if (auth()->user()->user_role->role->name === "Program Manager")
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseThree">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Management</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Management:</h6>
            <a class="collapse-item" href="{{ route('academic_calendars.index') }}">Academic Calendars</a>
            <a class="collapse-item" href="{{ route('institutes.index') }}">Institutes</a>
            <a class="collapse-item" href="{{ route('class_years.index') }}">Class Years</a>
            <a class="collapse-item" href="{{ route('colleges.index') }}">Colleges</a>
            <a class="collapse-item" href="{{ route('subjects.index') }}">Courses</a>
            <a class="collapse-item" href="{{ route('days.index') }}">Days</a>
            <a class="collapse-item" href="{{ route('departments.index') }}">Department</a>
            {{-- <a class="collapse-item" href="{{ route('department_heads.index') }}">Department Heads</a> --}}
            <a class="collapse-item" href="{{ route('section_allocations.index') }}">Section Allocations</a>
            <a class="collapse-item" href="{{ route('sections.index') }}">Sections</a>
            <a class="collapse-item" href="{{ route('semesters.index') }}">Semesters</a>
            <a class="collapse-item" href="{{ route('periods.index') }}">Periods</a>
        </div>
    </div>
</li>
@endif


@if (auth()->user()->user_role->role->name === "Admin")
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseFour">
        <i class="fas fa-fw fa-user"></i>
        <span>Infrastructure</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Infrastructure:</h6>
            <a class="collapse-item" href="{{ route('buildings.index') }}">Buildings</a>
            <a class="collapse-item" href="{{ route('rooms.index') }}">Rooms</a>
        </div>
    </div>
</li>
<hr class="sidebar-divider">
@endif

  <!-- Divider -->

 


  <!-- Nav Item - Charts -->
  @if (auth()->user()->user_role->role->name === "Program Manager")
  <li class="nav-item">
        <a class="nav-link" href="{{ route('timetables.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Timetables</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('exam_timetables.index') }}">
        <i class="fas fa-fw fa-chart-area"></i>
            <span>Exam Timetable</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
  @endif

  @if (auth()->user()->user_role->role->name === "Teacher")
    <li class="nav-item">
        <a class="nav-link" href="{{ route('my_timetable') }}">
        <i class="fas fa-fw fa-chart-area"></i>
            <span>My Timetable</span></a>
    </li>
  @endif    
  

  <!-- Divider -->

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->