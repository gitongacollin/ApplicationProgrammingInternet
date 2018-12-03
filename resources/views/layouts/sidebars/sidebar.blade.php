<!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="{{ route('home')}}">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
          </li>
          <li>
            <a class="" href="{{ route('users.index') }}">
                          <i class="icon_genius"></i>
                          <span>Manage Users</span>
                      </a>
          </li>
          <li>
            <a class="" href="{{ route('roles.index') }}">
                          <i class="icon_genius"></i>
                          <span>Manage Role</span>
                      </a>
          </li>
          <li>
            <a class="" href="{{ route('products.index') }}">
                          <i class="icon_genius"></i>
                          <span>Manage Product</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Courses</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route ('manageCourse')}}">Manage Courses</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_table"></i>
                          <span>Student</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{ route('getStudentRegister') }}">Create Student</a></li>
              <li><a class="" href="{{ route('studentInfo')}}">Student List</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Fees</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route ('getPayment') }}">Student Payment</a></li>
              <li><a class="" href="{{route ('getFeeReport') }}">Fee Report</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Reports</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{ route('getStudentList')}}">Student List</a></li>
              <li><a class="" href="{{ route('getStudentListMultiClass')}}">Multi class Student List</a></li>
              <li><a class="" href="{{ route('getNewStudentRegister')}}">New Student Enroll</a></li>
            </ul>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->