<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        <div class="ec-brand">
            <a href="" title="Projector Cabinet">
                <img class="ec-brand-name" src="{{ asset(get_setting('logo')) }}" alt="" />

            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>

                <li class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.blogs') }}">
                        <i class="mdi mdi-pencil-outline"></i>
                        <span class="nav-text">Blogs</span>
                    </a>
                    <hr>
                </li>
                <li class="{{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.settings.index') }}">
                        <i class="mdi mdi-wrench-outline"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                    <hr>
                </li>
                <li
                    class="has-sub {{ request()->routeIs('admin.banner') ||
                    request()->routeIs('admin.banner.add') ||
                    request()->routeIs('admin.banner.edit') ||
                    request()->routeIs('admin.about.us') ||
                    request()->routeIs('admin.about.edit') ||
                    request()->routeIs('admin.header.navigation') ||
                    request()->routeIs('admin.header.navigation.add')
                        ? 'active expand'
                        : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-palette-advanced"></i>
                        <span class="nav-text">CRM</span> <b class="caret"></b>
                    </a>
                    <div
                        class="collapse {{ request()->routeIs('admin.banner') || request()->routeIs('admin.banner.add') || request()->routeIs('admin.about.us') || request()->routeIs('admin.about.edit') || request()->routeIs('admin.header.navigation.add') || request()->routeIs('admin.header.navigation') ? 'show' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            {{-- <li class="{{request()->routeIs('admin.banner')?'active':''}}">
                                   <a class="sidenav-item-link" href="{{route('admin.banner')}}">
                                       <span class="nav-text">Banner</span>
                                   </a>
                               </li>

                               <li class="{{request()->routeIs('admin.about.us') || request()->routeIs('admin.about.edit')?'active':''}}">
                                   <a class="sidenav-item-link" href="{{route('admin.about.us')}}">
                                       <span class="nav-text">About us</span>
                                   </a>
                               </li> --}}

                            <li
                                class="{{ request()->routeIs('admin.header.navigation') || request()->routeIs('admin.header.navigation.add') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.header.navigation') }}">
                                    <span class="nav-text">Header Navigation</span>
                                </a>
                            </li>



                        </ul>
                    </div>
                </li>
                <li class="{{ request()->routeIs('admin.contactUs') ? 'active' : '' }} has-sub">
                    <a class="sidenav-item-link" href="{{ route('admin.contactUs') }}">
                        <i class="mdi mdi-contacts"></i>
                        <span class="nav-text">Free Quotes</span>
                    </a>

                </li>
                <!-- Projectors -->
                <li class="{{ request()->routeIs('admin.projectors.index') ? 'active' : '' }} has-sub">
                    <a class="sidenav-item-link" href="{{ route('admin.projectors.index') }}">
                        <i class="mdi mdi-television"></i>
                        <span class="nav-text">Projectors</span>
                    </a>

                </li>
                <li class="{{ request()->routeIs('admin.speakers.index') ? 'active' : '' }} has-sub">
                    <a class="sidenav-item-link" href="{{ route('admin.speakers.index') }}">
                        <i class="mdi mdi-volume-high"></i>
                        <span class="nav-text">Speakers</span>
                    </a>

                </li>
                <li
                    class="has-sub {{ request()->routeIs('admin.products.manage.tabs') || request()->routeIs('admin.products.add') || request()->routeIs('admin.products.add') || request()->routeIs('admin.products.index') || request()->routeIs('admin.products.child_index') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-palette-advanced"></i>
                        <span class="nav-text">Products</span> <b class="caret"></b>
                    </a>
                    <div
                        class="collapse {{ request()->routeIs('admin.products.manage.tabs') || request()->routeIs('admin.products.index') ? 'show' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('admin.products.add') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products.add') }}">
                                    <span class="nav-text">Add Products</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products.index') }}">
                                    <span class="nav-text">View Products</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.products.child_index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products.child_index') }}">
                                    <span class="nav-text">Manage Images</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('admin.products.manage.tabs') || request()->routeIs('admin.products.manual') || request()->routeIs('admin.products.description') || request()->routeIs('admin.products.artical') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products.manage.tabs') }}">
                                    <span class="nav-text">Manage Tabs</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="{{ request()->routeIs('admin..package.add') ? 'active' : '' }}">
                    <hr>
                    <a class="sidenav-item-link" href="{{ route('admin.package.add') }}">
                        <i class="mdi mdi-package"></i>
                        <span class="nav-text">Package Details</span>
                    </a>
                    <hr>
                </li>
                <li class="{{ request()->routeIs('admin.assemble.add') ? 'active' : '' }}">
                    <hr>
                    <a class="sidenav-item-link" href="{{ route('admin.assemble.add') }}">
                        <i class="mdi mdi-robot-industrial"></i>
                        <span class="nav-text">Product Assemble Parts</span>
                    </a>
                    <hr>
                </li>
                <li class="{{ request()->routeIs('admin.layout.attachment') ? 'active' : '' }}">

                    <a class="sidenav-item-link" href="{{ route('admin.layout.attachment') }}">
                        <i class="mdi mdi-attachment"></i>
                        <span class="nav-text">Layout Attachments</span>
                    </a>
                    <hr>
                </li>
                <li class="{{ request()->routeIs('admin.fusion.attachment') ? 'active' : '' }}">

                    <a class="sidenav-item-link" href="{{ route('admin.fusion.attachment') }}">
                        <i class="mdi mdi-paperclip"></i>
                        <span class="nav-text">Fusion Attachments</span>
                    </a>
                    <hr>
                </li>
                <li
                    class="has-sub {{ request()->routeIs('admin.products_associated.add') || request()->routeIs('admin.products_associated.index') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-cube-outline"></i>
                        <span class="nav-text">Products Association</span> <b class="caret"></b>
                    </a>
                    <div
                        class="collapse {{ request()->routeIs('admin.products_associated.add') || request()->routeIs('admin.products_associated.index') ? 'show' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('admin.products_associated.add') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products_associated.add') }}">
                                    <span class="nav-text">Add </span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.products_associated.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.products_associated.index') }}">
                                    <span class="nav-text">View </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="{{ request()->routeIs('admin.parts.index') ? 'active' : '' }} has-sub">
                    <a class="sidenav-item-link" href="{{ route('admin.parts.index') }}">
                        <i class="mdi mdi-wrench"></i>
                        <span class="nav-text">Parts - Index</span>
                    </a>

                </li>
                <li class="{{ request()->routeIs('admin.parts.add') ? 'active' : '' }} has-sub">
                    <a class="sidenav-item-link" href="{{ route('admin.parts.add') }}">
                        <i class="mdi mdi-settings"></i>
                        <span class="nav-text">Add Parts</span>
                    </a>

                </li>
                <li
                    class="has-sub {{ request()->routeIs('admin.product_parts.add') || request()->routeIs('admin.product_parts.index') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-tools"></i>
                        <span class="nav-text">Product-Parts</span> <b class="caret"></b>
                    </a>
                    <div
                        class="collapse {{ request()->routeIs('admin.product_parts.add') || request()->routeIs('admin.product_parts.index') ? 'show' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('admin.product_parts.add') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.product_parts.add') }}">
                                    <span class="nav-text">Add Product-Parts</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.product_parts.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.product_parts.index') }}">
                                    <span class="nav-text">View Product-Parts</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- Authentication -->
                <li class="{{ request()->routeIs('admin.sales_tax') ? 'active' : '' }}">
                    <hr>
                    <a class="sidenav-item-link" href="{{ route('admin.sales_tax') }}">
                        <i class="mdi mdi-percent"></i>
                        <span class="nav-text">Sales Tax</span>
                    </a>

                </li>
                <li class="{{ request()->routeIs('admin.faq') ? 'active' : '' }}">
                    <hr>
                    <a class="sidenav-item-link" href="{{ route('admin.faq') }}">
                        <i class="mdi mdi-help-circle"></i>
                        <span class="nav-text">FAQ</span>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>
