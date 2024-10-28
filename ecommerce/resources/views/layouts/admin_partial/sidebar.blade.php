 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{route('admin.dashboard')}}" class="brand-link">
         {{-- <img src="{{asset('public/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
         <span class="brand-text font-weight-bold">Confidence Cart</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 {{-- <img src="{{asset('public/backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{Auth::user()->name}}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item menu-open">
                     <a href="{{route('admin.dashboard')}}" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                 </li>
                 @if(Auth::user()->category == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Category
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('category.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Category</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->brand == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Brand
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('brand.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Brand</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->product == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Product
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('product.create')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Add New Product</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('product.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Manage Product</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->product == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Order
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('admin.order.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Manage Order</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->offer == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Offer
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('coupon.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Coupon</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->offer == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Blog
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('blog_category.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Blog Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('blog_post.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Blog Posts</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->report == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Reposts
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('order.report.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Order Report</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Customer Report</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Stock Report</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Report</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->settings == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Settings
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('admin.website.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Website</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('admin.mail.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Mail</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('admin.page.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Page</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif

                 @if(Auth::user()->userrole == 1)
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             User Role
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('create.role')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create Role</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('index.role')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Manage Role</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif
                 <li class="nav-header">Profile</li>
                 <li class="nav-item">
                    <a href="{{route('admin.password.change')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Change Password</p>
                    </a>
                </li>
                 <li class="nav-item">
                     <a href="{{route('admin.logout')}}" class="nav-link">
                         <i class="nav-icon far fa-circle text-danger"></i>
                         <p class="text">Logout</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>