<div class="sidebar" id="sidebar">
   <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li class="submenu-open">
               <h6 class="submenu-hdr">Main</h6>
               <ul>
                  <li class="active">
                     <a href="{{ route('home') }}"><i data-feather="grid"></i><span>Dashboard</span></a>
                  </li>
                  
               </ul>
            </li>
            <li class="submenu-open">
               <h6 class="submenu-hdr">Products</h6>
               <ul>
                  <li><a href="{{ route('master.item.index') }}"><i data-feather="box"></i><span>Products</span></a></li>
                  <li><a href="{{ route('master.item.create') }}"><i data-feather="plus-square"></i><span>Create Product</span></a></li>
               </ul>
            </li>
            <li class="submenu-open">
               <h6 class="submenu-hdr">Sales</h6>
               <ul>
                  <li><a href="#"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>
                  <li><a href="#"><i data-feather="file-text"></i><span>Invoices</span></a></li>
               </ul>
            </li>
            <li class="submenu-open">
               <h6 class="submenu-hdr">Purchases</h6>
               <ul>
                  <li><a href="{{ route('po.index') }}"><i data-feather="shopping-bag"></i><span>Purchases</span></a></li>
               </ul>
            </li>
            
            <li class="submenu-open">
               <h6 class="submenu-hdr">Reports</h6>
               <ul>
                  <li><a href="#"><i data-feather="bar-chart-2"></i><span>Sales Report</span></a></li>
                  <li><a href="#"><i data-feather="pie-chart"></i><span>Purchase report</span></a></li>
                  <li><a href="#"><i data-feather="credit-card"></i><span>Inventory Report</span></a></li>
                  <li><a href="#"><i data-feather="file"></i><span>Invoice Report</span></a></li>
                  <li><a href="#"><i data-feather="bar-chart"></i><span>Purchase Report</span></a></li>
               </ul>
            </li>

            <li class="submenu-open">
               <h6 class="submenu-hdr">Master</h6>
               <ul>
                  
                  <li><a href="{{ route('master.category.index') }}"><i data-feather="codepen"></i><span>Category</span></a></li>
                  <li><a href="{{ route('master.brand.index') }}"><i data-feather="tag"></i><span>Brands</span></a></li>
                  <li><a href="{{ route('master.unit.index') }}"><i data-feather="anchor"></i><span>Unit</span></a></li>
                  <li><a href="{{ route('master.vendor.index') }}"><i data-feather="anchor"></i><span>Vendors</span></a></li>
                  <li><a href="{{ route('master.hsn.index') }}"><i data-feather="anchor"></i><span>HSN Codes</span></a></li>
                  
               </ul>
            </li>

         </ul>
      </div>
   </div>
</div>