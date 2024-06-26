  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img src="{{ url('admin/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @if (Auth::guard('admin')->user()->image)
                      <img src="{{ asset(Auth::guard('admin')->user()->image) }}" alt="image" class="rounded-circle">
                  @else
                      <img src="{{ asset('admin/admin.png') }}" class="img-circle elevation-2" alt="User Image">
                  @endif
                  {{-- <img src="{{url('admin/images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> --}}
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Settings
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item ">
                              <a href="{{ url('admin/update-admin-details') }}"
                                  class="nav-link {{ Request::is('admin/update-admin-details', 'admin/update-admin-details/*') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Update Admin Details</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('admin/update-password') }}"
                                  class="nav-link {{ Request::is('admin/update-password', 'admin/update-password/*') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Update Password</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('admin/cms-pages') }}"
                          class="nav-link {{ Request::is('admin/cms-pages', 'admin/cms-pages/*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Pages
                              <span class="right badge"></span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('admin/categories') }}"
                          class="nav-link {{ Request::is('admin/categories', 'admin/categories/*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Categories
                              <span class="right badge"></span>
                          </p>
                      </a>
                  </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/trashed/categories') }}"
                            class="nav-link {{ Request::is('admin/trashed/categories') ? 'active' : '' }}">
                            <i class="fas fa-trash text-danger ml-2"></i>
                            <p>
                                Trashed Categories
                                <span class="right badge"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/products') }}"
                            class="nav-link {{ Request::is('admin/products', 'admin/products/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Products
                                <span class="right badge"></span>
                            </p>
                        </a>
                    </li>



              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
