@section('style')
<style>
.nav-item.menu-open-expanded>.nav-link>.right {
    transform: rotate(-90deg);
}

.nav-item.menu-open-expanded>.nav-link+.nav-treeview {
    display: block !important;
}
</style>
@endsection

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BankBimaArthonity</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
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
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fa-solid fa-house"></i>
                        <p>
                            ADMINISTRATOR
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-people-roof"></i>
                                <p>
                                    Client
                                    <!-- <i class="fas fa-angle-left right"></i> -->
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
                                    <!-- <i class="fas fa-angle-left right"></i> -->
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
                                <i class="fa-solid fa-people-roof"></i>
                                <p>
                                    Bank
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.banks')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Banks</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-location-dot"></i>
                                <p>
                                    Location
                                    <!-- <i class="fas fa-angle-left right"></i> -->
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
                                    Main Head
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.transaction.types')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Main Head</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <p>
                                    Tran With
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.tranwith')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Tran With</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-arrows-h"></i>
                                <p>
                                    Transaction Group
                                    <!-- <i class="fas fa-angle-left right"></i> -->
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
                                <i class="fa-solid fa-pen-to-square"></i>
                                <p>
                                    Tran With Groupe
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.tranwithgroupe')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Tran With Groupe</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-arrows-h"></i>
                                <p>
                                    Transaction Head
                                    <!-- <i class="fas fa-angle-left right"></i> -->
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
                    </ul>
                </li>

                <!-- Transaction -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <p>
                            GENERAL TRANSACTION
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('show.transaction.receive')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction Receive</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('show.transaction.payment')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Transaction With Bank -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <p>
                            BANK TRANSACTION<i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('show.bank.withdraws')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw from Bank</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('show.bank.deposits')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit to Bank</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- HR & PAYROLL -->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p>HR & PAYROLL</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- EMPLOYEE -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Employee</p>
                                <!-- <i class="fas fa-angle-left right"></i> -->
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.employees')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Employee</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('show/personal/info') ? 'menu-open' : '' }}">
                                    <a href="{{ route('show.personalinfo') }}"
                                        class="nav-link {{ Request::is('show/personal/info') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Personal Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('show.educationinfo') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Education Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('show.traininginfo') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Training Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('show.experienceinfo') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Experience Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('show.organizationinfo') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Organization Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('employee.attend.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attendence List</p>
                                    </a>
                                </li>
                                <!-- Add more submenu items as needed -->
                            </ul>
                        </li>
                        <!-- PAYROLL -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Payroll</p>
                                <!-- <i class="fas fa-angle-left right"></i> -->
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.payroll.setup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payroll Setup</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('show.payroll.middlewire')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payroll Middlewire</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('show.payroll')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payroll / Salary Payment</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-warehouse"></i>
                                <p>
                                    Department
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
                                <i class="fas fa-id-badge"></i>
                                <p>
                                    Designation
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
                    </ul>
                </li>

                <!-- PHARMACY -->
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-clinic-medical"></i>
                        <p>PHARMACY</p>
                        <i class="fas fa-angle-left right"></i>

                    </a>
                    <ul class="nav nav-treeview">
                        <!-- PHARMACY -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-industry"></i>
                                <p>
                                    Manufacturer
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.manufacturer.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Manufacturer</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-table-cells-large"></i>
                                <p>
                                    Category
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.category.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category Name</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-list-ul"></i>
                                <p>
                                    Item Form
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.form.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Form Type</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-scale-unbalanced"></i>
                                <p>
                                    Item Unit
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.unit.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Unit Type</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-shop"></i>
                                <p>
                                    Store Name
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.store.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Store</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-prescription-bottle-medical"></i>
                                <p>
                                    Pharmacy Product
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('show.pharmacy.product')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <!-- INVENTORY -->
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa-solid fa-right-left"></i>
                        <p>INVENTORY</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('show.inventory.purchase')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventory Purchase</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('show.inventory.issue')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventory Issue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('show.inventory.return')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventory Return</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Party Payments -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-brands fa-cc-amazon-pay"></i>
                        <p>
                            PARTY PAYMENT
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('show.party.receive')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Receive from Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('show.party.payment')}}" class="nav-link">
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
                            REPORTS & QUERIES:
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                <p>
                                    Balance Sheet
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('report.balance.sheet.details')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('report.balance.sheet.summary')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Summary</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pending.all.due')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Due Statement</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.groupe')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report By Groupe</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('summary.report')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Summary Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('party.details.report')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Party Details Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('party.summary.report')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Party Summary Report</p>
                            </a>
                        </li>
                    </ul>
                </li>









                <hr>



                <hr>

            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@section('ajax')
<script src="{{ asset('js/ajax/layout/sidebar.js') }}"></script>
@endsection