<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">BankBimaArthonity</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.dashboard') }}" class="d-block">BankBimaArthonity</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
          <i class="fa-solid fa-house"></i>
            <p>
            Administrator
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="fa-solid fa-person"></i> -->
            <i class="fa-solid fa-users-line"></i>
            <p>
              Employee
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.employees')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Employee</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-people-roof"></i>
            <p>
              Client
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.clients')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Clients</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-people-roof"></i>
            <p>
              Supplier
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.suppliers')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Suppliers</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-envelope"></i>
            <p>
              Department
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.departments')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Department</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-pen-to-square"></i>
            <p>
              Designation
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.designations')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Designation</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-location-dot"></i>
            <p>
              Location
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.locations')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Location</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <p>
              Transaction Group
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.transaction.groupes')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaction Groupe</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-right-left"></i>
            <p>
              Transaction Head 
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           <li class="nav-item">
              <a href="{{route('show.transaction.heads')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaction Head</p>
              </a>
            </li>
          </ul>
        </li>
        
        <hr>


        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <p>
              Transaction
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.transaction')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transactions</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('show.transaction')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaction Receive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('show.transaction')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaction Payment</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-brands fa-cc-amazon-pay"></i>
            <p>
              Party Payments
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('show.party')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Receive from Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('show.transaction')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment to Supplier</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="fa-solid fa-book-open"></i>
            <p>
              Reports:
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('pending.all.due')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Due Statement-</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('client.due.transaction')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>As Per Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('supplier.due.transaction') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>As Per Supllier</p>
              </a>
            </li>
        
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>